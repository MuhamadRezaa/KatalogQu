<?php

namespace App\Http\Controllers;

use App\Models\CatalogTemplate;
use App\Models\UserStore;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display the landing page with a selection of catalog templates.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch the 8 latest, active catalog templates to display on the welcome page.
        $templates = CatalogTemplate::where('is_active', true)
            ->get();
        $templateCount = CatalogTemplate::count();

        $user_stores = UserStore::count();

        return view('welcome', compact('templates', 'templateCount', 'user_stores'));
    }
}
