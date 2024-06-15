<?php

namespace App\Controllers;

use IntlDateFormatter;
use App\Models\AuthModel;

class Dashboard extends BaseController
{
    protected $dateFormat, $db, $builder, $auth, $request;

    public function __construct() {
        $this->dateFormat    = new IntlDateFormatter(
            'id_ID',
            IntlDateFormatter::FULL, 
            IntlDateFormatter::FULL
        );
        $this->dateFormat->setPattern('dd MMMM YYYY');
        
        $this->db       = \Config\Database::connect();
        $this->builder  = $this->db->table('submissions');
        $this->request  = \Config\Services::request();
        $this->auth     = new \App\Models\AuthModel();
    }
    
    public function index() {
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'  => $userData,
            'page'      => 'Dashboard',
            'data'      => [
                'recents'   => [],
                'topSales'  => [],
                'topDealer' => []
            ]
        ];
        
        $submission = $this->db->query("SELECT uid, name, unit, sales, date FROM submissions ORDER by dateSubmitted DESC LIMIT 0, 10");
        $sales      = $this->db->query("SELECT sales, COUNT(sales) as total FROM submissions GROUP by sales ORDER by COUNT(sales) DESC ");
        $dealer     = $this->db->query("SELECT dealer, COUNT(dealer) as total FROM submissions GROUP by dealer ORDER by COUNT(dealer) DESC ");
         
        $data['data']['recents']    = $submission->getResult('array');
        $data['data']['topSales']   = $sales->getResult('array');
        $data['data']['topDealer']  = $dealer->getResult('array');
        
        if(count($data['data']['recents']) > 0) {
            for($i = 0; $i < count($data['data']['recents']); $i++) {                
                $unitCode = $data['data']['recents'][$i]['unit'];
            
                $data['data']['recents'][$i]['date']    = $this->dateFormat->format(strtotime($data['data']['recents'][$i]['date']));
            }
        }
        
        $this->db->close();
        
        return view('dashboard', $data);
        // return $this->response->setJSON($data);
    }
    
    public function search() {
        helper('form');
        helper('number');
        
        $this->auth->verify('admin');
        
        $userData       = $this->auth->getData();
        $searchQuery    = $this->request->getGet('q');
        
        $data = [
            'userData'  => $userData,
            'page'      => 'Search',
            'data'      => [
                'query'         => $searchQuery,
                'totalResults'  => 0,
                'results'       => []
            ]
        ];
        
        if(!empty($searchQuery)) { 
            $query  = $this->db->query("SELECT uid, name, unit, sales, date FROM submissions WHERE unit LIKE '%$searchQuery%' OR name LIKE '%$searchQuery%' OR uid LIKE '%$searchQuery%' ORDER by unit DESC");
            $row    = $query->getResultArray();
            
            if(count($row) > 0) {
                $data['data']['totalResults']   = count($row);
                $data['data']['results']        = $row;
                
                for($i = 0; $i < count($row); $i++) {                
                    $unitCode = $row[$i]['unit'];
                
                    $data['data']['results'][$i]['date']    = $this->dateFormat->format(strtotime($row[$i]['date']));
                }
            }
        }
        
        $this->db->close();
        
        return view('search', $data);
        // return $this->response->setJSON($data);
    }
    
    public function view($uid) {
        helper('number');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'  => $userData,
            'data'      => [
                'uid'           => $uid,
                'totalResults'  => 0,
                'result'        => [],
                'viewPublic'    => true
            ]
        ];
        
        $this->builder->select('name, phoneNumber, address, identity, unit, price, tenor, package, insurance, date, surveyor, location, sales, dealer, dateSubmitted');
        $this->builder->where('uid', $uid);
        
        $query  = $this->builder->get(1);
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['result']         = $row;
            
            for($i = 0; $i < count($row); $i++) {
                $unitCode   = $row[$i]['unit'];
                
                $data['data']['result'][$i]['identity']         = json_decode($row[$i]['identity']);
                $data['data']['result'][$i]['price']            = number_to_currency((int) $row[$i]['price'], 'IDR', 'id_ID', 0);
                $data['data']['result'][$i]['tenor']            = $row[$i]['tenor'] . ' Tahun';
                $data['data']['result'][$i]['package']          = !empty($row[$i]['package'])|| $row[$i]['package'] != null ? $row[$i]['package'] : 'Tidak ada';
                $data['data']['result'][$i]['insurance']        = (int) $row[$i]['insurance'];
                $data['data']['result'][$i]['date']             = $this->dateFormat->format(strtotime($row[$i]['date']));
                $data['data']['result'][$i]['dateSubmitted']    = date("d/m/Y H:i:s", strtotime($row[$i]['dateSubmitted']));
            }
        }
        
        $this->db->close();
        
        return view('view', $data);
        // return $this->response->setJSON($data);
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
            
            return redirect()->to('/dashboard')->with('success','Berhasil menghapus data.'); 
        } else {
            $data['data']['status'] = 'failed';            
            
            $this->db->close();
            
            return redirect()->to('/dashboard/view/' . $uid)->with('errors','Gagal menghapus data.'); 
        }
        
        // return $this->response->setJSON($data);
    }
    
    public function table() {
        helper('number');
        
        $monthFormat  = new IntlDateFormatter(
            'id_ID',
            IntlDateFormatter::FULL, 
            IntlDateFormatter::FULL
        );
        $monthFormat->setPattern('MMMM YYYY');
        
        $this->auth->verify('admin');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'  => $userData,
            'page'      => 'Export',
            'data'      => [
                'totalResults'  => 0,
                'results'       => [],
                'fileName'      => 'Rekap Data - ' . $monthFormat->format(strtotime(date("d/m/Y")))
            ]
        ];
        
        $this->builder->select('uid, name, phoneNumber, address, identity, unit, price, tenor, package, insurance, date, surveyor, location, sales, dealer, dateSubmitted');
        $this->builder->orderBy('dateSubmitted', 'ASC');
        
        $query  = $this->builder->getWhere(['MONTH(dateSubmitted)' => date("m"), 'YEAR(dateSubmitted)' => date("Y")]);
        $row    = $query->getResult('array');
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['results']        = $row;
            
            for($i = 0; $i < count($row); $i++) {
                $unitCode   = $row[$i]['unit'];
                
                $data['data']['results'][$i]['identity']        = json_decode($row[$i]['identity']);
                $data['data']['results'][$i]['unit']            = $this->db->query("SELECT name FROM units WHERE unitCode='$unitCode'")->getRow('name');
                $data['data']['results'][$i]['unitCode']        = $unitCode;
                $data['data']['results'][$i]['price']           = number_to_currency((int) $row[$i]['price'], 'IDR', 'id_ID', 0);
                $data['data']['results'][$i]['tenor']           = $row[$i]['tenor'] . ' Tahun';
                $data['data']['results'][$i]['package']         = !empty($row[$i]['package'])|| $row[$i]['package'] != null ? $row[$i]['package'] : 'Tidak ada';
                $data['data']['results'][$i]['insurance']       = (int) $row[$i]['insurance'];
                $data['data']['results'][$i]['date']            = date("d/m/Y", strtotime($row[$i]['dateSubmitted']));
                $data['data']['results'][$i]['surveyor']        = $row[$i]['surveyor'];
                $data['data']['results'][$i]['sales']           = $row[$i]['sales'];
                $data['data']['results'][$i]['dateSubmitted']   = date("d/m/Y H:i:s", strtotime($row[$i]['dateSubmitted']));
            }
        }
        
        $this->db->close();
        
        return view('export', $data);
        // return $this->response->setJSON($data);
    }
}