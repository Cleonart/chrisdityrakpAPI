<?php
	
	require '../api_conf.php';
	require '../functions.php';

	// reconstruksi data
	$head = array("Judul Jurnal", "Edisi", "Tahun", "Tanggal Publikasi");
	$body = [];

	$id = $_GET['id'];

	// JOURNALS OPTIONS
	$journals_option = getJurnalByUserId($dale, $id);
	$user_detail     = getUserDetail($dale, $id);



	$qry  = "SELECT * FROM `jurnal` as a ";
	$qry .= "INNER JOIN `jurnal_edisi` as b ";
	$qry .= "ON a.jurnal_id = b.jurnal_id ";
	$qry .= "WHERE `jurnal_status` = 1 ";

	if($user_detail -> pengguna_status == '2'){
		$qry .= "AND `institusi_id` = '".$user_detail -> pengguna_institusi."' ";
	}

	$qry .= "ORDER BY `jurnal_nama` ASC, `jurnal_edisi_tahun` ASC, `jurnal_edisi_volume` ASC, `jurnal_edisi_nomor` ASC ";

	// JOURNAL EDITION
	$journals_edition = json_decode($dale->kueri($qry));
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