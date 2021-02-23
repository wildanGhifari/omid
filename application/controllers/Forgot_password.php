<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Forgot_password extends MY_Controller
{

    public function index()
    {
        $data['title'] = 'Forgot Password';
        $data['page']   = 'pages/auth/forgot_password';

        $this->view($data);
    }
}

/* End of file Forgot_password.php */
