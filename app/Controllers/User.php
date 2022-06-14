<?php

namespace App\Controllers;

use App\Models\ModelUser;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Files\File;

use function App\Helpers\cek_login;

class User extends BaseController
{
    function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->modeluser = new ModelUser();
        helper('pustaka_helper');
    }

    public function index()
    {
        $data['judul'] = 'Profil Saya';
        $data['user'] = $this->modeluser->cekData(['email' => session('email')])->getRowArray();

        if(!cek_login()){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('user/index', $data);
            echo view('templates/footer');
        } else {
            return redirect()->to('autentifikasi/gagal');
        }
    }

    public function anggota()
    {
        $data['judul'] = 'Data Anggota';
        $data['user'] = $this->modeluser->cekData(['email' => session('email')])->getRowArray();
        $data['anggota'] = $this->modeluser->getUserWhere(['role_id' => '1'])->get()->getResultArray();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('templates/topbar', $data);
        echo view('user/anggota', $data);
        echo view('templates/footer');
    }

    public function ubahprofil()
    {
        $model = new ModelUser();
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $model->cekData(['email' => session('email')])->getRowArray();
        $data['validation'] = \Config\Services::validation();

        $rules = [
            'nama' => 'required'
        ];

        $messages = [
            'nama' => [
                'required' => 'Nama tidak boleh kosong'
            ]
        ];

        if(!$this->validate($rules,$messages)){
            echo view('templates/header', $data);
            echo view('templates/sidebar', $data);
            echo view('templates/topbar', $data);
            echo view('user/ubah-profil', $data);
            echo view('templates/footer');
        } else {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $img = $this->request->getFile('image');
            $r = $img->getRandomName();
            $db = \Config\Database::connect();

            $validationRule = [
                'image' => [
                    'rules' => 'uploaded[image]'
                        . '|is_image[image]'
                        . '|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                ],
            ];
            $db->table('user')->set('nama', $nama)->where('email', $email)->update();
            if($this->validate($validationRule)){
                
                if ($this->request->getFile('image')) {
                    $gambar_lama = $data['user']['image'];
                    if($gambar_lama != 'default.jpg'){
                        unlink('./assets/img/profile/' .$gambar_lama);
                    }
                    $db->table('user')->set('image', $r)->where('email', $email)->update();
                    $img->move('./assets/img/profile/', $r);
                }
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>');
                return redirect()->to('user');
            
            } elseif($img == ""){
                session()->setFlashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>');
                return redirect()->to('user');
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Format tidak sesuai! </div>');
                var_dump($img->getName());
                return redirect()->to('user');
            }
            
        }
    }
}