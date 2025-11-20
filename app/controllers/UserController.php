<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Automatically generated via CLI.
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('ProductModel');
        if(segment(2) != 'logout') {
            $id = $this->lauth->get_user_id();
            if(!logged_in()){
                redirect('auth/login');
            }
            else if($this->lauth->is_user_verified($id) == 0){
                if($this->lauth->set_logged_out()) {
                    redirect('auth/login');
                }
            }
            else if(logged_in() && $this->lauth->get_role($id) == "admin") {
                redirect('');
            }
        }
    }

    public function index(){
        $data['products'] = $this->ProductModel->all();
        $this->call->view('home_user', $data);
    }
}