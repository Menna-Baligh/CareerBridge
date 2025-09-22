<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Company::latest();
        if($request->has('archived')){
            $query = Company::onlyTrashed();
        }
        $companies = $query->paginate(10)->onEachSide(1);
        return view('company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        $validated = $request->validated();
        Company::create($validated);
        return redirect()->route('company.index')->with('success','company Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return view('company.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $company = Company::findOrFail($id);
        $company->update($validated);
        return redirect()->route('company.index')->with('success','company Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('company.index')->with('success','company Archived Successfully');
    }
    public function restore(string $id)
    {
        $company = Company::onlyTrashed()->findOrFail($id);
        $company->restore();
        return redirect()->route('company.index',['archived' => 'true'])->with('success','company Restored Successfully');
    }
}
