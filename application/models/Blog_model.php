<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog_model extends MY_Model
{
    public $table;
    protected $perPage = 20;

    public function getDefaultValues()
    {
        return [
            'id_blog_category'  => '',
            'slug'              => '',
            'title'             => '',
            'key1'              => '',
            'key2'              => '',
            'key3'              => '',
            'description'       => '',
            'content'           => '',
            'image'             => '',
            'author'            => '',
            'author_links'      => '',
            'date'              => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_blog_category',
                'label' => 'Category',
                'rules' => 'required'
            ],
            [
                'field' => 'slug',
                'label' => 'Slug',
                'rules' => 'trim|required|callback_unique_slug'
            ],
            [
                'field' => 'title',
                'label' => 'Blog Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'key1',
                'label' => 'Keywords 1',
                'rules' => 'trim'
            ],
            [
                'field' => 'key2',
                'label' => 'Keywords 2',
                'rules' => 'trim'
            ],
            [
                'field' => 'key3',
                'label' => 'Keywords 3',
                'rules' => 'trim'
            ],
            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'author',
                'label' => 'Author',
                'rules' => 'trim'
            ],
            [
                'field' => 'author_links',
                'label' => 'Author Links',
                'rules' => 'trim'
            ],
            [
                'field' => 'date',
                'label' => 'Date',
                'rules' => 'date'
            ]
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './images/blog',
            'file_name'         => $fileName,
            'allowed_types'     => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'          => 1024,
            'max_width'         => 0,
            'max_height'        => 0,
            'overwrite'         => true,
            'file_ext_tolower'  => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./image/blog/$fileName")) {
            unlink("./image/blog/$fileName");
        }
    }
}

/* End of file Blog_model.php */
