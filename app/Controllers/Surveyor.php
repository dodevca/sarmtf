<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Surveyor extends BaseController
{
    protected $db, $builder, $auth, $request;

    public function __construct()
    {
        $this->db       = \Config\Database::connect();
        $this->builder  = $this->db->table('surveyors');
        $this->request  = \Config\Services::request();
        $this->auth     = new \App\Models\AuthModel();
    }
    
    public function index() {
        helper('form');
        
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'page'          => 'Surveyor',
            'data'          => [
                'totalResults'  => 0,
                'results'       => []
            ]
        ];

        $this->builder->select('name, uid');
        $this->builder->orderBy('name', 'ASC');
        
        $query  = $this->builder->get();
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['results']        = $row;
        }
        
        $this->db->close();
        
        return view('surveyor', $data);
        // return $this->response->setJSON($data);
    }
    
    public function create() {
        $this->auth->verify('admin');
        
        $rules = [
            'name'      => 'required',
        ];
        
        $data = [
            'uid'       => date("YmdHis"),
            'name'      => null,
        ];
        
        if(!$this->validate($rules)) {
            return redirect()->to('/dashboard/surveyor/')->with('errors', 'Gagal menambahkan Surveyor. Pastikan data yang dimasukkan sudah benar!');
        }
        
        $data['name'] = ucwords($this->request->getPost('name'));
        
        if($this->builder->insert($data)) {
            $this->db->close();
        
            return redirect()->to('/dashboard/surveyor/')->with('success', 'Berhasil menambahkan Surveyor.');
        } else {
            $this->db->close();
            
            return redirect()->to('/dashboard/surveyor/')->with('errors', 'Gagal menambahkan Surveyor. Pastikan data yang dimasukkan sudah benar!');
        }
        
        // return $this->response->setJSON($this->validate($rles)); 
    }
    
    public function read($uid) {
        helper('form');
        
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'data'          => [
                'uid'           => $uid,
                'totalResults'  => 0,
                'result'        => []
            ]
        ];
        
        $this->builder->select('name');
        $this->builder->where('uid', $uid);
        
        $query  = $this->builder->get(1);
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['result']         = $row;
        }
        
        $this->db->close();
            
        return view('surveyor-detail', $data);
        // return $this->response->setJSON($data);
    }
    public function update($uid) {
        $this->auth->verify('admin');
        
        $rules = [
            'name'      => 'required',
        ];
        
        $data = [
            'name'      => null,
        ];
        
        
        if(!$this->validate($rules)) {
            return redirect()->to('/dashboard/surveyor/' . $uid)->with('errors', 'Gagal memperbarui data Surveyor. Pastikan data yang dimasukkan sudah benar!');
        }
        
        $data['name'] = ucwords($this->request->getPost('name'));
        
        $this->builder->where('uid', $uid);
        
        if($this->builder->update($data)) {
            $this->db->close();
        
            return redirect()->to('/dashboard/surveyor/')->with('success', 'Berhasil memperbarui data Surveyor.');
        } else {
            $this->db->close();
            
            return redirect()->to('/dashboard/surveyor/' . $uid)->with('errors', 'Gagal memperbarui data Surveyor. Pastikan data yang dimasukkan sudah benar!');
        }
    }
    
    public function delete($uid) {
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'data'          => [
                'uid'       => $uid,
                'status'    => null
            ]
        ];
        
        if($this->builder->delete(['uid' => $uid])) {
            $data['data']['status'] = 'success';
            
            $this->db->close();
            
            return redirect()->to('/dashboard/surveyor')->with('success','Berhasil menghapus Surveyor.'); 
        } else {
            $data['data']['status'] = 'failed';
            
            $this->db->close();
            
            return redirect()->to('/dashboard/surveyor/' . $uid)->with('errors','Gagal menghapus Surveyor.'); 
        }
        
        // return $this->response->setJSON($data);
    }
}