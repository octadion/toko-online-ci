<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
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
        $id = decode_id($this->session->userdata('id'));
        $order = $this->db->query("SELECT * FROM orders where deleted_at is null and user_id = '$id'")->num_rows();
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
           'profile' => $this->db->select('*')->limit(1)->get_where('user',['id' => $id, 'deleted_at' => null])->row(),
           'order'=>$order,
        );
        $this->template->content_frontend('front/profile/index', $data);
    }

    public function edit(){
        $category = $this->category_model->get_view()->result();
        $id = decode_id($this->session->userdata('id'));
        $order = $this->db->query("SELECT * FROM orders where deleted_at is null and user_id = '$id'")->num_rows();
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
           'profile' => $this->db->select('*')->limit(1)->get_where('user',['id' => $id, 'deleted_at' => null])->row(),
           'order'=>$order,
        );
        $this->template->content_frontend('front/profile/edit/index', $data);
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

    public function update()
    {

        $id = decode_id($this->session->userdata('id'));
        $data = [
            // 'email' => $this->input->post('email'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'alamat' => $this->input->post('alamat'),
            // 'phone' => $this->input->post('phone')
        ];
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        if (!empty($_FILES['foto_name']['name'])) {
            $upload = upload_file('foto_name', 'uploads/profil/' . date('Y-m-d'), true, 'png|jpg|jpeg|gif', 5);
            $this->db->where('id', $id);
            $this->db->update('user', [
                'foto_path' => $upload['path_min'],
                'foto_name' => $upload['name'],
                // 'photo_size' => $upload['size'],
                // 'photo_extention' => $upload['ext'],
            ]);
            // $foto = [ 'path' => $upload['path_min'], 'name' => $upload['name']];
        // $this->session->set_userdata('foto', $foto);

print_r($id);
        }
            redirect('front/profile/edit');
    }
}