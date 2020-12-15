<?php

	require '../api_conf.php';

	// reconstruksi data
	$head = array("Nama Jurnal", "Institusi");
	$body = [];

	// jurnal
	$kry = "";
	$kry .= "SELECT * FROM `jurnal` ";
	$kry .= "WHERE `jurnal_status` = 0";

	$newJournal = json_decode($dale -> kueri($kry));
	for($i = 0; $i < sizeof($newJournal); $i++){

		$jurnal_id = $newJournal[$i] -> jurnal_id;
		$jurnal_nama = $newJournal[$i] -> jurnal_nama;
		$jurnal_institusi = $newJournal[$i] -> jurnal_institusi;

		$body[$i][0] = array('title' => $jurnal_id, 'type' => 'id');
		$body[$i][1] = array('title' => $jurnal_nama, 'type' => 'text');
		$body[$i][2] = array('title' => $jurnal_institusi, 'type' => 'text');
	}

	// DATA PACK
	$dataPack = array('head' => $head, 'body' => $body);
	echo json_encode($dataPack);

?>