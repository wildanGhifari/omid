<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shopping extends MY_Controller
{

    public function index($page = null)
    {
        $data['title']  = 'Shopping | Omid Health Style';
        $data['content']    = $this->shopping->select([
            'product.id', 'product.title AS product_title', 'product.description',
            'product.image', 'product.price', 'product.is_available',
            'category.title AS category_title', 'category.slug AS category_slug'
        ])
            ->join('category')
            ->where('product.is_available', 1)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->shopping->where('product.is_available', 1)->count();
        $data['pagination'] = $this->shopping->makePagination(
            base_url('shopping'),
            2,
            $data['total_rows']
        );
        $data['page']   = 'pages/shopping/index';

        $this->view($data);
    }


    public function detail($id)
    {
        $data['product']       = $this->shopping->where('id', $id)->first();
        if (!$data['product']) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('shopping'));
        }

        $this->shopping->table   = 'product';
        $data['product']   = $this->shopping->select([
            'product.id', 'product.title AS product_title', 'product.description',
            'product.image', 'product.price', 'product.is_available',
            'category.title AS category_title', 'category.slug AS category_slug'
        ])
            ->join('category')->where('product.id', $id)->where('product.is_available', 1)->get();
        $data['total_rows'] = $this->shopping->where('product.is_available', 1)->count();
        $data['pagination'] = $this->shopping->makePagination(
            base_url('shopping'),
            2,
            $data['total_rows']
        );

        $data['page']           = 'pages/shopping/detail';

        $this->view($data);
    }

    // public function reset()
    // {
    //     $this->session->unset_userdata('keyword');
    //     redirect(base_url('shopping'));
    // }
}

/* End of file Shopping.php */
