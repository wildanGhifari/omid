<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist extends MY_Controller
{

    private $id;

    public function __construct()
    {
        parent::__construct();
        $is_login   = $this->session->userdata('is_login');
        $this->id   = $this->session->userdata('id');

        if (!$is_login) {
            $this->session->set_flashdata('error', 'Please Login first.');
            redirect(base_url('login'));
            return;
        }
    }

    public function index()
    {
        $data['title']      = 'My Wishlist | Omid Health Style';
        $data['content']    = $this->wishlist->select([
            'wishlist.id', 'wishlist.qty', 'product.id', 'product.title',
            'product.image', 'product.slug', 'product.category',
            'product.price', 'product.weight'
        ])
            ->join('product')->where('wishlist.id_user', $this->id)->get();

        $data['page']   = 'pages/wishlist/index';

        return $this->view($data);
    }
}

/* End of file Wishlist.php */
