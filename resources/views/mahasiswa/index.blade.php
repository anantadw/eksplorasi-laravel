@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="py-12 px-40">
        <h1 class="text-4xl font-bold">Data</h1>
        <div class="mt-8 flex">
            <form action="{{ route('mahasiswa.index') }}" class="flex-auto" method="get" autocomplete="off">
                <input type="search" name="search" id="search"
                    class="w-1/3 rounded-lg px-4 py-2 outline-none border border-slate-500 focus:ring-2 focus:ring-slate-500">
                <button type="submit"
                    class="bg-gray-800 px-8 py-2 rounded-lg text-white ml-2 hover:bg-gray-700 transition duration-150">Cari</button>
            </form>
            <a href="{{ route('mahasiswa.create') }}"
                class="bg-blue-800 px-4 py-2 rounded-lg text-white hover:bg-blue-700 transition duration-150 justify-self-end">Tambah</a>
        </div>
        <div class="mt-6">
            <table class="w-full text-left table-auto shadow-lg mb-4">
                <thead class="bg-slate-700 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Lahir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Program Studi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jurusan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Diploma
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa as $mhs)
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                {{ $mhs->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $mhs->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Carbon\Carbon::parse($mhs->tanggal_lahir)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $mhs->program_studi }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $mhs->jurusan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $mhs->diploma }}
                            </td>
                            <td class="px-6 py-4 flex">
                                <a href="{{ route('mahasiswa.edit', ['mahasiswa' => $mhs->id]) }}"
                                    class="bg-yellow-500 px-4 py-2 rounded-lg font-medium hover:bg-yellow-400 active:bg-yellow-600 me-2">Ubah</a>
                                <form action="{{ route('mahasiswa.destroy', ['mahasiswa' => $mhs->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        class="bg-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-500 active:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b hover:bg-gray-100">
                            <th scope="row" colspan="7" class="px-6 py-4 font-medium whitespace-nowrap text-center">
                                Tidak ada data.
                            </th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $mahasiswa->links() }}
        </div>
    </div>
@endsection
