<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Datatables -->
<link rel="stylesheet" href="<?php echo get_assets()?>datatables/dataTables.min.css">
<script src="<?php echo get_assets()?>datatables/dataTables.min.js"></script>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Data Karyawan</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="form-group">
            <form action="<?php echo get_controller("home"); ?>" method="get">
                <button name="tambah" type="submit" class="btn btn-primary" value="1">Tambah</button>
            </form>
        </div>
        <div class="form-group">
        <table id="table_karyawan" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($list->num_rows() > 0){
                $csrf_token_name = $this->security->get_csrf_token_name();
                $csrf_hash = $this->security->get_csrf_hash();
                $no = 1;
                foreach($list->result_array() as $row){
                    echo '<tr>';
                    echo('<td>'.$no.'</td>');
                    echo('<td>'.html_print($row["nama"]).'</td>');
                    echo('<td>'.html_print($row["nik"]).'</td>');
                    echo('<td>'.html_print($row["jenis_kelamin"]).'</td>');
                    echo('<td>'.html_print($row["agama"]).'</td>');
                    echo('<td>'.html_print($row["alamat"]).'</td>');
                    echo('<td>'.html_print($row["no_telp"]).'</td>');

                    echo('<td><form action="'.get_controller("home").'" method="get">
                        <div class="btn-group">
                        <button name="edit" type="submit" class="btn btn-info" value="'.encrypt_str($row["id"]).'">Edit</button>
                        <button name="hapus" type="submit" class="btn btn-danger" value="'.encrypt_str($row["id"]).'">Hapus</button>
                        </div>
                        <input type="hidden" name="'.$csrf_token_name.'" value="'.$csrf_hash.'">
                        </form></td>');
                    echo '</tr>';
                    $no++;
                }
            }
            ?>
            </tbody>
            <tfoot>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Action</th>
            </tfoot>
        </table>    
        </div>  
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->

<script type="text/javascript">
  $(document).ready( function () {
        $('#table_karyawan').dataTable( {
            "paging":   true,
            "searching": true,
            "ordering": false,
            pageLength: 100,
            responsive: true,
            "language": {
                "lengthMenu": "Tampilan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang ditampilkan",
                "infoFiltered": "<br>(pencarian dari _MAX_ data)",
                "search": "Pencarian",
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            }
        });
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