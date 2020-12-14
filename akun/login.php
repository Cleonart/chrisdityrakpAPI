<?php

	header('Access-Control-Allow-Origin: *');
	require '../api_conf.php';

	// data request from json
	$request = file_get_contents("php://input");
	$data    = json_decode($request);
	
	// reconstruct json
	$username = $data -> username;
	$password = $data -> password;

	$kry = "";
	$kry .= "SELECT `pengguna_id`,`pengguna_nama`,`pengguna_status` FROM pengguna ";
	$kry .= "WHERE `username` = '".$username."' AND `pengguna_sandi` = '".$password."'";

	$login_data = $dale->kueri($kry);
	$login_data = json_decode($login_data);

	if(sizeof($login_data) > 0){
		echo json_encode(array("error_code"    => "success", 
							   'session'       => $login_data[0] -> pengguna_id,
							   "pengguna_nama" => $login_data[0] -> pengguna_nama, 
							   'stats'         => md5($login_data[0] -> pengguna_status)));
	}

	else{
		echo json_encode(array("error_code"    => "invalid",));
	}

?>