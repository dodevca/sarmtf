<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Unit extends BaseController
{
    protected $db, $builder, $auth, $request;

    public function __construct()
    {
        $this->db       = \Config\Database::connect();
        $this->builder  = $this->db->table('units');
        $this->request  = \Config\Services::request();
        $this->auth     = new \App\Models\AuthModel();
    }
    
    public function index() {
        helper('form');
        helper('number');
        
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'page'          => 'Unit',
            'data'          => [
                'dealer'        => [],
                'totalResults'  => 0,
                'results'       => []
            ]
        ];

        $queryDealer            = $this->db->query("SELECT name FROM dealers ORDER by name ASC");
        $data['data']['dealer'] = $queryDealer->getResultArray();
        
        $this->builder->select('name, price, unitCode, date, dealer');
        $this->builder->orderBy('name', 'ASC');
        
        $query  = $this->builder->get();
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['results']        = $row;
                        
            for($i = 0; $i < count($row); $i++) {
                $data['data']['results'][$i]['price'] = number_to_currency((int) $row[$i]['price'], 'IDR', 'id_ID', 2);
            }
        }
        
        $this->db->close();
            
        return view('unit', $data);
        // return $this->response->setJSON($data);
    }
    
    public function create() {
        $this->auth->verify('admin');
        
        $rules = [
            'name'      => 'required',
            'price'     => 'required',
            'unitCode'  => 'required|is_unique[units.unitCode]',
            'dealer'    => 'required',
            
        ];
        
        $data = [
            'name'      => null,
            'price'     => null,
            'unitCode'  => null,
            'dealer'    => null,
        ];
        
        if(!$this->validate($rules)) {
            return redirect()->to('/dashboard/unit/')->with('errors', 'Gagal menambahkan unit. Pastikan data yang dimasukkan sudah benar!');
        }
        
        $data['name']       = ucwords($this->request->getPost('name'));
        $data['price']      = str_replace(['.', ','], ['', ''], $this->request->getPost('price'));
        $data['unitCode']   = $this->request->getPost('unitCode');
        $data['dealer']     = $this->request->getPost('dealer');
        
        if($this->builder->insert($data)) {
            $this->db->close();
        
            return redirect()->to('/dashboard/unit/')->with('success', 'Berhasil menambahkan unit.');
        } else {
            $this->db->close();
            
            return redirect()->to('/dashboard/unit/')->with('errors', 'Gagal menambahkan unit. Pastikan data yang dimasukkan sudah benar!');
        }
        
        // return $this->response->setJSON($this->validate($rules)); 
    }
    
    
    public function read($unitCode) {
        helper('form');
        helper('number');
        
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'data'          => [
                'unitCode'      => $unitCode,
                'dealer'        => [],
                'totalResults'  => 0,
                'result'        => []
            ]
        ];
        
        $queryDealer            = $this->db->query("SELECT name FROM dealers ORDER by name ASC");
        $data['data']['dealer'] = $queryDealer->getResultArray();
        
        $this->builder->select('name, price, unitCode, date, dealer');
        $this->builder->where('unitCode', $unitCode);
        
        $query  = $this->builder->get(1);
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['result']         = $row;
            
            $data['data']['results'][0]['price'] = number_to_currency((int) $row[0]['price'], 'IDR', 'id_ID', 2);
        }
        
        $this->db->close();
            
        return view('unit-detail', $data);
        // return $this->response->setJSON($data);
    }
    
    public function update($unitCode) {
        $rules = [
            'name'      => 'required',
            'price'     => 'required',
            'unitCode'  => 'required|is_unique[units.unitCode]',
            'dealer'    => 'required',
            
        ];
        
        $data = [
            'name'      => null,
            'price'     => null,
            'unitCode'  => null,
            'dealer'    => null,
        ];
        
        if(!$this->validate($rules)) {
            return redirect()->to('/dashboard/unit/')->with('errors', 'Gagal menambahkan unit. Pastikan data yang dimasukkan sudah benar!');
        }
        
        $data['name']       = ucwords($this->request->getPost('name'));
        $data['price']      = str_replace(['.', ','], ['', ''], $this->request->getPost('price'));
        $data['unitCode']   = $this->request->getPost('unitCode');
        $data['dealer']     = $this->request->getPost('dealer');
        
        if($this->builder->update($data)) {
            $this->db->close();
        
            return redirect()->to('/dashboard/unit/')->with('success', 'Berhasil memperbarui data Unit.');
        } else {
            $this->db->close();
            
            return redirect()->to('/dashboard/unit/' . $uid)->with('errors', 'Gagal memperbarui data Unit. Pastikan data yang dimasukkan sudah benar!');
        }
    }
    
    public function delete($unitCode) {
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'data'          => [
                'unitCode'       => $unitCode,
                'status'    => null
            ]
        ];
        
        if($this->builder->delete(['unitCode' => $unitCode])) {
            $data['data']['status'] = 'success';
            
            $this->db->close();
            
            return redirect()->to('/dashboard/unit')->with('success','Berhasil menghapus unit.'); 
        } else {
            $data['data']['status'] = 'failed';
            
            $this->db->close();
            
            return redirect()->to('/dashboard/unit/' . $unitCode)->with('errors','Gagal menghapus unit.'); 
        }
        
        // return $this->response->setJSON($data);
    }
}