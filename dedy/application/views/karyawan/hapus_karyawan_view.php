<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form action="<?php echo get_controller("home"); ?>" method="post">
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Hapus Data Karyawan</h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>
                Nama : <?php cetak($nama); ?><br>
                NIK : <?php cetak($nik); ?><br>
                Jenis Kelamin : <?php cetak($jenis_kelamin); ?><br>
                Agama : <?php cetak($agama); ?><br>
                Alamat : <?php cetak($alamat); ?><br>
                No Telp : <?php cetak($no_telp); ?><br>
                Hapus Data ?
            </label>
        </div>
    </div>
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="box-footer">
        <button type="submit" name="hapus" value="<?php echo encrypt_str($id); ?>" class="btn btn-primary">Hapus</button>
        &nbsp;
        <button type="submit" name="batal" value="1" class="btn btn-danger">Batal</button>
    </div>
</div>
</form>
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