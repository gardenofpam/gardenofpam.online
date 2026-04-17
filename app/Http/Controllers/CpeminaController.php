<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;

class CpeminaController extends Controller
{
    public function index()
    {
        $profile = Profile::forNiche('cpemina');

        $projects = Project::forNiche('cpemina')
                           ->published()
                           ->orderBy('sort_order')
                           ->get();

        return view('cpemina.index', compact('profile', 'projects'));
    }
}