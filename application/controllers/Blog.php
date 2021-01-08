<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
{

    public function index($page = null)
    {
        $data['title']      = 'Blog | Omid Health Style';
        $data['contnet']    = $this->blog->select([
            'blog.id', 'blog.slug', 'blog.title AS blog_title', 'blog.description',
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
}

/* End of file Blog.php */
