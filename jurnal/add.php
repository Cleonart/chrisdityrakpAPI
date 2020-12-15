<?php

	header('Access-Control-Allow-Origin: *');
	require '../api_conf.php';

	$request = file_get_contents("php://input");
	$data    = json_decode($request);

	$jurnal_id         = rand(10000,99999);
	$jurnal_nama       = $data -> jurnal_nama;
	$institusi_id      = $data -> institusi_id;
	$jurnal_institusi  = $dale -> kueri("SELECT `fakultas_nama` FROM `fakultas` WHERE `fakultas_id` = '".$institusi_id."' ");
	$jurnal_institusi  = json_decode($jurnal_institusi)[0] -> fakultas_nama;
	
	$data_exist = json_decode($dale -> kueri("SELECT * FROM `jurnal` WHERE `jurnal_nama` = '".$jurnal_nama."'"));
	if(sizeof($data_exist) > 0){
		echo json_encode(array("error_code" => "jurnal_already_exist"));
	}
	else{

		$data = $dale->kueri("INSERT INTO `jurnal` 
							  SET jurnal_id         = '".$jurnal_id."', 
							  	  jurnal_nama       = '".$jurnal_nama."', 
							  	  jurnal_institusi  = '".$jurnal_institusi."', 
							  	  institusi_id      = '".$institusi_id."', 
							  	  jurnal_status     = 0
						      ON DUPLICATE KEY UPDATE 
								  jurnal_nama       = '".$jurnal_nama."', 
							  	  jurnal_institusi  = '".$jurnal_institusi."', 
							  	  institusi_id      = '".$institusi_id."', 
							  	  jurnal_status     = 0");

		echo json_encode(array("error_code" => "success"));
	}
?>