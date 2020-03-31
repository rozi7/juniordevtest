<?php

$nik = $app->input->post('nik');
$pass = $app->input->post('pass');

$akun = new \App\Models\User($app);

if($akun->update_pass($nik, $pass)) {
    $app->addMessage('edit_akun', 'Akun User Berhasil Diubah, Silahkan Logout dan Login kembali');
}
else {
    $app->addError('edit_akun', 'Akun User Gagal Diubah');
}

header('Location: edit_akun');