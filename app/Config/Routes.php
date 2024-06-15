<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/',                                       'Home::index');           
$routes->post('/login',                                 'Home::login');               
$routes->get('/logout',                                 'Home::logout');        

$routes->get('/dashboard',                              'Dashboard::index');         
$routes->match(['post', 'get'], '/dashboard/search',    'Dashboard::search');  
// $routes->get('/dashboard/view',                         'Dashboard::all');   
$routes->get('/dashboard/view/(:num)',                  'Dashboard::view/$1'); 
$routes->get('/dashboard/view/(:num)/hapus',            'Dashboard::delete/$1'); 
$routes->get('/dashboard/tabel',                        'Dashboard::table');    

$routes->get('/dashboard/pengaturan',                   'Setting::index');      
$routes->post('/dashboard/pengaturan/simpan',           'Setting::save');       

$routes->get('/dashboard/sales',                        'Sales::index');        
$routes->post('/dashboard/sales/tambah',                'Sales::create');       
$routes->get('/dashboard/sales/(:segment)',             'Sales::read/$1');       
$routes->post('/dashboard/sales/(:segment)/edit',       'Sales::update/$1');    
$routes->get('/dashboard/sales/(:segment)/hapus',       'Sales::delete/$1');     
       
$routes->get('/dashboard/surveyor',                     'Surveyor::index');     
$routes->post('/dashboard/surveyor/tambah',             'Surveyor::create');    
$routes->get('/dashboard/surveyor/(:segment)',          'Surveyor::read/$1');   
$routes->post('/dashboard/surveyor/(:segment)/edit',    'Surveyor::update/$1'); 
$routes->get('/dashboard/surveyor/(:segment)/hapus',    'Surveyor::delete/$1'); 
     
$routes->get('/dashboard/unit',                         'Unit::index');         
$routes->post('/dashboard/unit/tambah',                 'Unit::create');        
$routes->get('/dashboard/unit/(:segment)',              'Unit::read/$1');       
$routes->post('/dashboard/unit/(:segment)/edit',        'Unit::update/$1');     
$routes->get('/dashboard/unit/(:segment)/hapus',        'Unit::delete/$1');     
     
$routes->get('/dashboard/paket',                        'Package::index');      
$routes->post('/dashboard/paket/tambah',                'Package::create');     
$routes->get('/dashboard/paket/(:segment)',             'Package::read/$1');    
$routes->post('/dashboard/paket/(:segment)/edit',       'Package::update/$1');  
$routes->get('/dashboard/paket/(:segment)/hapus',       'Package::delete/$1');  

$routes->get('/formulir',                               'Form::index');               
$routes->post('/formulir/submit',                       'Form::submit');        
$routes->get('/formulir/(:num)',                        'Form::view/$1');       
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
