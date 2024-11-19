<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobsRequest;
use App\Http\Requests\UpdateJobsRequest;
use App\Models\Category;
use App\Models\CompanyJob;
use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();
    $companyJobs = $user->company ? $user->company->companyJobs : collect();
    return view('employer.companyJobs.index', compact('companyJobs', 'user'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('employer.companyJobs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobsRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailJobsPath = $request->file('thumbnail')->store('thumbnailJobs', 'public');
                $validated['thumbnail'] = $thumbnailJobsPath;
            }

            $validated['company_id'] = Auth::user()->company->id;
            $validated['slug'] = Str::slug($request->name);
            $validated['is_open'] = true;
            $companyJob = Auth::user()->company->companyJobs()->create($validated);

            $responsibilities = array_map(function($responsibility) {
                return ['name' => $responsibility];
            }, $request->responsibilities);
    
            $qualifications = array_map(function($qualification) {
                return ['name' => $qualification];
            }, $request->qualifications);
    
            $companyJob->responsibilities()->createMany($responsibilities);
            $companyJob->qualifications()->createMany($qualifications);
        });
        return redirect()->route('employer.companyJobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyJob $companyJob)
    {
        return view('employer.companyJobs.show', compact('companyJob'));
    }

    public function candidate(JobCandidate $jobCandidate)
    {
        return view('employer.companyJobs.manageCandidate', compact('jobCandidate'));
    }

    public function downloadResume($id)
    {
        $candidate = JobCandidate::findOrFail($id);
        $resumePath = storage_path('app/public/resumes/' . $candidate->resume);

        Log::info('Resume Path: ' . $resumePath);

        if (file_exists($resumePath)) {
            Log::info('File exists: ' . $resumePath);
            return response()->download($resumePath);
        } else {
            Log::error('Resume not found at path: ' . $resumePath);
            return redirect()->back()->with('error', 'Resume not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyJob $companyJob)
    {
        $categories = Category::all();
        return view('employer.companyJobs.edit', compact('companyJob', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobsRequest $request, CompanyJob $companyJob)
    {
        DB::transaction(function() use($request, $companyJob) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                if ($companyJob->thumbnail) {
                    Storage::disk('public')->delete($companyJob->thumbnail);
                }
            
                $thumbnailJobsPath = $request->file('thumbnail')->store('thumbnailJobs', 'public');
                $validated['thumbnail'] = $thumbnailJobsPath;
            }

            $validated['slug'] = Str::slug($request->name);
            $companyJob->update($validated);

            $currentResponsibilities = $companyJob->responsibilities->pluck('name')->toArray();
            $newResponsibilities = $request->responsibilities;

            foreach ($newResponsibilities as $newResponsibility) {
                if (!in_array($newResponsibility, $currentResponsibilities)) {
                    $companyJob->responsibilities()->create(['name' => $newResponsibility]);
                }
            }

            foreach ($currentResponsibilities as $currentResponsibility) {
                if (!in_array($currentResponsibility, $newResponsibilities)) {
                    $companyJob->responsibilities()->where('name', $currentResponsibility)->delete();
                }
            }

            $currentQualifications = $companyJob->qualifications->pluck('name')->toArray();
            $newQualifications = $request->qualifications;

            foreach ($newQualifications as $newQualification) {
                if (!in_array($newQualification, $currentQualifications)) {
                    $companyJob->qualifications()->create(['name' => $newQualification]);
                }
            }

            foreach ($currentQualifications as $currentQualification) {
                if (!in_array($currentQualification, $newQualifications)) {
                    $companyJob->qualifications()->where('name', $currentQualification)->delete();
                }
            }
        });
        return redirect()->route('employer.companyJobs.show', $companyJob);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyJob $companyJob)
    {

        if ($companyJob->thumbnail) {
            Storage::disk('public')->delete($companyJob->thumbnail);
        }

        $companyJob->delete();
        return redirect()->route('employer.companyJobs.index');
    }
}
