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

        // conversion rate
        $conversionRates = JobVacany::withCount('jobApplications as TotalCount')
                        ->having('TotalCount', '>', 0)
                        ->limit(5)
                        ->orderBy('TotalCount', 'desc')
                        ->get()
                        ->map(function ($job) {
                            if($job->viewCount > 0){
                                $job->conversionRate = round(($job->TotalCount / $job->viewCount) * 100,2);
                            }else{
                                $job->conversionRate = 0;
                            }
                            return $job;
                        });
        return view('dashboard.index',compact('analytics','mostAppliedJobs','conversionRates'));
    }
}
