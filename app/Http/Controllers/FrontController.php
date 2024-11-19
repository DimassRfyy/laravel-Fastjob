<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyJob;
use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index() {
        $user = Auth::user();
        $categories = Category::all();
        $companyJobs = CompanyJob::all();
        return view('front.index', compact('categories','companyJobs','user'));
    }
    public function search(Request $request) {
        $user = Auth::user();
        $categories = Category::all();
        $query = $request->input('query');

        $companyJobs = CompanyJob::where('name', 'like', '%' . $query . '%')
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->orWhereHas('company', function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->paginate(4);

        return view('front.search', compact('categories', 'companyJobs', 'user', 'query'));
    }

    public function category(Category $category) {
        $companyJobs = $category->companyJobs()->paginate(4);
        return view('front.category', compact('category','companyJobs'));
    }

    public function details(CompanyJob $companyJob) {
        $jobRandom = CompanyJob::where('id', '!=', $companyJob->id)->inRandomOrder()->limit(8)->get();
        return view('front.details', compact('companyJob', 'jobRandom'));
    }

    public function apply(CompanyJob $companyJob) {
        return view('front.apply', compact('companyJob'));
    }

    public function store_apply(Request $request, CompanyJob $companyJob) {
        $validate = $request->validate([
            'resume' => 'required|mimes:pdf,docx|max:2000',
            'message' => 'required|string',
        ]);
    
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $validate['resume'] = $resumePath;
        }
    
        $validate['user_id'] = Auth::id();
        $validate['company_job_id'] = $companyJob->id;
        $validate['is_hired'] = null;

        JobCandidate::create($validate);
    
        return view('front.success');
    }
}
