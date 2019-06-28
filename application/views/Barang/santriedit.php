<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Informasi Paket Santri</title>	
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/datepicker3.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>PAKET</span>SANTRI</a>
				
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="<?php echo base_url(); ?>assets/images/man.png" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $this->session->userdata('nama'); ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li ><a href="<?php echo base_url(); ?>welcome"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>csantri"><em class="fa fa-calendar">&nbsp;</em> Data Santri</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Data Paket <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Paket Masuk
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Paket Keluar
					</a></li>
				</ul>
			</li>
			
			<li><a href="<?php echo base_url(); ?>claporan"><em class="fa fa-toggle-off">&nbsp;</em> Laporan</a></li>
			<li><a href="<?php echo base_url(); ?>cuser"><em class="fa fa-clone">&nbsp;</em> User</a></li>
			<li><a href="<?php echo base_url(); ?>csettings"><em class="fa fa-bar-chart">&nbsp;</em>Settings</a></li>
			<li><a href="<?php echo base_url(); ?>welcome/logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Data Santri</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Santri</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<!-- Isi Data Santri -->

                <!-- /.col-lg-12 -->
        </div><br>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading" >
                            Edit Data Santri
                        </div>
                        <!-- /.panel-heading -->
                        
                         <div class="panel-body">
                            <form action="<?php echo base_url(); ?>Csantri/edit/<?php if($row){ echo $row->NIS; }else{ echo $id; } ?>" method="POST">
								<div class="form-group">
									<label>NIS</label>
									<input type="number" readonly value="<?php if($row){ echo $row->NIS; }else{ echo set_value('nis'); }?>" class="form-control" name="nis" placeholder="NIS"></input>
									<?php echo form_error('nis', '<p style="color: #a94442">', '</p>'); ?>
								</div>
								<div class="form-group">
									<label>Nama Santri</label>
									<input type="text" value="<?php if($row){ echo $row->NamaSantri; }else{ echo set_value('nama'); }?>" class="form-control" name="nama" placeholder="Nama"></input>
									<?php echo form_error('nama', '<p style="color: #a94442">', '</p>'); ?>
								</div>
								<div class="form-group">
									<label>Alamat Santri</label>
									<input type="text" value="<?php if($row){ echo $row->Alamat; }else{ echo set_value('alamat'); }?>" class="form-control" name="alamat" placeholder="Alamat"></input>
									<?php echo form_error('alamat', '<p style="color: #a94442">', '</p>'); ?>
								</div>

								<div class="form-group">
									<label>Asrama</label>
									<select name="asrama" class="form-control">
										<?php
										foreach($asrama->result() as $r) {
											if ($row->Asrama == $r->IDAsrama || $r->IDAsrama == set_value('asrama')) {
												echo '<option value="'. $r->IDAsrama .'" selected>'. ucwords($r->NamaAsrama) .'</option>';
											} else {
												echo '<option value="'. $r->IDAsrama .'">'. ucwords($r->NamaAsrama) .'</option>';
											}
										}
										?>
									</select>
									<?php echo form_error('asrama', '<p style="color: #a94442">', '</p>'); ?>
								</div>

								<div class="form-group">
									<label>Total Buku Yang Diterima</label>
									<input type="number" value="<?php if($row){ echo $row->Total; }else{ echo set_value('total'); }?>" class="form-control" name="total" placeholder="Total Buku yang diterima"></input>
									<?php echo form_error('total', '<p style="color: #a94442">', '</p>'); ?>
								</div>

								<input type="submit" class="btn btn-success" value="Save" style="margin-top: 20px;"> 
							</form>
                        </div>

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>




			<!-- akhir data santri -->
			<div class="col-sm-12">
				<p class="back-link">PaketSantri Theme by <a href="https://www.youtube.com/watch?v=DOyn9NaRC4A">Mr.d</a></p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	  

	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/chart-data.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/easypiechart.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/easypiechart-data.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	
</body>
</html>
