<?php

	require_once("connect.php");

	$hasil = array();
	$cari = $_POST["cari"];
	$query = "select * from bahan_baku where id_bahan_baku like '%$cari%' or nama_bahan_baku like '%$cari%' ";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		array_push($hasil,$row);
	}
	echo json_encode($hasil);

?>