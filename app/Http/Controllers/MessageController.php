<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Mail\VerifyMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function sendOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'from_niche'   => 'required|in:gardenofpam,cpemina,minapauldata',
                'sender_name'  => 'required|string|max:255',
                'sender_email' => 'required|email',
                'subject'      => 'required|string|max:255',
                'body'         => 'required|string',
            ]);

            // Generate 6-digit OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            Log::info('OTP Generated: ' . $otp);

            // Save message
            $contactMessage = Message::create([
                'from_niche'         => $validated['from_niche'],
                'sender_name'        => $validated['sender_name'],
                'sender_email'       => $validated['sender_email'],
                'subject'            => $validated['subject'],
                'body'               => $validated['body'],
                'verification_token' => Str::random(64),
                'otp_code'           => $otp,
                'otp_expires_at'     => now()->addMinutes(10),
                'otp_verified'       => false,
                'email_verified'     => false,
                'is_read'            => false,
            ]);

            // Send OTP email
            Mail::to($validated['sender_email'])
                ->send(new VerifyMessageMail($contactMessage, $otp));

            return response()->json([
                'success'    => true,
                'message_id' => $contactMessage->id,
                'email'      => $validated['sender_email'],
            ]);

        } catch (\Exception $e) {
            log::error('sendOtp error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ]);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $request->validate([
                'message_id' => 'required|exists:messages,id',
                'otp'        => 'required|string',
            ]);

            $contactMessage = Message::findOrFail($request->message_id);

            log::info('Verifying OTP', [
                'input'   => $request->otp,
                'stored'  => $contactMessage->otp_code,
                'expires' => $contactMessage->otp_expires_at,
                'now'     => now(),
            ]);

            // Check if already verified
            if ($contactMessage->otp_verified) {
                return response()->json([
                    'success' => false,
                    'error'   => 'This OTP has already been used.',
                ]);
            }

            // Check if OTP expired
            if (now()->isAfter($contactMessage->otp_expires_at)) {
                return response()->json([
                    'success' => false,
                    'error'   => 'OTP has expired. Please send your message again.',
                ]);
            }

            // Check OTP match
            $inputOtp  = trim($request->otp);
            $storedOtp = trim($contactMessage->otp_code);

            if ($inputOtp !== $storedOtp) {
                return response()->json([
                    'success' => false,
                    'error'   => 'Invalid OTP code. Please try again.',
                ]);
            }

            // Mark as verified
            $contactMessage->update([
                'otp_verified'   => true,
                'email_verified' => true,
                'verified_at'    => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
            ]);

        } catch (\Exception $e) {
            log::error('verifyOtp error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ]);
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            $request->validate([
                'message_id' => 'required|exists:messages,id',
            ]);

            $contactMessage = Message::findOrFail($request->message_id);

            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            log::info('Resend OTP Generated: ' . $otp);

            $contactMessage->update([
                'otp_code'       => $otp,
                'otp_expires_at' => now()->addMinutes(10),
                'otp_verified'   => false,
            ]);

            Mail::to($contactMessage->sender_email)
                ->send(new VerifyMessageMail($contactMessage, $otp));

            return response()->json([
                'success' => true,
                'message' => 'New OTP sent to your email.',
            ]);

        } catch (\Exception $e) {
            log::error('resendOtp error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
            ]);
        }
    }
}