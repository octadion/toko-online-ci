<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('format_url')){
    function format_url($str, $sep='-')
    {
            $res = strtolower($str);
            $res = preg_replace('/[^[:alnum:]]/', ' ', $res);
            // $res = preg_replace('/[^[:alpha:]]/', ' ', $res);
            $res = preg_replace('/[[:space:]]+/', $sep, $res);
            return trim($res, $sep);
    }
}


if (!function_exists('encode_id')) {

    function encode_id($string)
    {
        $string = $string . ' ' . date('YmdHis') . random_string('alnum', 8);
        $output = false;
        $security       = parse_ini_file("security.ini");
        $secret_key     = $security["encryption_key"];
        $secret_iv      = $security["iv"];
        $encrypt_method = $security["encryption_mechanism"];

        // hash
        $key    = hash("sha256", $secret_key);
        $iv     = substr(hash("sha256", $secret_iv), 0, 16);

        $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($result);
        return $output;
    }
}

if (!function_exists('decode_id')) {

    function decode_id($string)
    {

        $output = false;

        $security       = parse_ini_file("security.ini");
        $secret_key     = $security["encryption_key"];
        $secret_iv      = $security["iv"];
        $encrypt_method = $security["encryption_mechanism"];

        // hash
        $key    = hash("sha256", $secret_key);
        $iv = substr(hash("sha256", $secret_iv), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        $hasil = explode(" ", $output);
        return $hasil[0];
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal, $jam = false)
    {
        if ($jam == true) {
            $tanggal = explode(" ", $tanggal)[0];
        }
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

if (!function_exists('str_limit')) {
    function str_limit($str, $limit)
    {
        if (strlen($str) > $limit)
            $str = substr($str, 0, ($limit - 3)) . '...';

        return $str;
    }
}

if (!function_exists('csrf')) {
    function form_csrf()
    {
        $CI = &get_instance();
        $token_name = $CI->security->get_csrf_token_name();
        $token_hash = $CI->security->get_csrf_hash();
        $html = '<input type="hidden" name="' . $token_name . '" value="' . $token_hash . '">';
        return $html;
    }
}

if (!function_exists('upload_file')) {
    function upload_file($name, $path, $encryptName = true, $allowed_types = 'gif|jpg|png|jpeg|doc|docx|pdf|xls|xlsx', $maxSize = 5)
    {
        $CI = &get_instance();
        $CI->load->library('upload');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $realName = $_FILES[$name]['name'];
        // $_FILES[$name]['name'] = date('YmdHis') . '-' . $_FILES[$name]['name'];
        $_FILES[$name]['name'] = $_FILES[$name]['name'];
        $config = array(
            'upload_path'   => "$path",
            'allowed_types' => $allowed_types,
            'encrypt_name'  => $encryptName,
            'max_size' => $maxSize * 1000
        );
        $CI->upload->initialize($config);
        if ($CI->upload->do_upload($name)) {
            return [
                'path' => $path . '/' . $CI->upload->data("file_name"),
                'path_min' => $path,
                'real_name' => $realName,
                'name' => $CI->upload->data("file_name"),
                'type' => $CI->upload->data("file_type"),
                'size' => $CI->upload->data("file_size"),
                'ext' => $CI->upload->data("file_ext"),
            ];
        } else {
            // return false;
            return $CI->upload->display_errors();
            // exit;
        }
    }
}

if (!function_exists('generate_string')) {
    function generate_string($strength = 16)
    {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
}

function indo_currency($value)
{
    return 'Rp. ' . number_format($value, 0, ",", ".");
}


if (!function_exists('zip_downloads')) {
    function zip_downloads($files = [], $download_name, $save_path = null)
    {
        $CI = &get_instance();
        $CI->load->library('zip');

        foreach ($files as $file) {
            $CI->zip->read_file($file);
        }

        if ($save_path !== null) {
            $CI->zip->archive($save_path);
        }

        $CI->zip->download($download_name);
    }
}
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
