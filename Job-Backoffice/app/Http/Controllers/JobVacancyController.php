<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobVacany;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Requests\JobVacancyCreateRequest;
use App\Http\Requests\JobVacancyUpdateRequest;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobVacany::latest();
        if(auth()->user()->role == 'company-owner'){
            $query->where('companyId', auth()->user()->company->id);
        }
        if($request->has('archived')){
            $query = JobVacany::onlyTrashed();
        }
        $jobVacancies = $query->paginate(10)->onEachSide(1);
        return view('job-vacancy.index',compact('jobVacancies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $jobCategories = JobCategory::all();
        return view('job-vacancy.create',compact('companies','jobCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacancyCreateRequest $request)
    {
        $validated = $request->validated();
        JobVacany::create($validated);
        return redirect()->route('job-vacancy.index')->with('success','Job Vacancy Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobVacancy = JobVacany::findOrFail($id);
        return view('job-vacancy.show',compact('jobVacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobVacancy = JobVacany::findOrFail($id);
        $types = ['Full-Time','Contract','Remote','Hybrid'];
        $companies = Company::all();
        $categories = JobCategory::all();
        return view('job-vacancy.edit',compact('jobVacancy','types','companies','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobVacancyUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $jobVacancy = JobVacany::findOrFail($id);
        $jobVacancy->update($validated);
        if($request->query('redirectToShow') == true){
            return redirect()->route('job-vacancy.show',$jobVacancy->id)->with('success','Job Vacancy Updated Successfully');
        }
        return redirect()->route('job-vacancy.index')->with('success','Job Vacancy Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobVacancy = JobVacany::findOrFail($id);
        $jobVacancy->delete();
        return redirect()->route('job-vacancy.index')->with('success','Job Vacancy Archived Successfully');
    }
    public function restore(string $id)
    {
        $jobVacancy = JobVacany::onlyTrashed()->findOrFail($id);
        $jobVacancy->restore();
        return redirect()->route('job-vacancy.index',['archived' => true])->with('success','Job Vacancy Restored Successfully');
    }
}
