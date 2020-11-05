<?php
	
	require '../api_conf.php';

	$data = json_decode($dale->kueri("SELECT * FROM `dosen` as a INNER JOIN `fakultas` as b on a.fakultas_id = b.fakultas_id"));

	// reconstruksi data
	$head = array("ID Dosen", "Nama Dosen", "Fakultas", "hizkia");
	$body = [];

	for($i = 0; $i < sizeof($data); $i++){
		$id = $data[$i] -> dosen_id;
		$body[$i][0] = array('title' => $data[$i] -> dosen_id); // id_dosen
		$body[$i][1] = array('title' => $data[$i] -> dosen_nama); // nama_dosen
		$body[$i][2] = array('title' => $data[$i] -> fakultas_nama); //fakultas
	}

	echo json_encode(array('head' => $head, 'body' => $body));

?>