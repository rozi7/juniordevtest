<?php
// kalau sudah login redirect ke /home
//if(!is_null($app->sess->signature_key)) header('Location: ' . url('logout'));
?><!DOCTYPE html>
<html lang="id">
<head>
	<title>Register</title>
    <!-- Favicon -->
	<link rel="stylesheet" type="text/css" href="css/materialize.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div class="row">
	<div class="col 12 m4 s12 offset-12 offset-m4" >
		<br>
		<h4 class="center"><b><span class="merah">Junior Developer</span><span class="birutua"> Test</span></b></h4>
		<br>
		<div class="card z-depth-2">
			<div class="card-content">
				<form method="POST" class="col s12" action=""><!--action="<?php //echo url('login');?>">--><!---->
					<div class="row mepet">
						<div class="input-field col s12">
							<i class="mdi-action-picture-in-picture prefix"></i>
							<input type="text" name="user_name" required="" autofocus="" id="user">
							<label>Username</label>
						</div>
					</div>
					<div class="row mepet">
						<div class="input-field col s12">
							<i class="mdi-action-lock prefix"></i>
							<input type="email" name="user_email" required="" id="email">
							<label>Email</label>
						</div>
					</div>
					<input type="hidden" id="data" name="data" value="">
					<div class="row">
						<div class="input-field col s12">
							<input type="submit" name="login" value="Login" id="login" class="btn right">
						</div>
					</div>
					<div id="hasil-data">xxx</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>
<script type="text/javascript" src="js/msgbag.js"></script>
</body>
</html>

<script type="text/javascript">
        $(document).ready(function(){
        	
            $('#login').on('click', function(e) {
                $.ajax({
                    type : 'POST',
                    url  : 'http://recruitment.api.makekimia.network/api/register',
                    data : JSON.stringify({
			                "user_name": document.getElementById("user").value,
			                "user_email": document.getElementById("email").value
			               }),
                    success : function(data){
                    	var json = $.parseJSON(data);
                    	$('#hasil-data').html(json);
                    	console.log(json);
                    },
                    error: function(data){ console.log(data)}
                });
            });
            /*
           $(function() {
		    $('form').submit(function() {
		    	var user_name : JSON.stringify({
			                user_name: document.getElementById("user").value
			               });
		    	var user_email : JSON.stringify({
			                user_email: document.getElementById("email").value
			               });
		        $('#user').text(JSON.stringify(user_name: document.getElementById("user").value));
		        $('#email').text(JSON.stringify(user_name: document.getElementById("email").value));
		        return false;
		    });
		});*/
        });
    </script>
<script>