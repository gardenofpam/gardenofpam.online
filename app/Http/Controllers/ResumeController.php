<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResumeController extends Controller
{
    public function view()
    {
        $resume = $this->getActiveResume();
        $filename = $this->buildFilename($resume);

        if ($resume->resume_file && Storage::disk('public')->exists($resume->resume_file)) {
            return Storage::disk('public')->response(
                $resume->resume_file,
                $filename,
                ['Content-Type' => 'application/pdf']
            );
        }

        return $this->buildPdf($resume)->stream($filename);
    }

    public function download()
    {
        $resume = $this->getActiveResume();

        if ($resume->resume_file && Storage::disk('public')->exists($resume->resume_file)) {
            return Storage::disk('public')->download($resume->resume_file, $this->buildFilename($resume));
        }

        return $this->buildPdf($resume)->download($this->buildFilename($resume));
    }

    protected function getActiveResume(): Resume
    {
        $resume = Resume::getActive();

        if (! $resume) {
            abort(404, 'Resume not found');
        }

        return $resume;
    }

    protected function buildPdf(Resume $resume)
    {
        return Pdf::loadView('resume.pdf', compact('resume'));
    }

    protected function buildFilename(Resume $resume): string
    {
        $name = $resume->personal_info['name'] ?? 'Paul Albert Mina';
        $basename = Str::slug($name) ?: 'paul-albert-mina';

        return $basename . '-resume.pdf';
    }
}
