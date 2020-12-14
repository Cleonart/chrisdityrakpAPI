<?php
	
	require '../api_conf.php';
	require '../functions.php';

	if(isset($_GET['id'])){
		
		// rekonstruksi data
		$head = array("Judul Artikel", "Penulis", "Halaman", "Kata Kunci");
		$body = [];

		// helper variable
		$id 		   = $_GET['id'];
		$user_detail   = getUserDetail($dale, $id);

		$journals_option = getJurnalByUserId($dale, $id);
		$edition_journal = getEdisiByUserId($dale, $id);

		// ARTIKEL
		$kry = "";
		$kry .= "SELECT * FROM `artikel_daftar` as a ";
		$kry .= "INNER JOIN `jurnal_edisi` as b ";
		$kry .= "ON a.jurnal_edisi_id = b.jurnal_edisi_id ";

		if($user_detail -> pengguna_status == 2){
			$kry .= "INNER JOIN `jurnal` as c ";
			$kry .= "ON b.jurnal_id = c.jurnal_id ";
			$kry .= "WHERE c.institusi_id = '".$user_detail -> pengguna_institusi."' ";			
		}

		$article = json_decode($dale -> kueri($kry));

		for($i = 0; $i < sizeof($article); $i++){

			$artikel_id = $article[$i] -> artikel_id;
			$artikel_judul = $article[$i] -> artikel_judul;
			$artikel_keyword = $article[$i] -> artikel_keyword;
			$artikel_halaman = $article[$i] -> artikel_halaman; 
			$artikel_filepath = $article[$i] -> artikel_filepath;
			$jurnal_edisi_id = $article[$i] -> jurnal_edisi_id;

			//AUTHOR
			$kry = "";
			$kry .= "SELECT * FROM `artikel_daftar` as a ";
			$kry .= "INNER JOIN `artikel_penulis` as b ";
			$kry .= "ON a.artikel_id = b.artikel_id ";
			$kry .= "WHERE b.artikel_id = '".$artikel_id."' ";
			$kry .= "ORDER BY `status_artikel_penulis` ASC";
			

			$author = json_decode($dale->kueri($kry));
			$artikel_penulis = [];
			for($j = 0; $j < sizeof($author); $j++){
				$artikel_penulis[$j] = ucwords($author[$j] -> nama_artikel_penulis) ;
			}

			$body[$i][0] = array('title' => $artikel_id, 'type' => 'id');
			$body[$i][1] = array('title' => $jurnal_edisi_id, 'type' => 'id');
			$body[$i][2] = array('title' => $artikel_judul, 'type' => 'text');
			$body[$i][3] = array('title' => $artikel_penulis, 'type' => 'text');
			$body[$i][4] = array('title' => $artikel_halaman, 'type' => 'text');
			$body[$i][5] = array('title' => $artikel_keyword, 'type' => 'text');
		}

		// DATA PACK
		$dataPack = array('head' => $head, 'body' => $body, 'option' => $journals_option, 'edition' => $edition_journal);
		echo json_encode($dataPack);
	}


?>