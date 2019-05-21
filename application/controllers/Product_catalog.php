<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Catalog extends CI_Controller {
  private $user_id;
  public function  __construct()
  {
       parent::__construct();
      if(!$this->login_model->userLoginCheck())
      {
        redirect('user_auth');
      }
      else
      {
        $this->load->model("product_catalog_model");
        $this->load->model("sales_rank_conf_model");
        $this->load->helper(array('form', 'url','file'));
        $this->load->library('session');
        $this->load->library('pagination');
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
       
      }
       
  }
  public function index()
  {
    $areas = array('us' => 1,'ca' => 6,'uk' => 2,'de' => 3,'fr' => 4,'it' => 8,'es' => 9,'mx' => 11,'in' => 10,'jp' => 'last');
    $search_params = ' WHERE 1=1 ';
    if ($this->input->get('keyword')) {
      $search_params .= " AND (isbn = '".$this->input->get('keyword')."' OR lower(book_title) LIKE '%".strtolower($this->input->get('keyword'))."%' OR lower(author) LIKE '%".strtolower($this->input->get('keyword'))."%' ) ";
    }
    if ($this->input->get('min_rank')) {
      $search_params .= ' AND (';
      foreach ($areas as $key => $value) {
        $col = $key.'_rank';
        if ($value == 'last') {
          $search_params .= " CAST(REPLACE($col,',','') AS INT) >= '".$this->input->get('min_rank')."' ) ";
        } else {
          $search_params .= " CAST(REPLACE($col,',','') AS INT) >= '".$this->input->get('min_rank')."' AND ";
        }
      }
    }
    if ($this->input->get('max_rank')) {
      $search_params .= ' AND (';
      foreach ($areas as $key => $value) {
        $col = $key.'_rank';
        if ($value == 'last') {
          $search_params .= " CAST(REPLACE($col,',','') AS INT) <= '".$this->input->get('max_rank')."' ) ";
        } else {
          $search_params .= " CAST(REPLACE($col,',','') AS INT) <= '".$this->input->get('max_rank')."' AND ";
        }
      }
    }
    if ($this->input->get('min_profit')) {
      $search_params .= ' AND (';
      foreach ($areas as $key => $value) {
        $col = $key.'_price';
        if ($value == 'last') {
          $search_params .= " CAST(REPLACE($col,',','') AS INT) >= '".$this->input->get('min_profit')."' ) ";
        } else {
          $search_params .= " CAST(REPLACE($col,',','') AS INT) >= '".$this->input->get('min_profit')."' AND ";
        }
      }
    }
    if ($this->input->get('max_profit')) {
      $search_params .= ' AND (';
      foreach ($areas as $key => $value) {
        $col = $key.'_price';
        if ($value == 'last') {
          $search_params .= " CAST(REPLACE($col,',','') AS INT) <= '".$this->input->get('max_profit')."' ) ";
        } else {
          $search_params .= " CAST(REPLACE($col,',','') AS INT) <= '".$this->input->get('max_profit')."' AND ";
        }
      }
    }
    if ($this->input->get('source')) {
          $search_params .= " AND lower(book_store) LIKE '%".strtolower(str_replace('_', ' ', $this->input->get('source')))."%' ";
    }
    $params = array();
    $limit_per_page = 10;
    $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $total_records = $this->product_catalog_model->record_count($search_params);
    $items = $this->product_catalog_model->getProducts($limit_per_page, $start_index,$search_params);
    if ($total_records > 0) 
    {
      // get current page records
      $params["files"] = $items;
      $config['base_url'] = base_url() . 'product_catalog/index';
      $config['suffix'] = '?' . http_build_query($_GET, '', "&");
      $config['total_rows'] = $total_records;
      $config['per_page'] = $limit_per_page;
      $config["uri_segment"] = 3;
      $config['full_tag_open'] = "<ul class='pagination'>";
      $config['full_tag_close'] = '</ul>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['prev_link'] = '<i class="fa fa-arrow-left"></i>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '<i class="fa fa-arrow-right"></i>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      // build paging links
      $params["links"] = $this->pagination->create_links();
    }
    $onlyRegions = $this->sales_rank_conf_model->getRegions();
    $colors = array();
    foreach ($onlyRegions as $key => $value) {
      $colors[$value['region_code']] = $value['color'];
    }
    $params['colors'] = $colors;
    $params['stores'] = $this->sales_rank_conf_model->getStores();

    $this->load->view('UI/header');
    $this->load->view('UI/product_catalog',$params);
    $this->load->view('UI/footer');
  }

}

