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
            'product.image', 'product.slug', 'product.id_category',
            'product.price', 'product.weight'
        ])
            ->join('product')->where('wishlist.id_user', $this->id)->get();

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
                'qty'           => $input->qty,
                'subtotal'      => $subtotal
            ];

            if ($this->wishlist->create($data)) {
                $this->session->set_flashdata('success', 'Product successfully added!');
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong.');
            }

            redirect(base_url(''));
        }
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
