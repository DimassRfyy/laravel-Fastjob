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
}
