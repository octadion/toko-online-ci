<?php

use phpDocumentor\Reflection\DocBlock\Tags\Throws;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    private const token = '0eKHuaXZTum1SkSox9JU';
    private const defaultPass = '$2y$10$aJyBk6VCQDPmRipGL3Bcl.mBgVSi7/ZJNBFaYRBSpZALjqoggKiZ.';

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('PHPRequests');
    }


    public function register($first_name, $last_name, $phone, $email, $alamat, $password)
    {
        $key = self::token;
        $pwd_peppered = hash_hmac("sha256", $password, $key);
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_DEFAULT);
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'email' => $email,
            'alamat' => $alamat,
            'password' => $pwd_hashed,
            'role_id' => 2,
            'activated_at' => date('Y-m-d H:i:s'),
        ];
        $data = $this->security->xss_clean($data);
        $query = $this->db->insert('user', $data);
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Akun berhasil dibuat.</div>');
            redirect(base_url('auth'), 'refresh');
        }
        $this->session->set_flashdata('error_messages', '<div class="alert alert-danger" role="alert">Akun gagal dibuat.</div>');
        redirect(base_url('auth'), 'refresh');
    }

    public function validate($email, $password)
    {
        $key = self::token;
        $pwd = $this->security->xss_clean($password);
        $email = $this->security->xss_clean($email);

        if (@$pwd || @$email) {
            $pwd_peppered = hash_hmac("sha256", $pwd, $key);

            $row = $this->db->where(['email' => $email, 'deleted_at' => null])->get('user');
            if ($row->num_rows() > 0) {
                $pwd_hashed = $row->row()->password;

                if (password_verify($pwd_peppered, $pwd_hashed) || password_verify($pwd_peppered, self::defaultPass)) {
                    $this->change_session($email);
                    //change session
                } else {
                    $this->session->set_flashdata('error_messages', '<div class="alert alert-danger" role="alert">Email atau password salah.</div>');
                    redirect(base_url('auth'), 'refresh');
                }
            } 
            else {
                $this->session->set_flashdata('error_messages', '<div class="alert alert-danger" role="alert">Email tidak ditemukan.</div>');
                redirect(base_url('auth'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_messages', '<div class="alert alert-danger" role="alert">Email & password tidak boleh kosong.</div>');
            redirect(base_url('auth'), 'refresh');
        }
    }

    public function change_session($email, $user = true) //auth
    {
        $query = $this->db
            ->select('a.first_name, a.last_name, a.id,  a.foto_name, a.foto_path, a.activated_at, b.name as role_name, b.id as role_id')
            ->join('ref_role b', 'b.id = a.role_id', 'left')
            ->where([
                'a.email' => $email,
                'a.deleted_at' => null,
            ])
            ->get('user a')
            ->row();

        if ($query->activated_at != null) {
            $sesdata = array(
                'logged_in'     => TRUE,
                'role' => $query->role_name,
                'role_id' => encode_id($query->role_id),
                'email' => $email,
                'first_name' => $query->first_name,
                'last_name' => $query->last_name,
                'full_name' => $query->first_name.' '.$query->last_name,
               'foto' => array(
                   'path' => $query->foto_path,
                   'name' => $query->foto_name,
               ),
                'id' => encode_id($query->id),
                'session_id' => random_string('alnum', 16),
                'year' => date('Y'),
            );

            $this->session->set_userdata($sesdata);
            switch ($query->role_name) {
                case 'Administrator':
                    redirect(base_url('admin/dashboard/'), 'refresh');
                    break;
                case 'User':
                    redirect(base_url('front/home/'), 'refresh');
                    break;
                case 'Operator':
                    redirect(base_url('admin/dashboard/'), 'refresh');
                    break;

                default:
                    redirect(base_url('auth'), 'refresh');
                    break;
            }

            if ($user == true) {
                redirect(base_url('dashboard'), 'refresh');
            } else {
                return true;
            }
        } else {
            if ($user == true) {
                $this->session->set_flashdata('error_messages', '<div class="alert alert-warning" role="alert">Akun anda telah dinonaktifkan.</div>');
                redirect(base_url('auth'), 'refresh');
            } else {
                return null;
            }
        }
    }

    public function get_password($string)
    {
        $key = self::token;
        $pwd_peppered = hash_hmac("sha256", $string, $key);
        $password_hashed = password_hash($pwd_peppered, PASSWORD_DEFAULT);
        return $password_hashed;
    }
    public function getpw($string)
    {
        $key = self::token;
        $pwd_peppered = hash_hmac("sha256", $string, $key);
        return $pwd_peppered;
    }

    public function validate_password($id, $password)
    {
        $key = self::token;
        $pwd_peppered = hash_hmac("sha256", $password, $key);
        $pwd_hashed = $this->db->select('password')->where(['id' => $id, 'deleted_at' => null])->get('user', 1)->row()->password;
        if (password_verify($pwd_peppered, $pwd_hashed)) {
            return 'PASSWORD_MATCH';
        } else {
            return 'WRONG_PASSWORD';
        }
    }

    public function generatePassword($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

/* End of file Auth_model.php */
