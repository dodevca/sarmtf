<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Home extends BaseController
{
    protected $db, $builder, $auth, $request;

    public function __construct()
    {
        $this->db       = \Config\Database::connect();
        $this->builder  = $this->db->table('accounts');
        $this->request  = \Config\Services::request();
        $this->auth     = new \App\Models\AuthModel();
    }
    
    public function index()
    {
        $isLoggedIn = $this->auth->isLoggedIn();
        
        $userData   = $this->auth->getData();
        
        $data = [
            'isLoggedIn'    => $isLoggedIn,
            'userData'      => $userData
        ];
        
        if($isLoggedIn && $userData['hierarchy'] == 'admin') {
            return redirect()->to('/dashboard');
        } else if($isLoggedIn && $userData['hierarchy'] == 'sales') {
            return redirect()->to('/formulir');
        }
        
        return view('/homepage', $data);
        // return $this->response->setJSON($data);
    }
    
    public function login() {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('password');
        
        if(empty($email)) {
            return redirect()->back()->withInput();
        }
        
        $this->builder->select('name, password, hierarchy');
        $this->builder->where('email', $email);
        $this->builder->limit(1);
            
        $query  = $this->builder->get();
        $row    = $query->getRow();
        
        $this->db->close();
        
        if(count($query->getResult()) > 0) {
            if($password == $row->password) {
                $this->auth->setSession($email);
                
                if($row->hierarchy == 'admin') {
                    return redirect()->to('/dashboard');
                } else {
                    return redirect()->to('/formulir');
                }
            } else {
                return redirect()->back()->withInput()->with('errors', 'Password atau email salah'); 
            }
        } else {
            return redirect()->back()->withInput()->with('errors', 'Email atau password salah'); 
        }
        
        // return $this->response->setJSON($row->password);
    }
    
    public function logout(){
        $isLoggedIn = $this->auth->isLoggedIn();
        
        if($isLoggedIn) {
            $this->auth->removeSession();
        }
        
        return redirect()->to('/');
    }
}
