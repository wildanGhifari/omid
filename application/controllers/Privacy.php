<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Privacy extends MY_Controller
{

    public function index()
    {
        $data['title']  = 'Privacy Policy | Omid Health Style';
        $data['page']   = 'pages/privacy/index';

        $this->view($data);
    }
}

/* End of file Privacy.php */
