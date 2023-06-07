@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="py-8 px-40">
        <h1 class="text-4xl font-bold text-center">Tambah</h1>
        <div class="mt-8 w-full max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg mx-auto">
            <form class="space-y-6" action="{{ route('mahasiswa.store') }}" method="POST" autocomplete="off">
                @csrf
                <div>
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" name="nama" id="nama"
                        class="bg-gray-50 text-gray-900 text-sm rounded-lg ring-1 ring-gray-400 focus:ring-2 focus:ring-slate-500 shadow block w-full p-2.5 outline-none"
                        value="{{ old('nama') }}">
                    @error('nama')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                        class="bg-gray-50 border-0 text-gray-900 text-sm rounded-lg ring-1 ring-gray-400 focus:ring-2 focus:ring-slate-500 shadow block w-full p-2.5 outline-none"
                        value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="program_studi" class="block mb-2 text-sm font-medium text-gray-900">Program Studi</label>
                    <input type="text" name="program_studi" id="program_studi"
                        class="bg-gray-50 border-0 text-gray-900 text-sm rounded-lg ring-1 ring-gray-400 focus:ring-2 focus:ring-slate-500 shadow block w-full p-2.5 outline-none"
                        value="{{ old('program_studi') }}">
                    @error('program_studi')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-900">Jurusan</label>
                    <input type="text" name="jurusan" id="jurusan"
                        class="bg-gray-50 border-0 text-gray-900 text-sm rounded-lg ring-1 ring-gray-400 focus:ring-2 focus:ring-slate-500 shadow block w-full p-2.5 outline-none"
                        value="{{ old('jurusan') }}">
                    @error('jurusan')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-900">Diploma</label>
                    <div class="flex justify-around">
                        <div class="flex items-center mb-4">
                            <input id="d3" type="radio" name="diploma" value="D3"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                {{ old('diploma') == 'D3' ? 'checked' : '' }}>
                            <label for="d3" class="block ml-2 text-sm font-medium text-gray-900">
                                D3
                            </label>
                        </div>
                        <div class="flex items-center mb-4">
                            <input id="d4" type="radio" name="diploma" value="D4"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                {{ old('diploma') == 'D4' ? 'checked' : '' }}>
                            <label for="d4" class="block ml-2 text-sm font-medium text-gray-900">
                                D4
                            </label>
                        </div>
                    </div>
                    @error('diploma')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-between">
                    <a href="{{ route('mahasiswa.index') }}"
                        class="bg-slate-800 px-5 py-2.5 rounded-lg text-white hover:bg-slate-700 transition duration-150">Kembali</a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg px-5 py-2.5">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection
