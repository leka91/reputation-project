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
        $locations = $this->dashboardService->getLocationsForDashboard($id);
        
        return view('pages.dashboard', compact('locations'));
    }

    public function dashboardPost(DashboardPostRequest $request)
    {
        try {
            $organization = $this->dashboardService->findOrganizationByColumn('domain', $request->domain);

            return redirect()->route('dashboard', $organization->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function dashboardLocation($id, $locationId)
    {
        try {
            $organization = $this->dashboardService->findOrganizationByColumn('id', $id);
            $location = $this->dashboardService->findLocationByColumn('id', $locationId);

            // dump($location);

            return view('pages.location', compact('location'));
        } catch (\Exception $e) {
            return redirect()->route('landingPage')->with('error', $e->getMessage());
        }
    }
}
