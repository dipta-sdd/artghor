<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return response()->json($banners, 200);
    }
    public function create(Request $req)
    {
        try {
            $banner = new Banner();
            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $ext = $file->getClientOriginalExtension();
                $file_name = 'banner' . time() . '.' . $ext;
                try {
                    $file->move('assets/uploades', $file_name);
                } catch (FileException $e) {
                    return response()->json($e, 500);
                }
                $banner->path = $file_name;
            } else {
                $field = 'image';
                return response()->json(['errors' => [$field => ["The banner field is required."]]], 500);
            }
            $banner->link = $req->link;
            $banner->save();
            return response()->json($banner, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function update(Request $req)
    {
        try {
            $banner = Banner::find($req->id);
            if ($req->hasFile('image')) {
                $path = 'assets/uploades/' . $banner->name;
                if (File::exists($path)) {
                    File::delete($path);
                }

                $file = $req->file('image');
                $ext = $file->getClientOriginalExtension();
                $file_name = 'banner' . time() . '.' . $ext;
                try {
                    $file->move('assets/uploades', $file_name);
                } catch (FileException $e) {
                    return response()->json($e, 500);
                }
                $banner->path = $file_name;
            }
            if ($req->link) {
                $banner->link = $req->link;
            }
            $banner->save();
            return response()->json($banner, 200);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
    public function delete($id)
    {
        try {
            $banner = Banner::find($id);
            if ($banner) {
                $path = 'assets/uploades/' . $banner->path;
                Banner::find($id)->delete();
                if (File::exists($path)) {
                    File::delete($path);
                }
                return response()->json(['message' => 'Banner Deleted'], 200);
            }
            return
                response()->json(['message' => 'Banner Not Found'], 500);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }
}
