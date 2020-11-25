<?php
	
	require '../api_conf.php';

	// reconstruksi data
	$head = array("Judul Artikel", "Penulis", "Halaman", "Kata Kunci");
	$body = [];

	// JOURNALS OPTIONS
	$journals_temp = json_decode($dale->kueri("SELECT * FROM `jurnal`"));
	$journals_option = [];

	/* DUMMY */
	$index = 0;
	$journals_option[$index] = array("value" => null, "text" => "Pilih Jurnal");
	for($i = 0; $i < sizeof($journals_temp); $i++){
		$jurnal_id = $journals_temp[$i] -> jurnal_id;
		$jurnal_nama = $journals_temp[$i] -> jurnal_nama;
		$index++;
		$journals_option[$index] = array("value" => $jurnal_id, "text" => "Jurnal " . $jurnal_nama);
	}

	// JOURNAL EDITION
	$journals_edition = json_decode($dale->kueri("SELECT * FROM `jurnal` as a INNER JOIN `jurnal_edisi` as b ON a.jurnal_id = b.jurnal_id"));
	$index = 0;
	$edition_journal = [];
	$edition_journal[$index] = array("value" => null, "text" => "Pilih Edisi");
	for($i = 0; $i < sizeof($journals_edition); $i++){
		$jurnal_id  = $journals_edition[$i] -> jurnal_id;
		$jurnal_edisi_id  = $journals_edition[$i] -> jurnal_edisi_id;
		$jurnal_edisi_tahun   = $journals_edition[$i] -> jurnal_edisi_tahun;
		$jurnal_edisi = "Volume " . $journals_edition[$i] -> jurnal_edisi_volume . " No. " . $journals_edition[$i] -> jurnal_edisi_nomor . " Tahun " . $jurnal_edisi_tahun;
		$index++;
		$edition_journal[$index] = array('value' => $jurnal_edisi_id, 'text' => $jurnal_edisi, 'jurnal_id' => $jurnal_id);
	}

	// ARTIKEL
	$kry = "";
	$kry .= "SELECT * FROM `artikel_daftar` as a ";
	$kry .= "INNER JOIN `jurnal_edisi` as b ";
	$kry .= "ON a.jurnal_edisi_id = b.jurnal_edisi_id ";

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


?>