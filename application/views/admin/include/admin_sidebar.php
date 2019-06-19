<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);  
?>  

	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?= base_url() ?>public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?= ucwords($this->session->userdata('name')); ?></p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
		 
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li id="dashboard" class="treeview">
					<a href="#">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li id="dashboard"><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
					</ul>
				</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="admin" class="treeview">
						<a href="#">
							<i class="fa fa-user"></i> <span>Admin</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id=""><a href="<?= base_url('admin/profile'); ?>"><i class="fa fa-circle-o"></i>Admin Profile</a></li>
							<li id=""><a href="<?= base_url('admin/profile/change_pwd'); ?>"><i class="fa fa-circle-o"></i>Change Password</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="admin" class="treeview">
						<a href="#">
							<i class="fa fa-envelope"></i> <span>Mailbox</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id=""><a href="<?= base_url('admin/mailbox'); ?>"><i class="fa fa-circle-o"></i>inbox</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="users" class="treeview">
						<a href="#">
							<i class="fa fa-users"></i> <span>Users</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id=""><a href="<?= base_url('admin/users'); ?>"><i class="fa fa-circle-o"></i>Users List</a></li>
							<li id="user_add"><a href="<?= base_url('admin/users/add'); ?>"><i class="fa fa-circle-o"></i>Add Users</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="employer" class="treeview">
						<a href="#">
							<i class="fa fa-user-circle"></i> <span>Employers</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id=""><a href="<?= base_url('admin/employer'); ?>"><i class="fa fa-circle-o"></i>Employers List</a></li>
						</ul>
					</li>
			</ul>

			 <ul class="sidebar-menu">
				<li id="job" class="treeview">
						<a href="#">
							<i class="fa fa-file-text"></i> <span>Jobs Posting</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li id=""><a href="<?= base_url('admin/job'); ?>"><i class="fa fa-circle-o"></i>View Jobs</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="category" class="treeview">
						<a href="#">
							<i class="fa fa-bars"></i> <span>Categories</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class=""><a href="<?= base_url('admin/category'); ?>"><i class="fa fa-circle-o"></i>Category</a></li>
							<li class=""><a href="<?= base_url('admin/category/category_by_expertise_level'); ?>"><i class="fa fa-circle-o"></i>Categories & Expertise Level</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="industry" class="treeview">
						<a href="#">
							<i class="fa fa-industry "></i> <span>Industry</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class=""><a href="<?= base_url('admin/industry'); ?>"><i class="fa fa-circle-o"></i>Industry</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="education" class="treeview">
						<a href="#">
							<i class="fa fa-book "></i> <span>Education</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class=""><a href="<?= base_url('admin/education'); ?>"><i class="fa fa-circle-o"></i>Education</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="city" class="treeview">
						<a href="#">
							<i class="fa fa-location-arrow "></i> <span>Manage Cities</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class=""><a href="<?= base_url('admin/city'); ?>"><i class="fa fa-circle-o"></i>city</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="country" class="treeview">
						<a href="#">
							<i class="fa fa-map-marker "></i> <span>Manage Countries</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class=""><a href="<?= base_url('admin/country'); ?>"><i class="fa fa-circle-o"></i>country</a></li>
						</ul>
					</li>
			</ul>

			<ul class="sidebar-menu">
				<li id="export" class="treeview">
						<a href="#">
							<i class="fa fa-life-ring"></i> <span>Backup & Export</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class=""><a href="<?= base_url('admin/export'); ?>"><i class="fa fa-circle-o"></i> Database Backup </a></li>
						</ul>
					</li>
			</ul>  


		</section>
		<!-- /.sidebar -->
	</aside>

	
<script>
	$("#<?= $cur_tab ?>").addClass('active');
</script>
