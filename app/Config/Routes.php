<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index');
$routes->get('warning', 'Home::warning');

$routes->get('/cart/(:num)', 'Home::cart/$1', ['filter' => 'login']);
$routes->get('catalog', 'Home::catalog');
$routes->post('catalog', 'Home::catalog');
$routes->get('/shopping_cart', 'Home::shopping_cart', ['filter' => 'login']);
$routes->get('/add_cart/(:num)', 'Home::add_cart/$1', ['filter' => 'login']);
$routes->get('/remove_cart/(:any)', 'Home::remove_cart/$1', ['filter' => 'login']);
$routes->get('/remove_catalog/(:any)', 'Home::remove_catalog/$1', ['filter' => 'login']);
$routes->post('/formulir', 'Home::formulir', ['filter' => 'login']);
$routes->get('/formulir', 'Home::formulir', ['filter' => 'login']);
$routes->post('/hubungi', 'Home::hubungi', ['filter' => 'login']);

$routes->get('/add_product', 'RootAdmin::index', ['filter' => 'role:root_admin, login']);
$routes->post('/save_product', 'RootAdmin::save_product', ['filter' => 'role:root_admin, login']);
$routes->delete('/delete_product/(:num)', 'RootAdmin::delete_product/$1', ['filter' => 'role:root_admin, login']);
$routes->get('/edit_product/(:num)', 'RootAdmin::edit_product/$1', ['filter' => 'role:root_admin, login']);
$routes->post('/change_product/(:num)', 'RootAdmin::change_product/$1', ['filter' => 'role:root_admin, login']);
$routes->get('/daftar_user', 'RootAdmin::daftar_user', ['filter' => 'role:root_admin, login']);
$routes->get('/detail_user/(:num)', 'RootAdmin::detail_user/$1', ['filter' => 'role:root_admin, login']);
$routes->post('/updateStatus/(:num)', 'RootAdmin::updateStatus/$1', ['filter' => 'role:root_admin, login']);
$routes->post('/save_user', 'RootAdmin::save_user', ['filter' => 'role:root_admin, login']);
$routes->post('/update_user/(:num)', 'RootAdmin::update_user/$1', ['filter' => 'role:root_admin, login']);
$routes->delete('/hapus_user/(:num)', 'RootAdmin::hapus_user/$1', ['filter' => 'role:root_admin, login']);
$routes->get('/daftar_menu', 'RootAdmin::daftar_menu', ['filter' => 'role:root_admin, login']);
$routes->post('/save_menu', 'RootAdmin::save_menu', ['filter' => 'role:root_admin, login']);
$routes->post('/change_menu/(:num)', 'RootAdmin::change_menu/$1', ['filter' => 'role:root_admin, login']);
$routes->delete('/delete_menu/(:num)', 'RootAdmin::delete_menu/$1', ['filter' => 'role:root_admin, login']);
$routes->get('/daftar_submenu', 'RootAdmin::daftar_submenu', ['filter' => 'role:root_admin, login']);
$routes->post('/save_submenu', 'RootAdmin::save_submenu', ['filter' => 'role:root_admin, login']);
$routes->post('/change_submenu/(:num)', 'RootAdmin::change_submenu/$1', ['filter' => 'role:root_admin, login']);
$routes->delete('/delete_submenu/(:num)', 'RootAdmin::delete_submenu/$1', ['filter' => 'role:root_admin, login']);
$routes->post('/active/(:num)', 'RootAdmin::active/$1', ['filter' => 'role:root_admin, login']);

$routes->post('/print/(:num)', 'Admin::print/$1', ['filter' => 'role:admin, root_admin, login']);
$routes->get('/print/(:num)', 'Admin::print/$1', ['filter' => 'role:admin, root_admin, login']);
$routes->get('/transaksi', 'Admin::transaksi', ['filter' => 'role:admin, root_admin, login',]);
$routes->delete('/hapus_transaksi/(:num)', 'Admin::hapus_transaksi/$1', ['filter' => 'role:admin, root_admin, login']);
$routes->get('/detail_transaksi/(:num)', 'Admin::detail_transaksi/$1', ['filter' => 'role:admin, root_admin, login']);

$routes->get('/daftar_event', 'RootAdmin::daftar_event', ['filter' => 'role:root_admin, login']);
$routes->post('/save_event', 'RootAdmin::save_event', ['filter' => 'role:root_admin, login']);