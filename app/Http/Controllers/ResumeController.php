<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    public function download()
    {
        $resume = Resume::getActive();

        if (!$resume) {
            abort(404, 'Resume not found');
        }

        $pdf = Pdf::loadView('resume.pdf', compact('resume'));

        return $pdf->download('Paul-Albert-Mina-Resume.pdf');
    }
}