<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Resume;

class MinaPaulDataController extends Controller
{
    public function index()
    {
        $profile = Profile::forNiche('minapauldata');

        $projects = Project::forNiche('minapauldata')
                           ->publiclyVisible()
                           ->orderBy('sort_order')
                           ->get();

        $certificates = Certificate::forNiche('minapauldata')
                                   ->published()
                                   ->orderBy('sort_order')
                                   ->get();

        $resume = Resume::getActiveForNiche('minapauldata');

        return view('minapauldata.index', compact(
            'profile',
            'projects',
            'certificates',
            'resume'
        ));
    }
}
