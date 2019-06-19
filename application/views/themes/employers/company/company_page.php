	<!-- start banner Area -->
	<section class="banner-area relative custom_bg no_search" id="home">  
	  <div class="overlay overlay-bg"></div>
	  <div class="jt-breadcumb">
	    <div class="container">
	      <p class="link-nav text-left"><a href="<?= base_url('employers'); ?>">Home </a>  
	        <span class="lnr lnr-chevron-right"></span>  
	        <a href="">Company Details</a>
	        
	      </p>
	    </div>
	  </div>
	  <div class="container">
	    <div class="d-flex align-items-center justify-content-center">
	      <div class="about-content col-lg-12 page_heading custom_header">

	        <h1 class="">
	          Company Details     
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
					
					<?php if ($this->session->flashdata('file_error')) {
		              echo '<div class="alert alert-danger">' . $this->session->flashdata('file_error') . '</div>';
		            } ?>

					<?php
					if ($this->session->flashdata('update_success')) {
						echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';
					}
					if($this->session->flashdata('error_update')){
						echo '<div class="alert alert-danger">' . $this->session->flashdata('error_update') . '</div>';
					}
					?>
					<?php $attributes = array('id' => 'update_employers_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
					<?php echo form_open_multipart('employers/company',$attributes);?>

					<div class="profile_job_content col-lg-12">
						<div class="headline">
							<h3>Company Details</h3>
						</div>
						<div class="profile_job_detail">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Company Logo <small>( max size allowed : 500Kb | Format : jpg,png )</small></h5>
										<?php if(!empty($company_info['company_logo'])): ?>
											<p><img src="<?= base_url().$company_info['company_logo']; ?>" alt="Logo" height="50"></p>
										<?php endif; ?>
										<input type="file" name="userfile" class="form-control" placeholder="Company Name" />
										<input type="hidden" name="old_logo" value="<?= $company_info['company_logo']; ?>">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Company Name *</h5>
										<input class="form-control" type="text" name="company_name" value="<?= $company_info['company_name']; ?>" placeholder="Company Name">
										<!-- Hidden input for company ID-->
										<input class="form-control" type="hidden" name="company_id" value="<?= $company_info['id']; ?>" placeholder="Company Name" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Email *</h5>
										<input type="email" name="email" value="<?= $company_info['email']; ?>"  class="form-control" placeholder="example@example.com" required readonly>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Phone *</h5>
										<input class="form-control" type="tel" name="phone_no" value="<?= $company_info['phone_no']; ?>" placeholder="123456789" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Website:</h5>
										<input class="form-control" type="text" name="website" value="<?= $company_info['website']; ?>" placeholder="www.example.com" >
									</div>
								</div>

								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Founded Date</h5>
										<input type="date" name="founded_date" value="<?= $company_info['founded_date']; ?>" class="form-control" >
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Organization Type</h5>
										<select name="org_type"  class="form-control" >
											<option value="Public" <?php if($company_info['org_type'] == 'Public'){ echo "selected";} ?>>Public</option>
											<option value="Private" <?php if($company_info['org_type'] == 'Private'){ echo "selected";} ?>>Private</option>
											<option value="Government" <?php if($company_info['org_type'] == 'Government'){ echo "selected";} ?>>Government</option>
											<option value="NGO" <?php if($company_info['org_type'] == 'NGO'){ echo "selected";} ?>>NGO</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>No. of Employers </h5>
										<select name="no_of_employers" class="form-control">
											<option value="1-10" <?php if($company_info['no_of_employers'] == '1-10'){ echo "selected";} ?>>1-10</option>
											<option value="10-20" <?php if($company_info['no_of_employers'] == '10-20'){ echo "selected";} ?>>10-20</option>
											<option value="20-30" <?php if($company_info['no_of_employers'] == '20-30'){ echo "selected";} ?>>20-30</option>
											<option value="30-50" <?php if($company_info['no_of_employers'] == '30-50'){ echo "selected";} ?>>30-50</option>
											<option value="50-100" <?php if($company_info['no_of_employers'] == '50-100'){ echo "selected";} ?>>50-100</option>
											<option value="100+" <?php if($company_info['no_of_employers'] == '100+'){ echo "selected";} ?>>100+</option>
										</select>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="submit-field">
										<h5>Company Description *</h5>
										<textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Company Description" required><?= $company_info['description']; ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="profile_job_content col-lg-12 mt-5">
						<div class="headline">
							<h3>Address / Location</h3>
						</div>
						<div class="profile_job_detail">
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>Country</h5>
										<select name="country" class="form-control">
											<?php foreach($countries as $country):?>
												<?php if($company_info['country'] == $country['id']): ?>
													<option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
													<?php else: ?>
														<option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
													<?php endif; endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="submit-field">
										<h5>City / Town </h5>
										<select name="city" class="form-control">
											<?php foreach($cities as $city):?>
												<?php if($company_info['city'] == $city['id']): ?>
													<option value="<?= $city['id']; ?>" selected> <?= $city['name']; ?> </option>
													<?php else: ?>
														<option value="<?= $city['id']; ?>"> <?= $city['name']; ?> </option>
													<?php endif; endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="submit-field">
												<h5>Postcode </h5>
												<input type="text" name="postcode" value="<?= $company_info['postcode']; ?>" class="form-control" placeholder="50700">
											</div>
										</div>
										<div class="col-md-12 col-sm-12">
											<div class="submit-field">
												<h5>Full Address *</h5>
												<input type="text" name="address"  value="<?= $company_info['address']; ?>" class="form-control" required>
											</div>
										</div>
									</div>
								</div>
							</div>	

									<div class="profile_job_content col-lg-12 mt-5">
										<div class="headline">
											<h3>Company Social</h3>
										</div>
										<div class="profile_job_detail">
											<div class="row">
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Facebook</h5>
														<input type="text" name="facebook_link" value="<?= $company_info['facebook_link']; ?>"  class="form-control" placeholder="http://www.facebook.com">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Twitter</h5>
														<input type="text" name="twitter_link" value="<?= $company_info['twitter_link']; ?>" class="form-control"  placeholder="http://www.twitter.com">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Google Plus</h5>
														<input type="text" name="google_link" value="<?= $company_info['google_link']; ?>" class="form-control" placeholder="http://www.google-plus.com">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Youtube</h5>
														<input type="text" name="youtube_link" value="<?= $company_info['youtube_link']; ?>" class="form-control"  placeholder="http://www.youtube.com">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Vimeo</h5>
														<input type="text" name="vimeo_link" value="<?= $company_info['vimeo_link']; ?>" class="form-control"  placeholder="http://www.vimeo.com">
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="submit-field">
														<h5>Linkedin</h5>
														<input type="text" name="linkedin_link" value="<?= $company_info['linkedin_link']; ?>" class="form-control" placeholder="http://www.linkedin.com">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="add_job_btn col-lg-12 mt-5">
										<div class="submit-field">
											<input type="submit" name="update" value="Update" class="job_detail_btn">
										</div>
									</div>	
									<?php echo form_close(); ?>														
								</div>
							</div>
						</div>	
					</section>
	<!-- End post Area -->