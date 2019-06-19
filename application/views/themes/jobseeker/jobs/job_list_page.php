<section class="search-section page">
	<?php 
	$attributes = array('id' => 'search_job', 'method' => 'post');
 	echo form_open('jobs/search',$attributes);?>
		<div class="row form-wrap justify-content-center no-gutters py-3 search_wrap">
		  	<div class="col-lg-6 col-9 form-cols">
		    	<input type="text" class="form-control" name="job_title" value="<?php if(isset($search_value['job_title'])) echo str_replace('-', ' ', $search_value['job_title']); ?>" placeholder="Search Jobs By keywords">
		    	<input type="submit" name="search" class="search_btn"/> 
		    	<button><i class="fa fa-search"></i></button>
		  	</div>

		  	<div class="col-2 jl_filter text-right my-auto d-md-none">
		  		<span class="fa fa-sliders" id="jl-filter-icon"></span>
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
			<p class="link-nav text-left"><a href="<?= base_url(); ?>">Home </a>  
				<span class="lnr lnr-chevron-right"></span>  
				
				<?php 
				if( isset( $subtitle ) ): ?>
					<a href="<?= base_url('jobs-by-category') ?>"><?= $title; ?></a>
					<span class="lnr lnr-chevron-right"></span>  
					<a href=""><?= $subtitle; ?></a>
				<?php 
				else: ?>
					<a href="#"><?= $title; ?></a>
				<?php endif; ?>
			</p>
		</div>
	</div>
	<div class="container">
		<div class="d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12 page_heading custom_header">

				<h1 class="">
					<?php 
					if( isset($subtitle) ){
						echo $subtitle;
					} else{
						echo $title;
					} ?>			
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
			<div class="col-lg-4 order-2 sidebar search" id="sidebar_filter">
				<div class="sidebar_header d-md-none">
					<p class="f-header">Filters <i class="lni-close float-right" id="sidebar_close"></i> </p>
				</div>

				<?php 
				$attributes = array('id' => 'post_job', 'method' => 'post');
    			echo form_open('JobsExtended/advanceSearch',$attributes); ?>

    			<div class="single-slidebar">
    				<h4>Expertise Level</h4>
    				<?php $expertise_level = (isset($search_value['expertise_level']))? $search_value['expertise_level']: array();  ?>
    				<ul class="cat-list">
    					<li><p><input type="checkbox" name="expertise_level[]" value="entry-level" <?= (in_array('entry-level', $expertise_level))? 'checked' : '' ?> > Beginner </p></li>

    					<li><p><input type="checkbox" name="expertise_level[]" value="intermediate-level" <?= (in_array('intermediate-level', $expertise_level))? 'checked' : '' ?> > Intermediate </p></li>

    					<li><p><input type="checkbox" name="expertise_level[]" value="expert-level" <?= (in_array('expert-level', $expertise_level))? 'checked' : '' ?> > Expert </p></li>
    				</ul>
    			</div>

				<div class="single-slidebar">
					<h4>Category</h4>
					<ul class="cat-list">
						<?php $category_id = ( isset($search_value['category']) )? $search_value['category']: array();  ?>
						<?php foreach($categories as $category): ?>
							<li>
								<p><input type="checkbox" name="category[]" value="<?= $category['id']?>" <?= (in_array( $category['id'], $category_id))? 'checked' : '' ?> > <?= $category['name'] ?> </p>
							</li>
							
	                    <?php endforeach; ?>
					</ul>
				</div>

				<div class="single-slidebar">
					<h4>Experience</h4>
					<ul class="cat-list">
						<?php $experience = (isset($search_value['experience']))? $search_value['experience']: array();  ?>
						
						<li>
							<p><input type="checkbox" name="experience[]" value="0-1" <?= (in_array('0-1', $experience))? 'checked' : '' ?> > 0-1 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience[]" value="1-2" <?= (in_array('1-2', $experience))? 'checked' : '' ?>> 1-2 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience[]" value="2-5" <?= (in_array('2-5', $experience))? 'checked' : '' ?> > 2-5 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience[]" value="5-10" <?= (in_array('5-10', $experience))? 'checked' : '' ?> > 5-10 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience[]" value="10-15" <?= (in_array('10-15', $experience))? 'checked' : '' ?> > 10-15 Years</p>
						</li>
						<li>
							<p><input type="checkbox" name="experience[]" value="15+" <?= (in_array('15+', $experience))? 'checked' : '' ?> > 15+ Years</p>
						</li>
					</ul>
				</div>		

				<div class="single-slidebar">
					<h4>Job Type</h4>
					<?php $job_type = (isset($search_value['job_type']))? $search_value['job_type']: array();  ?>
					<ul class="cat-list">
						<li><p><input type="checkbox" name="job_type[]" value="full-time" <?= (in_array('full-time', $job_type))? 'checked' : '' ?> > Full Time</p></li>
						<li><p><input type="checkbox" name="job_type[]" value="part-time" <?= (in_array('part-time', $job_type))? 'checked' : '' ?> > Part Time</p></li>
						<li><p><input type="checkbox" name="job_type[]" value="freelance" <?= (in_array('freelance', $job_type))? 'checked' : '' ?> > Freelance</p></li>
						<li><p><input type="checkbox" name="job_type[]" value="internship" <?= (in_array('internship', $job_type))? 'checked' : '' ?> > Internship </p></li>
						<li><p><input type="checkbox" name="job_type[]" value="temporary" <?= (in_array('temporary', $job_type))? 'checked' : '' ?> > Temporary</p></li>
					</ul>
				</div>				

		
				<div class="single-slidebar btn-search">	
					<input type="submit" name="search" class="btn btn-info btn-block" value="Search">
				</div>				
				<?php echo form_close(); ?>
			</div> 
			<!-- End search sidebar -->

			<div class="col-lg-8 order-md-2  post-list">
				<div class="col-lg-12">
					<?php if(empty($jobs)): ?>
						<div class="alert alert-danger"><strong>Sorry,</strong> we could not find any job for the keywords that you entered</div>
					<?php endif; ?>
				</div>
				<?php foreach($jobs as $job): ?>
				  	<div class="single-post d-flex row no-gutters job_list">
					  	<div class="thumb col-4 col-md-2 my-auto text-center pr-3">
					  		<?php 
					  		if( $job['company_logo'] != "" ){
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
									<li><i class="lnr lnr-apartment"></i> <?= get_expertise_level_name($job['expertise_level']); ?></li>
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
				<?php endforeach; ?>
				<div class="pull-right">
			        <?php echo $this->pagination->create_links(); ?>
			      </div>
			</div>
		</div>
	</div>	
</section>
<!-- End post Area -->

