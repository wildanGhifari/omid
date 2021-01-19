<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MY_Controller
{

    public function index()
    {
        $data['title']  = 'Contact Us | Omid Health Style';
        $data['page']   = 'pages/contact/index';

        $this->view($data);
    }
}

/* End of file Contact.php */
