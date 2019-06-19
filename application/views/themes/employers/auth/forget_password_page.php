  <div class="container-login100">
    <div class="wrap-login100">
      <span class="login100-form-title pb-4">
          Forgot Password
      </span>
      <p>Enter your email and we will send you instructions on how to reset your password</p>
      <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
          <?=$this->session->flashdata('success')?>
        </div>
      <?php endif; ?>
      <?php if($this->session->flashdata('error')): ?>
       <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <?=$this->session->flashdata('error')?>
      </div>
    <?php endif; ?>

      <?php $attributes = array('id' => 'login_form', 'method' => 'post' , 'class' => 'login100-form validate-form');
        echo form_open(base_url('employers/auth/forgot_password'), $attributes);?>

        <div class="wrap-input100  mb-3">
          <input class="input100" type="text" name="email" placeholder="Email">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <span class="lnr lnr-envelope"></span>
          </span>
        </div>
        <div class="container-login100-form-btn pt-2">
          <input type="submit" class="login100-form-btn" name="submit" value="Recover Password">
        </div>
      <?php echo form_close(); ?>

      <div class="text-center w-full pt-4">
          <span class="txt1">
            You Remember Password?
          </span>
          <a class="txt1 bo1 hov1" href="<?= base_url(); ?>employers/auth/login">
            Login            
          </a>
      </div>
    </div>
  </div>
