<?php
$user = $app->input->post('user_name');
$email = $app->input->post('user_email');

echo $user.' '.$email;die();
$user = new \App\Models\User($app);

if($user->login($nik, $pass)){
    @$_SESSION['nik'] = $nik;

    $currentUser = $user->getUserByNIK($nik);
    $url = 'home';
    if($currentUser->posisi == 'admin') $url = 'a/home';

    //echo $url;die();

    /*
    $mres = new \App\Models\Resign($app);
    $resign = $mres->cekResign();
    if($resign == 1){
      $app->addMessage('dash_resign', 'Karyawan Resign Periode Yang Lalu Berhasil Diarsipkan');
    }elseif($resign == 0){
      $app->addMessage('dash_resign', 'Karyawan Resign Periode Yang Lalu Telah Kosong');
    }elseif($resign == 2){
      $app->addError('dash_resign', 'Karyawan Resign Periode Yang Lalu Gagal Diarsipkan');
    }
    /**/
    header("Location: " . url($url));
}
else {
    $app->addError('login', 'Login Gagal');
    header("Location: " . url('login'));
}