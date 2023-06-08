@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="py-12 px-40">
        <h1 class="text-4xl font-bold">Data</h1>
        <div class="mt-8 flex justify-between">
            <form action="{{ route('mahasiswa.index') }}" class="flex-1 space-x-2" method="get" autocomplete="off">
                <input type="search" name="search" id="search" placeholder="Nama / tanggal lahir / program studi"
                    class="w-1/3 rounded-lg px-4 py-2 outline-none border border-slate-500 focus:ring-2 focus:ring-slate-500"
                    value="{{ request('search') }}">
                <select name="jurusan" id="jurusan"
                    class="w-1/5 rounded-lg px-4 py-2 outline-none border border-slate-500 focus:ring-2 focus:ring-slate-500">
                    <option value="" @selected(!request('jurusan'))>Semua Jurusan</option>
                    <option value="Teknik Komputer dan Informatika" @selected(request('jurusan') == 'Teknik Komputer dan Informatika')>Teknik Komputer dan
                        Informatika</option>
                    <option value="Teknik Sipil" @selected(request('jurusan') == 'Teknik Sipil')>Teknik Sipil</option>
                    <option value="Teknik Mesin" @selected(request('jurusan') == 'Teknik Mesin')>Teknik Mesin</option>
                    <option value="Teknik Elektro" @selected(request('jurusan') == 'Teknik Elektro')>Teknik Elektro</option>
                </select>
                <label for="diploma" class="font-medium">Diploma</label>
                <div class="inline-block" id="diploma">
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input id="semua" type="radio" name="diploma" value=""
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                @checked(!request('diploma'))>
                            <label for="semua" class="block ml-2 text-sm font-medium text-gray-900">
                                Semua
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="d3" type="radio" name="diploma" value="D3"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                @checked(request('diploma') == 'D3')>
                            <label for="d3" class="block ml-2 text-sm font-medium text-gray-900">
                                D3
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="d4" type="radio" name="diploma" value="D4"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
                                @checked(request('diploma') == 'D4')>
                            <label for="d4" class="block ml-2 text-sm font-medium text-gray-900">
                                D4
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="bg-gray-800 px-8 py-2 rounded-lg text-white ml-2 hover:bg-gray-700 transition duration-150">Cari</button>
            </form>
            <a href="{{ route('mahasiswa.create') }}"
                class="flex-none bg-blue-800 px-4 py-2 rounded-lg text-white hover:bg-blue-700 transition duration-150">Tambah</a>
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
