<?php

namespace App\Controllers;
use App\Controllers\BaseController;


class Web extends BaseController{
    public function index(){
        $data['judul'] = "Halaman Depan";
        echo view('v_header', $data);
        echo view('v_index', $data);
        echo view('v_footer', $data);
    }

    public function about(){
        $data['judul'] = "Halaman About";
        echo view('v_header', $data);
        echo view('v_about', $data);
        echo view('v_footer', $data);
    }
}