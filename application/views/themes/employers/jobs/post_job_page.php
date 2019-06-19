<!-- start banner Area -->
<section class="banner-area relative custom_bg no_search" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="jt-breadcumb">
    <div class="container">
      <p class="link-nav text-left"><a href="<?= base_url('employers'); ?>">Home </a>  
        <span class="lnr lnr-chevron-right"></span>  
        <a href="">Post a New Job</a>
        
      </p>
    </div>
  </div>
  <div class="container">
    <div class="d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12 page_heading custom_header">

        <h1 class="">
          Post a New Job      
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
				<div class="row">
					<div class="col-12">
						<?php 
							if ($this->session->flashdata('post_job_success')) {
				                echo '<div class="alert alert-success">' . $this->session->flashdata('post_job_success') . '</div>';
				            }
							if($this->session->flashdata('post_job_error')){
				                echo '<div class="alert alert-danger">' . $this->session->flashdata('post_job_error') . '</div>';
				        	}
						?>
					</div>

					<?php $attributes = array('id' => 'post_job', 'method' => 'post');
        			echo form_open('employers/job/post',$attributes);?>

					<div class="add_job_content col-lg-12">
						<div class="headline">
							<h3><i class="fa fa-folder-o"></i> Post a New Job</h3>
						</div>
						<div class="add_job_detail">
							<div class="row">
								<div class="col-12">
									<div class="submit-field">
										<h5>Job Title*</h5>
										<input type="text" name="job_title" value="<?= set_value('job_title') ?>" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Job Type*</h5>
										<select name="job_type" class="form-control">
											<option value="full-time" <?= set_select('job_type', 'full-time') ?> >Full Time</option>
											<option value="freelance" <?= set_select('job_type', 'freelance') ?> >Freelance</option>
											<option value="part-time" <?= set_select('job_type', 'part-time') ?> >Part Time</option>
											<option value="internship" <?= set_select('job_type', 'internship') ?> >Internship</option>
											<option value="temporary" <?= set_select('job_type', 'temporary') ?> >Temporary</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Expertise Level*</h5>
										<select name="expertise_level" class="form-control">
											<?php foreach( $expertise_level as $el ): ?>
												<option value="<?= $el['el_slug'] ?>"  <?= set_select('expertise_level', $el['el_slug']) ?>  > <?= $el['el_name']; ?> </option>
												
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Job Category*</h5>
										<select class="form-control" name="category">
										   <?php foreach($categories as $category): ?>
										   		<option value="<?= $category['id']?>" <?= set_select('category', $category['id']) ?> ><?= $category['name']?></option>
										   <?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Job Indusry*</h5>
										<select class="form-control" name="industry">
										   <?php foreach($industries as $industry):?>
										   		<option value="<?= $industry['id']?>" <?= set_select('industry', $industry['id']) ?> ><?= $industry['name']?></option>
										   <?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Working Experience*</h5>
										<select class="form-control" name="experience" >
											<option value="0-1" <?= set_select('experience', '0-1') ?> >0-1 Years</option>
											<option value="1-2" <?= set_select('experience', '1-2') ?> >1-2 Years</option>
											<option value="2-5" <?= set_select('experience', '2-5') ?> >2-5 Years</option>
											<option value="5-10" <?= set_select('experience', '5-10') ?> >5-10 Years</option>
											<option value="10-15" <?= set_select('experience', '10-15') ?> >10-15 Years</option>
											<option value="15+" <?= set_select('experience', '15+') ?> >15+ Years</option>
										</select>
									</div>
								</div>
								<div class="col-12">
									<div class="submit-field">
										<h5>Salary*</h5>
										<div class="row">
											<div class="col-md-6">
												<div class="input-group">
													<select name="min_salary" class="form-control">
														<?php for($i=5000; $i<100000; $i=$i+5000): ?>
												   			<option value="<?= $i; ?>" <?= set_select('min_salary', $i) ?> ><?= $i; ?></option>
													    <?php endfor; ?>
													</select>
													<div class="input-group-append">
														<span class="input-group-text">NPR</span>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-group">
													<select name="max_salary" class="form-control">
														<?php for($i=5000; $i<100000; $i=$i+5000): ?>
												   			<option value="<?= $i; ?>" <?= set_select('max_salary', $i) ?> ><?= $i; ?></option>
													    <?php endfor; ?>
													</select>
													<div class="input-group-append">
														<span class="input-group-text">NPR</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="submit-field">
										<h5> Skills*</h5>
										<input type="text" name="skills" value="<?= set_value('skills') ?>"  class="form-control" placeholder="e.g. job title, responsibilites" required>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Job Description*</h5>
										<textarea name="description" class="form-control" id="exampleFormControlTextarea1"  rows="5"><?= trim(set_value('description')) ?></textarea>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field"> 
										<h5>Position Available*</h5>
										<select name="total_positions" class="form-control">	
									  	    <?php for($i=1; $i<30; $i++): ?>
									   			<option value="<?= $i; ?>" <?= set_select('total_positions', $i) ?> ><?= $i; ?></option>
										    <?php endfor; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field"> 
										<h5>Gender Requirement*</h5>
										<select name="gender" class="form-control">	
									   		<option value="Male" <?= set_select('gender', 'Male') ?> >Male</option>
									   		<option value="Female" <?= set_select('gender', 'Female') ?> >Female</option>
									   		<option value="No Preference" <?= set_select('experience', 'No Preference', TRUE) ?> >No Preference</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Employment Type*</h5>
										<select class="form-control" name="employment_type" >
											<option value="employee" <?= set_select('employment_type', 'employee') ?> >Employee</option>
											<option value="internship" <?= set_select('employment_type', 'internship') ?> >Internship</option>
											<option value="contractor" <?= set_select('employment_type', 'contractor') ?> >Contractor</option>
											<option value="temporary-employee" <?= set_select('employment_type', 'temporary-employee') ?> >Temporary Employee</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Education*</h5>
										<select class="form-control" name="education">
											<?php foreach($educations as $row): ?>
												<option value="<?= $row['id']; ?>" <?= set_select('education', $row['id']) ?> > <?= $row['type']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Country*</h5>
										<select class="form-control" name="country">
										    <?php foreach($countries as $country):?>
										   		<option value="<?= $country['id']?>" <?= set_select('country', $country['id']) ?> ><?= $country['name']?></option>
										    <?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>City*</h5>
										<select class="form-control" name="city">
									  	    <?php foreach($cities as $city):?>
									   			<option value="<?= $city['id']?>" <?= set_select('city', $city['id']) ?> ><?= $city['name']?></option>
										    <?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-12">
									<div class="submit-field">
										<h5>Location*</h5>
										<input type="text" name="location" value="<?= set_value('location'); ?>" class="form-control" placeholder="Type Address" required>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="add_job_btn col-lg-12 mt-3">
						<div class="submit-field">
							<input type="submit" class="job_detail_btn" name="post_job" value="Submit">
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>													
			</div>

		</div>
	</div>	
</section>
<!-- End post Area -->	