<?php
	session_start();

	if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']) header("Location:index.php");

	include 'include/config.php';
	$error 	= 'include/error.php';

	if(isset($_GET['page']) && $_GET['page'] != '') {
		if(isset($_GET['act']) && $_GET['act'] != '') {
			$file 	= 'include/' . $_GET['page'] . '/' .$_GET['act'] . '.php';
		} else {
			$file 	= 'include/poi/visible.php';
		}
	} else {
		$file 	= 'include/poi/visible.php';
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>PlesiAR - Dashboard</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- dataTables -->
	<link rel="stylesheet" href="css/plugins/datatable/TableTools.css">
	<!-- chosen -->
	<link rel="stylesheet" href="css/plugins/chosen/chosen.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- imagesLoaded -->
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<!-- slimScroll -->
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- dataTables -->
	<script src="js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="js/plugins/datatable/TableTools.min.js"></script>
	<script src="js/plugins/datatable/ColReorderWithResize.js"></script>
	<script src="js/plugins/datatable/ColVis.min.js"></script>
	<script src="js/plugins/datatable/jquery.dataTables.columnFilter.js"></script>
	<script src="js/plugins/datatable/jquery.dataTables.grouping.js"></script>
	<!-- Chosen -->
	<script src="js/plugins/chosen/chosen.jquery.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/form/jquery.form.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- Custom file upload -->
	<script src="js/plugins/fileupload/bootstrap-fileupload.min.js"></script>

	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
	
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script type="text/javascript">
		function poi() {
			$('#modal-delete').on('show', function() {
			    var id = $(this).data('id'),
			    	name = $(this).data('name'),
			        removeBtn = $(this).find('.btn-danger');

			    removeBtn.attr('href', removeBtn.attr('href').replace(/(&|\?)id=\d*/, '&id=' + id));
			    $('#debug-url').html('Delete : <strong>' + name + '</strong>');
			});

			$('.confirm-delete').on('click', function(e) {
			    e.preventDefault();

			    var id = $(this).data('id'),
			    	name = $(this).data('name');
			    $('#modal-delete').data('id', id);
			    $('#modal-delete').data('name', name);
			    $('#modal-delete').modal('show');
			});

				/* if map model's opened */
				$('#map-modal').on('shown', function () {
					<?php
						if($_GET['page'] == 'poi' && $_GET['act'] == 'edit' && $_GET['id'] != '') :
							$query 		= "SELECT * FROM poi WHERE id = '{$_GET['id']}' LIMIT 1";
							$result 	= mysql_query($query);
							
							$row 		= mysql_fetch_array($result);
					?>
							var point = new google.maps.LatLng(<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>);
					<?php else: ?>
							var point = new google.maps.LatLng(-6.96666670,110.41666670);
					<?php endif; ?>
					
					var map = new google.maps.Map(document.getElementById('map-canvas'), {
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						zoom: 13,
						center: point
					});
					tanda = new google.maps.Marker({
						animation: google.maps.Animation.BOUNCE,
						position: point,
						map: map
					});
					$("#coordx").val(point.lat());
					$("#coordy").val(point.lng());
					
					google.maps.event.addListener(map,'click',function(event){
						tanda.setMap(null);
						var lokasi = event.latLng;
						
						$("#coordx").val(lokasi.lat());
						$("#coordy").val(lokasi.lng());
						tanda = new google.maps.Marker({
							animation: google.maps.Animation.BOUNCE,
							position: lokasi,
							map: map
						});
					});
				});
				
				$('#savecoord').on('click', function(e) {
					var lat = $("#coordx").val();
					var lon = $("#coordy").val();
					
			        $("#lat").val(lat);
					$("#lon").val(lon);
					$('#map-modal').modal('hide');
					
					return false;
			    });
		}

		$(function() {
		    poi();
		});
	</script>
</head>

<body class="theme-darkblue" data-theme="theme-darkblue">
	<div id="navigation">
		<div class="container-fluid">
			<a href="dashboard.php" id="brand">PlesiAR</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<div class="user">
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $_SESSION['nama']; ?> <img src="img/admin/<?php echo $_SESSION['image']; ?>" alt="" style="height:27px;"></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="dashboard.php?page=admin&act=edit&id=<?php echo $_SESSION['id']; ?>">Edit profile</a>
						</li>
						<li>
							<a href="logout.php">Sign out</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="content">
		<div id="left">
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Dashboard</span></a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">POI</a>
						<ul class="dropdown-menu">
							<li>
								<a href="dashboard.php?page=poi&act=visible">Ditampilkan</a>
							</li>
							<li>
								<a href="dashboard.php?page=poi&act=hidden">Disembunyikan</a>
							</li>
							<li>
								<a href="dashboard.php?page=poi&act=add">Tambah POI</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="dashboard.php?page=admin&act=front">Administrator</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Daftar POI</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='darkblue'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big"></span>
									<span></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<?php if(isset($_SESSION['has_flashdata']) && $_SESSION['has_flashdata']): ?>
				<div class="row-fluid">
					<div class="span12">
						<div class="alert alert-<?php echo $_SESSION['class']; ?>">
							<button type=button class=close data-dismiss=alert>×</button>
							<?php if($_SESSION['class']=='error'): ?>
							<h4>Oh snap!</h4>
							<?php else: ?>
							<h4>Heads up!</h4>
							<?php endif; ?>
							<?php echo $_SESSION['msg']; ?>
						</div>
					</div>
				</div>
				<?php $_SESSION['has_flashdata']	= FALSE; ?>
				<?php $_SESSION['class'] 			= ''; ?>
				<?php $_SESSION['msg'] 				= ''; ?>
				<?php endif; ?>
				<?php
					if (file_exists($file)) {
						include  $file;
					} else {
						include  $error;
					}
					
				 	
				 ?>
			</div>
		</div>
	</div>		
</body>
</html>