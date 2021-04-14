<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form action="<?php echo get_controller("home"); ?>" method="post">
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Tambah Karyawan</h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php cetak($nama); ?>" <?php echo max_length_input()?>>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" placeholder="NIK" value="<?php cetak($nik); ?>" <?php echo max_length_input()?>>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin" value="<?php cetak($jenis_kelamin); ?>" <?php echo max_length_input()?>>
            <br>
            <div class="btn-group">
                <button type="button" id="btn_laki_laki" class="btn btn-primary">Laki-Laki</button>
                <button type="button" id="btn_perempuan" class="btn btn-success">Perempuan</button>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Agama</label>
            <input type="text" name="agama" class="form-control" placeholder="Agama" value="<?php cetak($agama); ?>" <?php echo max_length_input()?>>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?php cetak($alamat); ?>" <?php echo max_length_input()?>>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>No Telp</label>
            <input type="text" name="no_telp" class="form-control" placeholder="No Telp" value="<?php cetak($no_telp); ?>" <?php echo max_length_input()?>>
        </div>
    </div>
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="box-footer">
        <button type="submit" name="tambah" value="1" class="btn btn-primary">Simpan</button>
        &nbsp;
        <button type="submit" name="batal" value="1" class="btn btn-danger">Batal</button>
    </div>
</div>
</form>
<script type="text/javascript">
    $("#btn_laki_laki").on("click", function(){
        $("#jenis_kelamin").val("Laki-Laki");
    });

    $("#btn_perempuan").on("click", function(){
        $("#jenis_kelamin").val("Perempuan");
    });
</script>

<?php
if(($message != "") && ($color != "")){
    echo "<link rel=\"stylesheet\" href=\"".base_url()."assets/iziToast/dist/css/iziToast.min.css\">".
    "<script src=\"".base_url()."assets/iziToast/dist/js/iziToast.min.js\"></script>".
    "<script type=\"text/javascript\">
    $(function(){
        iziToast.show({title: \"".$message."\", color: \"".$color."\", timeout: 2000});
    });
    </script>";
}
?>