<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $jurusan = $request->jurusan;
        $diploma = $request->diploma;
        $query = Mahasiswa::query();

        if ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('tanggal_lahir', 'LIKE', '%' . $search . '%')
                ->orWhere('program_studi', 'LIKE', '%' . $search . '%');
        }

        if ($jurusan) {
            $query->where('jurusan', $jurusan);
        }

        if ($diploma) {
            $query->where('diploma', $diploma);
        }

        $mahasiswa = $query->paginate(10)->withQueryString();

        return view('mahasiswa.index', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|regex:/^[a-zA-Z\s\.]*$/',
            'tanggal_lahir' => 'required|date',
            'program_studi' => 'required|string|max:50|regex:/^[a-zA-Z\s\.]*$/',
            'jurusan' => 'required|string|max:50|regex:/^[a-zA-Z\s\.]*$/',
            'diploma' => [
                'required',
                Rule::in(['D3', 'D4'])
            ]
        ]);

        try {
            Mahasiswa::create($validated);
            return redirect()->route('mahasiswa.index')->with('message', 'Data mahasiswa berhasil ditambah!');
        } catch (\Throwable $t) {
            Log::error($t->getMessage());

            return redirect()->route('mahasiswa.index')->with('message', 'Data mahasiswa gagal ditambah!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|regex:/^[a-zA-Z\s\.]*$/',
            'tanggal_lahir' => 'required|date',
            'program_studi' => 'required|string|max:50|regex:/^[a-zA-Z\s\.]*$/',
            'jurusan' => 'required|string|max:50|regex:/^[a-zA-Z\s\.]*$/',
            'diploma' => [
                'required',
                Rule::in(['D3', 'D4'])
            ]
        ]);

        try {
            Mahasiswa::find($id)->update($validated);
            return redirect()->route('mahasiswa.index')->with('message', 'Data mahasiswa berhasil diubah!');
        } catch (\Throwable $t) {
            Log::error($t->getMessage());

            return redirect()->route('mahasiswa.index')->with('message', 'Data mahasiswa gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Mahasiswa::destroy($id);
            return redirect()->route('mahasiswa.index')->with('message', 'Data mahasiswa berhasil dihapus!');
        } catch (\Throwable $t) {
            Log::error($t->getMessage());

            return redirect()->route('mahasiswa.index')->with('message', 'Data mahasiswa gagal dihapus!');
        }
    }
}
