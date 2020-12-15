<?php 

	function getInstitusi($dale){
		$data = $dale->kueri("SELECT * FROM `fakultas`");
		$data = json_decode($data);
		$body = [];
		$body[0] = array('value' => null, 'text' => 'Pilih Institusi');

		$index = 1;

		for($i = 0; $i < sizeof($data); $i++){
			$fakultas_id   = $data[$i] -> fakultas_id;
			$fakultas_nama = $data[$i] -> fakultas_nama;
			$body[$index] = array('value' => $fakultas_id, 'text' => $fakultas_nama);
			$index++;
		}

		return ($body);
	}

	function getNumArray($start, $end, $default=0, $abbv=''){

		$body = [];
		$current = $start;
		$body[0] = array('value' => null, 'text' => $default);
		$index = 1;

		for($index; $current <= $end; $index++){
			$body[$index] = array('value' => $current, 'text' => $abbv . ' ' . $current);
			$current++;
		}

		return ($body);
	}

	function getUserDetail($dale, $id){
		
		$kry = "SELECT * FROM pengguna ";
		$kry .= "WHERE `pengguna_id` = '".$id."' ";
		$data = $dale -> kueri($kry);
		$data = json_decode($data);

		return $data[0];
	}

	function getJurnalByUserId($dale, $id){

		$user_detail  = getUserDetail($dale, $id);
		$journals_temp = [];

		// mengambil semua data jurnal jika berstatus admin
		if($user_detail -> pengguna_status == 1){
			$journals_temp = json_decode($dale->kueri("SELECT * FROM `jurnal` WHERE `jurnal_status` = 1"));
		}

		// mengambil hanya data jurnal dengan institusi yang sama
		else if($user_detail -> pengguna_status == 2){
			$journals_temp = json_decode($dale->kueri("SELECT * FROM `jurnal` WHERE `institusi_id` = '".$user_detail -> pengguna_institusi."' AND `jurnal_status` = 1"));
		}

		$journals_option = [];

		/* DUMMY */
		$index = 0;
		$journals_option[$index] = array("value" => null, "text" => "Pilih Jurnal");
		for($i = 0; $i < sizeof($journals_temp); $i++){
			$jurnal_id = $journals_temp[$i] -> jurnal_id;
			$jurnal_nama = $journals_temp[$i] -> jurnal_nama;
			$index++;
			$journals_option[$index] = array("value" => $jurnal_id, "text" => $jurnal_nama);
		}

		return $journals_option;
	}

	function getEdisiByUserId($dale, $id){

		$user_detail  = getUserDetail($dale, $id);

		$kry  = "SELECT * FROM `jurnal` as a ";
		$kry .= "INNER JOIN `jurnal_edisi` as b ";
		$kry .= "ON a.jurnal_id = b.jurnal_id ";

		if($user_detail -> pengguna_institusi == 2){
			$kry .= "WHERE institusi_id = '".$user_detail -> pengguna_institusi."' ";
		}

		$journals_edition = json_decode($dale->kueri($kry));

		$index = 0;
		$edition_journal = [];
		$edition_journal[$index] = array("value" => null, "text" => "Pilih Edisi");
		for($i = 0; $i < sizeof($journals_edition); $i++){
			$jurnal_id  = $journals_edition[$i] -> jurnal_id;
			$jurnal_edisi_id  = $journals_edition[$i] -> jurnal_edisi_id;
			$jurnal_edisi_tahun   = $journals_edition[$i] -> jurnal_edisi_tahun;
			$jurnal_edisi = "Vol " . $journals_edition[$i] -> jurnal_edisi_volume . " No. " . $journals_edition[$i] -> jurnal_edisi_nomor . " (" . $jurnal_edisi_tahun. ")";
			$index++;
			$edition_journal[$index] = array('value' => $jurnal_edisi_id, 'text' => $jurnal_edisi, 'jurnal_id' => $jurnal_id);
		}
		
		return $edition_journal;
	}

	function zipToInput($title, $type, $label, $placeholder, $select=""){
		$data = array("title" => $title, "type" => $type, "label" => $label, "placeholder" => $placeholder);

		if($type == "select"){
			$data = array("title" => $title, "type" => 'select', "label" => $label, "placeholder" => $placeholder, "select" => $select);
		}

		return $data;
	}

?>