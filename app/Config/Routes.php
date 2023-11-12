<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'BankAccountController::index');
$routes->get('/bank_accounts', 'BankAccountController::index');
$routes->post('add-bank-account', 'BankAccountController::store');
$routes->post('edit-bank-account', 'BankAccountController::edit');
$routes->post('update-bank-account', 'BankAccountController::update');
$routes->post('delete-bank-account', 'BankAccountController::delete');

