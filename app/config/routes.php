<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/
$router->get('', 'Admin/ProductController::index');

$router->group('/product', function() use ($router){
    $router->get('/home', 'Admin/ProductController::index');
    $router->get('/trash', 'Admin/ProductController::trash');
    $router->match('/create', 'Admin/ProductController::product', ['GET', 'POST']);
    $router->match('/upload', 'Admin/ProductController::upload', ['GET', 'POST']);
    $router->match('/update/{id}', 'Admin/ProductController::update', ['GET', 'POST']);
    $router->match('/delete/{id}', 'Admin/ProductController::delete', ['GET', 'POST']);
    $router->match('/restore/{id}', 'Admin/ProductController::restore', ['GET', 'POST']);
    $router->match('/soft-delete/{id}', 'Admin/ProductController::soft_delete', ['GET', 'POST']);
});

$router->group('/auth', function() use ($router){
    $router->match('/verify-email', 'Auth::verify_email', ['POST', 'GET']);
    $router->match('/login', 'Auth::login', ['POST', 'GET']);
    $router->get('/logout', 'Auth::logout');
    $router->match('/password-reset', 'Auth::password_reset', ['POST', 'GET']);
    $router->match('/set-new-password', 'Auth::set_new_password', ['POST', 'GET']);
});

$router->group('/staff', function() use ($router){
    $router->get('/home', 'UserController::index');
    $router->get('/trash', 'UserController::trash');
});