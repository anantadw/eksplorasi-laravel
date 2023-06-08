<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MahasiswaAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $mahasiswa = Mahasiswa::all();

            return response()->json([
                'data' => $mahasiswa
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:100|regex:/^[a-zA-Z\s\.]*$/',
                'tanggal_lahir' => 'required|date',
                'program_studi' => 'required|string|max:50|regex:/^[a-zA-Z\s\.]*$/',
                'jurusan' => 'required|string|max:50|regex:/^[a-zA-Z\s\.]*$/',
                'diploma' => [
                    'required',
                    Rule::in(['D3', 'D4'])
                ]
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], Response::HTTP_BAD_REQUEST);
            }

            $mahasiswa = Mahasiswa::create($validator->validated());

            return response()->json([
                'data' => $mahasiswa
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);

            return response()->json([
                'data' => $mahasiswa
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:100|regex:/^[a-zA-Z\s\.]*$/',
                'tanggal_lahir' => 'required|date',
                'program_studi' => 'required|string|max:50|regex:/^[a-zA-Z\s\.]*$/',
                'jurusan' => 'required|string|max:50|regex:/^[a-zA-Z\s\.]*$/',
                'diploma' => [
                    'required',
                    Rule::in(['D3', 'D4'])
                ]
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], Response::HTTP_BAD_REQUEST);
            }

            $mahasiswa->save($validator->validated());

            return response()->json([
                'data' => $mahasiswa
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Mahasiswa::findOrFail($id)->delete();

            return response()->json([], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
