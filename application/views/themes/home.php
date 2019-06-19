<!-- start banner Area -->
<?php 
$banner_images = array(
	'banner_1.svg',
	'banner_2.svg',
	'banner_3.svg',
	'banner_4.svg',
	'banner_7.jpg',
	'banner_8.jpg'
);
$index = array_rand( $banner_images );
$b_image = base_url('/assets/img/banners/').$banner_images[$index];
?>


<section class="banner-area relative" id="home" style=" background: url('<?= $b_image ?>') no-repeat; background-position: 50% 50%;
    background-size: cover;" >
	<div class="overlay overlay-bg" ></div>

  	<div class="container">
	 	<div class="row fullscreen d-flex align-items-center justify-content-center banner-content home_banner-content">

			<div class="col-lg-12 animated fadeInUp">
				<h4 class="text-white">
					<!-- Only portal that find a perfect job for any level of IT professionals.       -->
				</h4>
			</div>

			<div class="col-lg-12 animated fadeIn">
				<ul class="text-white mx-auto">
					<?php if( isset( $job_count ) ): ?>
				  		<?php foreach( $job_count as $jc ): ?>
							<li> 
								<a href=" <?= base_url('JobsExtended/expertise_level/').$jc['el_slug']; ?> ">
						  			<?= $jc['num']."+" ?> 
						  			jobs for <span> <?= $jc['el_name'] ?> </span> 
						  			<i class="float-right fa fa-chevron-right"></i>
						  		</a>
							</li>
					  	<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>

			<div class="col-lg-12 animated fadeInUp search-section home_banner">
			   	<?php $attributes = array('id' => 'search_job', 'method' => 'post');
			   	echo form_open('jobs/search',$attributes);?>
				<div class="row justify-content-center form-wrap search_wrap">
				  	<div class="col-lg-6 col-12 form-cols position-relative p-0">
					 	<input type="text" class="form-control" name="job_title" placeholder="Search Jobs">
					 	<input type="submit" class="search_btn" name="search" value="Search" />
					 	<button type="submit" name="search"><i class="fa fa-search"></i></button>
				  	</div>            
			   	</div>
			   	<?php echo form_close(); ?>
			</div>
	 	</div>
  	</div>
</section>
<!-- End banner Area -->


<!-- browse job section | Combined Category  -->
<section class="combined-cat section-full">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 d-flex justify-content-center">
				<div class="menu-content pb-20 col-lg-10">
					<div class="title text-center">
						<h1 class="mb-10">Jobs by Category</h1>
					</div>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
			<?php  
			$levels_to_show = $this->config->item('expertise_level_slug');
			foreach ($levels_to_show as $ls) : ?>
				<div class="col-md-4 mb-4">
					<div class="cc-wrapper">
						<div class="row no-gutters">
							<div class="col-12 my-auto cc-level">
								<p><?= $ls['name'] ?></p>
							</div>
							<div class="col-12 cc-category">
								<ul>
								<?php
								if( isset( $combined_categories ) ):
									foreach ($combined_categories as $coc) : 
										if( ( $ls['slug'] == $coc['el_slug'] ) && ( (int)$coc['jobs_count'] > 0 ) ): ?>
											<li> <a href="<?= base_url('job-by-category').'/'.$coc['el_slug'].'/'.$coc['slug'] ?>"> <?= $coc['name'] ?> <span>(<?= $coc['jobs_count'] ?>)</span> </a> </li>
										<?php 
										endif;
									endforeach;
								endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php
			endforeach; ?>
		</div>
	</div>
</section>
<!-- end of browser job section | Combined Category -->


<!-- Start post Area -->
<section class="post-area section-full bg-gray">
	<div class="container">
	  	<div class="row d-flex justify-content-center">
			<div class="menu-content pb-20 col-lg-10">
			  	<div class="title text-center">
					<h1 class="mb-10">Featured Jobs</h1>
			  	</div>
			</div>
	  	</div>
	  	<div class="row justify-content-center d-flex">
			<div class="col-lg-8 post-list featured-job-list-wrap">
			  	<?php 
			  	foreach($jobs as $job): ?>
				  	<div class="single-post d-flex row no-gutters">
					  	<div class="thumb col-4 col-md-2 my-auto text-center pr-3">
					  		<?php 
					  		if( $job['company_logo'] != "" || !empty($job['company_logo']) ){
					  			$logo_url = base_url($job['company_logo']);
					  		}else{
					  			$logo_url = base_url()."assets/img/job_icon.png";
					  		}
					  		?>
							<img src="<?= $logo_url; ?>" alt="">

					  	</div>
					  	<div class="details col-8 col-md-6">
							<div class="title d-flex flex-row justify-content-between">
							  	<div class="titles">
									<a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>"><h4><?= text_limit($job['job_title'], 35); ?></h4></a>
									<h6><?= $job['company_name']; ?></h6>         
							  	</div>
							</div>
							<div class="job-listing-footer">
							  	<ul>
									<li><i class="lnr lnr-map-marker"></i> <?= get_city_name($job['city']); ?>, <?= get_country_name($job['country']); ?></li>
									<li><i class="lnr lnr-apartment"></i> <?= get_industry_name($job['industry']); ?></li>
									<li><i class="lnr lnr-clock"></i> <?= time_ago($job['created_date']); ?></li>
							  	</ul>                 
							</div>
					  	</div>
					  	<div class="job-listing-btns d-none d-md-block">
							<ul class="btns">
						  		<li><a href="<?= site_url('jobs/'.$job['id'].'/'.($job['job_slug'])); ?>">Apply</a></li>
							</ul>
					  	</div>
					</div>
			  	<?php 
				endforeach; ?>

		  		<a class="text-uppercase loadmore-btn mx-auto d-block my-1" href="<?= base_url('jobs'); ?>">Load More job Posts</a>
			</div>

			<div class="col-lg-4 col-12 sidebar mt-4 mt-md-0">
			 	<div class="single-slidebar">
			  		<h4>Top Employers</h4>
	  				<div class="row">
			  			<?php 
			  			foreach($companies as $company): ?>
			  				<?php 
	  				  		if( $company['company_logo'] != "" || !empty($company['company_logo']) ){
	  				  			$logo_url = base_url($company['company_logo']);
	  				  		}else{
	  				  			$logo_url = base_url()."assets/img/job_icon.png";
	  				  		}
			  				?>
			  				<div class="col-4 company_logo my-auto text-center">
			  					<a href="<?= base_url('company/'.$company['company_slug']); ?>">
			  						<img src="<?= $logo_url ?>" alt="<?= $company['company_name'] ?>" title="<?= $company['company_name'] ?>" />
			  					</a>
			  				</div>
			  			<?php 
			  			endforeach; ?>
		  			</div>                             
			  	</div>              
			</div>
	  	</div>
	</div>  
</section>
<!-- End post Area -->



<!-- Start call-to-action Area -->
<section class="callto-action-area section-half" id="join">
	<div class="container">
	  	<div class="row d-flex justify-content-center">
			<div class="menu-content col-lg-9">
			  	<div class="title text-center">
					<h1 class="mb-10 text-white"> Submit your resume and get notified</h1>
					<p class="text-white">Signup and complete your profile. We will automatically recommend you the matching jobs.</p>
					<a class="primary-btn" href="<?= base_url(); ?>employers/auth/registration">Sign Up Now</a>
			  	</div>
			</div>
	  	</div>  
	</div>  
</section>
<!-- End call-to-action Area -->


  


  