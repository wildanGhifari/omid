<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Terms extends MY_Controller
{

    public function index()
    {
        $data['title']  = 'Terms & Conditions | Omid Health Style';
        $data['page']   = 'pages/terms/index';

        $this->view($data);
    }
}

/* End of file Terms.php */
