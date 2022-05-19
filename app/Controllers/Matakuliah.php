<?php

namespace App\Controllers;


class Matakuliah extends BaseController
{
    
    public function index()
    {
        session();

        $data = [
            'title' => 'Form Input Matakuliah',
            'validation' => \Config\Services::validation()
        ];
        return view('view_form_matakuliah', $data);
    }

    public function cetak()
    {
        $validasi = \Config\Services::validation();

        // $validasi->setRule('kode', 'Kode Matakuliah', 'required|min_length[2]',[
        //     'required' => 'Kode Matakuliah harus diisi',
        //     'min_length' => 'Kode terlalu pendek'
        // ]);

        // $validasi->setRule('nama', 'Nama Matakuliah', 'required|min_length[2]',[
        //     'required' => 'Nama Matakuliah harus diisi',
        //     'min_length' => 'Nama terlalu pendek'
        // ]);

        // if($validasi->run() != true){
        //     // return view('view_form_matakuliah');
        //     echo $validasi->listErrors();

        $rules = [
            "kode" => "required|min_length[3]|numeric",
            "nama" => "required|min_length[3]"
        ];
        $message = [
            "kode" => [
                "required" => "Kode matakuliah harus diisi",
                "min_length" => "Kode terlalu pendek",
                "numeric" => "Harus berisi angka"
            ],
            "nama" => [
                "required" => "Nama Harus Diisi",
                "min_length" => "Nama terlalu pendek"
            ]
        ];
        if(!$this->validate($rules,$message)){
            return redirect()->to('../matakuliah')->withInput();
            // echo $validasi->listErrors();
        }else{

        $data = [
            'kode' => $_POST["kode"],
            'nama' => $_POST["nama"],
            'sks' => $_POST["sks"]
        ];

        return view('view_data_matakuliah', $data);

        }
    }
}