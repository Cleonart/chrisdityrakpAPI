<?php

	require '../api_conf.php';

	$id     = $_GET['id'];
	$status = $_GET['status'];
	
	$kry    = "";

	// terima
	if($status == 1){
		$kry .= "UPDATE `jurnal` ";
		$kry .= "SET `jurnal_status` = '".$status."' ";
		$kry .= "WHERE `jurnal`.`jurnal_id` = '".$id."' ";
	}

	// tolak
	else{
		$kry .= "DELETE FROM `jurnal` ";
		$kry .= "WHERE `jurnal_id` = '".$id."'";
	}

	$data = $dale -> kueri($kry);

?>