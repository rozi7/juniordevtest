<?php 
require '_base_head.php';

$mbel = new \App\Models\Belanja($app);

$redirect = url('add_shop');
if($app->input->get('redirect')) $redirect = $app->input->get('redirect');
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          <h2>Data Transaksi</h2>
          <a href="<?php echo url('add_shop');?>" class="btn btn-success pull-right">
            <i class="fa fa-plus fa-spin"></i> Add Shop <i class="fa fa-plus fa-spin"></i>
          </a>
          <div class="clearfix"></div>
      </div>

        <?php
        $defmsg_category = 'home';
        require '../pages/defmsg.php';
          
          $list = $mbel->get();
        ?>
        <!-- TABLE -->
        <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="table-responsive" align="center">
                <hr>
                <table class="table table-bordered table-hover table-striped display nowrap row-border order-column" style="width:100%" id="myTableP">
                  <thead>
                    <tr>
                      <th>Opsi</th>
                      <th width="5%">No</th>
                      <th>Nama</th>
                      <th>Produk</th>
                      <th>Harga Satuan</th>
                      <th>Jumlah</th>
                      <th>Total Harga</th>
                      <th>Status Pembelian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($list as $index => $bel) { ?>
                    <tr>
                      <td>
                        <a title="Edit" href="<?php echo url('add_shop?edit=' . $bel['id_shop'] . '&redirect=' . redirect_url());?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                        
                        <button title="Hapus" type="button" data-url="<?php echo url('shop?_method=delete&id=' . $bel['id_shop'] . '&redirect=' . redirect_url());?>" data-toggle="modal" data-target="#confirm_delete" class="btn btn-danger btn-xs" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
                      </td>
                      <td><?php echo $index+1;?></td>
                      <td><?php echo $bel['nama'];?></td>
                      <td><?php echo $bel['nama_produk'];?></td>
                      <td><?php echo indo_number($bel['harga']);?></td>
                      <td><?php echo $bel['jumlah'];?></td>
                      <td><?php echo indo_number($bel['total']);?></td>
                      <td><?php echo $bel['nama_status'];?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Select2 -->
<script src="<?php echo url();?>js/select2.full.min.js"></script>

<?php require '_base_foot.php';?>