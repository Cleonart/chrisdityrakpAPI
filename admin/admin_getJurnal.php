<?php

	require '../api_conf.php';

	// reconstruksi data
	$head = array("Nama Jurnal", "Institusi", "Kepala Pengelola");
	$body = [];

	// jurnal
	$kry = "";
	$kry .= "SELECT * FROM `jurnal` as a ";
	$kry .= "INNER JOIN `pengguna` as b ";
	$kry .= "ON a.jurnal_editorial_id = b.pengguna_id ";
	$kry .= "WHERE `jurnal_status` = 0";

	$newJournal = json_decode($dale -> kueri($kry));
	for($i = 0; $i < sizeof($newJournal); $i++){

		$jurnal_id = $newJournal[$i] -> jurnal_id;
		$jurnal_nama = $newJournal[$i] -> jurnal_nama;
		$jurnal_institusi = $newJournal[$i] -> jurnal_institusi;
		$pengguna_nama = $newJournal[$i] -> pengguna_nama;

		$body[$i][0] = array('title' => $jurnal_id, 'type' => 'id');
		$body[$i][1] = array('title' => $jurnal_nama, 'type' => 'text');
		$body[$i][2] = array('title' => $jurnal_institusi, 'type' => 'text');
		$body[$i][3] = array('title' => $pengguna_nama, 'type' => 'text');

	}

	// DATA PACK
	$dataPack = array('head' => $head, 'body' => $body);
	echo json_encode($dataPack);

?>