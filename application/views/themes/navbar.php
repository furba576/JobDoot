<!-- #header start -->
<header id="header">
	<div class="container">
		<div class="row align-items-center d-flex">
			<div class="col-2 ml-4 ml-md-0">
				<div id="logo">
					<a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/img/onjob_logo.png" alt="" title="" /></a>
				</div>
			</div>
			<div class="col-10">
				<nav id="nav-menu-container">
					<ul class="nav-menu">
					 
						<?php if ($this->session->userdata('is_user_login')): ?>
							<li class="menu-has-children"><a href="#">Jobs</a>
								<ul>
									<li><a href="<?= base_url('jobs'); ?>">All Jobs</a></li>
									<li><a href="<?= base_url('jobs-by-category'); ?>">Jobs By Category</a></li>
								</ul>
							</li>
							<li class=""><a href="<?= base_url('about'); ?>">About</a></li>
							<li class=""><a href="<?= base_url('company'); ?>">Companies</a></li> 
							</li>   
							<li class="menu-has-children margin-left-400 d-none d-md-block"><img src="<?= $_SESSION['pro_pic']?$_SESSION['pro_pic'] : base_url('assets/img/user.png')?>" alt="user_img" height=35 /><a href="#"> <?= $this->session->userdata('username'); ?> </a>
								<ul>
									<li><a href="<?= base_url('profile'); ?>">My Profile</a></li>
									<li><a href="<?= base_url('myjobs'); ?>">My Applications</a></li>
									<li><a href="<?= base_url('myjobs/matching'); ?>">Matching Jobs</a></li>
									<li><a href="<?= base_url('setting/change_password'); ?>">Change Password</a></li>
									<li><a href="<?= base_url('auth/logout')?>">LogOut</a></li>
								</ul>
							</li>   
						<?php elseif ($this->session->userdata('is_employer_login')): ?> 
						<li><a href="<?= base_url('employers/profile') ?>"> Dashboard</a>
						<li><a href="<?= base_url('employers/job/post'); ?>"> Post New Job</a>
						<li><a href="<?= base_url('employers/job/listing') ?>"> Manage Jobs</a>
						<li><a href="<?= base_url('employers/cv/search') ?>"> CV Search</a>
						

						
						<li class="menu-has-children margin-left-400 d-none d-md-block"><img src="<?= base_url('assets/img/user.png')?>" alt="user_img"  height=35 /><a href="#"> <?= $this->session->userdata('username'); ?> </a>
							<ul>
								<li><a href="<?= base_url('employers/profile'); ?>">Personal Info</a></li>
								<li><a href="<?= base_url('employers/company'); ?>">Company Profile</a></li>
								<li><a href="<?= base_url('employers/cv/shortlisted') ?>">Shortlisted Resumes</a></li>
								<li><a href="<?= base_url('employers/setting/change_password'); ?>">Change Password</a></li>
								<li><a href="<?= base_url('employers/auth/logout')?>">LogOut</a></li>
							</ul>
						</li>   
						<?php else: ?> 
						<li class=""><a href="<?= base_url(); ?>">Home</a></li>
						<li class="menu-has-children  margin-left-400"><a href="#">Jobs</a>
							<ul>
								<li><a href="<?= base_url('jobs'); ?>">All Jobs</a></li>
								<li><a href="<?= base_url('jobs-by-category'); ?>"> Jobs By Category </a></li>
							</ul>
						</li>
						<li class=""><a href="<?= base_url('about'); ?>">About</a></li>
						<li class=""><a href="<?= base_url('company'); ?>">Companies</a></li> 
						<li class="menu-has-children margin-left-400 pr-2">
							<a href="#" class="ticker-btn-nav btn_login mt-1">Login</a>
							<ul>
								<li>
									<a class="ticker-btn-nav btn_login mt-1" href="<?= base_url('auth/login') ?>"><i class="lnr lnr-user pr-1"></i> Employee Login</a>
								</li>
								<li>
									<a class="ticker-btn-nav btn_login mt-1" href="<?= base_url('employers/auth/login') ?>"><i class="lnr lnr-briefcase pr-1"></i> Employer Login</a>
								</li>
							</ul>
						</li>
						<li><a class="nav_btn mt-1" href="<?= base_url('employers') ?>"><i class="lnr lnr-briefcase pr-1"></i> For Employers</a> </li>
						<?php endif; ?>                                 
					</ul>
				</nav><!-- #nav-menu-container -->      
			</div>      
		</div>
	</div>

	<?php if ($this->session->userdata('is_user_login')): ?>
		<ul class="custom-login d-lg-none">
			<li> <i class="lnr lnr-user"></i> <button type="button" data-toggle="modal" data-target="#user_loggedin_menu"> <?= $this->session->userdata('username'); ?> </a></li>
		</ul>
	<?php elseif( $this->session->userdata('is_employer_login') ): ?>
		<ul class="custom-login d-lg-none">
			<li> <i class="lnr lnr-user"></i> <button type="button" data-toggle="modal" data-target="#employer_loggedin_menu"> <?= $this->session->userdata('username'); ?> </a></li>
			
		</ul>
	<?php else: ?>

	<ul class="custom-login d-lg-none">
		<li><button type="button" data-toggle="modal" data-target="#login_option">Login</a></li>
		<li><button type="button" data-toggle="modal" data-target="#signup_option">SignUp</a></li>
	</ul>
	
	<?php endif; ?>


