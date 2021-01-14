<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reseller extends MY_Controller
{

    public function index($page = null)
    {
        $data['title']      = 'Reseller | Omid Health Style';
        $data['contnet']    = $this->reseller->select([
            'reseller.id', 'reseller.slug', 'reseller.title AS reseller_title', 'reseller.description',
            'reseller.price', 'reseller.weight', 'reseller.is_available', 'reseller.image',
            'reseller_category.slug AS reseller_category_slug', 'reseller_category.title AS reseller_category_title'
        ])
            ->join('reseller_category')->where('reseller.is_available', 1)
            ->paginate($page)->get();
        $data['total_rows'] = $this->reseller->where('reseller.is_available', 1)->count();
        $data['pagination'] = $this->reseller->makePagination(
            base_url('reseller'),
            2,
            $data['total_rows']
        );

        $data['page']       = 'pages/reseller/index';

        $this->view($data);
    }

    public function detail($slug)
    {
        $data['reseller']   = $this->reseller->where('slug', $slug)->first();
        if (!$data['reseller']) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('reseller'));
        }

        $data['reseller']   = $this->reseller->select([
            'reseller.id', 'reseller.slug', 'reseller.title AS reseller_title', 'reseller.description',
            'reseller.price', 'reseller.weight', 'reseller.is_available', 'reseller.image',
            'reseller_category.slug AS reseller_category_slug', 'reseller_category.title AS reseller_category_title'
        ])
            ->join('reseller_category')
            ->where('reseller.slug', $slug)
            ->where('reseller.is_available', 1)
            ->get();
        $data['total_rows'] = $this->reseller->where('product.is_available', 1)->count();
        $data['pagination'] = $this->reseller->makePagination(
            base_url('reseller'),
            2,
            $data['total_rows']
        );

        $data['page']           = 'pages/reseller/detail';

        $this->view($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('reseller'));
        }

        $keyword            = $this->session->userdata('keyword');
        $data['title']      = 'reseller | Omid Health Style';
        $data['content']    = $this->reseller->select([
            'reseller.id', 'reseller.slug', 'reseller.title AS reseller_title', 'reseller.description',
            'reseller.price', 'reseller.weight', 'reseller.is_available', 'reseller.image',
            'reseller_category.slug AS reseller_category_slug', 'reseller_category.title AS reseller_category_title'
        ])
            ->join('reseller_category')
            ->like('reseller.title', $keyword)
            ->orlike('reseller.description', $keyword)
            ->orlike('reseller_category.title', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->reseller->like('reseller.title', $keyword)->orlike('description', $keyword)->count();
        $data['pagination'] = $this->reseller->makePagination(
            base_url('reseller/search'),
            3,
            $data['total_rows']
        );
        $data['page']       = 'pages/reseller/index';

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('reseller'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->reseller->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName  = url_title($input->title, '-', true) . '-' . date('Ymdhis');
            $upload     = $this->reseller->uploadImage('image', $imageName);
            if ($upload) {
                $input->image   = $upload['file_name'];
            } else {
                redirect(base_url('reseller/create'));
            }
        }

        if (!$this->reseller->validate()) {
            $data['title']          = 'Add new Reseller Product';
            $data['input']          = $input;
            $data['form_action']    = base_url('reseller/create');
            $data['page']           = 'pages/reseller/form';

            $this->view($data);
            return;
        }

        if ($this->reseller->create($input)) {
            $this->session->set_flashdata('success', 'New reseller successfully created.');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url('reseller'));
    }
}

/* End of file Reseller.php */
