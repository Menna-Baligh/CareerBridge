<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
{
    public  $industries = ['IT','Finance','HR','Sales','Marketing','Operations','Legal','Accounting','Procurement','Supply Chain','Technology'];

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
        $industries = $this->industries;
        return view('company.create',compact('industries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        $validated = $request->validated();
        $owner = User::create([
            'name' => $validated['owner_name'],
            'email' => $validated['owner_email'],
            'password' => Hash::make($validated['password']),
        ]);
        if(!$owner){
            return redirect()->route('company.create')->with('error','Owner could not be created');
        }
        Company::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'industry' => $validated['industry'],
            'website' => $validated['website'],
            'ownerId' => $owner->id
        ]);
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
        $industries = $this->industries;
        return view('company.edit',compact('company','industries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $company = Company::findOrFail($id);
        $company->update([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'industry' => $validated['industry'],
            'website' => $validated['website'],
        ]);
        $ownerData = [];
        $ownerData['name'] = $validated['owner_name'];
        if($validated['password']){
            $ownerData['password'] = Hash::make($validated['password']);
        }
        $company->owner()->update($ownerData);
        if($request->query('redirectToShow') == true){
            return redirect()->route('company.show',$company->id)->with('success','company Updated Successfully');
        }
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
