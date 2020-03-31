<?php
$mbel = new \App\Models\Belanja($app);

$id = $app->input->get('id');
$nama = $app->input->get('nama_produk');

$data = $mbel->getApi($id, $nama);

header('Content-Type: application/json; charset=UTF8');
if(empty($data)){
	echo json_encode(['status'=>'success', 'data'=>'data tidak ditemukan']);
}else{
	echo json_encode(['status'=>'success', 'data'=>$data]);
}
?>