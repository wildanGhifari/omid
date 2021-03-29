<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');
        if ($role != 'admin') {
            redirect(base_url('/'));
            return;
        }
    }


    public function index($page = null)
    {
        $data['title']      = 'Admin: Product';
        $data['content']    = $this->product->select(
            [
                'product.id', 'product.title AS product_title', 'product.sku', 'product.image', 'product.price', 'product.is_available',
                'category.title AS category_title'
            ]
        )
            ->join('category')
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->product->count();
        $data['pagination'] = $this->product->makePagination(
            base_url('product'),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/product/index';

        $this->view($data);
    }


    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('product'));
        }

        $keyword            = $this->session->userdata('keyword');
        $data['title']      = 'Admin | Product';
        $data['content']    = $this->product->select(
            [
                'product.id', 'product.title AS product_title', 'product.sku', 'product.image', 'product.price', 'product.is_available',
                'category.title AS category_title'
            ]
        )
            ->join('category')
            ->like('product.title', $keyword)
            ->orlike('product.judul', $keyword)
            ->orlike('product.sku', $keyword)
            ->orlike('category.title', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->product->like('product.title', $keyword)->orlike('description', $keyword)->count();
        $data['pagination'] = $this->product->makePagination(
            base_url('product/search'),
            3,
            $data['total_rows']
        );
        $data['page']       = 'pages/product/index';

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('product'));
    }


    public function create()
    {
        if (!$_POST) {
            $input  = (object) $this->product->getDefaultValues();
        } else {
            $input  = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName  = url_title($input->title, '-', true) . '-' . date('Ymdhis');
            $upload     = $this->product->uploadImage('image', $imageName);
            if ($upload) {
                $input->image   = $upload['file_name'];
            } else {
                redirect(base_url('product/create'));
            }
        }

        if (!$this->product->validate()) {
            $data['title']          = 'Add new Product';
            $data['input']          = $input;
            $data['form_action']    = base_url('product/create');
            $data['page']           = 'pages/product/form';

            $this->view($data);
            return;
        }

        if ($this->product->create($input)) {
            $this->session->set_flashdata('success', 'New product successfully created.');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url('product'));
    }


    public function edit($id)
    {
        $data['content']    = $this->product->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('product'));
        }

        if (!$_POST) {
            $data['input']  = $data['content'];
        } else {
            $data['input']  = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName  = url_title($data['input']->title, '-', true) . '-' . date('Ymdhis');
            $upload     = $this->product->uploadImage('image', $imageName);
            if ($upload) {
                if ($data['content']->image !== '') {
                    $this->product->deleteImage($data['content']->image);
                }
                $data['input']->image   = $upload['file_name'];
            } else {
                redirect(base_url("product/edit/$id"));
            }
        }

        if (!$this->product->validate()) {
            $data['title']          = 'Edit Product';
            $data['form_action']    = base_url("product/edit/$id");
            $data['page']           = 'pages/product/form';

            $this->view($data);
            return;
        }

        if ($this->product->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Product successfully updated');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url('product'));
    }


    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('product'));
        }

        $product    = $this->product->where('id', $id)->first();

        if (!$product) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('product'));
        }

        if ($this->product->where('id', $id)->delete()) {
            $this->product->deleteImage($product->image);
            $this->session->set_flashdata('success', 'Product successfully deleted');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url('product'));
    }

    public function unique_slug()
    {
        $slug       = $this->input->post('slug');
        $id         = $this->input->post('id');
        $product   = $this->product->where('slug', $slug)->first();

        if ($product) {
            if ($id == $product->id) {
                return true;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_message('unique_slug', '$s already used.');
            return false;
        }

        return true;
    }


    public function unique_sku()
    {
        $sku       = $this->input->post('sku');
        $id         = $this->input->post('id');
        $product   = $this->product->where('sku', $sku)->first();

        if ($product) {
            if ($id == $product->id) {
                return true;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_message('unique_sku', '$s already used.');
            return false;
        }

        return true;
    }
}

/* End of file Product.php */
