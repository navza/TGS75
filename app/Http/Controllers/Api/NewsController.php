<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $berita = Berita::with(['user', 'komentar.user'])->latest()->paginate(10);
        return response()->json($berita);
    }

    public function show($id)
    {
        $berita = Berita::with(['user', 'komentar.user'])->findOrFail($id);
        return response()->json($berita);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('berita', 'public');
            $data['gambar'] = $path;
        }

        // Associate to authenticated user if available
        $user = $request->user();
        if ($user) {
            $data['user_id'] = $user->id;
        } elseif (empty($data['user_id'])) {
            return response()->json(['message' => 'Unauthenticated or missing user_id'], 401);
        }

        $berita = Berita::create($data);

        return response()->json($berita, 201);
    }
}
