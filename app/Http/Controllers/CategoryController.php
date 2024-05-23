<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller

{
    public function getCategories()
    {
        try {
            $categories = Category::orderBy('created_at', 'desc')->get();
            return view('dashboard', ['categories' => $categories]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch categories. Please try again.');
        }
    }

    public function destroy(Category $category)
    { try {
        DB::beginTransaction();
        $directory = 'public/photos/category_'.$category->id;
        Storage::deleteDirectory($directory);
        $category->delete();
        DB::commit();
        return back()->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
        DB::rollBack();
            return back()->with('error', 'Failed to delete category. Please try again.');
        }
    }


    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
        ]);
        try {
            $category = new Category();
            $category->type = $validatedData['type'];
            $category->save();
            return back()->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create category');
        }
    }

}
