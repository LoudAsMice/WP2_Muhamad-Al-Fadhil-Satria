<?php

namespace App\Controllers;

class Matakuliah extends BaseController
{
    public function index()
    {
        return view('view_form_matakuliah');
    }

    public function cetak()
    {
        $data = [
            'kode' => $_POST["kode"],
            'nama' => $_POST["nama"],
            'sks' => $_POST["sks"]
        ];

        return view('view_data_matakuliah', $data);
    }
}