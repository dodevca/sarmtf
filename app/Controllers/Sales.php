<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Sales extends BaseController
{
    protected $db, $builder, $auth, $request;

    public function __construct()
    {
        $this->db       = \Config\Database::connect();
        $this->builder  = $this->db->table('sales');
        $this->request  = \Config\Services::request();
        $this->auth     = new \App\Models\AuthModel();
    }
    
    
    public function index() {
        helper('form');
        
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'page'          => 'Sales',
            'data'          => [
                'dealer'        => [],
                'totalResults'  => 0,
                'results'       => []
            ]
        ];
        
        $queryDealer            = $this->db->query("SELECT name FROM dealers ORDER by name ASC");
        $data['data']['dealer'] = $queryDealer->getResultArray();
        
        $this->builder->select('email, name, uid, dealer');
        $this->builder->orderBy('name', 'ASC');
        
        $query  = $this->builder->get();
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['results']        = $row;
        }
        
        $this->db->close();
        
        return view('sales', $data);
        // return $this->response->setJSON($data);
    }
    
    public function create() {
        $this->auth->verify('admin');
        
        $rules = [
            'name'      => 'required',
            'email'     => 'required',
            'dealer'    => 'required',
            'password'  => 'required|matches[passwordMatch]',
        ];
        
        $data1 = [
            'uid'       => date("YmdHis"),
            'name'      => null,
            'email'     => null,
            'dealer'    => null,
        ];
        
        $data2 = [
            'email'     => null,
            'name'      => null,
            'password'  => null,
            'hierarchy' => 'sales',
            'dealer'    => null,
        ];
        
        if(!$this->validate($rules)) {
            return redirect()->to('/dashboard/sales/')->with('errors', 'Gagal menambahkan Sales. Pastikan data yang dimasukkan sudah benar!');
        }
        
        $name       = ucwords($this->request->getPost('name'));
        $email      = $this->request->getPost('email');
        $dealer     = $this->request->getPost('dealer');
        $password   = $this->request->getPost('password');
        
        $data1['name']      = $name;
        $data1['email']     = $email;
        $data1['dealer']    = $dealer;
        
        $data2['email']     = $email;
        $data2['name']      = $name;
        $data2['password']  = $password;
        $data2['dealer']    = $dealer;
        
        if($this->builder->insert($data1) && $this->db->table('accounts')->insert($data2)) {
            $this->db->close();
        
            return redirect()->to('/dashboard/sales/')->with('success', 'Berhasil menambahkan Sales.');
        } else {
            $this->db->close();
            
            return redirect()->to('/dashboard/sales/')->with('errors', 'Gagal menambahkan Sales. Pastikan data yang dimasukkan sudah benar!');
        }
        
        // return $this->response->setJSON($this->validate($rules)); 
    }
    
    public function read($uid) {
        helper('form');
        
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'      => $userData,
            'data'          => [
                'uid'           => $uid,
                'dealer'        => [],
                'totalResults'  => 0,
                'result'        => []
            ]
        ];
        
        $queryDealer            = $this->db->query("SELECT name FROM dealers ORDER by name ASC");
        $data['data']['dealer'] = $queryDealer->getResultArray();
        
        $this->builder->select('email, name, dealer');
        $this->builder->where('uid', $uid);
        
        $query  = $this->builder->get(1);
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['result']         = $row;
            
            $email = $row[0]['email'];
            
            $data['data']['result'][0]['password'] = $this->db->query("SELECT password FROM accounts WHERE email='$email' LIMIT 1")->getRow('password');
        }
        
        $this->db->close();
    
        return view('sales-detail', $data);
        // return $this->response->setJSON($data);
    }
    
    public function update($uid) {
        $this->auth->verify('admin');
        
        $rules = [
            'name'      => 'required',
            'email'     => 'required',
            'dealer'    => 'required',
            'password'  => 'required',
        ];
        
        $data1 = [
            'name'      => null,
            'email'     => null,
            'dealer'    => null,
        ];
        
        $data2 = [
            'email'     => null,
            'name'      => null,
            'password'  => null,
            'dealer'    => null,
        ];
        
        
        if(!$this->validate($rules)) {
            return redirect()->to('/dashboard/sales/' . $uid)->with('errors', 'Gagal memperbarui data Sales. Pastikan data yang dimasukkan sudah benar!');
        }
        
        $name       = ucwords($this->request->getPost('name'));
        $email      = $this->request->getPost('email');
        $dealer     = $this->request->getPost('dealer');
        $password   = $this->request->getPost('password');
        
        $data1['name']      = $name;
        $data1['email']     = $email;
        $data1['dealer']    = $dealer;
        
        $data2['email']     = $email;
        $data2['name']      = $name;
        $data2['password']  = $password;
        $data2['dealer']    = $dealer;
        
        $this->builder->where('uid', $uid);
        
        $account = $this->db->table('accounts');
        
        $account->where('email', $email);
        
        // $sql = "UPDATE table_name SET column1 = value1, column2 = value2 WHERE condition";
        
        if($this->builder->update($data1) && $account->update($data2)) {
            $this->db->close();
        
            return redirect()->to('/dashboard/sales/')->with('success', 'Berhasil memperbarui data Sales.');
        } else {
            $this->db->close();
            
            return redirect()->to('/dashboard/sales/' . $uid)->with('errors', 'Gagal memperbarui data Sales. Pastikan data yang dimasukkan sudah benar!');
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
        
        $this->builder->select('email');
        $this->builder->where('uid', $uid);
        
        $query  = $this->builder->get(1);
        $row    = $query->getResult('array');
        
        $account = $this->db->table('accounts');
        
        if($this->builder->delete(['uid' => $uid]) && $account->delete(['email' => $row[0]['email']])) {
            $data['data']['status'] = 'success';
            
            $this->db->close();
            
            return redirect()->to('/dashboard/sales')->with('success','Berhasil menghapus Sales.'); 
        } else {
            $data['data']['status'] = 'failed';            
            
            $this->db->close();
            
            return redirect()->to('/dashboard/sales/' . $uid)->with('errors','Gagal menghapus Sales.'); 
        }
        
        // return $this->response->setJSON($data);
    }
}