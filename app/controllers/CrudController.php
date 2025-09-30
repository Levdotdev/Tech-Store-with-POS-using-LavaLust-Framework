<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: CrudController
 * 
 * Automatically generated via CLI.
 */
class CrudController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('CrudModel');
        if(segment(2) != 'logout') {
            $id = $this->lauth->get_user_id();
            if($this->lauth->is_user_verified($id) == 0){
                if($this->lauth->set_logged_out()) {
                    redirect('auth/login');
                }
            }
            else if(logged_in() && $this->lauth->get_role($id) == "user") {
                redirect('home-user');
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
        $this->pagination->initialize($total_rows, $records_per_page, $page,'home/?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('home', $data);
    }

    public function create()
    {
        if($this->io->method() == 'post'){
            $name = $this->io->post('name');
            $class = $this->io->post('class');

            $this->call->library('upload', $_FILES["fileToUpload"]);
		    $this->upload
			->max_size(5)
			//->min_size(1)
			->set_dir('uploads')
			->allowed_extensions(array('png', 'jpg'))
			->allowed_mimes(array('image/png', 'image/jpeg'))
			->is_image()
			->encrypt_name();

            if($this->upload->do_upload()){
                $data = [
                'name' => $name,
                'class' => $class,
                'pic' => $this->upload->get_filename()
            ];
                $this->CrudModel->insert($data);
                redirect();
            }
        }
        else{
            $this->call->view('create');
        }
    }

    public function update($id)
    {
        $data['char'] = $this->CrudModel->find($id);
        if($this->io->method() == 'post'){
            $name = $this->io->post('name');
            $class = $this->io->post('class');

            $this->call->library('upload', $_FILES["fileToUpload"]);
		    $this->upload
			->max_size(5)
			//->min_size(1)
			->set_dir('uploads')
			->allowed_extensions(array('png', 'jpg'))
			->allowed_mimes(array('image/png', 'image/jpeg'))
			->is_image()
			->encrypt_name();

            if($this->upload->do_upload()){
                $data = [
                'name' => $name,
                'class' => $class,
                'pic' => $this->upload->get_filename()
            ];
                $this->CrudModel->update($id, $data);
                redirect();
            }
        }
        else{
            $this->call->view('update', $data);
        }
    }

    function delete($id){
        if($this->lauth->get_role($id) == "admin") {
            $this->CrudModel->delete($id);
            redirect('trash');
        }
    }

    function soft_delete($id){
        if($this->lauth->get_role($id) == "admin") {
            $this->CrudModel->soft_delete($id);
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
        $this->pagination->initialize($total_rows, $records_per_page, $page,'trash/?q='.$q);
        $data['page'] = $this->pagination->paginate();
        $this->call->view('trash', $data);
    }

    function restore($id){
        if($this->lauth->get_role($id) == "admin") {
            return;
        }
        $this->CrudModel->restore($id);
        redirect('trash');
    }
}