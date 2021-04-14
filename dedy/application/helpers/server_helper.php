<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_db_connection_str(){
    $db_config['hostname'] = 'localhost';
    $db_config['username'] = 'root';
    $db_config['password'] = '';
    $db_config['database'] = 'dedy';
    $db_config['dbdriver'] = 'mysqli';
    $db_config['dbprefix'] = '';
    $db_config['pconnect'] = FALSE;
    $db_config['db_debug'] = TRUE;
    $db_config['cache_on'] = FALSE;
    $db_config['cachedir'] = '';
    $db_config['char_set'] = 'utf8';
    $db_config['dbcollat'] = 'utf8mb4_general_ci';
    $db_config['swap_pre'] = '';
    $db_config['encrypt'] = FALSE;
    $db_config['compress'] = FALSE;
    $db_config['stricton'] = FALSE;
    $db_config['failover'] = array();
    $db_config['save_queries'] = TRUE;
    return $db_config;
}

function get_base_url($site_url) 
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 4);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_URL, $site_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    global $base_url; 
    $base_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $http_response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close ($ch);
    return array($base_url, $response);
}

function  get_controller($name){
    return get_instance()->config->base_url("index.php/", NULL).$name;
}

function get_assets(){
    return get_instance()->config->base_url("", NULL)."assets/";
}

function html_print($str){
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function cetak($str){
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function max_length_input(){
    return "1000";
}

function rand_string($id, $length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = $id . "_";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function hash_str($str){
    return hash('sha512', $str);
}

function sercret_key(){
    //Jangan diubah
    //Kombinasi Kunci 94^100 = 2,0548747705235988594523568506725e+197
    return "AA,X~s~!P^@JSo\{UF9cAKk58R^soM.l.\q8F]1}7}gljry*6)W]b+z.{IlEt*YA7RG@~2w;hdr}ItJ?.&AgY_kW`26u%OhIoQUR";
}

function encrypt_str($str){
    $key = hash('sha256', sercret_key(), true);
    $plaintext = $str;
    $ivlen = openssl_cipher_iv_length($cipher="AES-256-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
    return $ciphertext;
}

function decrypt_str($str){
    $key = hash('sha256', sercret_key(), true);
    $ciphertext = $str;
    $c = base64_decode($ciphertext);
    $ivlen = openssl_cipher_iv_length($cipher="AES-256-CBC");
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len=32);
    $ciphertext_raw = substr($c, $ivlen+$sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
    {
        return $original_plaintext;
    }else{
        return "";
    }
}

function get_day($date_time){
    $index = date('w', $date_time);
    switch ($index) {
        case '0':
            return 'Minggu';
            break;

        case '1':
            return 'Senin';
            break;
        
        case '2':
            return 'Selasa';
            break;   

        case '3':
            return 'Rabu';
            break; 

        case '4':
            return 'Kamis';
            break; 
        
        case '5':
            return 'Jum\'at';
            break;
        
        case '6':
            return 'Sabtu';
            break;
    }
}

function get_month($date_time){
    $index = date('m', $date_time);
    switch ($index) {
        case '01':
            return 'Januari';
            break;
        
        case '02':
            return 'Februari';
            break;
        
        case '03':
            return 'Maret';
            break;
        
        case '04':
            return 'April';
            break;
        
        case '05':
            return 'Mei';
            break;
        
        case '06':
            return 'Juni';
            break;
        
        case '07':
            return 'Juli';
            break;

        case '08':
            return 'Agustus';
            break;

        case '09':
            return 'September';
            break;
        
        case '10':
            return 'Oktober';
            break;
        
        case '11':
            return 'November';
            break;
        
        case '12':
            return 'Desember';
            break;
    }
}

function get_time(){
    $self =& get_instance();
    $self->load->helper('date');
    return now('Asia/Jakarta'); //Waktu Indonesia Barat (WIB)
}

function get_dmy_t($date_time){
    return get_day($date_time).', '.intval(date('d', $date_time)).' '.get_month($date_time).' '.date('Y', $date_time).' | '.date('h:i:s', $date_time);
}

function get_my($date_time){
    return get_month($date_time).' '.date('Y', $date_time);
}

function get_y($date_time){
    return date('Y', $date_time);
}
