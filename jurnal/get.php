<?php
	
	require '../api_conf.php';

	// reconstruksi data
	$head = array("Judul Jurnal", "Edisi", "Tahun", "Tanggal Publikasi");
	$body = [];

	// JOURNALS OPTIONS
	$journals_temp = json_decode($dale->kueri("SELECT * FROM `jurnal`"));
	$journals_option = [];

	/* DUMMY */
	$index = 0;
	$journals_option[$index] = array("value" => null, "text" => "Pilih Jurnal");
	for($i = 0; $i < sizeof($journals_temp); $i++){
		$jurnal_id = $journals_temp[$i] -> jurnal_id;
		$jurnal_nama = $journals_temp[$i] -> jurnal_nama;
		$index++;
		$journals_option[$index] = array("value" => $jurnal_id, "text" => "Jurnal " . $jurnal_nama);
	}

	// JOURNAL EDITION
	$journals_edition = json_decode($dale->kueri("SELECT * FROM `jurnal` as a INNER JOIN `jurnal_edisi` as b ON a.jurnal_id = b.jurnal_id"));
	for($i = 0; $i < sizeof($journals_edition); $i++){
		$jurnal_id  = $journals_edition[$i] -> jurnal_id;
		$jurnal_nama  = $journals_edition[$i] -> jurnal_nama;
		$jurnal_edisi = "Volume " . $journals_edition[$i] -> jurnal_edisi_volume . " No. " . $journals_edition[$i] -> jurnal_edisi_nomor;
		$jurnal_edisi_tahun   = $journals_edition[$i] -> jurnal_edisi_tahun;
		$jurnal_edisi_publish = $journals_edition[$i] -> jurnal_edisi_publish;

		$body[$i][0] = array('title' => $jurnal_id, 'type' => 'id');
		$body[$i][1] = array('title' => $jurnal_nama, 'type' => 'text');
		$body[$i][2] = array('title' => $jurnal_edisi, 'type' => 'text');
		$body[$i][3] = array('title' => $jurnal_edisi_tahun, 'type' => 'text');
		$body[$i][4] = array('title' => $jurnal_edisi_publish, 'type' => 'text');
	}

	// DATA PACK
	$dataPack = array('head' => $head, 'body' => $body, 'option' => $journals_option);
	echo json_encode($dataPack);


?>