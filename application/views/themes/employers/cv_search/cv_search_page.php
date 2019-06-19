<section class="search-section page">
	<?php 
		$attributes = array('id' => 'search_job', 'method' => 'post');
	 	echo form_open('employers/cv/search',$attributes);?>
		<div class="row form-wrap justify-content-center no-gutters px-2 py-3 search_wrap">
		  	<div class="col-lg-6 col-12 form-cols">
		    	<input type="text" class="form-control" name="job_title" value="<?php if(isset($search_value['job_title'])) echo str_replace('-', ' ', $search_value['job_title']); ?>" placeholder="search cv by keyword">
		    	<input type="submit" name="search" class="search_btn" value="Search">
		    	<button><i class="fa fa-search"></i></button>
		  	</div>

		</div>
  	<?php 
  	echo form_close(); ?>
</section>

<!-- start banner Area -->
<section class="banner-area relative custom_bg" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="jt-breadcumb">
    <div class="container">
      <p class="link-nav text-left"><a href="<?= base_url('employers'); ?>">Home </a>  
        <span class="lnr lnr-chevron-right"></span>  
        <a href="">CV Search</a>
        
      </p>
    </div>
  </div>
  <div class="container">
    <div class="d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12 page_heading custom_header">

        <h1 class="">
          CV Search      
        </h1>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->


<!-- Start post Area -->
<section class="post-area section-gap">
	<div class="container">
		<div class="row d-flex">
			<!-- End search sidebar -->
			<div class="col-12 post-list">
				<?php if(empty($profiles)): ?>
		          <p class="alert alert-danger"><strong>Sorry,</strong> we could not find any profile for the keywords that you entered</p>
		        <?php endif; ?>
				<?php foreach($profiles as $row): ?>
				<div class="single-post d-flex flex-row">
					<div class="thumb">
						<img src="<?= base_url()?>assets/img/user.png" height=100 alt="">
						<?php  $skills = explode("," , $row['skills']);?>
						<ul class="tags">
							<?php foreach($skills as $skill): ?>
							<li>
								<a href="#"><?= $skill; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="details col-lg-7">
						<div class="title d-flex flex-row justify-content-between">
							<div class="titles">
								<a href="#"><h4><?= $row['firstname'].' '.$row['lastname']; ?></h4></a>
								<h6><?= $row['job_title']; ?></h6>					
							</div>
						</div>
						<?php if( !empty($row['city']) ||  !empty($row['country']) ): ?>
							<p class="">Location: <?= get_city_name($row['city']).','. get_country_name($row['country']); ?></p>
						<?php endif; ?>

						<?php if( isset($row['education_level']) && ( trim($row['education_level'] ) != "" ) ): ?>
							<p class="">Education: <?= get_education_level($row['education_level']); ?></p>
						<?php endif; ?>
						
						<p class="">Experience: <?= $row['experience']; ?> Years</p>
						<p class="">Nationality: <?= get_country_name($row['nationality']); ?></p>
						<p class="">Current Salary: <?= $row['current_salary']; ?>$</p>
						<p class="">Expected Salary: <?= $row['expected_salary']; ?>$</p>
						<p class="">Category: <?= $row['category']; ?></p>
						<p class="address">
							<?= $row['description']; ?>
						</p>
					</div>
					<div class="options col-lg-3">
						<ul class="btns">
							<li class=""><a href="<?= base_url('employers/cv/make_shortlist/'.$row['id']); ?>">Shortlist</a></li><br/>
							<?php if(!empty($row['resume'])) :?>
							<li><a href="<?= base_url().$row['resume']; ?>">Download Resume</a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>			
				<?php endforeach; ?>									
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->