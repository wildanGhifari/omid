<?php

defined('BASEPATH') or exit('No direct script access allowed');

class About extends My_Controller
{

    public function index()
    {
        $data['title']  = 'About Us | Omid Health Style';
        $data['page']   = 'pages/about/index';

        $this->view($data);
    }
}

/* End of file About.php */
