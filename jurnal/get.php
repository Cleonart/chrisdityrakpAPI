<?php
	
	require '../api_conf.php';

	$data = json_decode($dale->kueri("SELECT * FROM `publikasi`"));

	// reconstruksi data
	$head = array("Judul Jurnal", "Tanggal Publikasi", "Nama Penulis", "Jurnal");
	$body = [];

	for($i = 0; $i < sizeof($data); $i++){
		$id = $data[$i] -> publikasi_id;
		$body[$i][0] = array('title' => $data[$i] -> publikasi_judul_jurnal); // judul
		$body[$i][1] = array('title' => $data[$i] -> publikasi_tahun_jurnal); // tahun

		// nama pengusung
		$penulis = json_decode($dale->kueri("SELECT * FROM `publikasi_penulis` WHERE `publikasi_id` = '".$id."'"));
		$penulis_data = [];
		for($j = 0; $j < sizeof($penulis); $j++){
			$penulis_data[$j] = $penulis[$i] -> publikasi_penulis_nama;
		}
		$body[$i][2] = array('title' => $penulis_data); 
		$body[$i][3] = array('title' => $data[$i] -> publikasi_jurnal); // judul
	}

	echo json_encode(array('head' => $head, 'body' => $body));

?>