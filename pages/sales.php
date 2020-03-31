<?php 
require '_base_head.php';
?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          <h2>Data Sales</h2>
          <form method="post" action="http://recruitment.api.makekimia.network/api/sales">
            <input type="submit" name="submit" id="submit" value="View Sales" class="btn btn-success pull-right">
          </form>
          <div class="clearfix"></div>
          <div id="hasil-data"></div>
      </div>
    </div>
  </div>
</div>

<!-- Select2 -->
<script src="<?php echo url();?>js/select2.full.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
          
            $('#submit').on('click', function(e) {
                $.ajax({
                    type : 'POST',
                    url  : 'http://recruitment.api.makekimia.network/api/sales',
                    data : JSON.stringify({
                      "signature_key": "c43589130bbf1ed56ecb19c7a9b52c38"
                     }),
                    success : function(data){
                    var json = $.parseJSON(data);
                      $('#hasil-data').html(json);
                      console.log(json);
                    },
                    error: function(data){ console.log(data)}
                });
            });
        });
</script>
<?php require '_base_foot.php';?>