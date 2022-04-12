<?php

namespace App\Controllers;


class Latihan1 extends BaseController
{
    public function index()
    {
        // return view('view_form_matakuliah');
        echo "Selamat datang... selamat belajar Web Programming";
    }

    public function penjumlahan($n1,$n2)
    {
        $this->Model_latihan1 = model('Model_Latihan1');
        $hasil = $this->Model_latihan1->jumlah($n1,$n2);
        echo "Hasil penjumlahan dari ". $n1 ."+". $n2 ." = ". $hasil;
    }

    public function penjumlahan2($n1,$n2)
    {
        $this->Model_latihan1 = model('Model_latihan1');

        $data['nilai1'] = $n1;
        $data['nilai2'] = $n2;
        $data['hasil'] = $this->Model_latihan1->jumlah($n1,$n2);

        return view('view_latihan1', $data);
    }
}