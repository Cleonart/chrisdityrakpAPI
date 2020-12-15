<?php

	#zipToInput(value, type, label, placeholder)

	require '../api_conf.php';
	require '../functions.php';

	// reconstruksi data
	$head = array("Nama Lengkap", "Username", "Institusi");
	$body = [];

	// jurnal
	$jurnal = getJurnalByUserId($dale, $_GET['user_id']);

	$parameter_by_id     = "`jurnal_edisi_id`, `jurnal_id`, `jurnal_edisi_volume`, `jurnal_edisi_nomor`, `jurnal_edisi_tahun`";
	$parameter_by_public = $parameter_by_id;
	
	// kueri
	$kry  = "";
	$kry .= "SELECT " . (isset($_GET['id']) ? $parameter_by_public : $parameter_by_id) . " FROM `jurnal_edisi` as a ";

	if (isset($_GET['id'])){
		$kry .= "WHERE `jurnal_edisi_id` = '".$_GET['id']."'"; 
	}

	$data = $dale->kueri($kry);
	$data = json_decode($data);
	if(sizeof($data) > 0){
		for($i = 0; $i < sizeof($data); $i++){
			$jurnal_edisi_id     = $data[$i] -> jurnal_edisi_id;
			$jurnal_id   		 = $data[$i] -> jurnal_id;
			$jurnal_edisi_volume = $data[$i] -> jurnal_edisi_volume;
			$jurnal_edisi_nomor  = $data[$i] -> jurnal_edisi_nomor;
			$jurnal_edisi_tahun  = $data[$i] -> jurnal_edisi_tahun;

			# Input per ID
			if(isset($_GET['id'])){
				$body[0] = array('title' => $jurnal_edisi_id, 'type' => 'id');
				$body[1] = zipToInput($jurnal_id, 'select', 'Pilih Institusi', "Pilih Institusi", getInstitusi($dale));

			}
		}
	}
	else{
		if(isset($_GET['id'])){
			if($_GET['id'] == 'tambah'){
				$body[0] = zipToInput("", 'id', '', "");
				$body[1] = zipToInput(null, 'select', 'Pilih Jurnal', "Pilih Jurnal", $jurnal);
				$body[2] = zipToInput(null, 'select', 'Pilih Volume Edisi', "Pilih Volume Edisi", getNumArray(1, 99, "Pilih Volume Edisi", 'Volume'));
				$body[3] = zipToInput(null, 'select', 'Pilih Nomor Edisi', "Pilih Nomor Edisi", getNumArray(1, 99, "Silahkan pilih nomor edisi", 'Nomor'));
				$body[4] = zipToInput(null, 'select', 'Pilih Tahun Edisi', "Pilih Tahun Edisi", getNumArray(2000, date('Y'), "Silahkan pilih tahun edisi", 'Tahun'));
			}
		}
	}

	$dataPack = array('head' => $head, 'body' => $body);
	echo json_encode($dataPack);

?>