<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, $beritaId)
    {
        $validator = Validator::make($request->all(), [
            'isi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $berita = Berita::findOrFail($beritaId);

        $komentar = Komentar::create([
            'berita_id' => $berita->id,
            'user_id' => $request->user()->id,
            'isi' => $request->isi,
        ]);

        return response()->json($komentar, 201);
    }
}
