<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new User([
            'name' => $row['nama'],
            'email' => $row['email'],
            'nis' => $row['nis'],
            'kelas' => $row['kelas'],
            'role' => 'siswa',
            'password' => Hash::make('password123'),
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'nis' => 'required|unique:users,nis',
            'kelas' => 'required',
        ];
    }
}
