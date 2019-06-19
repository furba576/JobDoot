<section class="content">
	<header class="box box-body">
		<div class="col-md-6">
			<h3><i class="fa fa-folder-o"></i> Post a New Job</h3>
		</div>
		<div class="col-md-6">
			<a href="<?= base_url('admin/job'); ?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> View Job List</a>
		</div>
	</header>
	<div class="box box-body">
		<div class="row">
			<div class="col-md-12">
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
			echo form_open('admin/job/post',$attributes);?>

			<div class="add_job_content col-lg-12">
				<div class="add_job_detail">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<h5>Job Title*</h5>
								<input type="text" name="job_title" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<h5>Company Name*</h5>
								<input type="text" name="company_name" class="form-control">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Job Type*</h5>
								<select name="job_type" class="form-control">
									<option>Select Job Type</option>
									<option value="full-time">Full Time</option>
									<option value="freelance">Freelance</option>
									<option value="part-time">Part Time</option>
									<option value="internship">Internship</option>
									<option value="temporary">Temporary</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Job Category*</h5>
								<select class="form-control" name="category">
								   <option value="">Select Category</option>
								   <?php foreach($categories as $category): ?>
								   		<option value="<?= $category['id']?>"><?= $category['name']?></option>
								   <?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Job Indusry*</h5>
								<select class="form-control" name="industry">
								   <option value="">Select Indusry</option>
								   <?php foreach($industries as $industry):?>
								   		<option value="<?= $industry['id']?>"><?= $industry['name']?></option>
								   <?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Working Experience*</h5>
								<select class="form-control" name="experience" >
									<option value="0-1">0-1 Years</option>
									<option value="1-2" >1-2 Years</option>
									<option value="2-5">2-5 Years</option>
									<option value="5-10">5-10 Years</option>
									<option value="10-15">10-15 Years</option>
									<option value="15+">15+ Years</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<h5>Salary*</h5>
								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
											<select name="min_salary" class="form-control">
												<?php for($i=500; $i<10000; $i=$i+500): ?>
										   			<option value="<?= $i; ?>"><?= $i; ?></option>
											    <?php endfor; ?>
											</select>
											<div class="input-group-addon">
												<span>$</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-group">
											<select name="max_salary" class="form-control">
												<?php for($i=500; $i<10000; $i=$i+500): ?>
										   			<option value="<?= $i; ?>"><?= $i; ?></option>
											    <?php endfor; ?>
											</select>
											<div class="input-group-addon">
												<span>$</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<h5> Skills*</h5>
								<input type="text" name="skills" class="form-control" placeholder="e.g. job title, responsibilites">
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<h5>Job Description*</h5>
								<textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group"> 
								<h5>Position Available*</h5>
								<select name="total_positions" class="form-control">	
							  	    <?php for($i=1; $i<30; $i++): ?>
							   			<option value="<?= $i; ?>"><?= $i; ?></option>
								    <?php endfor; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group"> 
								<h5>Gender Requirement*</h5>
								<select name="gender" class="form-control">	
							   		<option value="Male">Male</option>
							   		<option value="Female">Female</option>
							   		<option value="No Preference" selected="">No Preference</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Employment Type*</h5>
								<select class="form-control" name="employment_type" >
									<option value="">Select Employment Type</option>
									<option value="employee">Employee</option>
									<option value="internship">Internship</option>
									<option value="contractor">Contractor</option>
									<option value="temporary-employee">Temporary Employee</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Education*</h5>
								<select class="form-control" name="education">
									<option value="">Select Education</option>
									<?php foreach($educations as $row): ?>
										<option value="<?= $row['id']; ?>"> <?= $row['type']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Country*</h5>
								<select class="form-control" name="country">
								   <option value="">Select Country</option>
								    <?php foreach($countries as $country):?>
								   		<option value="<?= $country['id']?>"><?= $country['name']?></option>
								    <?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>City*</h5>
								<select class="form-control" name="city">
								   <option value="">Select City</option>
							  	    <?php foreach($cities as $city):?>
							   			<option value="<?= $city['id']?>"><?= $city['name']?></option>
								    <?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<h5>Location*</h5>
								<input type="text" name="location" class="form-control" placeholder="Type Address">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="add_job_btn col-lg-12 mt-3">
				<div class="form-group">
					<input type="submit" class="btn btn-primary btn-block" name="post_job" value="Submit">
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>
