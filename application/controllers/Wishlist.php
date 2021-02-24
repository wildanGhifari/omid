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
            'wishlist.id', 'wishlist.qty', 'wishlist.subtotal', 'product.title AS product_title',
            'product.image', 'product.slug', 'product.id_category',
            'product.price', 'product.weight', 'category.title AS category_title',
            'category.slug AS category_slug'
        ])
            ->join('product')->join('category')->where('wishlist.id_user', $this->id)->get();

        $data['page']   = 'pages/wishlist/index';

        return $this->view($data);
    }

    public function add()
    {
        if (!$_POST || $this->input->post('qty') < 1) {
            $this->session->set_flashdata('error', 'Product quantity cannot be empty.');
            redirect(base_url());
        } else {
            $input                  = (object) $this->input->post(null, true);

            $this->wishlist->table  = 'product';
            $product                = $this->wishlist->where('id', $input->id_product)->first();

            $subtotal               = $product->price * $input->qty;

            $this->wishlist->table  = 'wishlist';
            $wishlist                   = $this->wishlist->where('id_user', $this->id)->where('id_product', $input->id_product)->first();

            if ($wishlist) {
                $data = [
                    'qty'           => $wishlist->qty + $input->qty,
                    'subtotal'      => $wishlist->subtotal + $subtotal
                ];

                if ($this->wishlist->where('id', $wishlist->id)->update($data)) {
                    $this->session->set_flashdata('success', 'Product successfully added!');
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong.');
                }

                redirect(base_url(''));
            }

            $data = [
                'id_user'       => $this->id,
                'id_product'    => $input->id_product,
                'id_category'    => $input->id_category,
                'qty'           => $input->qty,
                'subtotal'      => $subtotal
            ];

            if ($this->wishlist->create($data)) {
                $this->session->set_flashdata('success', 'Product successfully added!');
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong.');
            }

            redirect(base_url('shopping'));
        }
    }

    public function update($id)
    {
        if (!$_POST || $this->input->post('qty') < 1) {
            $this->session->set_flashdata('error', 'Product quantity cannot be empty.');
            redirect(base_url('wishlist/index'));
        }

        $data['content']    = $this->wishlist->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data cannnot be found!');
            redirect(base_url('wishlist/index'));
        }

        $data['input']      = (object) $this->input->post(null, true);
        $this->wishlist->table    = 'product';
        $product            = $this->wishlist->where('id', $data['content']->id_product)->first();

        $subtotal           = $data['input']->qty * $product->price;

        $wishlist               = [
            'qty'       => $data['input']->qty,
            'subtotal'  => $subtotal
        ];

        $this->wishlist->table  = 'wishlist';
        if ($this->wishlist->where('id', $id)->update($wishlist)) {
            $this->session->set_flashdata('success', 'Product successfully updated!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong.');
        }

        redirect(base_url('/wishlist/index'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('wishlist/index'));
        }

        if (!$this->wishlist->where('id', $id)->first()) {
            $this->session->set_flashdata('warning', 'Sorry, The data does not exist!');
            redirect(base_url('wishlist/index'));
        }

        if ($this->wishlist->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data successfully deleted!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong.');
        }

        redirect(base_url('wishlist/index'));
    }
}

/* End of file Wishlist.php */
