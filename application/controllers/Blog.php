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
}

/* End of file Blog.php */
