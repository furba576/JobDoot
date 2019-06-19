  <!-- start banner Area -->
  <section class="banner-area relative custom_bg no_search" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="jt-breadcumb">
      <div class="container">
        <p class="link-nav text-left"><a href="<?= base_url(); ?>">Home </a>  
          <span class="lnr lnr-chevron-right"></span>  
          <a href="">Applied Jobs</a>
          
        </p>
      </div>
    </div>
    <div class="container">
      <div class="d-flex align-items-center justify-content-center">
        <div class="about-content col-lg-12 page_heading custom_header">

          <h1 class="">
            Applied Jobs      
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
				<?php $this->load->view($user_sidebar); ?>
			</div>
			<div class="col-lg-8 post-list">
                <?php if(empty($jobs)): ?>
                  <p class="text-gray"><strong>Sorry,</strong> there is no job application at the moment</p>
                <?php endif; ?>
                
				<?php foreach($jobs as $job): ?>
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="<?= base_url()?>assets/img/job_icon.png" alt="">
					</div>
					<div class="details">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
								<a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['job_title'], 35); ?></h4></a>
								<h6><?= $job['company_name']; ?></h6>					
							</div>
							
						</div>
						<div class="job-listing-footer">
							<ul>
								<li><i class="lnr lnr-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
								<li><i class="lnr lnr-briefcase"></i> <?= $job['job_type']; ?></li>
								<li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
								<li><i class="lnr lnr-clock"></i> <?= time_ago($job['created_date']); ?></li>
							</ul>									
						</div>
					</div>
					<div class="job-listing-btns ml-4">
						<ul class="btns">
							<!-- <li><a href="#"><span class="lnr lnr-trash"></span></a></li> -->
						</ul>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->		