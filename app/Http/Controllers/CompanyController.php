<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myCompany = Auth::user()->company;
        return view('employer.company.index', compact('myCompany'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employer.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp,svg',
            'about' => 'required|string',
        ]);

        if($request->hasFile('logo')) {
            $logoCompanyPath = $request->file('logo')->store('logoCompany', 'public');
            $validate['logo'] = $logoCompanyPath;
        }

        $validate['slug'] = Str::slug($validate['name']);
        $validate['user_id'] = Auth::user()->id;
        Company::create($validate);
        return redirect()->route('employer.company.index')->with('success', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('employer.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg,webp,svg',
            'about' => 'required|string',
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
    
            $companyLogoPath = $request->file('logo')->store('logoCompany', 'public');
            $validate['logo'] = $companyLogoPath;
            }

        $validate['slug'] = Str::slug($validate['name']);
        $validate['user_id'] = Auth::user()->id;
        $company->update($validate);
        return redirect()->route('employer.company.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();
        return redirect()->route('employer.company.index')->with('success', 'Company deleted successfully');
    }
}