</header><!-- #header End-->

<section class="category-fixed-top">
	<div class="container">
		<div class="row ft-cat-main-row justify-content-center">
			<div class="col col-md-2 text-center my-auto ft_category_wrap position-relative jf-section-fh">
				<span>Jobs For :</span>
			</div>
			<div class="col col-md-2 text-center my-auto ft_category_wrap">
				<a href="<?= base_url('JobsExtended/expertise_level/entry-level') ?>">Beginner</a>
			</div>
			<div class="col col-md-2 text-center my-auto ft_category_wrap">
				<a href="<?= base_url('JobsExtended/expertise_level/intermediate-level') ?>">Intermediate</a>
			</div>
			<div class="col col-md-2 text-center my-auto ft_category_wrap">
				<a href="<?= base_url('JobsExtended/expertise_level/expert-level') ?>">Expert</a>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="login_option" tabindex="-1" role="dialog" aria-labelledby="loginOptions" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-body position-relative  auth_option">
		        <span class="float-right d-block close-modal-span" data-dismiss="modal"><i class="lnr lnr-cross"></i></span>
		        <ul class="modal_login_option">
		        	<li>
		        		<a href="<?= base_url('auth/login') ?>"><i class="lnr lnr-user pr-1"></i> Employee Login <i class="mt-1 float-right lnr lnr-chevron-right"></i></a>
		        	</li>
		        	<li>
		        		<a href="<?= base_url('employers/auth/login') ?>"><i class="lnr lnr-briefcase pr-1"></i> Employer Login <i class="mt-1 float-right lnr lnr-chevron-right"></i></a>
		        	</li>

		        </ul>
	      	</div>
	    </div>
  	</div>
</div>

<div class="modal fade" id="signup_option" tabindex="-1" role="dialog" aria-labelledby="signUpOptions" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-body position-relative  auth_option">
		        <span class="float-right d-block close-modal-span" data-dismiss="modal"><i class="lnr lnr-cross"></i></span>
		        <ul class="modal_login_option">
		        	<li>
		        		<a href="<?= base_url('auth/registration') ?>"><i class="lnr lnr-user pr-1"></i> I am Jobseeker <i class="mt-1 float-right lnr lnr-chevron-right"></i></a>
		        	</li>
		        	<li>
		        		<a href="<?= base_url('employers/auth/registration') ?>"><i class="lnr lnr-briefcase pr-1"></i> I am Employer <i class="mt-1 float-right lnr lnr-chevron-right"></i></a>
		        	</li>

		        </ul>
	      	</div>
	    </div>
  	</div>
</div>


<div class="modal fade" id="user_loggedin_menu" tabindex="-1" role="dialog" aria-labelledby="signUpOptions" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-body position-relative  auth_option">
		        <span class="float-right d-block close-modal-span" data-dismiss="modal"><i class="lnr lnr-cross"></i></span>
		        <ul class="modal_login_option">
	        		<li>
	        			<a href="<?= base_url('profile'); ?>">My Profile <i class="mt-1 float-right lnr lnr-chevron-right"></i> </a>
	        		</li>
	        		<li><a href="<?= base_url('myjobs'); ?>">My Applications <i class="mt-1 float-right lnr lnr-chevron-right"></i> </a></li>
	        		<li><a href="<?= base_url('myjobs/matching'); ?>">Matching Jobs  <i class="mt-1 float-right lnr lnr-chevron-right"></i></a></li>
	        		<li><a href="<?= base_url('setting/change_password'); ?>">Change Password  <i class="mt-1 float-right lnr lnr-chevron-right"></i></a></li>
	        		<li><a href="<?= base_url('auth/logout')?>">LogOut <i class="mt-1 float-right lnr lnr-chevron-right"></i> </a></li>
		        </ul>
	      	</div>
	    </div>
  	</div>
</div>


<div class="modal fade" id="employer_loggedin_menu" tabindex="-1" role="dialog" aria-labelledby="signUpOptions" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-body position-relative  auth_option">
		        <span class="float-right d-block close-modal-span" data-dismiss="modal"><i class="lnr lnr-cross"></i></span>
		        <ul class="modal_login_option">
	        		<li><a href="<?= base_url('employers/profile'); ?>">Personal Info <i class="mt-1 float-right lnr lnr-chevron-right"></i> </a></li>
	        		<li><a href="<?= base_url('employers/company'); ?>">Company Profile <i class="mt-1 float-right lnr lnr-chevron-right"></i> </a></li>
	        		<li><a href="<?= base_url('employers/cv/shortlisted') ?>">Shortlisted Resumes <i class="mt-1 float-right lnr lnr-chevron-right"></i> </a></li>
	        		<li><a href="<?= base_url('employers/setting/change_password'); ?>">Change Password <i class="mt-1 float-right lnr lnr-chevron-right"></i> </a></li>
	        		<li><a href="<?= base_url('employers/auth/logout')?>">LogOut <i class="mt-1 float-right lnr lnr-chevron-right"></i> </a></li>
		        </ul>
	      	</div>
	    </div>
  	</div>
</div>