<?php
$messages = $app->messages($defmsg_category);
$errors = $app->errors($defmsg_category);

if(count($errors)>0) {
?>
<div class="msgbag-panel col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 alert alert-danger">
    <?php foreach($errors as $error) { echo "<div class='msgbag-item'>{$error}</div>"; }?>
</div>
<?php
}
if(count($messages)>0){
?>
<div class="msgbag-panel col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 alert alert-success">
<?php foreach($messages as $message) { echo "<div class='msgbag-item'>{$message}</div>"; }?>
</div>
<?php } ?>