<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,svg,webp',
        ]);

        if($request->hasFile('icon')) {
            $categoryIconPath = $request->file('icon')->store('categories', 'public');
            $validate['icon'] = $categoryIconPath;
        }
        $validate['slug'] = Str::slug($validate['name']);

        Category::create($validate);
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'sometimes|image|mimes:jpeg,png,jpg,svg,webp',
        ]);

        if ($request->hasFile('icon')) {
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }
    
            $categoryIconPath = $request->file('icon')->store('categories', 'public');
            $validate['icon'] = $categoryIconPath;
        }
    
        $validate['slug'] = Str::slug($validate['name']);

        $category->update($validate);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->icon) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
