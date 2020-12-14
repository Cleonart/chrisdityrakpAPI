<?php
	
	header('Access-Control-Allow-Origin: *');
	require '../api_conf.php';

	// data request from json
	$request = file_get_contents("php://input");
	$data    = json_decode($request);

	// reconstruction
	$artikel_id        = $data -> id;
	$artikel_judul     = $data -> judul;
	$artikel_jurnal_id = $data -> jurnal_select;
	$artikel_edisi_id  = $data -> edisi_select;
	$artikel_penulis   = $data -> penulis;
	$artikel_keyword   = $data -> keyword;
	$artikel_abstrak   = $data -> abstrak;
	$artikel_filepath  = $data -> filepath;

	// ID DATA
	if($artikel_id == ""){
		$artikel_id = rand(10000,99999);
	}

	else{
		$dale->kueri("DELETE FROM `artikel_penulis` WHERE `artikel_id` = '".$artikel_id."'");
	}

	$data = $dale->kueri("INSERT INTO `artikel_daftar` 
							  SET artikel_id        = '".$artikel_id."', 
								  artikel_judul     = '".$artikel_judul."', 
								  artikel_abstrak   = '".$artikel_abstrak."',
								  artikel_keyword   = '".$artikel_keyword."',
								  artikel_filepath  = '".$artikel_filepath."',
								  artikel_jurnal_id = '".$artikel_jurnal_id."',
								  jurnal_edisi_id  = '".$artikel_edisi_id."'
	 						  ON DUPLICATE KEY UPDATE 
								  artikel_judul     = '".$artikel_judul."', 
								  artikel_abstrak   = '".$artikel_abstrak."',
								  artikel_keyword   = '".$artikel_keyword."',
								  artikel_filepath  = '".$artikel_filepath."',
								  artikel_jurnal_id = '".$artikel_jurnal_id."',
								  jurnal_edisi_id  = '".$artikel_edisi_id."'");

	for($i = 0; $i < sizeof($artikel_penulis); $i++){
		$id_artikel_penulis = rand(1000000,9999999);
		$dale->kueri("INSERT INTO `artikel_penulis` 
							  SET artikel_id             = '".$artikel_id."', 
								  id_artikel_penulis     = '".$id_artikel_penulis."', 
								  nama_artikel_penulis   = '".$artikel_penulis[$i]."',
								  status_artikel_penulis = '".$i."'");
	}

?>