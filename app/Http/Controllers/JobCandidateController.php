<?php

namespace App\Http\Controllers;

use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobApplications = JobCandidate::where('user_id', Auth::user()->id)->get();
        return view('employee.applications.index', compact('jobApplications'));
    }

    public function approve($id)
{
    $jobCandidate = JobCandidate::find($id);
    $jobCandidate->is_hired = true;
    $jobCandidate->save();

    return redirect()->back()->with('success', 'Candidate approved successfully.');
}

    public function reject($id)
    {
        $jobCandidate = JobCandidate::find($id);
        $jobCandidate->is_hired = false;
        $jobCandidate->save();

        return redirect()->back()->with('success', 'Candidate rejected successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobCandidate $jobCandidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCandidate $jobCandidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobCandidate $jobCandidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCandidate $jobCandidate)
    {
        //
    }
}
