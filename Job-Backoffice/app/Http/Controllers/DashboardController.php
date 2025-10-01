<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacany;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->role == 'admin'){
            $analytics = $this->adminDashboard();
        }else{
            $analytics = $this->companyOwnerDashboard();
        }
        return view('dashboard.index',compact('analytics'));
    }
    public function adminDashboard(){
        // last 30 days active users (job seekers)
        $activeUsers = User::where('last_login_at', '>=', now()->subDays(30))
                    ->where('role', 'job-seeker')->count();

        // total jobs (not archived)
        $totalJobs = JobVacany::whereNull('deleted_at')->count();

        // total applications (not archived)
        $totalApplications = JobApplication::whereNull('deleted_at')->count();



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
            $analytics =[
            'activeUsers' => $activeUsers,
            'totalJobs' => $totalJobs,
            'totalApplications' => $totalApplications,
            'mostAppliedJobs' => $mostAppliedJobs,
            'conversionRates' => $conversionRates,
            ];
            return $analytics;
    }
    public function companyOwnerDashboard(){
        $company = auth()->user()->company;
        //* filter active users by applying to jobs of the company
        $activeUsers = User::where('last_login_at', '>=', now()->subDays(30))
                    ->where('role', 'job-seeker')
                    ->whereHas('jobApplications',function($query) use ($company){
                        $query->whereIn('jobVacancyId',$company->jobVacancies->pluck('id'));
                        })->count();

        // total jobs  of the company
        $totalJobs = $company->jobVacancies->count();

        // total applications to the company
        $totalApplications = JobApplication::whereIn('jobVacancyId',$company->jobVacancies->pluck('id'))->count();

        // most applied jobs of the company
        $mostAppliedJobs = JobVacany::withCount('jobApplications as TotalCount')
                        ->whereIn('id',$company->jobVacancies->pluck('id'))
                        ->orderBy('TotalCount', 'desc')
                        ->limit(5)
                        ->get();
        // conversion rate of the company
        $conversionRates = JobVacany::withCount('jobApplications as TotalCount')
                        ->whereIn('id',$company->jobVacancies->pluck('id'))
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

        $analytics =[
            'activeUsers' => $activeUsers,
            'totalJobs' => $totalJobs,
            'totalApplications' => $totalApplications,
            'mostAppliedJobs' => $mostAppliedJobs,
            'conversionRates' => $conversionRates,
            ];
            return $analytics;
    }
}
