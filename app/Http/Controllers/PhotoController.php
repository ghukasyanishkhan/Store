<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Item $item)
    {
        try {
            $request->validate([
                'photo' => 'image|max:2048'
            ]);
            DB::beginTransaction();
            if ($request->hasFile('photo')) {
                $path = 'photos/category_' . $item->category_id;
                $photoPath = $request->photo->store($path, 'public');
                $photo = new Photo();
                $photo->item_id = $item->id;
                $photo->path = $photoPath;
                $photo->save();
            }
            DB::commit();
            return back()->with('success', 'Photo stored successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to store photo. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        try {
            DB::beginTransaction();
            Storage::delete('public/' . $photo->path);
            $photo->delete();
            DB::commit();
            return back()->with('success', 'Photo deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete Photo');
        }
    }
}
