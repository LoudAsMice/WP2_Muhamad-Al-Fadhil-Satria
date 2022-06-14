<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelUser extends Model
{ 
    public function simpanData($data = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->insert($data);
    }

    public function cekData($where = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->getWhere($where);
    }

    public function getUserWhere($where = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->where($where);
    }

    public function cekUserAccess($where = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->select('*');
        $builder->from('access_menu');
        $builder->where($where);
        return $builder->get();
    }

    public function getUserLimit()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        return $builder->limit(10,0);
    }
}