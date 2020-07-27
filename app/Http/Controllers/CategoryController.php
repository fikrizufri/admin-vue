<?php

namespace App\Http\Controllers;

use App\Category;
use Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('created_at', 'desc')->paginate();
        return response()->json($category, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'required|image:jpeg,png,jpg'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $path = $request->file('image')->store('category_images');
        $category->image = $path;

        if ($category->save()) {
            return response()->json($category, 200);
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred while deleting the category',
                    'status_code' => 500
                ],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'image:jpeg,png,jpg'
        ]);
        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $oldPath = $category->image;
            $path = $request->file('image')->store('category_images');
            $category->image = $path;
            Storage::delete($oldPath);
        }

        if ($category->save()) {
            return response()->json($category, 200);
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred while deleting the category',
                    'status_code' => 500
                ],
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            Storage::delete($category->image);
            return response()->json(
                [
                    'message' => 'Category was successfully deleted',
                    'status_code' => 200
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred while deleting the category',
                    'status_code' => 500
                ],
                500
            );
        }
    }
}
