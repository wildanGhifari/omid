<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blog_model extends MY_Model
{

    protected $perPage = 20;

    public function getDefaultValues()
    {
        return [
            'id_blog_category'  => '',
            'slug'              => '',
            'title'             => '',
            'description'       => '',
            'content'           => '',
            'image'             => ''
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
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'trim|required'
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
