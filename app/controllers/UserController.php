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
            $time = $this->io->post('transaction_time');
            $itemsJson = $this->io->post('items');

            // Decode the JSON items array
            $items = json_decode($itemsJson, true);
            
                $data = [
                'total' => $total,
                'cashier' => $name,
                'timestamp' => $time
                ];

                $this->TransactionModel->insert($data);

                foreach ($items as $item) {

                $id = $item['product_id']; // product ID
                $qty = $item['qty'];       // quantity bought

                $product = $this->ProductModel->find($id);


                $newStock = $product['stock'] - $qty;
                $newSold = $product['stock'] + $qty;

                $product = [
                'stock' => $newStock,
                'sold' => $newSold
                ];

                $this->ProductModel->update($id, $product);
            }

                $this->session->set_flashdata('alert', 'success');
                    $this->session->set_flashdata('message', 'Transaction completed!');
            redirect('pos');
        }
    }
}