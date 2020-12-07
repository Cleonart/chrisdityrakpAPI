<?php

	require '../api_conf.php';
	require '../functions.php';

	// reconstruksi data
	$head = array("Nama Lengkap", "Username", "Institusi");
	$body = [];

	$parameter_by_id     = "`pengguna_id`, `username`, `pengguna_nama`, `fakultas_nama`, `fakultas_id` ";
	$parameter_by_public = $parameter_by_id . ", `pengguna_sandi`";
	
	// kueri
	$kry  = "";
	$kry .= "SELECT " . (isset($_GET['id']) ? $parameter_by_public : $parameter_by_id) . " FROM `pengguna` as a ";
	$kry .= "INNER JOIN `fakultas` as b ";
	$kry .= "ON a.pengguna_institusi = b.fakultas_id ";

	if (isset($_GET['id'])) $kry .= "WHERE `pengguna_id` = '".$_GET['id']."'"; 

	$data = $dale->kueri($kry);
	$data = json_decode($data);
	if(sizeof($data) > 0){
		for($i = 0; $i < sizeof($data); $i++){
			$pengguna_id   = $data[$i] -> pengguna_id;
			$pengguna_nama = $data[$i] -> pengguna_nama;
			$pengguna_user = $data[$i] -> username;
			$pengguna_pass = "";
			$pengguna_fak  = $data[$i] -> fakultas_nama;

			// selector untuk sandi dan fakultas
			if(isset($_GET['id'])) $pengguna_pass = $data[$i] -> pengguna_sandi;
			if(isset($_GET['id'])) $pengguna_fak  = $data[$i] -> fakultas_id;

			// konstruksi ulang data yang akan ditampilkan di tabel dan daftar

			# Input per ID
			if(isset($_GET['id'])){
				$body[0] = array('title' => $pengguna_id, 'type' => 'id');
				$body[1] = zipToInput($pengguna_nama, 'text', 'Nama Lengkap', "Masukan Nama Pengguna");
				$body[2] = zipToInput($pengguna_user, 'text', 'Username', "Masukan Username");
				$body[3] = zipToInput($pengguna_pass, 'text', 'Password', "Masukan Password");
				$body[4] = zipToInput($pengguna_fak, 'select', 'Pilih Institusi', "Pilih Institusi", getInstitusi($dale));
			}

			# Tabel
			else{
				$body[$i][0] = array('title' => $pengguna_id, 'type' => 'id');
				$body[$i][1] = array('title' => $pengguna_nama, 'type' => 'text');
				$body[$i][2] = array('title' => $pengguna_user, 'type' => 'text');
				$body[$i][4] = array('title' => $pengguna_fak, 'type' => 'text');
			}
		}
	}
	else{
		if($_GET['id'] == 'tambah'){
			$body[0] = zipToInput("", 'text', 'Nama Lengkap', "Masukan Nama Pengguna");
			$body[1] = zipToInput("", 'text', 'Username', "Masukan Username");
			$body[2] = zipToInput("", 'text', 'Password', "Masukan Password");
			$body[3] = zipToInput(null, 'select', 'Pilih Institusi', "Pilih Institusi", getInstitusi($dale));
		}
	}

	$dataPack = array('head' => $head, 'body' => $body);
	echo json_encode($dataPack);

?>