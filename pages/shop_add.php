<?php 
require '_base_head.php';
$mbel = new \App\Models\Belanja($app);

$users = $mbel->getUser();
$prods = $mbel->getProd();
$stats = $mbel->getStat();

$edit = false;
$id = false;
if($app->input->get('edit')) {
  $id = $app->input->get('edit');
  $edit = $mbel->getById($id);
}

$redirect = url('home');
if($app->input->get('redirect')) $redirect = $app->input->get('redirect');
?>
<style type="text/css">
  #committee{
    pointer-events: none;
  }
</style>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Form <?php echo $id? 'Ubah' : 'Input' ;?> Transaksi</h2>
            <div class="clearfix">
            </div>
        </div>
      <div class="x_content">      
        <form action="<?php echo url('add_shop' . ($edit ? '?redirect=' . urlencode($redirect) : ''))?>" name="fwizard" id="fwizard" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <?php 
        if($edit) {
        ?>
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id_shop" value="<?php echo $edit['id_shop'];?>">
        <?php } ?>
        <div class="form-group">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="bagian">
            Nama User
          </label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <select name="user" id="user" class="form-control select2_single" required style="cursor:pointer">
              <option></option>
              <?php foreach($users as $user) { ?>
              <option <?php echo $edit['id_user'] == $user['id_user'] ? 'selected' : '' ;?> value="<?php echo $user['id_user'];?>"><?php echo $user['nama'];?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="bagian">
            Nama Produk
          </label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <select name="produk" id="produk" class="form-control select2_single" required style="cursor:pointer">
              <option></option>
              <?php foreach($prods as $prod) { ?>
              <option <?php echo $edit['id_product'] == $prod['id_product'] ? 'selected' : '' ;?> value="<?php echo $prod['id_product'];?>"><?php echo $prod['nama_produk'];?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="bagian">
            Jumlah
          </label>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <input type="text" name="jumlah" id="jumlah" required  autofocus class="form-control col-md-7 col-xs-12" value="<?php echo $edit ? $edit['jumlah'] : '' ;?>" placeholder="Jumlah Barang" maxlength="16">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-4 col-sm-3 col-xs-12" for="bagian">
            Status Pembelian
          </label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <select name="status" id="status" class="form-control select2_single" required style="cursor:pointer">
              <option></option>
              <?php foreach($stats as $stat) { ?>
              <option <?php echo $edit['id_status'] == $stat['id_status'] ? 'selected' : '' ;?> value="<?php echo $stat['id_status'];?>"><?php echo $stat['nama_status'];?></option>
              <?php }?>
            </select>
          </div>
        </div>
        
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
            <button name="simpan" type="submit" class="btn btn-success">
              <i class="glyphicon glyphicon-ok"></i>
              &nbsp;&nbsp;&nbsp;&nbsp;Simpan&nbsp;&nbsp;&nbsp;&nbsp;
            </button>

            <?php if($edit) { ?>
            <a href="<?php echo $redirect;?>" class="btn btn-default">
              &nbsp;&nbsp;&nbsp;&nbsp;Batal&nbsp;&nbsp;&nbsp;&nbsp;
            </a>
            <?php } ?>
          </div>
        </div>
        
        </form>
        <!-- End SmartWizard Content -->   

      </div>
    </div>
  </div>
</div>

<!-- Select2 -->
<script src="<?php echo url();?>js/select2.full.min.js"></script>
<!-- jquery.inputmask -->
<script src="<?php echo url();?>js/jquery.inputmask.bundle.min.js"></script>
<!-- Switchery -->
<script src="<?php echo url();?>js/switchery.min.js"></script>

<!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $("#user.select2_single").select2({
            placeholder: "Pilih User",
            allowClear: true
        });
        $("#produk.select2_single").select2({
            placeholder: "Pilih Produk",
            allowClear: true
        });
        $("#status.select2_single").select2({
            placeholder: "Pilih Status",
            allowClear: true
        });

      });
    </script>
<!-- /bootstrap-daterangepicker -->
<?php require '_base_foot.php';?>