<?php

namespace App\Controllers;

use IntlDateFormatter;
use CodeIgniter\HTTP\Files\File;
use App\Models\AuthModel;

class Form extends BaseController
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
        helper('form');
        
        // $this->auth->verify('sales');
        
        $userData   = $this->auth->getData();
        
        $data = [
            'userData'  => $userData,
            'data'      => [
                'units'     => [],
                'sales'     => [],
                'surveyors' => [],
                'packages'  => [],
                'pricelist' => json_decode($this->db->query("SELECT pricelist FROM settings WHERE id='1'")->getRow('pricelist'))
            ]
        ];
        
        $dealer = $data['userData']['dealer'];
        
        // $units                  = $this->db->query("SELECT name, price, unitCode, image FROM units WHERE dealer='$dealer' ORDER by name ASC");
        // $data['data']['units']  = $units->getResultArray();
        
        // $sales                  = $this->db->query("SELECT uid, name FROM sales WHERE dealer='$dealer' ORDER by name ASC");
        // $data['data']['sales']  = $sales->getResultArray();
        
        $surveyors                  = $this->db->query("SELECT uid, name FROM surveyors ORDER by name ASC");
        $data['data']['surveyors']  = $surveyors->getResultArray();
        
        // $packages                   = $this->db->query("SELECT uid, name FROM packages ORDER by name ASC");
        // $data['data']['packages']   = $packages->getResultArray();
        
        $this->db->close();
        
        return view('form', $data);
        // return $this->response->setJSON($data);
    }
    
    public function submit() {
        // $this->auth->verify('sales');
        
        $rules = [
            'sales'         => 'required',
            'dealer'        => 'required',
            'name'          => 'required',
            'phoneNumber'   => 'required',
            'address'       => 'required',
            'unit'          => 'required',
            'price'         => 'required',
            'tenor'         => 'required',
            'date'          => 'required',
            'surveyor'      => 'required',
            'geo'           => 'required',
        ];
        
        $data = [
            'sales'         => null,
            'dealer'        => null,
            'uid'           => date("YmdHis"),
            'name'          => null,
            'phoneNumber'   => null,
            'address'       => null,
            'identity'      => [],
            'unit'          => null,
            'price'         => null,
            'tenor'         => null,
            'package'       => null,
            'insurance'     => false,
            'date'          => null,
            'surveyor'      => null,
            'location'      => null,
        ];
        
        
        if(!$this->validate($rules)) {
            return redirect()->to('/formulir')->with('errors', $this->validator->getErrors());
            // return $this->response->setJSON($this->validator->getErrors());
        }
        
        $data['sales']          = ucwords($this->request->getPost('sales'));
        $data['dealer']         = ucwords($this->request->getPost('dealer'));
        $data['name']           = ucwords($this->request->getPost('name'));
        $data['phoneNumber']    = $this->request->getPost('phoneNumber');
        $data['address']        = ucwords($this->request->getPost('address'));
        $data['unit']           = ucwords($this->request->getPost('unit'));
        $data['price']          = (int) str_replace('.', '', $this->request->getPost('price'));
        $data['tenor']          = ucwords($this->request->getPost('tenor'));
        $data['package']        = $this->request->getPost('package');
        $data['insurance']      = $this->request->getPost('insurance') == null ? false : true;
        $data['date']           = date("Y-m-d", strtotime($this->request->getPost('date')));
        $data['surveyor']       = $this->request->getPost('surveyor');
        $data['location']       = $this->request->getPost('geo');
        
        $ktp1 = $this->request->getFile('ktp1');
        $ktp2 = $this->request->getFile('ktp2');
        
        $ktpArr = [];
        
        if($ktp1 && $ktp2) {
            if (($ktp1->isValid() && !$ktp1->hasMoved()) && ($ktp1->isValid() && !$ktp1->hasMoved())) {
                $imageName1 = $ktp1->getRandomName();
                $imageName2 = $ktp2->getRandomName();

                $ktp1->move('/home/sarw4488/public_html/uploads/ktp/', $imageName1);
                $ktp2->move('/home/sarw4488/public_html/uploads/ktp/', $imageName2);
                
                array_push($ktpArr, $imageName1);
                array_push($ktpArr, $imageName2);
            }
        }
        
        $data['identity'] = json_encode($ktpArr);
        
        if(!empty($data['identity'])) {
            if($this->builder->insert($data)) {
                $this->db->close();
            
                return redirect()->to('/formulir/' . $data['uid']);
            } else {
                $this->db->close();
                
                return redirect()->to('/formulir')->with('errors', ['Formulir gagal dikirim. Isi data dengan benar!']);
            }
        } else {
            $this->db->close();
            
            return redirect()->to('/formulir')->with('errors', ['Formulir gagal dikirim. Foto KTP kosong!']);
        }
        
        // return $this->response->setJSON($data); 
    }
    
    public function view($uid) {
        helper('number');
        
        // $this->auth->verify('sales');
        
        $userData = $this->auth->getData();
        
        $data = [
            'userData'  => $userData,
            'data'      => [
                'uid'           => $uid,
                'totalResults'  => 0,
                'result'        => [],
                'sendUrl'       => null
            ]
        ];
        
        $this->builder->select('name, phoneNumber, address, identity, unit, price, tenor, package, insurance, date, surveyor, location, sales, dealer, dateSubmitted');
        $this->builder->where('uid', $uid);
        
        $query  = $this->builder->get(1);
        $row    = $query->getResult('array');
        
        // if($data['userData']['dealer'] != $row[0]['dealer']) {
        //     return redirect()->to('/');
        // }
        
        if(count($row) > 0) {
            $data['data']['totalResults']   = count($row);
            $data['data']['result']         = $row;
            
            for($i = 0; $i < count($row); $i++) {
                $unitCode   = $row[$i]['unit'];
                
                $data['data']['result'][$i]['identity']         = json_decode($row[$i]['identity']);
                $data['data']['result'][$i]['price']            = number_to_currency((int) $row[$i]['price'], 'IDR', 'id_ID', 0);
                $data['data']['result'][$i]['package']          = !empty($row[$i]['package'])|| $row[$i]['package'] != null ? $row[$i]['package'] : '-';
                $data['data']['result'][$i]['insurance']        = (int) $row[$i]['insurance'];
                $data['data']['result'][$i]['date']             = $this->dateFormat->format(strtotime($row[$i]['date']));
                $data['data']['result'][$i]['dateSubmitted']    = date("d/m/Y H:i:s", strtotime($row[$i]['dateSubmitted']));
            }
            
            $to         = $this->db->query("SELECT whatsAppNumber FROM settings WHERE id='1'")->getRow('whatsAppNumber');
            $content    = [];
            
            $content[0]     = 'Order #' . $uid;
            $content[1]     = '--------------';
            $content[2]     = 'Selengkapnya cek:';
            $content[3]     = 'https://sarmtf.com/dashboard/view/'. $uid;
            $content[4]     = '--------------';
            $content[5]     = 'Dealer: ' . $data['data']['result'][0]['dealer'];
            $content[6]     = 'Unit: ' . $data['data']['result'][0]['unit'];
            $content[7]     = 'Harga: ' . $data['data']['result'][0]['price'];
            $content[8]     = 'Tenor: ' . $data['data']['result'][0]['tenor'];
            $content[9]     = 'Paket: ' . $data['data']['result'][0]['package'];
            $content[10]    = '--------------';
            $content[11]    = 'Sales: ' . $data['data']['result'][0]['sales'];
            $content[12]    = 'CMO: ' . $data['data']['result'][0]['surveyor'];
            $content[13]    = 'Lokasi Survey: ' . $data['data']['result'][0]['location'];
            
            $data['data']['sendUrl'] = 'https://wa.me/' . $to . '?text=' . urlencode(join("\n", $content));
        }
        
        $this->db->close();
        
        return view('form-view', $data);
        // return $this->response->setJSON($data);
    }
}