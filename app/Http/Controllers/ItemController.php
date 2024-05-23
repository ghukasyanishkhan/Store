<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    public function userSearch(Request $request)
    {
        $query = $request->validate([
            'query' => 'string|max:20'
        ]);

        $items = Item::where('name', 'LIKE', "%{$query['query']}%")
            ->get();

        return view('user.home', compact('items'));
    }
    public function adminSearch(Request $request)
    {
        $query = $request->validate([
            'query' => 'string|max:20'
        ]);

        $items = Item::where('name', 'LIKE', "%{$query['query']}%")
            ->get();

        return view('dashboard', compact('items'));
    }


    public function getItems(Category $category)
    {
        try {
            $items = $category->items()->get();
            return view('dashboard', ['items' => $items]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch items. Please try again.');
        }
    }

    public function getItemsHome(Category $category)
    {
        try {
            $categories = Category::orderBy('created_at', 'desc')->get();
            $items = $category->items()->get();
            return view('user.home', ['items' => $items, 'categories' => $categories]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch items. Please try again.');
        }
    }

    public function create(Category $category)
    {
        return view('admin.components.createItem', ['category' => $category]);
    }

    public function store(Category $category, Request $request)
    {
        try {
            $request->validate([
                'photo' => 'image|max:2048',
                'name' => 'required|string|max:30',
                'price' => 'required|numeric',
                'description' => 'required|string'
            ]);

            DB::beginTransaction();
            $item = new Item();
            $item->category_id = $category->id;
            $item->name = $request->name;
            $item->price = $request->price;
            $item->description = $request->description;
            $item->save();

            if ($request->hasFile('photo')) {
                $categoryDirectory = 'category_' . $category->id;
                $photoPath = $request->photo->store('photos/' . $categoryDirectory, 'public');
                $photo = new Photo();
                $photo->item_id = $item->id;
                $photo->path = $photoPath;
                $photo->save();
            }

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Item created successfully');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Failed to create item. Please try again.");
        }
    }


    public function destroy(Item $item)
    {
        try {
            DB::beginTransaction();
            foreach ($item->photos as $photo) {
                Storage::delete('public/' . $photo->path);
            }
            $directory = 'public/photos/category_' . $item->category_id;
            if (count(Storage::allFiles($directory)) === 0) {
                Storage::deleteDirectory($directory);
            }
            $item->delete();
            DB::commit();
            return back()->with('success', 'Item deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete item');
        }
    }

    public function edit(Item $item)
    {
        return view('admin.components.editItem', ['item' => $item]);
    }

    public function update(Item $item, Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'required|string'
            ]);
            $item->update($data);
            return redirect()->route('dashboard.items', ['category' => $item
                ->category->id])->with('success', 'Item updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (QueryException $e) {
            return back()->with('error', 'Database error occurred.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Item not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred.');
        }
    }

    public function show(Item $item)
    {
        $item->increment('views');
        return view('user.components.item', ['item' => $item]);
    }
}
