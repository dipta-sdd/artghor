<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreate;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $products = Product::with(['colorfamilies', 'category', 'subcategory'])
                ->when($request->has('category_id'), function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
                ->paginate($request->limit);

            // Sorting
            if ($request->has('sort')) {
                $sort = $request->sort;
                $direction = $request->direction ?? 'asc'; // Default direction is ascending

                switch ($sort) {
                    case 'name':
                        $products = $products->orderBy('name', $direction);
                        break;
                    case 'price':
                        $products = $products->orderBy('price', $direction);
                        break;
                    case 'quantity':
                        $products = $products->orderBy('quantity', $direction);
                        break;
                    case 'created_at':
                        $products = $products->orderBy('created_at', $direction);
                        break;
                    default:
                        break;
                }
            }

            // $products = $products->get();

            return response()->json($products, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function read($id)
    {
        try {
            $product = Product::with(['colorfamilies', 'category', 'subcategory'])->find($id);
            return response()->json($product, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function create(ProductCreate $req)
    {
        // dd(json_encode($req));
        // return response()->json($req, 200);
        $data = $req->validate([
            'name' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image1' => 'required|image'
        ]);
        // dd(json_encode($req));
        try {

            // return response()->json($data, 200);
            if ($req->hasFile('image1')) {
                $data['image1'] = $this->file_saver($req, 'image1');
            } else {
                $field = 'image1';
                return response()->json(['errors' => [$field => ["The $field field is required."]]], 500);
            }
            if ($req->hasFile('image2')) {
                $data['image2'] = $this->file_saver($req, 'image2');
            }
            if ($req->hasFile('image3')) {
                $data['image3'] = $this->file_saver($req, 'image3');
            }
            if ($req->hasFile('image4')) {
                $data['image4'] = $this->file_saver($req, 'image4');
            }

            $product = Product::create($data);
            return response()->json($product, 200);
        } catch (Exception $e) {

            return response()->json($e, 500);
        }
    }
    public function update($id, Request $req)
    {
        $product = Product::find($id);
        $data = $req->validate([
            'name' =>
            'string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string|max:2000',
            'price' => 'numeric',
            'quantity' => 'numeric',
            'category_id' => 'numeric',
            'subcategory_id' => 'numeric',
        ]);
        try {
            if ($req->hasFile('image1')) {
                $this->delete_file($product->image1);
                $data['image1'] = $this->file_saver($req, 'image1');
            }
            if ($req->hasFile('image2')) {
                $this->delete_file($product->image2);
                $data['image2'] = $this->file_saver($req, 'image2');
            }
            if ($req->hasFile('image3')) {
                $this->delete_file($product->image3);
                $data['image3'] = $this->file_saver($req, 'image3');
            }
            if ($req->hasFile('image4')) {
                $this->delete_file($product->image4);
                $data['image4'] = $this->file_saver($req, 'image4');
            }
            $product->update($data);
            return response()->json($product, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function delete($id)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                $this->delete_file($product->image1);
                $this->delete_file($product->image2);
                $this->delete_file($product->image3);
                $this->delete_file($product->image4);
                Product::find($id)->delete();
                return response()->json(['message' => 'Product Deleted'], 200);
            }
            return
                response()->json(['message' => 'Product Not Found'], 500);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    protected function delete_file($name)
    {
        $path = 'assets/uploades/' . $name;
        if (File::exists($path)) {
            File::delete($path);
        }
    }
    protected function file_saver($req, $name)
    {
        $file = $req->file($name);
        $ext = $file->getClientOriginalExtension();
        $file_name = 'product_' . $name . time() . '.' . $ext;
        try {
            $file->move('assets/uploades', $file_name);
        } catch (FileException $e) {
            throw $e;
        }
        return $file_name;
    }
}
