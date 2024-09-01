<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            // $categories = Category::all();
            $categories =
                Category::with('subcategories')->get();
            return response()->json($categories, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function read($id)
    {
        try {
            $category = Category::find($id);
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function create(Request $req)
    {

        $data = $req->validate([
            'name' => 'required|string|max:255|unique:categories',
            'slug' => 'nullable|string|max:20|unique:categories',
            'description' => 'nullable|string|max:2000'
        ]);
        try {
            if ($req->hasFile('logo')) {
                $file = $req->file('logo');
                $ext = $file->getClientOriginalExtension();
                $file_name = 'catagory' . time() . '.' . $ext;
                try {
                    $file->move('assets/uploades', $file_name);
                } catch (FileException $e) {
                    return response()->json($e, 500);
                }
                $data['logo'] = $file_name;
            } else {
                $field = 'logo';
                return response()->json(['errors' => [$field => ["The $field field is required."]]], 500);
            }
            $category = Category::create($data);
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function update($id, Request $req)
    {
        $category = Category::find($id);
        $data = $req->validate([
            'name' =>
            'string|max:255|unique:categories,name,' . $category->id,
            'slug' =>
            'nullable|string|max:20|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string|max:2000'
        ]);
        try {
            if ($req->hasFile('logo')) {
                $path = 'assets/uploades/' . $category->logo;
                if (File::exists($path)) {
                    File::delete($path);
                }

                $file = $req->file('logo');
                $ext = $file->getClientOriginalExtension();
                $file_name = 'category' . time() . '.' . $ext;
                try {
                    $file->move('assets/uploades', $file_name);
                } catch (FileException $e) {
                    return response()->json($e, 500);
                }
                $data['logo'] = $file_name;
            }
            $category->update($data);
            return response()->json($category, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if ($category) {
                $path = 'assets/uploades/' . $category->logo;
                Category::find($id)->delete();
                if (File::exists($path)) {
                    File::delete($path);
                }
                return response()->json(['message' => 'Category Deleted'], 200);
            }
            return
                response()->json(['message' => 'Category Not Found'], 500);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
}