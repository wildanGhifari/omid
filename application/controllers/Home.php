<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends My_Controller
{

    public function index($page = null)
    {
        $data['title']  = 'Home | Omid Health Style';
        $data['content']    = $this->home->select(
            [
                'product.id', 'product.slug', 'product.title AS product_title', 'product.description',
                'product.image', 'product.price', 'product.is_available', 'product.weight',
                'category.title AS category_title', 'category.slug AS category_slug'
            ]
        )
            ->join('category')
            ->where('product.is_available', 1)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->home->where('product.is_available', 1)->count();

        $this->home->table = 'product';
        $data['products'] = $this->home->select([
            'product.id', 'product.slug', 'product.title AS product_title', 'product.description',
            'product.image', 'product.price', 'product.is_available', 'product.weight',
            'category.title AS category_title', 'category.slug AS category_slug'
        ])
            ->join('category')
            ->where('category.title', 'B2B')
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->home->where('product.is_available', 1)->count();

        $this->home->table = 'blog';
        $data['blogs'] = $this->home->select(
            [
                'blog.id', 'blog.slug', 'blog.title AS blog_title', 'blog.description', 'blog.content',
                'blog.image', 'blog_category.title AS blog_category_title', 'blog_category.slug AS blog_category_slug'
            ]
        )
            ->join('blog_category')
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->home->count();

        $data['page']   = 'pages/home/index';

        $this->view($data);
    }
}

/* End of file Home.php */
