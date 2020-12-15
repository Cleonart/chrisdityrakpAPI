<?php
	
	header('Access-Control-Allow-Origin: *');
	require '../api_conf.php';

	// data request from json
	$request = file_get_contents("php://input");
	$data    = json_decode($request);

	// reconstruct json
	$jurnal_edisi_id     = $data[0];
	$jurnal_id           = $data[1];
	$jurnal_edisi_volume = $data[2];
	$jurnal_edisi_nomor  = $data[3];
	$jurnal_edisi_tahun  = $data[4];

	// id data
	if($jurnal_edisi_id == ""){
		$jurnal_edisi_id = rand(10000,99999);
	}

	$qry  = "SELECT * FROM `jurnal_edisi` WHERE ";
	$qry .= "`jurnal_id` = '".$jurnal_id."' AND ";
	$qry .= "`jurnal_edisi_volume` = '".$jurnal_edisi_volume."' AND ";
	$qry .= "`jurnal_edisi_nomor` = '".$jurnal_edisi_nomor."' AND ";
	$qry .= "`jurnal_edisi_tahun` = '".$jurnal_edisi_tahun."' ";

	$data_exist = $dale -> kueri($qry);

	if(sizeof(json_decode($data_exist)) > 0){
		echo json_encode(array("error_code" => 'data_exist'));
	}

	else{

		$data = $dale->kueri("INSERT INTO `jurnal_edisi` 
							  SET jurnal_edisi_id    	= '".$jurnal_edisi_id."', 
								  jurnal_id           	= '".$jurnal_id."', 
								  jurnal_edisi_volume	= '".$jurnal_edisi_volume."',
								  jurnal_edisi_nomor	= '".$jurnal_edisi_nomor."',
								  jurnal_edisi_tahun	= '".$jurnal_edisi_tahun."'
	 						  ON DUPLICATE KEY UPDATE
	 						  	  jurnal_id           	= '".$jurnal_id."', 
								  jurnal_edisi_volume	= '".$jurnal_edisi_volume."',
								  jurnal_edisi_nomor	= '".$jurnal_edisi_nomor."',
								  jurnal_edisi_tahun	= '".$jurnal_edisi_tahun."' ");

		echo json_encode(array("error_code" => 'success'));
	}

?>