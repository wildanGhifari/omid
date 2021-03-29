<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $is_login   = $this->session->userdata('is_login');

        if ($is_login) {
            redirect(base_url());
            return;
        }
    }


    public function index()
    {
        if (!$_POST) {
            $input  = (object) $this->register->getDefaultValues();
        } else {
            $input  = (object) $this->input->post(null, true);
        }

        if (!$this->register->validate()) {
            $data['title']  = 'Register';
            $data['input']  = $input;
            $data['page']   = 'pages/auth/register';
            $this->view($data);
            return;
        }

        if ($this->register->run($input)) {
            $this->session->set_flashdata('success', 'Successfully registered, please check the verification email in your inbox');

            redirect(base_url('/login'));
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
            redirect(base_url('/register'));
        }
    }


    public function activate()
    {
        $id = $this->uri->segment(4);
        $userToken = $this->uri->segment(5);

        $user = $this->register->where('id', $id)->get();
        if($user['token'] == $userToken){
            $this->register->update(['is_active' => 1]);
            $this->session->set_flashdata('success', 'Your account has been activated');
        } else {
            $this->session->set_flashdata('error', 'Oops! something wnet wrong');
        }

        redirect('/login');
        
    }
}

/* End of file Register.php */
