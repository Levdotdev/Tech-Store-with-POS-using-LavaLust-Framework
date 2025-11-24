<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: _AdminController
 * 
 * Automatically generated via CLI.
 */
class _AdminController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('ProductModel');
        $this->call->model('StaffModel');
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
            else if(logged_in() && $this->lauth->get_role($id) == "user") {
                redirect('pos');
            }
        }
    }

    public function index(){
        $this->pagination->set_options([
            'first_link'     => 'First',
            'last_link'      => 'Last',
            'next_link'      => '→',
            'prev_link'      => '←',
            'page_delimiter' => '&page='
        ]);

        $q = trim($this->io->get('q') ?? '');
        $r = trim($this->io->get('r') ?? '');
        $s = trim($this->io->get('s') ?? '');
        $t = trim($this->io->get('t') ?? '');
        $u = trim($this->io->get('u') ?? '');

        $page_products     = (int) ($this->io->get('page_products') ?? 1);
        $page_inventory    = (int) ($this->io->get('page_inventory') ?? 1);
        $page_users        = (int) ($this->io->get('page_users') ?? 1);
        $page_transactions = (int) ($this->io->get('page_transactions') ?? 1);
        $page_applicants   = (int) ($this->io->get('page_applicants') ?? 1);

        $records_per_page = 5;

        $all = $this->ProductModel->products($q, $records_per_page, $page_products);
        $data['all'] = $all['records'];

        $this->pagination->set_theme('custom');
        $this->pagination->initialize(
            $all['total_rows'], 
            $records_per_page, 
            $page_products,
            '?q=' . $q . '&page_products='
        );
        $data['page_products'] = $this->pagination->paginate();


        $all = $this->ProductModel->inventory($r, $records_per_page, $page_inventory);
        $data['inventory'] = $all['records'];

        $this->pagination->initialize(
            $all['total_rows'], 
            $records_per_page, 
            $page_inventory,
            '?r=' . $r . '&page_inventory='
        );
        $data['page_inventory'] = $this->pagination->paginate();


        $all = $this->StaffModel->users($s, $records_per_page, $page_users);
        $data['users'] = $all['records'];

        $this->pagination->initialize(
            $all['total_rows'], 
            $records_per_page, 
            $page_users,
            '?s=' . $s . '&page_users='
        );
        $data['page_users'] = $this->pagination->paginate();


        $all = $this->TransactionModel->transactions($t, $records_per_page, $page_transactions);
        $data['transactions'] = $all['records'];

        $this->pagination->initialize(
            $all['total_rows'], 
            $records_per_page, 
            $page_transactions,
            '?t=' . $t . '&page_transactions='
        );
        $data['page_transactions'] = $this->pagination->paginate();


        $all = $this->StaffModel->applicants($u, $records_per_page, $page_applicants);
        $data['applicants'] = $all['records'];

        $this->pagination->initialize(
            $all['total_rows'], 
            $records_per_page, 
            $page_applicants,
            '?u=' . $u . '&page_applicants='
        );
        $data['page_applicants'] = $this->pagination->paginate();


        $data['sales'] = $this->db
            ->table('transactions')
            ->select_sum('total', 'total')
            ->get();

        $data['sold'] = $this->db
            ->table('products')
            ->select_sum('sold', 'sold')
            ->whereNull('deleted_at')
            ->get();

        $res = $this->db->raw("SELECT COUNT(stock) AS total FROM products WHERE stock < 5 AND deleted_at IS NULL");
        $data['low_stock'] = $res->fetch();


        $this->call->view('home', $data);
    }

    public function settings(){
        if($this->io->method() == 'post'){
            $email = $this->io->post('email');
            $password = $this->io->post('current-password');
            $pass = $this->io->post('new-password');
            $pass2 = $this->io->post('confirm-password');

            $this->lauth->reset_admin($password, $email, $pass, $pass2);
            redirect('');
        }
    }
}