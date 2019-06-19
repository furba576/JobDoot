<section class="content">
	<header class="box box-body">
		<div class="col-md-6">
			<h3><i class="fa fa-folder-o"></i> Edit Job</h3>
		</div>
		<div class="col-md-6">
			<a href="<?= base_url('admin/job'); ?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> View Job List</a>
		</div>
	</header>
	<div class="box box-body">
		<div class="row">
			<div class="col-md-12">
				<?php 
					if($this->session->flashdata('edit_job_error')){
		                echo '<div class="alert alert-danger">' . $this->session->flashdata('edit_job_error') . '</div>';
		        	}
				?>
			</div>

			<?php $attributes = array('id' => 'edit_job', 'method' => 'post');
			echo form_open('admin/job/edit/'.$job_detail['id'],$attributes);
			?>

			<div class="add_job_content col-lg-12">
				<div class="add_job_detail">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<h5>Job Title*</h5>
								<input type="text" name="job_title" value="<?= $job_detail['job_title']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<h5>Company Name*</h5>
								<input type="text" name="company_name" value="<?= $job_detail['company_name']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Job Type*</h5>
								<select name="job_type" class="form-control">
									<option value="">Select Job Type</option>
									<option value="full-time" <?php if($job_detail['job_type']=='full-time')echo 'selected'; ?> >Full Time</option>
									<option value="freelance" <?php if($job_detail['job_type']=='freelance')echo 'selected'; ?>>Freelance</option>
									<option value="part-time" <?php if($job_detail['job_type']=='part-time')echo 'selected'; ?>>Part Time</option>
									<option value="internship" <?php if($job_detail['job_type']=='internship')echo 'selected'; ?>>Internship</option>
									<option value="temporary" <?php if($job_detail['job_type']=='temporary')echo 'selected'; ?>>Temporary</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Job Category*</h5>
								<select class="form-control" name="category">
								   <option>Select Category</option>
								   <?php foreach($categories as $category):?>
								   		<?php if($job_detail['category'] == $category['id']): ?>
											<option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
										<?php else: ?>
											<option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
									<?php endif; endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Job Indusry*</h5>
								<select class="form-control" name="industry">
								   <option>Select Indusry</option>
								   <?php foreach($industries as $industry):?>
								   		<?php if($job_detail['industry'] == $industry['id']): ?>
											<option value="<?= $industry['id']; ?>" selected> <?= $industry['name']; ?> </option>
										<?php else: ?>
											<option value="<?= $industry['id']; ?>"> <?= $industry['name']; ?> </option>
									<?php endif; endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Working Experience*</h5>
								<select class="form-control" name="experience" >
									<option value="0-1" <?php if($job_detail['experience'] == '0-1'){ echo "selected";} ?>>0-1 Years</option>
									<option value="1-2" <?php if($job_detail['experience'] == '1-2'){ echo "selected";} ?> >1-2 Years</option>
									<option value="2-5" <?php if($job_detail['experience'] == '2-5'){ echo "selected";} ?> >2-5 Years</option>
									<option value="5-10" <?php if($job_detail['experience'] == '5-10'){ echo "selected";} ?> >5-10 Years</option>
									<option value="10-15" <?php if($job_detail['experience'] == '10-15'){ echo "selected";} ?> >10-15 Years</option>
									<option value="15+" <?php if($job_detail['experience'] == '15+ '){ echo "selected";} ?> >15+ Years</option>
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
													<?php if($job_detail['min_salary'] == $i): ?>
										   			<option value="<?= $i; ?>" selected><?= $i; ?></option>
										   			<?php else: ?>
										   			<option value="<?= $i; ?>" ><?= $i; ?></option>	
											    <?php endif; endfor; ?>
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
										   			<?php if($job_detail['max_salary'] == $i): ?>
										   			<option value="<?= $i; ?>" selected><?= $i; ?></option>
										   			<?php else: ?>
										   			<option value="<?= $i; ?>" ><?= $i; ?></option>	
											    <?php endif; endfor; ?>
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
								<input type="text" name="skills" value="<?= $job_detail['skills']; ?>" class="form-control" placeholder="e.g. job title, responsibilites">
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<h5>Job Description*</h5>
								<textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5"><?= $job_detail['description']; ?></textarea>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group"> 
								<h5>Position Available*</h5>
								<select name="total_positions" class="form-control">	
							  	    <?php for($i=1; $i<30; $i++): ?>
							   			<?php if($job_detail['total_positions'] == $i): ?>
							   			<option value="<?= $i; ?>" selected><?= $i; ?></option>
							   			<?php else: ?>
							   			<option value="<?= $i; ?>" ><?= $i; ?></option>	
								    <?php endif; endfor; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group"> 
								<h5>Gender Requirement*</h5>
								<select name="gender" class="form-control">	
							   		<option value="Male" <?php if($job_detail['gender'] == 'Male'){ echo "selected";} ?> >Male</option>
							   		<option value="Female" <?php if($job_detail['gender'] == 'Female'){ echo "selected";} ?> >Female</option>
							   		<option value="No Preference" <?php if($job_detail['gender'] == 'No Preference'){ echo "selected";} ?> >No Preference</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Employment Type*</h5>
								<select class="form-control" name="employment_type" >
									<option value="">Select Employment Type</option>
									<option value="employee" <?php if($job_detail['employment_type']=='employee')echo 'selected'; ?>>Employee</option>
									<option value="internship" <?php if($job_detail['employment_type']=='internship')echo 'selected'; ?>>Internship</option>
									<option value="contractor" <?php if($job_detail['employment_type']=='contractor')echo 'selected'; ?>>Contractor</option>
									<option value="temporary-employee" <?php if($job_detail['employment_type']=='temporary-employee')echo 'selected'; ?>>Temporary Employee</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Education*</h5>
								<select class="form-control" name="education">
									<option value="">Select Education</option>
									<?php foreach($educations as $education):?>
							   			<?php if($job_detail['education'] == $education['id']): ?>
										<option value="<?= $education['id']; ?>" selected> <?= $education['type']; ?> </option>
										<?php else: ?>
											<option value="<?= $education['id']; ?>"> <?= $education['type']; ?> </option>
									<?php endif; endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>Country*</h5>
								<select class="form-control" name="country">
								   <option>Select Country</option>
								    <?php foreach($countries as $country):?>
								   		<?php if($job_detail['country'] == $country['id']): ?>
											<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
										<?php else: ?>
											<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
									<?php endif; endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<h5>City*</h5>
								<select class="form-control" name="city">
								   <option>Select City</option>
							  	    <?php foreach($cities as $city):?>
							   			<?php if($job_detail['city'] == $city['id']): ?>
											<option value="<?= $city['id']; ?>" selected> <?= $city['name']; ?> </option>
										<?php else: ?>
											<option value="<?= $city['id']; ?>"> <?= $city['name']; ?> </option>
									<?php endif; endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<h5>Location*</h5>
								<input type="text" name="location" value="<?= $job_detail['location']; ?>" class="form-control" placeholder="Type Address">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="add_job_btn col-lg-12 mt-3">
				<div class="form-group">
					<input type="submit" class="btn btn-primary btn-block" name="edit_job" value="Update">
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>
