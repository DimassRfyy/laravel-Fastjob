<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyJob;
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

    public function details(CompanyJob $companyJob) {
        $jobRandom = CompanyJob::where('id', '!=', $companyJob->id)->inRandomOrder()->limit(8)->get();
        return view('front.details', compact('companyJob', 'jobRandom'));
    }
}
