<?php
	require_once("connect.php");
	
	//jika belum login -> kembalikan ke halaman login
	if(!isset($_SESSION["hans_id_pengguna"]))
	{
		?><script>alert('Silahkan login dahulu');</script><?php
		?><script>document.location.href='index.php';</script><?php
		die(0);
	}
	
	$id_supplier = "";
	$nama_supplier = "";
	$alamat_supplier ="";
	$telp_supplier ="";
	if(isset($_GET["id_supplier"]))
	{
		$id_supplier = $_GET["id_supplier"];
		$query = "select * from supplier where id_supplier='$id_supplier'";
		$result = mysql_query($query);
		if($row = mysql_fetch_array($result))
		{
			$nama_supplier = $row["nama_supplier"];
			$alamat_supplier = $row["alamat_supplier"];
			$telp_supplier = $row["telp_supplier"];
	
		}
		else{
			
			?><script>alert("Data tidak ditemukan");</script>
			<script>document.location.href='supplier.php'</script><?php
			die(0);
		}
	}
	else
	{
		?><script>alert("Data tidak ditemukan");</script>
		<script>document.location.href='supplier.php'</script><?php
		die(0);
	}
	
	if(isset($_POST["simpan"]))
	{
		$id_supplier = $_POST["id_supplier"];
		$nama_supplier = $_POST["nama_supplier"];
		$alamat_supplier = $_POST["alamat_supplier"];
		$telp_supplier = $_POST["telp_supplier"];
		
		$error = 0;
		//pengecekan error
		$query = "select * from supplier where nama_supplier='$nama_supplier' and id_supplier <> '$id_supplier'";
		$resultCek = mysql_query($query);
		if(mysql_num_rows($resultCek) > 0)
		{
			?><script>alert("Nama supplier sudah ada sebelumnya");</script><?php
			$error = 1;
		}
		
		if($error == 0)
		{
			$query = "update supplier set 
						nama_supplier='$nama_supplier',alamat_supplier='$alamat_supplier',telp_supplier='$telp_supplier'
					where id_supplier='$id_supplier'";
			mysql_query($query);
			
			?><script>alert("Data berhasil diubah");</script>
			<script>document.location.href='supplier.php'</script><?php
			die(0);
		}
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
		<h3>supplier</h3>
		<br/>
		<form action="" method="post">
		<div  style="width: 600px;">
			<table class="table table-bordered table-striped table-hover ">
				<thead>	<!-- kop table -->
				</thead>
				</tbody> <!-- isi table -->
					<tr>
						<td style="width:150px;">Id supplier</td>
						<td><input readonly required style="width:150px"; class="form-control" name="id_supplier" id="id_supplier" placeholder="Id supplier" value="<?php echo $id_supplier; ?>" /></td>
					</tr>
					<tr>
						<td>Nama supplier</td>
						<td><input required class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Satuan" value="<?php echo $nama_supplier; ?>" /></td>
					</tr>
					<tr>
						<td>Alamat supplier</td>
						<td><input required class="form-control" name="alamat_supplier" id="alamat_supplier" placeholder="Alamat Supplier " value="<?php echo $alamat_supplier; ?>" /></td>
					</tr>
					<tr>
						<td>telp supplier</td>
						<td><input type="number" required class="form-control" name="telp_supplier" id="telp_supplier" placeholder="Telepon Supplier" value="<?php echo $telp_supplier; ?>" /></td>
					</tr>
					<tr>
						<td> </td>
						<td>
							<button type="submit" name="simpan" class="btn btn-success">Simpan</button> 
 							<a href="supplier.php" class="btn btn-danger">Batal</a>
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