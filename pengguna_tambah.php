<?php
	require_once("connect.php");
	
	//jika belum login -> kembalikan ke halaman login
	if(!isset($_SESSION["hans_id_pengguna"]))
	{
		?><script>alert('Silahkan login dahulu');</script><?php
		?><script>document.location.href='index.php';</script><?php
		die(0);
	}
	
	$id_pengguna = "";
	$nama_pengguna = "";
	$password="";
	$jenis_pengguna ="";
	
	if(isset($_POST["simpan"]))
	{
		$id_pengguna = $_POST["id_pengguna"];
		$nama_pengguna = $_POST["nama_pengguna"];
		$password = $_POST["password"];
		$jenis_pengguna = $_POST["jenis_pengguna"];
		$error = 0;
		//pengecekan error
		$query = "select * from pengguna where id_pengguna='$id_pengguna'";
		$resultCek = mysql_query($query);
		if(mysql_num_rows($resultCek) > 0) //menghitung jumlah baris hasil query
		{
			?><script>alert("Id pengguna sudah ada sebelumnya");</script><?php
			$error = 1;
		}
		

		
		if($error == 0)
		{
			$query = "insert into pengguna(id_pengguna,nama_pengguna,password,jenis_pengguna) values ('$id_pengguna','$nama_pengguna','$password','$jenis_pengguna')";
			mysql_query($query);
			
			?><script>alert("Data berhasil ditambah");</script>
			<script>document.location.href='pengguna.php'</script><?php
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
		<h3>pengguna</h3>
		<br/>
		<form action="" method="post">
		<div  style="width: 600px;">
			<table class="table table-bordered table-striped table-hover ">
				<thead>	<!-- kop table -->
				</thead>
				</tbody> <!-- isi table -->
					<tr>
						<td style="width:150px;">Id pengguna</td>
						<td><input required style="width:150px"; class="form-control" name="id_pengguna" id="id_pengguna" placeholder="Id pengguna" value="<?php echo $id_pengguna; ?>" /></td>
					</tr>
					<tr>
						<td>Nama pengguna</td>
						<td><input required class="form-control" name="nama_pengguna" id="nama_pengguna" placeholder="Nama pengguna" value="<?php echo $nama_pengguna; ?>" /></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input required class="form-control" name="password" id="password" placeholder="Password  " value="<?php echo $password; ?>" /></td>
					</tr>
					<tr>
					<tr>
						<td>Jenis pengguna</td>
						<td><select required class="form-control" name="jenis_pengguna" id="jenis_pengguna">
							<option value="">Pilih Jenis Pengguna</option>
							<option value="manajer"  <?php if($jenis_pengguna == "manajer") { echo "selected"; } ?> >manajer</option>
							<option value="supervisor"  <?php if($jenis_pengguna == "supervisor") { echo "selected"; } ?> >supervisor</option>
						</select></td>
					</tr>
					<tr>
						<td> </td>
						<td>
							<button type="submit" name="simpan" class="btn btn-success">Simpan</button> 
 							<a href="pengguna.php" class="btn btn-danger">Batal</a>
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