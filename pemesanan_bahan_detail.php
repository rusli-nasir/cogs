<?php
	require_once("connect.php");
	
	//jika belum login -> kembalikan ke halaman login
	if(!isset($_SESSION["hans_id_pengguna"]))
	{
		?><script>alert('Silahkan login dahulu');</script><?php
		?><script>document.location.href='index.php';</script><?php
		die(0);
	}
	
	$id_pemesanan_bahan = "";
	$tanggal_pemesanan_bahan = date("Y-m-d");
	$id_supplier ="";
	$nama_supplier = "";
	$total ="0";
	$status_pemesanan_bahan ="Belum finish";
	$data_id_bahan_baku = array();
	$data_nama_bahan_baku = array();
	$data_jumlah = array();
	$data_id_satuan = array();
	$data_harga = array();
	$data_subtotal = array();
	
	if(isset($_GET["id_pemesanan_bahan"]))
	{
		$id_pemesanan_bahan = $_GET["id_pemesanan_bahan"];
		$query = "select * from pemesanan_bahan inner join supplier on pemesanan_bahan.id_supplier=supplier.id_supplier where id_pemesanan_bahan='$id_pemesanan_bahan'";
		$result = mysql_query($query);
		if($row = mysql_fetch_array($result))
		{
			$tanggal_pemesanan_bahan = $row["tanggal_pemesanan_bahan"];
			$id_supplier = $row["id_supplier"];
			$nama_supplier = $row["nama_supplier"];
			$total = $row["total"];
	
		}
		else{
			
			?><script>alert("Data tidak ditemukan");</script>
			<script>document.location.href='pemesanan_bahan.php'</script><?php
			die(0);
		}
	}
	else
	{
		?><script>alert("Data tidak ditemukan");</script>
		<script>document.location.href='pemesanan_bahan.php'</script><?php
		die(0);
	}
	
?>
<!doctype html>
<html lang="en">
<head>
	<?php include("head.php"); ?>
</head>
<body>
	
	<?php include("header.php"); ?>
	
	<!-- bagian isi -->
	<div class="content container-fluid">
		<h3>Pemesanan Bahan</h3>
		<br/>
		<form action="" method="post">
		<div  >
			<table class="table table-bordered table-striped table-hover ">
				<thead>	<!-- kop table -->
				</thead>
				</tbody> <!-- isi table -->
					<tr>
						<td style="width:150px;">Id Pemesanan</td>
						<td><input required readonly style="width:150px"; class="form-control" name="id_pemesanan_bahan" id="id_pemesanan_bahan" placeholder="Id Roti" value="<?php echo $id_pemesanan_bahan; ?>" /></td>
					</tr>
					<tr>
						<td>tanggal_pemesanan_bahan</td>
						<td><input required readonly class=" form-control" name="tanggal_pemesanan_bahan" id="tanggal_pemesanan_bahan" placeholder="Nama Roti" value="<?php echo balikTanggal($tanggal_pemesanan_bahan); ?>" /></td>
					</tr>
					<tr>
						<td>Id supplier</td>
						<td><input type="text" readonly style="width:300px";   class="form-control" name="id_supplier" id="id_supplier" value="<?php echo $nama_supplier; ?>"></td>
					</tr>
					<tr>
						<td>Total</td>
						<td><input style="width:250px;" required readonly class="form-control" name="total" id="total" placeholder="total " value="<?php echo $total; ?>" /></td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2"><h4>Detail Pemesanan</h4></td>
					</tr>
					
					<tr>
						<td colspan="2">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>Id Bahan Baku</th>
										<th>Nama Bahan Baku</th>
										<th>Jumlah Pesan</th>
										<th>Satuan</th>
										<th>Harga</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody id="detail_pesan">
								<?php
									$query = "select * from detail_pemesanan_bahan inner join bahan_baku on detail_pemesanan_bahan.id_bahan_baku=bahan_baku.id_bahan_baku
												where id_pemesanan_bahan='$id_pemesanan_bahan'";
									$resultDetail = mysql_query($query);
									$i = 0;
									
									while($rowDetail = mysql_fetch_array($resultDetail))
									{
								?>
								<tr>
									<td><input class="form-control" type="text" readonly data-input-name="id_bahan_baku" name="id_bahan_baku[]" id="id_bahan_baku_<?php echo $i; ?>" value="<?php echo $rowDetail["id_bahan_baku"]; ?>" /></td>
									<td><input class="form-control" type="text" readonly data-input-name="nama_bahan_baku" name="nama_bahan_baku[]" id="nama_bahan_baku_<?php echo $i; ?>" value="<?php echo $rowDetail["nama_bahan_baku"]; ?>" /></td>
									<td><input class="form-control" text="text" readonly required style="width:150px;" type="number" data-input-name="jumlah" name="jumlah[]" id="jumlah_<?php echo $i; ?>" value="<?php echo $rowDetail["jumlah"]; ?>" /></td>
									<td><input class="form-control" readonly required style="width:150px;" type="text" data-input-name="id_satuan" name="id_satuan[]" id="id_satuan_<?php echo $i; ?>" value="<?php echo $rowDetail["satuan_beli"]; ?>" /></td>
									<td><input class="form-control" readonly style="width:150px;" type="text" data-input-name="harga" name="harga[]" id="harga_<?php echo $i; ?>" value="<?php echo $rowDetail["harga"]; ?>" /></td>
									<td><input class="form-control" readonly min="0" required style="width:150px;" type="number" data-input-name="subtotal" name="subtotal[]" id="subtotal_<?php echo $i; ?>" value="<?php echo $rowDetail["subtotal"]; ?>" /></td>
								</tr>
								<?php
										$i++;
									}
								?>								
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td> </td>
						<td>
 							<a href="pemesanan_bahan.php" class="btn btn-danger">Batal</a>
						</td>
					</tr>
				</tbody>
				<tfoot>	<!-- bagian bawah table -->
				</tfoot>
			</table>
		</div>
		</form>
	</div>
	<!-- akhir bagian isi -->
	

	<?php include("footer.php"); ?>

</body>
</html>