	<div class="container-login100 my-auto">
			<div class="wrap-login100">

				<span class="login100-form-title pb-5">
					Sign Up
				</span>
				
				<?php $attributes = array('id' => 'registeration_form', 'method' => 'post',  'class' => 'login100-form validate-form'); ?>

				<div class="row social_login mt-3 mb-4">
					<div class="col fb-ln ln-btn">
						<a href="<?= base_url('auth/fbLogin') ?>" class="sm_wrapper facebook text-center p-2 d-block">
							<i class="fa fa-facebook"></i>
						</a>
					</div>
					<div class="col ggl-ln ln-btn">
						<a href="<?= base_url('auth/googleLogin') ?>" class="sm_wrapper google text-center p-2 d-block">
							<i class="fa fa-google-plus"></i>
						</a>
					</div>
					<div class="col-12 text-center mt-4">
						<div class="login_hr position-relative">
							<span>OR</span>
						</div>
					</div>
				</div>

				<?php echo form_open('auth/registration',$attributes); ?>
					
					 <?php 
							if($this->session->flashdata('validation_errors')){

								echo '<div class="alert alert-danger">' . $this->session->flashdata('validation_errors') . '</div>';
							}
					?>


					
					<div class="wrap-input100 validate-input" data-validate = "Valid name is required: johnny">
						<input class="input100" type="text" name="firstname" value="<?= set_value('firstname'); ?>" placeholder="First Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-user"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid name is required: smith">
						<input class="input100" type="text" name="lastname" value="<?= set_value('lastname'); ?>" placeholder="Last Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-user"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" value="<?= set_value('email'); ?>" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="confirmpassword" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="contact100-form-checkbox pt-2 ml-1">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="termsncondition">
						<label class="label-checkbox100" for="ckb1">
							Terms & Conditions
						</label>
					</div>
					
					<div class="container-login100-form-btn pt-4">
						<input type="submit" class="login100-form-btn" name="submit" value="Sign Up">
					</div>
				</form>

				<div class="text-center w-full pt-4">
						<span class="txt1">
							Already a member?
						</span>

						<a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/login">
							Sign in now             
						</a>
				</div>
			</div>
		</div>