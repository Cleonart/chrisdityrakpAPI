<?php
	
	require '../api_conf.php';
	require '../functions.php';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$jurnal = getJurnalByUserId($dale, $id);
		$edisi  = getEdisiByUserId($dale, $id);

		$encoded = array('jurnal' => $jurnal, 'edisi' => $edisi);
		echo json_encode($encoded);
	}

	else if(isset($_GET['article_id'])){
		$article_id  = $_GET['article_id'];
		$id          = $_GET['user_id'];
		$final_json  = [];

		$kry  = "SELECT `artikel_id` as 'id', ";
		$kry .= "`artikel_judul`     as 'judul', ";
		$kry .= "`artikel_abstrak`   as 'abstrak', ";
		$kry .= "`artikel_jurnal_id` as 'jurnal_select', ";
		$kry .= "`jurnal_edisi_id`   as 'edisi_select', ";
		$kry .= "`artikel_keyword`   as 'keyword', ";
		$kry .= "`artikel_filepath`  as 'filepath' ";
		$kry .= "FROM `artikel_daftar` ";
		$kry .= "WHERE `artikel_id` = '".$article_id."' ";
		
		$data = $dale->kueri($kry);
		$final_json = json_decode($data);

		$penulis = json_decode($dale -> kueri("SELECT `nama_artikel_penulis` FROM `artikel_penulis` WHERE `artikel_id` = '".$article_id."'"));
		$penulis_fix = [];
		for($i = 0; $i < sizeof($penulis); $i++){
			$penulis_fix[$i] = $penulis[$i] -> nama_artikel_penulis;
		}

		$final_json[0] -> penulis = $penulis_fix;

		$jurnal = getJurnalByUserId($dale, $id);
		$edisi  = getEdisiByUserId($dale, $id);
		$encoded = array('jurnal' => $jurnal, 'edisi' => $edisi, 'artikel' => $final_json[0]);
		echo json_encode($encoded);
	}

?>