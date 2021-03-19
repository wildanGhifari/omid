<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends My_Controller {

    public function index()
    {
        $data['title']  = 'FAQs | Omid Health Style';
        $data['page']  = 'pages/faqs/index';

        $this->view($data);
    }

}

/* End of file Faqs.php */
