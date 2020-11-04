<?php
	
	require '../api_conf.php';

	$data = json_decode($dale->kueri("SELECT * FROM `publikasi`"));

	echo $data;

?>