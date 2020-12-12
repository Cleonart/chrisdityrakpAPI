<?php
	
	header('Access-Control-Allow-Origin: *');
	require '../api_conf.php';

	// data request from json
	$request = file_get_contents("php://input");
	$data    = json_decode($request);

	// reconstruct json
	$id = $data[0];
	$nama_lengkap = $data[1];
	$username = $data[2];
	$password = md5($data[3]);
	$institusi = $data[4];

	// id data
	if($id == ""){
		$id = rand(10000,99999);
	}

	$username_exist = $dale -> kueri("SELECT * FROM `pengguna` WHERE `username` = '".$username."' AND `pengguna_id` != '".$id."'");

	if(sizeof(json_decode($username_exist)) > 0){
		echo json_encode(array("error_code" => 'username_exist'));
	}

	else{

		$data = $dale->kueri("INSERT INTO `pengguna` 
							  SET pengguna_id        = '".$id."', 
								  username           = '".$username."', 
								  pengguna_nama      = '".$nama_lengkap."',
								  pengguna_sandi     = '".$password."',
								  pengguna_institusi = '".$institusi."',
								  pengguna_status    = 2
	 						  ON DUPLICATE KEY UPDATE 
								  username           = '".$username."', 
								  pengguna_nama      = '".$nama_lengkap."',
								  pengguna_sandi     = '".$password."',
								  pengguna_institusi = '".$institusi."',
								  pengguna_status    = 2");

		echo json_encode(array("error_code" => 'success'));
	}

?>