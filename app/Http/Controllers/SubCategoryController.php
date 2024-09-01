<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class SubCategoryController extends Controller
{
    public function index()
    {
        try {
            $subcategories = Subcategory::all();
            return response()->json($subcategories, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function read($id)
    {
        try {
            $subcategory = Subcategory::find($id);
            return response()->json($subcategory, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function create(Request $req)
    {

        $data = $req->validate([
            'name' => 'required|string|max:255|unique:subcategories',
            'slug' => 'nullable|string|max:20|unique:subcategories',
            'category_id' => "required|numeric",
            'description' => 'nullable|string|max:2000'
        ]);
        try {
            if ($req->hasFile('logo')) {
                $file = $req->file('logo');
                $ext = $file->getClientOriginalExtension();
                $file_name = 'subcategory' . time() . '.' . $ext;
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
            $subcategory = Subcategory::create($data);
            return response()->json($subcategory, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function update($id, Request $req)
    {
        $subcategory = Subcategory::find($id);
        $data = $req->validate([
            'name' =>
            'string|max:255|unique:subcategories,name,' . $subcategory->id,
            'slug' =>
            'nullable|string|max:20|unique:subcategories,slug,' . $subcategory->id,
            'category_id' => "numeric",
            'description' => 'nullable|string|max:2000'
        ]);
        try {
            if ($req->hasFile('logo')) {
                $path = 'assets/uploades/' . $subcategory->logo;
                if (File::exists($path)) {
                    File::delete($path);
                }

                $file = $req->file('logo');
                $ext = $file->getClientOriginalExtension();
                $file_name = 'subcategory' . time() . '.' . $ext;
                try {
                    $file->move('assets/uploades', $file_name);
                } catch (FileException $e) {
                    return response()->json($e, 500);
                }
                $data['logo'] = $file_name;
            }
            $subcategory->update($data);
            return response()->json($subcategory, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function delete($id)
    {
        try {
            $subcategory = Subcategory::find($id);
            if ($subcategory) {
                $path = 'assets/uploades/' . $subcategory->logo;
                Subcategory::find($id)->delete();
                if (File::exists($path)) {
                    File::delete($path);
                }
                return response()->json(['message' => 'Sub-Category Deleted'], 200);
            }
            return
                response()->json(['message' => 'Sub-Category Not Found'], 500);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
}
