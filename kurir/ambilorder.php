<?php 
	session_start(); 
	include "login/ceksession.php";?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>e-Kurir</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  </head>
  
  <body class="hold-transition skin-blue sidebar-mini">
  	<div class="wrapper">

  		<?php include "header.php"; ?>
  		<!-- Left side column. contains the logo and sidebar -->
  		<?php include "menu.php"; ?>

  		<!-- Content Wrapper. Contains page content -->
  		<div class="content-wrapper">
  			<!-- Content Header (Page header) -->
  			<section class="content-header">
  				<h1>
  					Order Yang Berlangsung
  				</h1>
  				<ol class="breadcrumb">
  					<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  					<li class="active">Order</li>
  				</ol>
  			</section>

  			<!-- Main content -->
  			<section class="content">
  				<!-- Main row -->
  				<div class="row">
  					<!-- Left col -->
  					<section class="col-lg-12 connectedSortable">

  						<!-- TO DO List -->
  						<div class="box box-primary">
  							<div class="box-header">
  								<i class="ion ion-clipboard"></i>
  								<h3 class="box-title">Order Yang Berlangsung</h3>
  								<div class="box-tools pull-right">
  								</div> 
  							</div><!-- /.box-header -->
  							<?php include '../koneksi/koneksi.php';
  							if (!($_GET['no_transaksi'] == '')){
  								$no_transaksi= $_GET['no_transaksi'];
  								$sql  		= "SELECT * FROM tb_transaksi where no_transaksi='".$no_transaksi."' and status ='Belum Terkirim'";                        
  								$query  	= mysqli_query($db, $sql);
  								$stts		= mysqli_fetch_array($query);
  								$data0 		= mysqli_num_rows($query);
  								$sql2  		= "SELECT * FROM tb_transaksi inner join tb_pelanggan on tb_transaksi.pengirim = tb_pelanggan.id_pelanggan where no_transaksi='".$no_transaksi."'";                        
  								$query2  	= mysqli_query($db, $sql2);
  								$data 		= mysqli_fetch_array($query2);						
  								if ($data0 == 1){
  									date_default_timezone_set('Asia/Jakarta'); 		
  									$date  = date("d-m-Y H:i:s");
  									$waktu = $stts['waktu'].'<br>'.'Penjemputan Barang &nbsp&nbsp&nbsp('.$date.')';
  									$sql1 = "UPDATE tb_transaksi set 
  									kurir = '".$_SESSION['id']."',
  									status = 'Penjemputan Barang',
  									waktu = '$waktu'
  									where no_transaksi = '".$no_transaksi."'";
  									
  									$execute = mysqli_query($db, $sql1);					
  									echo "<meta http-equiv='refresh' content='0;url=ambilorder.php?no_transaksi=".$no_transaksi."'>";	
  									?>
  									<div class="box-body">
  										<form class="form-horizontal style-form" action="proses/proses_editstatus.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">No Transaksi</label>
  												<div class="col-sm-4">
  													<input name="no_transaksi" value="<?php echo $data['no_transaksi']?>" type="text" id="no_transaksi" class="form-control" autocomplete="off" readonly />
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Nama Barang</label>
  												<div class="col-sm-4">
  													<input name="nama_barang" value="<?php echo $data['nama_barang']?>" type="text" id="nama_barang" class="form-control" autocomplete="off" readonly />
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Alamat Asal</label>
  												<div class="col-sm-4">
  													<textarea name="alamat_asal"; id="alamat_asal" class="form-control"  autocomplete="off" readonly /><?php echo $data['alamat_asal']?></textarea>
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Alamat Tujuan</label>
  												<div class="col-sm-4">
  													<textarea name="alamat_tujuan" id="alamat_tujuan" class="form-control" autocomplete="off" readonly/><?php echo $data['alamat_tujuan']?></textarea>
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Pengirim</label>
  												<div class="col-sm-4">
  													<input name="pengirim" value="<?php echo $data['nama_pelanggan']?>" type="text" id="pengirim" class="form-control"  autocomplete="off" readonly />
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Penerima</label>
  												<div class="col-sm-4">
  													<input name="penerima" value="<?php echo $data['penerima']?>" type="text" id="penerima" class="form-control"  autocomplete="off" readonly />
  												</div>
  											</div>                            
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">No HP Penerima</label>
  												<div class="col-sm-4">
  													<input value="<?php echo $data['no_hp_penerima']?>" type="text" name="no_hp_penerima" id="no_hp_penerima" class="form-control"  autocomplete="off" maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)" readonly />
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Kurir</label>
  												<div class="col-sm-4">
  													<input type="text" value="<?php echo $_SESSION['nama']?>" name="kurir" id="kurir" class="form-control"  autocomplete="off"  readonly />
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Berat</label>
  												<div class="col-sm-4">
  													<input name="berat" onkeyup="operasi()" onchange="operasi()" <?php if($data['status'] == 'Proses Pengiriman'){ echo "readonly"; } ?> value="<?php echo $data['berat_barang']?>" type="number" id="berat" class="form-control" placeholder="Masukkan Berat" autocomplete="off" required /> 
  												</div>
  												<div class="col-sm-1">Kg</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Biaya</label>
  												<div class="col-sm-4">
  													<input name="biaya" value="<?php echo $data['biaya']?>" type="text" id="biaya" class="form-control" autocomplete="off" readonly />
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Status Terkini</label>
  												<div class="col-sm-4">
  													<input name="stt" value="<?php echo $data['status']?>" type="text" id="stt" class="form-control" autocomplete="off" readonly />
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label">Ubah Status Menjadi</label>
  												<div class="col-sm-4">
  													<select id="status" name="status" class="form-control" required>
  														<option value="" disabled>-- Pilih Status --</option>
  														<option value="Proses Pengiriman" <?php if($data['status'] == 'Proses Pengiriman'){ echo "disabled"; } ?>>Proses Pengiriman</option> 
  														<option value="Terkirim" <?php if($data['status'] == 'Proses Pengiriman'){ echo "selected"; } else if($data['status'] == 'Penjemputan Barang'){ echo "disabled"; }  ?>>Terkirim</option> 
  													</select>  
  												</div>
  											</div>
  											<div class="form-group">
  												<label class="col-sm-2 col-sm-2 control-label"></label>
  												<div class="col-sm-10">
  													<input type="submit" name="input" value="Save" class="btn btn-sm btn-primary" />&nbsp;
  													<a href="dataorder.php" class="btn btn-sm btn-danger">Batal</a>
  												</div> 
  											</div>
  											<?php
  											
  										}
  										
  										if($data['status'] == 'Terkirim'){
  											echo "<meta http-equiv='refresh' content='0;url=orderterkirim.php'>";
  										}
  										if($data['kurir'] <> $_SESSION['id'] and $data['kurir'] <> ''){
  											echo "<center><h2>Orderan ini telah diambil Kurir lain</h2></center>
  											<meta http-equiv='refresh' content='2;url=dataorder.php'>";
  										}
  										if ($data['kurir'] == $_SESSION['id']){
  											?>
  											<div class="box-body">
  												<form class="form-horizontal style-form" action="proses/proses_editstatus.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">No Transaksi</label>
  														<div class="col-sm-4">
  															<input name="no_transaksi" value="<?php echo $data['no_transaksi']?>" type="text" id="no_transaksi" class="form-control" autocomplete="off" readonly />
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Nama Barang</label>
  														<div class="col-sm-4">
  															<input name="nama_barang" value="<?php echo $data['nama_barang']?>" type="text" id="nama_barang" class="form-control" autocomplete="off" readonly />
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Alamat Asal</label>
  														<div class="col-sm-4">
  															<textarea name="alamat_asal"; id="alamat_asal" class="form-control"  autocomplete="off" readonly /><?php echo $data['alamat_asal']?></textarea>
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Alamat Tujuan</label>
  														<div class="col-sm-4">
  															<textarea name="alamat_tujuan" id="alamat_tujuan" class="form-control" autocomplete="off" readonly/><?php echo $data['alamat_tujuan']?></textarea>
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Pengirim</label>
  														<div class="col-sm-4">
  															<input name="pengirim" value="<?php echo $data['nama_pelanggan']?>" type="text" id="pengirim" class="form-control"  autocomplete="off" readonly />
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Penerima</label>
  														<div class="col-sm-4">
  															<input name="penerima" value="<?php echo $data['penerima']?>" type="text" id="penerima" class="form-control"  autocomplete="off" readonly />
  														</div>
  													</div>                            
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">No HP Penerima</label>
  														<div class="col-sm-4">
  															<input value="<?php echo $data['no_hp_penerima']?>" type="text" name="no_hp_penerima" id="no_hp_penerima" class="form-control"  autocomplete="off" maxlength="12" onKeyPress="return goodchars(event,'0123456789',this)" readonly />
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Kurir</label>
  														<div class="col-sm-4">
  															<input type="text" value="<?php echo $_SESSION['nama']?>" name="kurir" id="kurir" class="form-control"  autocomplete="off"  readonly />
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Berat</label>
  														<div class="col-sm-4">
  															<input name="berat" onkeyup="operasi()" onchange="operasi()" <?php if($data['status'] == 'Proses Pengiriman'){ echo "readonly"; } ?> value="<?php echo $data['berat_barang']?>" type="number" id="berat" class="form-control" placeholder="Masukkan Berat" autocomplete="off" required /> 
  														</div>
  														<div class="col-sm-1">Kg</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Biaya</label>
  														<div class="col-sm-4">
  															<input name="biaya" value="<?php echo $data['biaya']?>" type="text" id="biaya" class="form-control" autocomplete="off" readonly />
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Status Terkini</label>
  														<div class="col-sm-4">
  															<input name="stt" value="<?php echo $data['status']?>" type="text" id="stt" class="form-control" autocomplete="off" readonly />
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label">Ubah Status Menjadi</label>
  														<div class="col-sm-4">
  															<select id="status" name="status" class="form-control" required>
  																<option value="" disabled>-- Pilih Status --</option>
  																<option value="Proses Pengiriman" <?php if($data['status'] == 'Proses Pengiriman'){ echo "disabled"; } ?>>Proses Pengiriman</option> 
  																<option value="Terkirim" <?php if($data['status'] == 'Proses Pengiriman'){ echo "selected"; } else if($data['status'] == 'Penjemputan Barang'){ echo "disabled"; }  ?>>Terkirim</option> 
  															</select>  
  														</div>
  													</div>
  													<div class="form-group">
  														<label class="col-sm-2 col-sm-2 control-label"></label>
  														<div class="col-sm-10">
  															<input type="submit" name="input" value="Save" class="btn btn-sm btn-primary" />&nbsp;
  															<a href="dataorder.php" class="btn btn-sm btn-danger">Batal</a>
  														</div> 
  													</div>
  													<?php
  												}
  												?>                
  											</form>
  										</div><!-- /.box-body -->
  										<?php }
  									else{
  										echo "<meta http-equiv='refresh' content='0;url=dataorder.php'>";
  									}?>
  								</div><!-- /.box -->

  							</section><!-- /.Left col -->
  						</div><!-- /.row (main row) -->

  					</section><!-- /.content -->
  				</div><!-- /.content-wrapper -->
  				<?php include "footer.php"; ?>

      <!-- Add the sidebar's background. This div must be placed
      	immediately after the control sidebar -->
      	<div class="control-sidebar-bg"></div>
      </div><!-- ./wrapper -->

      <!-- jQuery 2.1.4 -->
      <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="../assets/css/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
      $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.5 -->
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="../assets/plugins/morris/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../assets/plugins/knob/jquery.knob.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../assets/plugins/fastclick/fastclick.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/app.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../assets/dist/js/demo.js"></script>
  <script>
	//options method for call datepicker
	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
	
	function operasi() {
		var total;
		var berat = document.getElementById("berat").value;
		total = berat * 10000;
		document.getElementById("biaya").value = total;
	}
</script>
</body>
</html>
