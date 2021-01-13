<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
{

    public function index($page = null)
    {
        $data['title']      = 'Blog | Omid Health Style';
        $data['content']    = $this->blog->select([
            'blog.id', 'blog.slug', 'blog.title AS blog_title', 'blog.description', 'blog.content',
            'blog.image', 'blog_category.title AS blog_category_title', 'blog_category.slug AS blog_category_slug'
        ])
            ->join('blog_category')
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->blog->count();
        $data['pagination'] = $this->blog->makePagination(
            base_url('blog'),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/blog/index';

        $this->view($data);
    }

    public function detail($slug)
    {
        $data['blog']       = $this->blog->where('slug', $slug)->first();
        if (!$data['blog']) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('blog'));
        }

        $data['blog']       = $this->blog->select([
            'blog.id', 'blog.slug', 'blog.title AS blog_title', 'blog.description', 'blog.content',
            'blog.image', 'blog_category.title AS blog_category_title', 'blog_category.slug AS blog_category_slug'
        ])
            ->join('blog_category')->where('blog.slug', $slug)->get();
        $data['total_rows'] = $this->blog->count();
        $data['pagination'] = $this->blog->makePagination(
            base_url('blog'),
            2,
            $data['total_rows']
        );

        $data['page']       = 'pages/blog/detail';

        $this->view($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('blog'));
        }

        $keyword            = $this->session->userdata('keyword');
        $data['title']      = 'Blog | Omid Health Style';
        $data['content']    = $this->blog->select([
            'blog.id', 'blog.slug', 'blog.title AS blog_title', 'blog.description', 'blog.content',
            'blog.image', 'blog_category.title AS blog_category_title', 'blog_category.slug AS blog_category_slug'
        ])
            ->join('blog_category')
            ->like('blog.title', $keyword)
            ->orlike('blog.description', $keyword)
            ->orlike('blog_category.title', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->blog->like('blog.title', $keyword)->orlike('description', $keyword)->count();
        $data['pagination'] = $this->blog->makePagination(
            base_url('blog/search'),
            3,
            $data['total_rows']
        );
        $data['page']       = 'pages/blog/index';

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('blog'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->blog->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName  = url_title($input->title, '-', true) . '-' . date('Ymdhis');
            $upload     = $this->blog->uploadImage('image', $imageName);
            if ($upload) {
                $input->image   = $upload['file_name'];
            } else {
                redirect(base_url('blog/create'));
            }
        }

        if (!$this->blog->validate()) {
            $data['title']          = 'Add new Blog Post';
            $data['input']          = $input;
            $data['form_action']    = base_url('blog/create');
            $data['page']           = 'pages/blog/form';

            $this->view($data);
            return;
        }

        if ($this->blog->create($input)) {
            $this->session->set_flashdata('success', 'New blog successfully created.');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url('blog'));
    }

    public function edit($id)
    {
        $data['content']    = $this->blog->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('blog'));
        }

        if (!$_POST) {
            $data['input']  = $data['content'];
        } else {
            $data['input']  = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName  = url_title($data['input']->title, '-', true) . '-' . date('Ymdhis');
            $upload     = $this->blog->uploadImage('image', $imageName);
            if ($upload) {
                if ($data['content']->image !== '') {
                    $this->blog->deleteImage($data['content']->image);
                }
                $data['input']->image   = $upload['file_name'];
            } else {
                redirect(base_url("user/edit/$id"));
            }
        }

        if (!$this->blog->validate()) {
            $data['title']          = 'Edit blog';
            $data['form_action']    = base_url("blog/edit/$id");
            $data['page']           = 'pages/blog/form';

            $this->view($data);
            return;
        }

        if ($this->blog->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'blog successfully updated');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url('blog'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('blog'));
        }

        $blog    = $this->blog->where('id', $id)->first();

        if (!$blog) {
            $this->session->set_flashdata('warning', 'Data cannot be found.');
            redirect(base_url('blog'));
        }

        if ($this->blog->where('id', $id)->delete()) {
            $this->blog->deleteImage($blog->image);
            $this->session->set_flashdata('success', 'blog successfully deleted');
        } else {
            $this->session->set_flashdata('error', 'Oops! Something went wrong');
        }

        redirect(base_url('blog'));
    }

    public function unique_slug()
    {
        $slug       = $this->input->post('slug');
        $id         = $this->input->post('id');
        $blog   = $this->blog->where('slug', $slug)->first();

        if ($blog) {
            if ($id == $blog->id) {
                return true;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_message('unique_slug', '$s already used.');
            return false;
        }

        return true;
    }
}

/* End of file Blog.php */
