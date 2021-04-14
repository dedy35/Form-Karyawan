<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->helper("url");
        $this->load->helper("server");
        $this->load->model("karyawan_model");
	}
	public function index()
	{
        //GET Tambah
        if(isset($_GET["tambah"]) == true){
            $this->load->view("home/home_view", [
                "title" => "Tambah Data Karyawan <small>Silahkan melakukan penambahan data karyawan.</small>",
                "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                "content" => $this->load->view("karyawan/tambah_karyawan_view", [
                    "nama" => "",
                    "nik" => "",
                    "jenis_kelamin" => "",
                    "agama" => "",
                    "alamat" => "",
                    "no_telp" => "",
                    "message" => "",
                    "color" => ""
                ], true)
            ]);
        }else


        //GET Edit
        if(isset($_GET["edit"]) == true){
            $this->karyawan_model->id = decrypt_str($_GET["edit"]);
            if($this->karyawan_model->exist_by_id() == true){
                $this->load->view("home/home_view", [
                    "title" => "Edit Data Karyawan <small>Silahkan melakukan perubahan data karyawan.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/edit_karyawan_view", [
                        "id" => $this->karyawan_model->id,
                        "nama" => $this->karyawan_model->nama,
                        "nik" => $this->karyawan_model->nik,
                        "jenis_kelamin" => $this->karyawan_model->jenis_kelamin,
                        "agama" => $this->karyawan_model->agama,
                        "alamat" => $this->karyawan_model->alamat,
                        "no_telp" => $this->karyawan_model->no_telp,
                        "message" => "",
                        "color" => ""
                    ], true)
                ]);
            }else{
                $this->load->view("home/home_view", [
                    "title" => "Home <small>Selamat datang.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/karyawan_view", [
                        "list" => $this->karyawan_model->list(),
                        "message" => "Data karyawan tidak ditemukan.",
                        "color" => "red"
                    ], true)
                ]);
            }
        }else


        //GET Hapus
        if(isset($_GET["hapus"]) == true){
            $this->karyawan_model->id = decrypt_str($_GET["hapus"]);
            if($this->karyawan_model->exist_by_id() == true){
                $this->load->view("home/home_view", [
                    "title" => "Hapus Data Karyawan <small>Silahkan melakukan penghapusan data karyawan.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/hapus_karyawan_view", [
                        "id" => $this->karyawan_model->id,
                        "nama" => $this->karyawan_model->nama,
                        "nik" => $this->karyawan_model->nik,
                        "jenis_kelamin" => $this->karyawan_model->jenis_kelamin,
                        "agama" => $this->karyawan_model->agama,
                        "alamat" => $this->karyawan_model->alamat,
                        "no_telp" => $this->karyawan_model->no_telp,
                        "message" => "",
                        "color" => ""
                    ], true)
                ]);
            }else{
                $this->load->view("home/home_view", [
                    "title" => "Home <small>Selamat datang.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/karyawan_view", [
                        "list" => $this->karyawan_model->list(),
                        "message" => "Data karyawan tidak ditemukan.",
                        "color" => "red"
                    ], true)
                ]);
            }
        }else


        //POST Tambah
        if((isset($_POST["tambah"]) == true) &&
        (isset($_POST["nama"]) == true) &&
        (isset($_POST["nik"]) == true) &&
        (isset($_POST["jenis_kelamin"]) == true) &&
        (isset($_POST["agama"]) == true) &&
        (isset($_POST["alamat"]) == true) &&
        (isset($_POST["no_telp"]) == true)){
            $error_message = "";
            if($_POST["nama"] == ""){
                $error_message .= "Nama tidak boleh kosong.<br>";
            }
            if($_POST["nik"] == ""){
                $error_message .= "NIK tidak boleh kosong.<br>";
            }
            if($_POST["jenis_kelamin"] == ""){
                $error_message .= "Jenis Kelamin tidak boleh kosong.<br>";
            }
            if($_POST["agama"] == ""){
                $error_message .= "Agama tidak boleh kosong.<br>";
            }
            if($_POST["alamat"] == ""){
                $error_message .= "Alamat tidak boleh kosong.<br>";
            }
            if($_POST["no_telp"] == ""){
                $error_message .= "Alamat tidak boleh kosong.<br>";
            }
            if($error_message == ""){
                $this->karyawan_model->nama = $_POST["nama"];
                $this->karyawan_model->nik = $_POST["nik"];
                $this->karyawan_model->jenis_kelamin = $_POST["jenis_kelamin"];
                $this->karyawan_model->agama = $_POST["agama"];
                $this->karyawan_model->alamat = $_POST["alamat"];
                $this->karyawan_model->no_telp = $_POST["no_telp"];
                $this->karyawan_model->insert();
                $this->load->view("home/home_view", [
                    "title" => "Home <small>Selamat datang.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/karyawan_view", [
                        "list" => $this->karyawan_model->list(),
                        "message" => "Data karyawan berhasil ditambahkan.",
                        "color" => "green"
                    ], true)
                ]);
            }else{
                $this->load->view("home/home_view", [
                    "title" => "Tambah Data Karyawan <small>Silahkan melakukan penambahan data karyawan.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/tambah_karyawan_view", [
                        "nama" => $_POST["nama"],
                        "nik" => $_POST["nik"],
                        "jenis_kelamin" => $_POST["jenis_kelamin"],
                        "agama" => $_POST["agama"],
                        "alamat" => $_POST["alamat"],
                        "no_telp" => $_POST["no_telp"],
                        "message" => $error_message,
                        "color" => "red"
                    ], true)
                ]);
            }
        }else
        
        
        //POST Edit
        if((isset($_POST["edit"]) == true) &&
        (isset($_POST["nama"]) == true) &&
        (isset($_POST["nik"]) == true) &&
        (isset($_POST["jenis_kelamin"]) == true) &&
        (isset($_POST["agama"]) == true) &&
        (isset($_POST["alamat"]) == true) &&
        (isset($_POST["no_telp"]) == true)){
            $error_message = "";
            if($_POST["nama"] == ""){
                $error_message .= "Nama tidak boleh kosong.<br>";
            }
            if($_POST["nik"] == ""){
                $error_message .= "NIK tidak boleh kosong.<br>";
            }
            if($_POST["jenis_kelamin"] == ""){
                $error_message .= "Jenis Kelamin tidak boleh kosong.<br>";
            }
            if($_POST["agama"] == ""){
                $error_message .= "Agama tidak boleh kosong.<br>";
            }
            if($_POST["alamat"] == ""){
                $error_message .= "Alamat tidak boleh kosong.<br>";
            }
            if($_POST["no_telp"] == ""){
                $error_message .= "Alamat tidak boleh kosong.<br>";
            }
            if($error_message == ""){
                $this->karyawan_model->id = decrypt_str($_POST["edit"]);
                if($this->karyawan_model->exist_by_id() == true){
                    $this->karyawan_model->nama = $_POST["nama"];
                    $this->karyawan_model->nik = $_POST["nik"];
                    $this->karyawan_model->jenis_kelamin = $_POST["jenis_kelamin"];
                    $this->karyawan_model->agama = $_POST["agama"];
                    $this->karyawan_model->alamat = $_POST["alamat"];
                    $this->karyawan_model->no_telp = $_POST["no_telp"];
                    $this->karyawan_model->update();
                    $this->load->view("home/home_view", [
                        "title" => "Home <small>Selamat datang.</small>",
                        "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                        "content" => $this->load->view("karyawan/karyawan_view", [
                            "list" => $this->karyawan_model->list(),
                            "message" => "Data karyawan berhasil dirubah.",
                            "color" => "green"
                        ], true)
                    ]);
                }else{
                    $this->load->view("home/home_view", [
                        "title" => "Home <small>Selamat datang.</small>",
                        "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                        "content" => $this->load->view("karyawan/karyawan_view", [
                            "list" => $this->karyawan_model->list(),
                            "message" => "Data karyawan tidak ditemukan.",
                            "color" => "red"
                        ], true)
                    ]);
                }
            }else{
                $this->load->view("home/home_view", [
                    "title" => "Edit Data Karyawan <small>Silahkan melakukan perubahan data karyawan.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/edit_karyawan_view", [
                        "id" => decrypt_str($_POST["edit"]),
                        "nama" => $_POST["nama"],
                        "nik" => $_POST["nik"],
                        "jenis_kelamin" => $_POST["jenis_kelamin"],
                        "agama" => $_POST["agama"],
                        "alamat" => $_POST["alamat"],
                        "no_telp" => $_POST["no_telp"],
                        "message" => $error_message,
                        "color" => "red"
                    ], true)
                ]);
            }
        }else
        
        
        //POST Hapus
        if(isset($_POST["hapus"]) == true){
            $this->karyawan_model->id = decrypt_str($_POST["hapus"]);
            if($this->karyawan_model->exist_by_id() == true){
                $this->karyawan_model->delete();
                $this->load->view("home/home_view", [
                    "title" => "Home <small>Selamat datang.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/karyawan_view", [
                        "list" => $this->karyawan_model->list(),
                        "message" => "Data karyawan berhasil dihapus.",
                        "color" => "green"
                    ], true)
                ]);
            }else{
                $this->load->view("home/home_view", [
                    "title" => "Home <small>Selamat datang.</small>",
                    "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                    "content" => $this->load->view("karyawan/karyawan_view", [
                        "list" => $this->karyawan_model->list(),
                        "message" => "Data karyawan tidak ditemukan.",
                        "color" => "red"
                    ], true)
                ]);
            }
        }else


        //Home
        {
            $this->load->view("home/home_view", [
                "title" => "Home <small>Selamat datang.</small>",
                "navigasi" => $this->load->view("navigasi/navigasi_view", ["active_index" => 0], true),
                "content" => $this->load->view("karyawan/karyawan_view", [
                    "list" => $this->karyawan_model->list(),
                    "message" => "",
                    "color" => ""
                ], true)
            ]);
        }
	}
}