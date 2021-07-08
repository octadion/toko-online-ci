<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['akun_model', 'auth_model']);
        check_admin();
    }

    public function index()
    {
        $this->_display('admin/profil/index', [
            'menu_active' => 'profil',
            'title' => 'Manajemen Profile',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }
    public function get_profile(){
        $id = decode_id($this->session->userdata('id'));
        $prf = $this->db->select('*')
                ->limit(1)
                ->get_where('user',[
                    'id' => $id,
                    'deleted_at' => null
                ])->row();
                $result = [
                    'id' => encode_id($prf->id),
                    'first_name' => $prf->first_name,
                    'last_name' => $prf->last_name,
                    'email' => $prf->email,
                    'phone' => $prf->phone,
                    'alamat' => $prf->alamat,
                    'foto_name' => $prf->foto_name,
                    'foto_path' => $prf->foto_path,
                ];
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
    
    }
    public function update()
    {

        $id = $this->db
            ->select('id')
            ->where([
                'id'  => decode_id($this->session->userdata('id'))
            ])
            ->limit(1)
            ->get('user')
            ->row()
            ->id;

        $data = [
            'email' => $this->input->post('email'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'alamat' => $this->input->post('alamat'),
            'phone' => $this->input->post('phone')
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
            $foto = [ 'path' => $upload['path_min'], 'name' => $upload['name']];
        $this->session->set_userdata('foto', $foto);


        }

        // $message = $_FILES;

        $message = "Data Berhasil Di Update";

        $result = [
            'status' => 'succes',
            'title' => 'Berhasil',
            'message' => $message
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
    
    public function edit_pw(){

        $id = decode_id($this->session->userdata('id'));

        $password = $this->input->post('password');


        if ($this->Auth_model->validate_password($id, $password) == 'PASSWORD_MATCH') {

            $data = [
                'password' => $this->Auth_model->get_password($this->input->post('new_password')),
                
            ];

            $this->db
                ->where('id', $id)
                ->update('user', $data);

            $message = "Password updated successfully";
            $result = [
                'status' => 'succes',
                'title' => 'Berhasil',
                'message' => $message
            ];
        }else{
            $message = "Sorry! Current password is not matching";
            $result = [
                'status' => 'succes',
                'title' => 'Gagal',
                'message' => $message
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    // public function upload_photo_profil(){
    //     $uploads = upload_file('image', 'uploads/profil/');
    //     echo base_url($uploads['path']);
    // }



    
}
