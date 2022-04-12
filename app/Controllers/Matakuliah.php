<?php

namespace App\Controllers;

use CodeIgniter\HTTP\URI;

class Matakuliah extends BaseController
{
    
    public function index()
    {
        return view('view_form_matakuliah');
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
            "kode" => "required|min_length[3]",
            "nama" => "required|min_length[3]"
        ];
        $message = [
            "kode" => [
                "required" => "Kode Matakuliah Harus Diisi",
                "min_length" => "Kode terlalu pendek"
            ],
            "nama" => [
                "required" => "Nama Harus Diisi",
                "min_length" => "Nama terlalu pendek"
            ]
        ];
        if(!$this->validate($rules,$message)){
            return redirect()->to('http://localhost/WP2_Muhamad-Al-Fadhil-Satria/public/matakuliah');
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