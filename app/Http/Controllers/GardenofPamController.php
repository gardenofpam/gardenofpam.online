<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use Illuminate\View\View;

class GardenofPamController extends Controller
{
    public function index(): View
    {
        $profile = Profile::forNiche('gardenofpam');
        $projects = Project::forNiche('gardenofpam')
            ->publiclyVisible()
            ->orderBy('sort_order')
            ->get();

        return view('gardenofpam.index', compact('profile', 'projects'));
    }
}
