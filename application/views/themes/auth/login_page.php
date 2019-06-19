	<div class="container-login100 my-auto">
		<div class="wrap-login100">
			<span class="login100-form-title pb-4">
					Sign in
			</span>
			<?php    
				if ($this->session->flashdata('registration_success')) {
					echo  $this->session->flashdata('registration_success');
				}
				if($this->session->flashdata('error_login')){
					echo '<div class="alert alert-danger">' . $this->session->flashdata('error_login') . '</div>';
				}
				if($this->session->flashdata('success')){
					echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
				}
			?> 

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
			


			<?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
				echo form_open('auth/login',$attributes);?>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input class="input100" type="text" name="email" value="<?= set_value('email'); ?>" placeholder="Email" >
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

				<div class="contact100-form-checkbox pt-1 ml-1">
					<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
					<label class="label-checkbox100" for="ckb1">
						Remember me
					</label>
				</div>
				
				<div class="container-login100-form-btn pt-4">
					<input type="submit" class="login100-form-btn" name="login" value="LogIn">
				</div>
			<?php echo form_close(); ?>

			<div class="text-center w-full pt-4">
				<a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/forgot_password">
					Forgot Password?            
				</a>
			</div>
			<div class="text-center w-full pt-3">
					<span class="txt1">
						Don't have an account?
					</span>
					<a class="txt1 bo1 hov1" href="<?= base_url(); ?>auth/registration">
						Sign up now             
					</a>
			</div>
		</div>
	</div>
