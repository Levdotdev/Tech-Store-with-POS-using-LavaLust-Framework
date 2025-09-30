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
        $this->call->model('CrudModel');
        if(segment(2) != 'logout') {
            $id = $this->lauth->get_user_id();
            if(logged_in() && $this->lauth->get_role($id) == "admin") {
                redirect('home');
            }
            else if(!logged_in()){
                redirect('auth/login');
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

        $all = $this->CrudModel->page_home($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page,'home-user/?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('home_user', $data);
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

        $all = $this->CrudModel->page_trash($q, $records_per_page, $page);
        $data['all'] = $all['records'];
        $total_rows = $all['total_rows'];
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); // or 'tailwind', or 'custom'
        $this->pagination->initialize($total_rows, $records_per_page, $page,'trash-user/?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('trash_user', $data);
    }
}