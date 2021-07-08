<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['akun_model', 'auth_model']);
        check_admin();
    }
    
    function get_ajax() {
        $list = $this->akun_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->first_name.' '.$item->last_name;
            $row[] = $item->phone;
            $row[] = $item->email;
            $row[] =  $this->status_color($item->name);
            // add html for action
            $row[] = '<button id="upd'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" data-first_name="'.$item->first_name.'"
                    data-last_name="'.$item->last_name.'"data-email="'.$item->email.'" data-phone="'.$item->phone.'" 
                    data-alamat="'.$item->alamat.'" data-role_id="'.$item->role_id.'" 
                    data-toggle="modal" data-target="#modal-popin" class="edit_akun btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</button>
                    <button id="'.$item->id.'" data-id="'.$item->id.'" class="swal-confirm-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->akun_model->count_all(),
                    "recordsFiltered" => $this->akun_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index()
    {
        $this->_display('admin/akun/index', [
            'menu_active' => 'akun',
            'title' => 'Manajemen Akun',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }

    public function add()
    {
        $item = new stdClass();
		$item->id = null;
        $item->username = null;
        $item->email = null;
        $item->first_name = null;
        $item->last_name = null;
        $item->password = null;
        $item->role_id =  null;

        $this->_display('akun/form/index', [
            'menu_active' => 'Manajemen Akun',
            'title' => 'Tambah Akun',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'page' => 'add',
            'item' => $item,
        ]);
    }

    public function process(){
        $post = $this->input->post(null, TRUE);
        print_r($post);
		if($post['page'] == 'add'){
			$data = $this->akun_model->add($post);
		} else if($post['page'] == 'edit'){
			$data = $this->akun_model->edit($post);
		} 
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success','Data berhasil disimpan');
	
		}
      
        // echo json_encode($data);
		// redirect('kategori');
    }
    function status_color($name){
        if($name == 'Administrator'){
            return '<span class="badge badge-primary">Administrator</span>';
        }
        else if($name == 'Operator'){
            return '<span class="badge badge-success">Operator</span>';
        }
        else if($name == 'User'){
            return '<span class="badge badge-warning">User</span>';
        }
    }
    public function tambah(){
        // $post = $this->input->post(null, TRUE);
        // print_r($post);
            
            if (!empty($_FILES['foto_name']['name'])) {
                $upload = upload_file('foto_name', 'uploads/profil/' . date('Y-m-d'), true, 'png|jpg|jpeg|gif', 5);
                // $this->db->where('id', $id);
                $post = [
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                
                  'phone' => $this->input->post('phone'),
                  'alamat' =>$this->input->post('alamat'),
          
                    'password' => $this->auth_model->get_password($this->input->post('password')),
                    'role_id'=> $this->input->post('role_id'),
                    'foto_path' => $upload['path_min'],
                'foto_name' => $upload['name'],];
                $data = $this->db->insert('user', $post);
            }
            $this->session->set_flashdata('success','Data berhasil disimpan');
    }

    public function edit_pw(){
        $post = $this->input->post(null, TRUE);
        if($post['page'] == 'edit'){
			$data = $this->akun_model->edit_pw($post);
		}
        if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success','Data berhasil disimpan');
	
		}
    }

    public function edit($id)
    {
        $query = $this->akun_model->get($id);
        if($query->num_rows() > 0){
            $item = $query->row();
            $this->_display('akun/form/form-edit', [
                'menu_active' => 'Akun',
                'title' => 'Edit Akun',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                'page' => 'edit',
                'item' => $item,
                ]);
        }
        else{
            echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('akun')."';</script>";
        }
    }
    public function del(){
        $post = $this->input->post(null, TRUE);
		$data = $this->akun_model->del($post["id"]);
		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Data tidak dapat dihapus (sudah berelasi)');</script>";
		} else {
			echo "<script>alert('Data berhasil dihapus');</script>";
		}
        echo $data;
	}

    public function check_email_exists()
    {
        $response = array();
        $email = $this->input->post('email');
        $check = $this->akun_model->check('email','email',array('email'=>$email));

        if($check)
        {
            echo(json_encode("Email sudah dipakai!")); 
        }
        else
        {
            echo(json_encode(true)); 
        }
    }
    public function check_password_lama(){
        $response = array();
        $old_password =$this->input->post('password');
        $id =  decode_id($this->session->userdata('id'));
        print_r($old_password);
        // $check = $this->akun_model->check_pw_lama('password','password',array('password'=>$password));
        $password = $this->db
            ->select('password')
            ->where('id',$id)
            ->limit(1)
            ->get('auth')
            ->row()
            ->password;
        print_r($password);
        if(password_verify($this->auth_model->get_password($old_password), $password))
        {
            echo(json_encode("Password lama salah!")); 
        }
        else
        {
            echo(json_encode(true)); 
        }
    }
    // public function upload_photo_profil(){
    //     $uploads = upload_file('image', 'uploads/profil/');
    //     echo base_url($uploads['path']);
    // }
}