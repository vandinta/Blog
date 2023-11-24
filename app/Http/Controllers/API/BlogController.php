<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blog = Blog::all();

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Ada Data Blog'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => $blog
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:webp,png,jpg|max:2048',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $uuid = Str::uuid();

        $profileImage = $request->image->getClientOriginalName();
        $request->image->move('assets/image', $profileImage);

        $blog = Blog::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $profileImage,
        ]);

        if ($blog) {
            return response()->json([
                'success' => true,
                'message' => 'Data Blog Berhasil Ditambahkan'
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data Blog Gagal Ditambahkan'
        ], 409);
    }

    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->all();

        if ($request->file('image') != null) {
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'description' => 'required',
                    'image' => 'required|image|mimes:webp,png,jpg|max:2048',
                ]
            );

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $profileImage = $request->image->getClientOriginalName();
            $request->image->move('assets/image', $profileImage);
            $input['image'] = $profileImage;
        } else {
            $imageName = $blog->image;
            $input['image'] = $imageName;
        }

        $blog->update($input);

        if ($blog) {
            return response()->json([
                'success' => true,
                'message' => 'Data Blog Berhasil Mengubah'
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data Blog Gagal Mengubah'
        ], 409);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Data Blog Gagal Dihapus'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }
}
