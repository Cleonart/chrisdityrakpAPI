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

	function zipToInput($title, $type, $label, $placeholder, $select=""){
		$data = array("title" => $title, "type" => $type, "label" => $label, "placeholder" => $placeholder);

		if($type == "select"){
			$data = array("title" => $title, "type" => 'select', "label" => $label, "placeholder" => $placeholder, "select" => $select);
		}

		return $data;
	}

?>