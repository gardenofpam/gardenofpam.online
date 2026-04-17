<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class GardenofPamController extends Controller
{
    public function index()
    {
        $profile = Profile::forNiche('gardenofpam');

        return view('gardenofpam.index', compact('profile'));
    }
}