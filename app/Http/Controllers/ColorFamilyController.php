<?php

namespace App\Http\Controllers;

use App\Models\Colorfamily;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ColorFamilyController extends Controller
{
    public function index()
    {
        try {
            $colorfamilies = Colorfamily::all();
            return response()->json($colorfamilies, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function read($id)
    {
        try {
            $colorfamily = Colorfamily::find($id);
            return response()->json($colorfamily, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function create(Request $req)
    {

        $data = $req->validate([
            'color_family' => 'required|string|max:255',
            'color_code' => 'nullable|string|max:50',
            'product_id' => 'required|numeric|',
            'quantity' => 'required|numeric|',
        ]);
        try {
            $colorfamily = Colorfamily::create($data);
            $this->updateProductQuantity($data['product_id']);
            return response()->json($colorfamily, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function update($id, Request $req)
    {
        $colorfamily = Colorfamily::find($id);
        $data = $req->validate([
            'color_family' => 'string|max:255',
            'color_code' => 'nullable|string|max:50',
            'product_id' => 'numeric',
            'quantity' => 'numeric',
        ]);
        try {
            $colorfamily->update($data);
            $this->updateProductQuantity($colorfamily->product_id);
            return response()->json($colorfamily, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function delete($id)
    {
        try {
            $colorfamily = Colorfamily::find($id);
            if ($colorfamily) {
                Colorfamily::find($id)->delete();
                return response()->json(['message' => 'Color Family Deleted'], 200);
            }
            return
                response()->json(['message' => 'Color Family Not Found'], 500);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    protected function updateProductQuantity($productId)
    {
        DB::table('products')
            ->where('id', $productId)
            ->update([
                'quantity' => DB::table('colorfamilies')
                    ->where('product_id', $productId)
                    ->sum('quantity')
            ]);
    }
}
