<!-- start banner Area -->
<section class="banner-area relative custom_bg no_search" id="home">  
	<div class="overlay overlay-bg"></div>
	<div class="jt-breadcumb">
		<div class="container">
			<p class="link-nav text-left"><a href="<?= base_url('employers'); ?>">Home </a>  
				<span class="lnr lnr-chevron-right"></span>  
				<a href="">Manage Jobs</a>
				
			</p>
		</div>
	</div>
	<div class="container">
		<div class="d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12 page_heading custom_header">

				<h1 class="">
					Manage Jobs      
				</h1>
			</div>                      
		</div>
	</div>
</section>
<!-- End banner Area -->  

<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row justify-content-center d-flex">
			<div class="col-lg-4 sidebar">             
				<?php $this->load->view($emp_sidebar); ?>
			</div>
			<div class="col-lg-8 post-list">
				<div class="col-md-12">
					<?php if ($this->session->flashdata('update_success')) :?>
						<div class="alert alert-success">
							<a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
							<strong><?=$this->session->flashdata('update_success')?></strong> 
						</div>
					<?php endif;?>
					<?php if ($this->session->flashdata('deleted')) :?>
						<div class="alert alert-success">
							<a href="#" class="close" data-dimdiss="alert" aria-label="close" title="close">×</a>
							<strong><?=$this->session->flashdata('deleted')?></strong> 
						</div>
					<?php endif;?>
				</div>
				<div class="profile_job_content col-lg-12">
					<div class="headline">
						<div class="row">
							<div class="col-md-8 col-sm-8">
								<h3>Manage Your's Job</h3>
							</div>
					</div>  
				</div>

				<div class="onjob-job-alerts">
					<div class="col-12">
						<?php 
						if(empty($job_info)): ?>
							<p class="text-gray"><strong>Sorry,</strong> you didn't posted any job yet!</p>
						<?php 
						else: 
							foreach ($job_info as $job): ?>

								<div class="row emp-jl-wrapper my-3">
									<div class="col-10">
										<h4><?= $job['job_title']; ?></h4>
										<p> <i class="fa fa-calender"></i> <?= date('Y-m-d H:i:s A',strtotime($job['created_date']) ); ?> </p>

										<a class="jl_applications" href="<?= base_url('employers/applicants/view/'.$job['id']); ?>">Applied (<?= $job['cand_applied']?>)</a>
										<a class="jl_applications" href="<?= base_url('employers/applicants/shortlisted/'.$job['id']); ?>">Shortlisted (<?= $job['total_shortlisted']?>)</a><br/>
									</div>


									<div class="col-2 jl_btns">

										<a href="<?= base_url('employers/job/edit/'.$job['id']); ?>"><i title="edit" class="lnr lnr-pencil"></i></a>
										<a href="<?= base_url('employers/job/delete/'.$job['id']); ?>"><i title="delete" class="lnr lnr-trash"></i></a>
										
									</div>
								</div>

							<?php 
							endforeach;
						endif; ?>
					</div>
				</div>


			</div>                            

		</div>

	</div>
</div>  
</section>
			<!-- End Job listing Area -->