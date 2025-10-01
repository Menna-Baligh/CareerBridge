<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationUpdateRequest;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobApplication::latest();
        if(auth()->user()->role == 'company-owner'){
            $query->whereHas('jobVacany', function($q){
                $q->where('companyId', auth()->user()->company->id);
            });
        }
        if($request->has('archived')){
            $query = JobApplication::onlyTrashed();
        }
        $jobApplications = $query->paginate(10)->onEachSide(1);
        return view('application.index',compact('jobApplications'));
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application = JobApplication::findOrFail($id);
        return view('application.show',compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $application = JobApplication::findOrFail($id);
        return view('application.edit',compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobApplicationUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $application = JobApplication::findOrFail($id);
        $application->update($validated);
        if($request->query('redirectToShow') == true){
            return redirect()->route('application.show',$application->id)->with('success','Application Updated Successfully');
        }
        return redirect()->route('application.index')->with('success','Application Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = JobApplication::findOrFail($id);
        $application->delete();
        return redirect()->route('application.index')->with('success','Application Archived Successfully');
    }
    public function restore(string $id)
    {
        $application = JobApplication::onlyTrashed()->findOrFail($id);
        $application->restore();
        return redirect()->route('application.index',['archived' => true])->with('success','Application Restored Successfully');
    }
}
