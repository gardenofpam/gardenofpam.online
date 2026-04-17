<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Message</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #FAF9F5;
            color: #061B0E;
            padding: 40px 20px;
        }
        .container {
            max-width: 560px;
            margin: 0 auto;
            background: #F5F0E8;
            border-radius: 16px;
            border: 1px solid rgba(6,27,14,0.08);
            overflow: hidden;
        }
        .header {
            background: #061B0E;
            padding: 36px 40px;
        }
        .header-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(250,249,245,0.40);
            margin-bottom: 8px;
        }
        .header-title {
            font-size: 24px;
            font-weight: 700;
            color: #FAF9F5;
            line-height: 1.3;
        }
        .body {
            padding: 40px;
        }
        .greeting {
            font-size: 16px;
            color: #061B0E;
            margin-bottom: 16px;
            line-height: 1.6;
        }
        .description {
            font-size: 14px;
            color: rgba(6,27,14,0.60);
            line-height: 1.7;
            margin-bottom: 32px;
        }
        .otp-box {
            text-align: center;
            background: #FAF9F5;
            border: 1px solid rgba(6,27,14,0.10);
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 32px;
        }
        .otp-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(6,27,14,0.35);
            margin-bottom: 12px;
        }
        .otp-code {
            font-size: 48px;
            font-weight: 700;
            color: #061B0E;
            letter-spacing: 0.15em;
            font-family: 'Courier New', monospace;
        }
        .otp-expiry {
            font-size: 12px;
            color: rgba(6,27,14,0.35);
            margin-top: 12px;
        }
        .message-box {
            background: #FAF9F5;
            border: 1px solid rgba(6,27,14,0.08);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 32px;
        }
        .message-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.10em;
            text-transform: uppercase;
            color: rgba(6,27,14,0.35);
            margin-bottom: 8px;
        }
        .message-subject {
            font-size: 15px;
            font-weight: 600;
            color: #061B0E;
            margin-bottom: 10px;
        }
        .message-body {
            font-size: 13px;
            color: rgba(6,27,14,0.60);
            line-height: 1.6;
        }
        .divider {
            height: 1px;
            background: rgba(6,27,14,0.08);
            margin: 14px 0;
        }
        .note {
            font-size: 12px;
            color: rgba(6,27,14,0.35);
            line-height: 1.6;
            text-align: center;
        }
        .footer {
            background: #061B0E;
            padding: 24px 40px;
            text-align: center;
        }
        .footer p {
            font-size: 11px;
            color: rgba(250,249,245,0.30);
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <p class="header-label">Paul Albert Mina · Portfolio</p>
            <p class="header-title">Your Verification<br>Code.</p>
        </div>

        <div class="body">

            <p class="greeting">
                Hello, <strong>{{ $contactMessage->sender_name }}</strong>.
            </p>

            <p class="description">
                You are sending a message through the
                <strong>{{ ucfirst($contactMessage->from_niche) }}</strong> portfolio.
                Enter the code below to verify your email and complete sending.
            </p>

            {{-- OTP Code --}}
            <div class="otp-box">
                <p class="otp-label">Your Verification Code</p>
                <p class="otp-code">{{ $otp }}</p>
                <p class="otp-expiry">This code expires in 10 minutes.</p>
            </div>

            {{-- Message Preview --}}
            <div class="message-box">
                <p class="message-label">Your Message</p>
                <p class="message-subject">{{ $contactMessage->subject }}</p>
                <div class="divider"></div>
                <p class="message-body">{{ $contactMessage->body }}</p>
            </div>

            <p class="note">
                If you did not send this message, please ignore this email.
            </p>

        </div>

        <div class="footer">
            <p>
                © {{ date('Y') }} Paul Albert Mina Portfolio<br>
                This is an automated email — please do not reply.
            </p>
        </div>

    </div>
</body>
</html>