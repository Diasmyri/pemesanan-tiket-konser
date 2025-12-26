<?php

use CodeIgniter\Router\RouteCollection;

/*
|--------------------------------------------------------------------------
| DEFAULT ROUTE
|--------------------------------------------------------------------------
*/
$routes->get('/', fn() => redirect()->to('/admin/auth/login'));
$routes->get('admin', fn() => redirect()->to('/admin/auth/login'));

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
$routes->group('admin', function ($routes) {

    // =======================
    // AUTH
    // =======================
    $routes->get('auth/login', 'Admin\Auth::login');
    $routes->post('auth/loginProcess', 'Admin\Auth::loginProcess');
    $routes->get('auth/logout', 'Admin\Auth::logout');
    $routes->get('login', fn() => redirect()->to('/admin/auth/login'));

    // =======================
    // DASHBOARD
    // =======================
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // =======================
    // MASTERS
    // =======================
    $routes->group('masters', function ($routes) {

        // Artists
        $routes->get('artists', 'Admin\Masters\Artists::index');
        $routes->get('artists/create', 'Admin\Masters\Artists::create');
        $routes->post('artists/store', 'Admin\Masters\Artists::store');
        $routes->get('artists/edit/(:num)', 'Admin\Masters\Artists::edit/$1');
        $routes->post('artists/update/(:num)', 'Admin\Masters\Artists::update/$1');
        $routes->get('artists/delete/(:num)', 'Admin\Masters\Artists::delete/$1');

        // Events
        $routes->get('events', 'Admin\Masters\Events::index');
        $routes->get('events/create', 'Admin\Masters\Events::create');
        $routes->post('events/store', 'Admin\Masters\Events::store');
        $routes->get('events/edit/(:num)', 'Admin\Masters\Events::edit/$1');
        $routes->post('events/update/(:num)', 'Admin\Masters\Events::update/$1');
        $routes->get('events/delete/(:num)', 'Admin\Masters\Events::delete/$1');

        // Venues
        $routes->get('venues', 'Admin\Masters\Venues::index');
        $routes->get('venues/create', 'Admin\Masters\Venues::create');
        $routes->post('venues/store', 'Admin\Masters\Venues::store');
        $routes->get('venues/edit/(:num)', 'Admin\Masters\Venues::edit/$1');
        $routes->post('venues/update/(:num)', 'Admin\Masters\Venues::update/$1');
        $routes->get('venues/delete/(:num)', 'Admin\Masters\Venues::delete/$1');

        // Ticket Types
        $routes->get('tickettypes', 'Admin\Masters\TicketTypes::index');
        $routes->get('tickettypes/create', 'Admin\Masters\TicketTypes::create');
        $routes->post('tickettypes/store', 'Admin\Masters\TicketTypes::store');
        $routes->get('tickettypes/edit/(:num)', 'Admin\Masters\TicketTypes::edit/$1');
        $routes->post('tickettypes/update/(:num)', 'Admin\Masters\TicketTypes::update/$1');
        $routes->get('tickettypes/delete/(:num)', 'Admin\Masters\TicketTypes::delete/$1');

        // Users
        $routes->get('users', 'Admin\Masters\Users::index');
    });

    // =======================
    // TRANSACTIONS (ADMIN)
    // =======================
    $routes->group('transactions', ['namespace' => 'App\Controllers\Admin\Transactions'], function ($routes) {

        $routes->get('orders', 'Orders::index');
        $routes->get('orders/ticket-types/(:num)', 'Orders::getTicketTypes/$1');

        $routes->get('payments', 'Payments::index');
        $routes->post('payments/store', 'Payments::store');
        $routes->get('payments/orderDetail/(:num)', 'Payments::orderDetail/$1');

        $routes->get('checkin', 'Checkin::index');
        $routes->get('checkin/create', 'Checkin::create');
        $routes->post('checkin/store', 'Checkin::store');
        $routes->post('checkin/process', 'Checkin::process');

        $routes->get('refunds', 'Refunds::index');
        $routes->get('refunds/approve/(:num)', 'Refunds::approve/$1');
        $routes->get('refunds/reject/(:num)', 'Refunds::reject/$1');
        $routes->get('refunds/refunded/(:num)', 'Refunds::refunded/$1');
    });

    // =======================
    // REPORTS
    // =======================
    $routes->group('reports', ['namespace' => 'App\Controllers\Admin\Reports'], function ($routes) {
        $routes->get('daily', 'Daily::index');
        $routes->get('monthly', 'Monthly::index');
        $routes->get('daily/export/pdf', 'Daily::exportPDF');
        $routes->get('daily/export/excel', 'Daily::exportExcel');
        $routes->get('monthly/export/pdf', 'Monthly::exportPDF');
        $routes->get('monthly/export/excel', 'Monthly::exportExcel');
    });
});

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/
$routes->group('user', function ($routes) {

    // Landing
    $routes->get('/', 'User\Auth::homeLogin');

    // Auth
    $routes->get('login', 'User\Auth::loginForm');
    $routes->post('login', 'User\Auth::loginProcess');
    $routes->get('register', 'User\Auth::registerForm');
    $routes->post('register', 'User\Auth::registerProcess');
    $routes->get('forgot-password', 'User\Auth::forgotForm');
    $routes->post('forgot-password', 'User\Auth::forgotProcess');
    $routes->get('auth/artists/(:num)', 'User\Auth::artists/$1');
    // Home
    $routes->get('home', 'User\Home::index');

    // Events
    $routes->get('events', 'User\Event::index');
    $routes->get('event/getArtists/(:num)', 'User\Event::getArtists/$1');
    $routes->get('event/getTicketTypes/(:num)', 'User\Event::getTicketTypes/$1');
    $routes->post('event/buyTicket', 'User\Event::buyTicket');

    // 🔥 ROUTE BARU (INI YANG BIKIN TIDAK 404)
    $routes->get('event/artists/(:num)', 'User\Event::artists/$1');

    // Orders
    $routes->get('orders', 'User\Orders::index');
    $routes->get('orders/create/(:num)', 'User\Orders::create/$1');
    $routes->post('orders/store', 'User\Orders::store');

    // Transactions
    $routes->get('transactions', 'User\Transactions::index');
    $routes->post('transactions/pay/store', 'User\Transactions::storePayment');
    $routes->post('transactions/refund/store', 'User\Transactions::storeRefund');
    $routes->delete('transactions/cancel/(:num)', 'User\Transactions::cancelOrder/$1');
    $routes->get('transactions/qr/(:any)', 'User\Transactions::qr/$1');

// Profile
$routes->get('profile', 'User\Profile::index');
$routes->post('profile/update', 'User\Profile::update');


    // Logout
    $routes->get('logout', 'User\Auth::logout');
});
