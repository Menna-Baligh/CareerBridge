<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacany;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // last 30 days active users (job seekers)
        $activeUsers = User::where('last_login_at', '>=', now()->subDays(30))
                    ->where('role', 'job-seeker')->count();

        // total jobs (not archived)
        $totalJobs = JobVacany::whereNull('deleted_at')->count();

        // total applications (not archived)
        $totalApplications = JobApplication::whereNull('deleted_at')->count();

        $analytics =[
            'activeUsers' => $activeUsers,
            'totalJobs' => $totalJobs,
            'totalApplications' => $totalApplications,
        ];

        // most applied jobs
        $mostAppliedJobs = JobVacany::withCount('jobApplications as TotalCount')
                        ->whereNull('deleted_at')
                        ->orderBy('TotalCount', 'desc')
                        ->limit(5)
                        ->get();

        return view('dashboard.index',compact('analytics','mostAppliedJobs'));
    }
}
