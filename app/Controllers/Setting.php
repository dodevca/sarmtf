<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Setting extends BaseController
{
    protected $db, $builder, $auth, $request;

    public function __construct()
    {
        $this->db       = \Config\Database::connect();
        $this->builder  = $this->db->table('settings');
        $this->request  = \Config\Services::request();
        $this->auth     = new \App\Models\AuthModel();
    }
    
    public function index() {
        helper('form');
        
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'page'          => 'Setting',
            'data'          => [
                'account'   => null,
                'setting'   => null
            ]
        ];
        
        $email = $data['userData']['email'];

        $queryAccount               = $this->db->query("SELECT email, name, password FROM accounts WHERE email='$email'");
        $data['data']['account']    = $queryAccount->getResultArray();
        
        $this->builder->select('whatsAppNumber, pricelist');
        $this->builder->where(['id' => 1]);
        
        $query  = $this->builder->get();
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['setting']        = $row;
            
            $data['data']['setting'][0]['pricelist'] = json_decode($row[0]['pricelist']);
        }
        
        $this->db->close();
        
        return view('setting', $data);
        // return $this->response->setJSON($data);
    }
    
    public function save() {
        $this->auth->verify('admin');
        
        $target = $this->request->getPost('targetResult');
        
        if($target == 'account') {
            $rules = [
                'name'      => 'required',
                'email'     => 'required',
                'password'  => 'required',
            ];
            
            $data = [
                'name'      => $this->request->getPost('name'),
                'email'     => $this->request->getPost('email'),
                'password'  => $this->request->getPost('password')
            ];
            
            $dbTable = $this->db->table('accounts');
            
            $dbTable->where(['email' => $data['email']]);
        } else if($target == 'setting') {
            $rules = [
                'whatsApp' => 'required',
            ];
            
            $data = [
                'whatsAppNumber' => preg_replace('/[^0-9]/', '', $this->request->getPost('whatsApp'))
            ];
            
            $dbTable = $this->db->table('settings');
            
            $dbTable->where(['id' => 1]);
        } else {
            $rules = [
                'targetResult' => 'required',
            ];
            $data = [
                'pricelist' => []
            ];
            
            $dbTable = $this->db->table('settings');
            
            $dbTable->where(['id' => 1]);
            
            $pricelist = $this->request->getFiles();
            
            if($pricelist) {
                foreach ($pricelist['images'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $imageName = $img->getRandomName();

                        $img->move('/home/sarw4488/public_html/uploads/pricelists/', $imageName);
                        array_push($data['pricelist'], $imageName);
                    }
                }
                
                $data['pricelist'] = json_encode($data['pricelist']);
            } else {
                return redirect()->to('/dashboard/pengaturan/')->with('errors', 'Gagal menambahkan pricelist. Pastikan data yang dimasukkan sudah benar!');
            }
        }
            
        if(!$this->validate($rules)) {
            $this->db->close();
            
            return redirect()->to('/dashboard/pengaturan/')->with('errors', 'Gagal menyimpan perubahan. Pastikan data yang dimasukkan sudah benar!');
        }
        
        if($dbTable->update($data)) {
            $this->db->close();
        
            return redirect()->to('/dashboard/pengaturan/')->with('success', 'Berhasil menyimpan perubahan.');
        } else {
            $this->db->close();
            
            return redirect()->to('/dashboard/pengaturan/')->with('errors', 'Gagal menyimpan perubahan. Pastikan data yang dimasukkan sudah benar!');
        }
        
        // return $this->response->setJSON($data);
    }
}