<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=isset($title)?$title.' - OnJob': 'OnJob PHP Job Portal'; ?></title>
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.png">
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/linearicons.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
	<link href="https://cdn.lineicons.com/1.0.1/LineIcons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/nice-select.css">					
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.theme.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.transitions.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/croppie.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/update.css">
  	<script src="<?= base_url(); ?>assets/js/vendor/jquery-3.3.1.min.js"></script>
</head>


<body>

	<!-- Navbar File-->
	<?php include('navbar.php'); ?>

	<!--main content start-->
		<?php $this->load->view($layout); ?>
	<!--main content end-->

	<!-- Footer File-->
	<?php include('footer.php'); ?>


	<!-- Scripts Files -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/vendor/bootstrap.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/easing.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/hoverIntent.js"></script>
	<script src="<?= base_url(); ?>assets/js/superfish.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/jquery.ajaxchimp.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>	
	<script src="<?= base_url(); ?>assets/js/owl.carousel.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/jquery.sticky.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.nice-select.min.js"></script>			
	<script src="<?= base_url(); ?>assets/js/parallax.min.js"></script>		
	<script src="<?= base_url(); ?>assets/js/croppie.min.js"></script>
	
	<script src="<?= base_url(); ?>assets/js/main.js"></script>
	<script src="<?= base_url(); ?>assets/js/custom.js"></script>



</body>
</html>