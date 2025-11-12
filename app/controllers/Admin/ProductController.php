<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: ProductController
 * 
 * Automatically generated via CLI.
 */
class ProductController extends Controller {
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
            else if(logged_in() && $this->lauth->get_role($id) == "user") {
                redirect('home-user');
            }
        }
    }

    public function index(){
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        $all = $this->ProductModel->products($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => 'First',
            'last_link'      => 'Last',
            'next_link'      => '→',
            'prev_link'      => '←',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page,'home/?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('home', $data);
    }

    public function product()
    {
        if($this->io->method() == 'post'){
            $id = $this->io->post('product_id');
            $name = $this->io->post('product_name');
            $category = $this->io->post('category');
            $price = $this->io->post('unit_price');

            
                $data = [
                'id' => $id,
                'name' => $name,
                'category' => $category,
                'price' => $price
                ];

                $this->ProductModel->insert($data);
                redirect();
        }
    }

    public function update($id)
    {
        $char = $this->ProductModel->find($id);
        if($this->io->method() == 'post'){
            $id = $this->io->post('product_id');
            $name = $this->io->post('product_name');
            $category = $this->io->post('category');
            $price = $this->io->post('unit_price');

                $data = [
                'id' => $id,
                'name' => $name,
                'category' => $category,
                'price' => $price
                ];

                $this->ProductModel->update($data);
                redirect();
        }
    }

    function delete($id){
        if($this->lauth->get_role(get_user_id()) == "admin") {
            $this->ProductModel->delete($id);
            redirect('trash');
        }
    }

    function soft_delete($id){
        if($this->lauth->get_role(get_user_id()) == "admin") {
            $this->ProductModel->soft_delete($id);
            redirect();
        }
    }

    function trash(){
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        $all = $this->ProductModel->page_trash($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => 'First',
            'last_link'      => 'Last',
            'next_link'      => '→',
            'prev_link'      => '←',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page,'trash/?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('trash', $data);
    }

    function restore($id){
        if($this->lauth->get_role(get_user_id()) == "admin") {
            $this->ProductModel->restore($id);
            redirect('trash');
        }
    }
}