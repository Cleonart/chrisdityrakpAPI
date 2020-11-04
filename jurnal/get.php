<?php
	
	require '../api_conf.php';

	$data = $dale->kueri("SELECT * FROM `jurnal`");

	echo $data;

?>