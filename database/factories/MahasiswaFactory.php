<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prodi = ['Teknik Informatika', 'Konstruksi Gedung', 'Teknik Aeronautika', 'Teknik Otomasi Industri'];
        $jurusan = ['Teknik Komputer dan Informatika', 'Teknik Sipil', 'Teknik Mesin', 'Teknik Elektro'];
        $diploma = ['D3', 'D4'];
        return [
            'nama' => fake()->name(),
            'tanggal_lahir' => fake()->date(),
            'program_studi' => $prodi[array_rand($prodi)],
            'jurusan' => $jurusan[array_rand($jurusan)],
            'diploma' => $diploma[array_rand($diploma)]
        ];
    }
}
