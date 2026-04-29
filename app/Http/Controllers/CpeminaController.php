<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use Illuminate\View\View;

class CpeminaController extends Controller
{
    public function index(): View
    {
        $profile = Profile::forNiche('cpemina');

        $projects = Project::forNiche('cpemina')
                           ->publiclyVisible()
                           ->orderBy('sort_order')
                           ->get();

        return view('cpemina.index', compact('profile', 'projects'));
    }

    public function show(string $slug): View
    {
        $project = Project::forNiche('cpemina')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProjects = Project::forNiche('cpemina')
            ->published()
            ->whereKeyNot($project->getKey())
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('cpemina.project', compact('project', 'relatedProjects'));
    }
}
