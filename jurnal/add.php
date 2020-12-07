<?php

	require '../api_conf.php';

	$jurnal_nama        = $_GET['jurnal_nama'];
	$jurnal_institution = $_GET['jurnal_nama'];

	$data = $dale->kueri("INSERT INTO `service` 
						  SET service_id = '".$id."', 
						  	  service_name      = '".$_GET['data_0']."', 
						  	  service_nominal   = '".$_GET['data_1']."',
							  	  service_information = 'services'
							  ON DUPLICATE KEY UPDATE 
							  	  service_id        = '".$id."', 
							  	  service_name      = '".$_GET['data_0']."', 
							  	  service_nominal   = '".$_GET['data_1']."',
							  	  service_information = 'services'");

?>