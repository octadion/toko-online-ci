<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends MY_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
        $this->load->library('cart');
	}
    public function index()
    {
       
        
        // $faq = $this->db->("SELECT * FROM faq where status = 'public' ")->get()->num_rows();
        $category = $this->category_model->get_view()->result();
        $data = array(
            'category'=> $category,
            // 'berita'=> $this->db->select('*')->from('berita')
            // ->where('status','public')->limit(4)->order_by('id','DESC')->get()->result(),
            // 'sosmed'=>$this->db->select('*')->from('grid_footer')->get()->result(),
            'menu_active' => 'akun',
            'cartItems' => $this->cart->contents(),
            'title' => 'Manajemen Akun',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'product'=>$this->db->select('product.*, product.id as id_product, product_photo.foto_name, product_photo.foto_path')->
            from('product')->join('product_photo','product_photo.produk_id = product.id','left')
            ->where('product.deleted_at', null)->where('product.status_post','published')->limit(4)->order_by('product.name','desc')->get()->result(),
            
        );
        $this->template->content_frontend('front/about/index', $data);
    }
    public function save(){
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'subject' => $this->input->post('subject'),
            'content' => $this->input->post('content'),
            // 'google' => $this->input->post('google'),
        ];
        $this->db->insert('pengaduan',$data);
    
    $result = [
        'status' => 'success',
        'title' => 'Berhasil',
        'msg' => 'Berhasil mengirim aduan'
    ];

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));

    }
}