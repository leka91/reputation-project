<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardPostRequest;
use App\Interfaces\DashboardInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    
    public function landingPage()
    {
        return view('pages.landing-page');
    }

    public function dashboard($id)
    {
        $locations = $this->dashboardService->getLocations($id);

        dd($locations);
        
        return view('pages.dashboard', compact('locations'));
    }

    public function dashboardPost(DashboardPostRequest $request)
    {
        try {
            $organization = $this->dashboardService->findOrganizationByDomain($request->domain);

            return redirect()->route('dashboard', $organization->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
