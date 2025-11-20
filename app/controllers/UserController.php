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
        $this->call->model('TransactionModel');
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
        $data['products'] = $this->ProductModel->stock();
        $this->call->view('home_user', $data);
    }

    public function transaction()
    {
        if($this->io->method() == 'post'){
            $total = $this->io->post('total');
            $name = $this->io->post('cashier');
            
                $data = [
                'total' => $total,
                'cashier' => $name
                ];

                $this->TransactionModel->insert($data);

                /*if ($this->ProductModel->insert($data)) {
                    $this->session->set_flashdata('message', 'Product inserted successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong.');
                }*/
            redirect('pos');
        }
    }
}