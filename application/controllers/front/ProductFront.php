<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductFront extends MY_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('front/product_front_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('unit_model');
        $this->load->model('foto_model');
        $this->load->library('cart');
	}
    public function index()
    {
        
        // $faq = $this->db->("SELECT * FROM faq where status = 'public' ")->get()->num_rows();
       
        $data = array(
            'category' => $this->product_front_model->filter_category('category_name'),
            'menu_active' => 'akun',
            'title' => 'Manajemen Akun',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'cartItems' => $this->cart->contents(),
        );
        $this->template->content_frontend('front/product_front/index', $data);
    }
    // public function save(){
    //     $data = [
    //         'name' => $this->input->post('name'),
    //         'email' => $this->input->post('email'),
    //         'subject' => $this->input->post('subject'),
    //         'content' => $this->input->post('content'),
    //         // 'google' => $this->input->post('google'),
    //     ];
    //     $this->db->insert('pengaduan',$data);
    
    // $result = [
    //     'status' => 'success',
    //     'title' => 'Berhasil',
    //     'msg' => 'Berhasil mengirim aduan'
    // ];

    // $this->output
    //     ->set_content_type('application/json')
    //     ->set_output(json_encode($result));

    // }
    public function fetch_data(){
        $minimum_price = $this->input->post('minimum_price');
        $maximum_price = $this->input->post('maximum_price');
        $category = $this->input->post('category');
        $this->load->library('pagination');
        $config = array();
        $config['base_url'] = '#';
        $config['total_rows'] = $this->product_front_model->
                                count_all($minimum_price, $maximum_price,
                                $category);
        $config['per_page'] = 6;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = true;
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] ='<ul class="pagination">';
        $config['full_tag_close'] ='</ul>';
        $config['first_tag_open'] ='<li class="page-item">';
        $config['first_tag_close'] ='</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close']='</li>';
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['next_tag_open']= '<li class="page-item">';
        $config['next_tag_close']= '</li>';
        $config['prev_link'] = ' <i class="fa fa-angle-left"></i>';
        $config['prev_tag_open']= '<li class="page-item">';
        $config['prev_tag_close']= '</li>';
        $config['cur_tag_open']= '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']= '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 3;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(4);
        $start = ((int)$page - (int)1) * $config['per_page'];
        $output = array(
            'pagination_link' => $this->pagination->create_links(),
            'product_list' => $this->product_front_model->fetch_data($config["per_page"],
            $start, $minimum_price, $maximum_price, $category)
        );
        echo json_encode($output);
    }
    public function detail($id){
        $this->db->select('product.*,  category.category_name, unit.unit_name');
        $this->db->join('category', 'product.category_id = category.id', 'left');
         $this->db->join('unit', 'product.unit_id = unit.id', 'left');
        $this->db->where([
            'product.deleted_at' => null,
            'product.id' => $id,
        ]);
        $this->db->from('product');
        $data = $this->db->get()->row();
        
        if (!$data || $id == null) {
            echo 'data tidak ditemukan';
            die;
        }
        $query = $this->product_model->get($id);
        $category = $this->category_model->get_view()->result();
        $unit = $this->unit_model->get_view()->result();
        $foto = $this->db->get_where('product_photo', ['produk_id' => $id])->result();
        
        if($query->num_rows() > 0){
            $item = $query->row();
            $this->template->content_frontend('front/product_front/detail/index', [
                'menu_active' => 'product',
                'title' => 'Detail Product',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                // 'page' => 'edit',
                'item' => $item,
                'category' => $category,
                'unit' => $unit,
                'foto'=>$foto,
                'data'=>$data,
                'product'=>$this->db->select('product.*, product.id as id_product, product_photo.foto_name, product_photo.foto_path')->
                from('product')->join('product_photo','product_photo.produk_id = product.id','left')
                ->where('product.deleted_at', null)->where('product.status_post','published')->limit(4)->order_by('product.name','desc')->get()->result(),
                ]);
        }
        else{
            echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('front/productfront')."';</script>";
        }
    }

    public function cart($id){
        $this->db->select('product.*,  category.category_name, unit.unit_name');
        $this->db->join('category', 'product.category_id = category.id', 'left');
         $this->db->join('unit', 'product.unit_id = unit.id', 'left');
        $this->db->where([
            'product.deleted_at' => null,
            'product.id' => $id,
        ]);
        $this->db->from('product');
        $data = $this->db->get()->row();
        
        if (!$data || $id == null) {
            echo 'data tidak ditemukan';
            die;
        }
        $query = $this->product_model->get($id);
        $category = $this->category_model->get_view()->result();
        $unit = $this->unit_model->get_view()->result();
        // $foto = $this->db->get_where('product_photo', ['produk_id' => $id])->result();
        $cart = array(
            'id'    => $data->id,
            'qty'    => 1,
            'price'    => $data->price,
            'name'    => $data->name,
            'foto' => $data->thumbnail,
            'weight' => $data->weight,
            'barcode' => $data->barcode,

        );
        $this->cart->insert($cart);
        redirect('front/cart/');
      
    }
    public function cart_by_dtl(){
        $redirect_page = $this->input->post('redirect_page');
        $data = array(
            'id'    => $this->input->post('id'),
            'qty'    => $this->input->post('qty'),
            'price'    => $this->input->post('price'),
            'name'    => $this->input->post('name'),
            'weight' => $this->input->post('weight'),
            'barcode' => $this->input->post('barcode'),
            // 'foto' => $data->thumbnail,
        );
        $this->cart->insert($data);
        redirect($redirect_page, 'refresh');
    }

}