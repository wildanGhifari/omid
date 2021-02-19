<?php


defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    protected $table    = '';
    protected $perPage  = 5;


    public function __construct()
    {
        parent::__construct();

        if (!$this->table) {
            $this->table = strtolower(
                str_replace('_model', '', get_class($this))
            );
        }
    }


    /**
     * Fungsi Validasi Input
     * Rules: Di deklarasikan dalam masing-masing model
     * 
     * @return void
     */
    public function validate()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters(
            '<small class="form-text text-danger">',
            '</small>'
        );

        $validationRules = $this->getValidationRules();

        $this->form_validation->set_rules($validationRules);

        return $this->form_validation->run();
    }


    public function select($columns)
    {
        $this->db->select($columns);
        return $this;
    }


    public function where($column, $conditions)
    {
        $this->db->where($column, $conditions);
        return $this;
    }


    public function like($column, $condition)
    {
        $this->db->like($column, $condition);
        return $this;
    }


    public function orlike($column, $condition)
    {
        $this->db->or_like($column, $condition);
        return $this;
    }


    public function join($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.id_$table = $table.id", $type);
        return $this;
    }


    public function orderBy($column, $order = 'asc')
    {
        $this->db->order_by($column, $order);
        return $this;
    }


    public function limit($record, $value)
    {
        $this->db->limit($record, $value);
        return $this;
    }


    public function random($column, $random)
    {
        $random = 'random';
        $this->db->order_by($column, $random);
        return $this;
    }


    public function first()
    {
        return $this->db->get($this->table)->row();
    }


    public function get()
    {
        return $this->db->get($this->table)->result();
    }


    public function count()
    {
        return $this->db->count_all_results($this->table);
    }


    // CRUD Model
    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data)
    {
        return $this->db->update($this->table, $data);
    }

    public function delete()
    {
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    // End of CRUD Model


    // Pagination Model
    public function paginate($page)
    {
        $this->db->limit(
            $this->perPage,
            $this->calculateRealOffset($page)
        );

        return $this;
    }

    public function calculateRealOffset($page)
    {
        if (is_null($page) || empty($page)) {
            $offset = 0;
        } else {
            $offset = ($page * $this->perPage) - $this->perPage;
        }

        return $offset;
    }

    public function makePagination($baseUrl, $uriSegment, $totalRows = null)
    {
        $this->load->library('pagination');

        $config = [
            'base_url'          => $baseUrl,
            'uri_segment'       => $uriSegment,
            'per_page'          => $this->perPage,
            'total_rows'        => $totalRows,
            'use_page_numbers'  => true,

            'full_tag_open'     => '<ul class="pagination  justify-content-center">',
            'full_tag_close'    => '</ul>',
            'attributes'        => ['class' => 'page-link'],
            'first_link'        => false,
            'last_link'         => false,
            'first_tag_open'    => '<li class="page-item">',
            'first_tag_close'   => '</li>',
            'prev_link'         => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            'prev_tag_open'     => '<li class="page-item">',
            'prev_tag_close'    => '</li>',
            'next_link'         => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            'next_tag_open'     => '<li class="page-item">',
            'next_tag_close'    => '</li>',
            'last_tag_open'     => '<li class="page-item">',
            'last_tag_close'    => '</li>',
            'cur_tag_open'      => '<li class="page-item active"><a href="#" class="page-link">',
            'cur_tag_close'     => '<span class"sr-only"></span></a></li>',
            'num_tag_open'      => '<li class="page-item">',
            'num_tag_close'     => '</li>',

        ];

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}


/* End of file MY_Model.php */


// Terima kasih sudah mau menjawab.

// Code yang saya buat ketika saya jalankan di browser tidak menunjukan error sama sekali, tapi di Code Editor nya masih tetap menunjukan ada error di 'getValidationRules'-nya. Saya masih bingung dan takut akan berpengaruh ke tutorial selanjutnya.