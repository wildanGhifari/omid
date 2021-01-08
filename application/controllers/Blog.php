<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
{

    public function index()
    {
        $data['title']  = 'Blog | Omid Health Style';
        $data['page']   = 'pages/blog/index';

        $this->view($data);
    }
}

/* End of file Blog.php */
