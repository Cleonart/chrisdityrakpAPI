<?php
	
	require '../api_conf.php';

	$data = json_decode($dale->kueri("SELECT * FROM `artikel`"));

	// reconstruksi data
	$head = array("Judul Artikel", "Author", "Keyword", "Tanggal Publish");
	$body = [];

	echo json_encode(array('head' => $head, 'body' => $body));

?>