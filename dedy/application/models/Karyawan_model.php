<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_model extends CI_Model{
    public $id, $nama, $nik, $jenis_kelamin, $agama, $alamat, $no_telp;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("server");
        $this->load->database(get_db_connection_str());
    }

    public function insert(){
        $this->db->trans_start();
        $this->db->query("INSERT INTO `tb_karyawan`(`id`, `nama`, `nik`, `jenis_kelamin`, `agama`, `alamat`, `no_telp`) VALUES (NULL,?,?,?,?,?,?)",
        array($this->nama, $this->nik, $this->jenis_kelamin, $this->agama, $this->alamat, $this->no_telp));
        $this->db->trans_complete();     
        if ($this->db->trans_status() === true){
            return true;
        }else{
            return false;
        }
    }

    public function update(){
        $this->db->trans_start();
        $this->db->query("UPDATE `tb_karyawan` SET `nama`=?,`nik`=?,`jenis_kelamin`=?,`agama`=?,`alamat`=?,`no_telp`=? WHERE `id`=BINARY ?",
        array($this->nama, $this->nik, $this->jenis_kelamin, $this->agama, $this->alamat, $this->no_telp, $this->id));
        $this->db->trans_complete();     
        if ($this->db->trans_status() === true){
            return true;
        }else{
            return false;
        }
    }

    public function delete(){
        $this->db->trans_start();
        $this->db->query("DELETE FROM `tb_karyawan` WHERE `id`=BINARY ?",
        array($this->id));
        $this->db->trans_complete();     
        if ($this->db->trans_status() === true){
            return true;
        }else{
            return false;
        }
    }

    public function exist_by_id(){
        $this->db->trans_start();
        $query = $this->db->query("SELECT * FROM `tb_karyawan` WHERE `id`=BINARY ?",
        array($this->id));
        $this->db->trans_complete();     
        if($query->num_rows() == 1){
            $row = $query->row_array(0);
            $this->id = $row["id"];
            $this->nama = $row["nama"];
            $this->nik = $row["nik"]; 
            $this->jenis_kelamin = $row["jenis_kelamin"];
            $this->agama = $row["agama"]; 
            $this->alamat = $row["alamat"]; 
            $this->no_telp = $row["no_telp"];
            return true;
        }else{
            $this->id = "";
            $this->nama = "";
            $this->nik = "";
            $this->jenis_kelamin = "";
            $this->agama = "";
            $this->alamat = "";
            $this->no_telp = "";
            return false;
        }
    }

    public function list(){
        return $this->db->query("SELECT * FROM `tb_karyawan` ORDER BY `nama` ASC");
    }
}