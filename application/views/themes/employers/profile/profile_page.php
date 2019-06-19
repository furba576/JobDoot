	<!-- start banner Area -->
	<section class="banner-area relative custom_bg no_search" id="home">  
	  <div class="overlay overlay-bg"></div>
	  <div class="jt-breadcumb">
	    <div class="container">
	      <p class="link-nav text-left"><a href="<?= base_url('employers'); ?>">Home </a>  
	        <span class="lnr lnr-chevron-right"></span>  
	        <a href="">Personal Info</a>
	        
	      </p>
	    </div>
	  </div>
	  <div class="container">
	    <div class="d-flex align-items-center justify-content-center">
	      <div class="about-content col-lg-12 page_heading custom_header">

	        <h1 class="">
	         	Personal Info    
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
					<?php
				        if ($this->session->flashdata('update_success')) {
				                echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';
				            }
				        if($this->session->flashdata('error_update')){
				                echo '<div class="alert alert-danger col-md-8">' . $this->session->flashdata('error_update') . '</div>';
				          }
				    ?>
					 <?php $attributes = array('id' => 'update_employers_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>
    				<?php echo form_open('employers/profile',$attributes);?>

					<div class="profile_job_content col-lg-12">
						<div class="headline">
							<h3> Personal Info</h3>
						</div>
						<div class="profile_job_detail">
							<div class="row">
								<div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5>First Name *</h5>
				                      <input class="form-control" type="text" name="firstname" value="<?= $emp_info['firstname']; ?>" placeholder="John Wick" required>
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5>Last Name *</h5>
				                      <input class="form-control" type="text" name="lastname" value="<?= $emp_info['lastname']; ?>" placeholder="John Wick" required>
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5>Email *</h5>
				                      <input class="form-control" type="email" name="email" value="<?= $emp_info['email']; ?>" placeholder="example@example.com" required readonly>
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5>Designation </h5>
				                      <input class="form-control" type="text" name="designation" value="<?= $emp_info['designation']; ?>" placeholder="Designation">
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5>Date of Birth:</h5>
				                      <input class="form-control" type="date" name="dob" value="<?= $emp_info['dob']; ?>">
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5>Phone Number </h5>
				                      <input class="form-control" type="tel" name="mobile_no" value="<?= $emp_info['mobile_no']; ?>" placeholder="11 333 444">
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5>Country </h5>
				                      <select name="country" class="form-control">
				                        <option>Select Country</option>
				                         <?php foreach($countries as $country):?>
				                            <?php if($emp_info['country'] == $country['id']): ?>
				                              <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
				                            <?php else: ?>
				                              <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
				                          <?php endif; endforeach; ?>
				                      </select>
				                    </div>
				                  </div>
				                  <div class="col-md-6 col-sm-12">
				                    <div class="submit-field">
				                      <h5>City </h5>
				                      <select name="city" class="form-control">
				                        <option>Select City</option>
				                        <?php foreach($cities as $city):?>
				                            <?php if($emp_info['city'] == $city['id']): ?>
				                            <option value="<?= $city['id']; ?>" selected> <?= $city['name']; ?> </option>
				                          <?php else: ?>
				                            <option value="<?= $city['id']; ?>"> <?= $city['name']; ?> </option>
				                        <?php endif; endforeach; ?>
				                      </select>
				                    </div>
				                  </div>
				                  <div class="col-md-12 col-sm-12">
				                    <div class="submit-field">
				                      <h5>Description </h5>
				                      <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Nulla bibendum commodo rhoncus. Sed mattis magna nunc, ac varius quam pharetra vitae. Praesent vitae ipsum eu magna pretium aliquam. Curabitur interdum quis velit non tincidunt.Donec pretium gravida erat, a faucibus velit egestas eget."><?= $emp_info['description']; ?></textarea>
				                    </div>
				                  </div>
							</div>
						</div>
					</div>
					<div class="add_job_btn col-lg-12 mt-5">
						<div class="submit-field">
							<input type="submit" class="job_detail_btn" name="update" value="Update">
						</div>
					</div>		
					<?php echo form_close(); ?>													
				</div>
			</div>
		</div>	
	</section>
	<!-- End post Area -->