<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $db, $builder, $session;

    public function __construct()
    {
        $this->db       = \Config\Database::connect();
        $this->builder  = $this->db->table('accounts');
        $this->session  = session();        
    }

    public function isLoggedIn()
    {
        $isLoggedIn = false;

        if($this->session->has('isLoggedInEmail'))
            $isLoggedIn = true;

        return $isLoggedIn;
    }

    public function setSession($email)
    {
        $this->session->set([
            'isLoggedInEmail'  => $email
        ]);
        
        return true;
    }

    public function removeSession()
    {
        $this->session->remove([
            'isLoggedInEmail'
        ]);
    
        return true;
    }
    
    public function getData() {
        $data = [
            'email'     => null,
            'name'      => null,
            'id'        => null,
            'hierarchy' => null,
            'dealer'    => null
        ];
        
        if($this->session->has('isLoggedInEmail')) {
            $this->builder->select('email, name, hierarchy, dealer');
            $this->builder->where('email', $this->session->get('isLoggedInEmail'));
            $this->builder->limit(1);
            
            $query  = $this->builder->get();
            $row    = $query->getRow();
            
            $email = $row->email;
            
            $data['email']      = $email;
            $data['name']       = $row->name;
            $data['id']        = $this->db->query("SELECT uid FROM sales WHERE email='$email'")->getRow('uid');
            $data['hierarchy']  = $row->hierarchy;
            $data['dealer']     = $row->dealer;
            
            $this->db->close();
            
            return $data;
        } else {
            return $data;
        }
    }
    
    public function verify($hierarchy) {
        if(!$this->isLoggedIn()) {   
            header("Location: /");
            die();
        } else {
            if($hierarchy == 'admin') {
                if($this->getData()['hierarchy'] != 'admin') {
                    header("Location: /");
                    die();
                }
            } else {
                if($this->getData()['hierarchy'] != 'sales') {
                    header("Location: /");
                    die();
                }
            }
        }
    }
}