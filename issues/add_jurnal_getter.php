<?php
	
	require '../api_conf.php';
	require '../functions.php';

	if(isset($_GET['id'])){
		$id   = $_GET['id'];
		$data = getUserDetail($dale, $id);

		if($data -> pengguna_status == '1'){
			echo json_encode(getInstitusi($dale));
		}
		else{
			$institusi = json_decode($dale -> kueri("SELECT `fakultas_nama`,`pengguna_institusi` FROM pengguna as a INNER JOIN fakultas as b ON a.pengguna_institusi = b.fakultas_id"));
			$data = [];
			$data[0] = array("value" => null, "text" => "Pilih Institusi");
			$data[1] = array("value" => $institusi[0] -> pengguna_institusi, "text" => $institusi[0] -> fakultas_nama);
			echo json_encode($data);
		}
	}

?>