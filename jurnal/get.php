<?php
	
	require '../api_conf.php';

	$data = json_decode($dale->kueri("SELECT * FROM `jurnal_edisi`"));

	// reconstruksi data
	$head = array("Judul Jurnal", "Edisi", "Tahun", "Tanggal Publikasi");
	$body = [];

	echo json_encode(array('head' => $head, 'body' => $body));

?>