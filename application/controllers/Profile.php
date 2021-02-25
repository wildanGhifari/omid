<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{

    private $id;

    public function __construct()
    {
        parent::__construct();
        $is_login   = $this->session->userdata('is_login');
        $this->id   = $this->session->userdata('id');

        if (!$is_login) {
            redirect(base_url());
            return;
        }
    }


    public function index($page = null)
    {
        $data['title']      = 'Profile';
        $data['content']    = $this->profile->where('id', $this->id)->first();

        $this->profile->table   = 'orders';
        $data['order']  = $this->profile->select([
            'orders.id', 'orders.id_user', 'orders.invoice',
            'orders.date', 'orders.total', 'orders.status'
        ])
            ->orderby('date', 'DESC')->get();

        $this->profile->table   = 'orders';
        $data['myOrders'] = $this->profile->select([
            'orders.id_user', 'orders.invoice',
            'orders.date', 'orders.total', 'orders.status'
        ])
            ->where('orders.id_user', $data['content']->id)->orderby('date', 'DESC')->get();

        $this->profile->table   = 'user';
        $data['users']  = $this->profile->select([
            'user.id', 'user.name', 'user.role', 'user.is_active'
        ])->get();

        $this->profile->table  = 'wishlist';
        $data['wishlist'] = $this->profile->select([
            'wishlist.id', 'wishlist.qty', 'wishlist.subtotal', 'product.title AS product_title',
            'product.image', 'product.slug', 'product.id_category',
            'product.price', 'product.weight', 'category.title AS category_title',
            'category.slug AS category_slug'
        ])
            ->join('product')->join('category')->where('wishlist.id_user', $this->id)->get();

        $this->profile->table  = 'product';
        $data['products'] = $this->profile->select([
            'product.id', 'product.title AS product_title', 'product.image', 'product.price', 'product.is_available',
            'product.slug', 'product.weight', 'category.title AS category_title', 'category.slug AS category_slug'
        ])
            ->join('category')
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->profile->count();
        $data['pagination'] = $this->profile->makePagination(
            base_url('profile'),
            2,
            $data['total_rows']
        );

        $data['page']      = 'pages/profile/index';

        return $this->view($data);
    }


    public function update($id)
    {
        $data['content']    = $this->profile->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('profile'));
        }

        if (!$_POST) {
            $data['input']  = $data['content'];
        } else {
            $data['input']  = (object) $this->input->post(null, true);
            if ($data['input']->password !== '') {
                $data['input']->password = hashEncrypt($data['input']->password);
            } else {
                $data['input']->password = $data['content']->password;
            }
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName  = url_title($data['input']->name, '-', true) . '-' . date('Ymdhis');
            $upload     = $this->profile->uploadImage('image', $imageName);
            if ($upload) {
                if ($data['content']->image !== '') {
                    $this->profile->deleteImage($data['content']->image);
                }
                $data['input']->image   = $upload['file_name'];
            } else {
                redirect(base_url("profile/update/$id"));
            }
        }

        if (!$this->profile->validate()) {
            $data['title']          = 'Update profile';
            $data['form_action']    = base_url("profile/update/$id");
            $data['page']           = 'pages/profile/form';

            $this->view($data);
            return;
        }

        if ($this->profile->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'profile successfully updated');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url('profile'));
    }


    public function unique_email()
    {
        $email       = $this->input->post('email');
        $id         = $this->input->post('id');
        $user   = $this->profile->where('email', $email)->first();

        if ($user) {
            if ($id == $user->id) {
                return true;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_message('unique_email', '$s already used.');
            return false;
        }

        return true;
    }
}

/* End of file Profile.php */
