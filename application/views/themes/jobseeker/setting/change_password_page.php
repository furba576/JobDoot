<!-- start banner Area -->
<section class="banner-area relative custom_bg no_search" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="jt-breadcumb">
    <div class="container">
      <p class="link-nav text-left"><a href="<?= base_url(); ?>">Home </a>  
        <span class="lnr lnr-chevron-right"></span>  
        <a href="">Change Password</a>
        
      </p>
    </div>
  </div>
  <div class="container">
    <div class="d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12 page_heading custom_header">

        <h1 class="">
          Change Password      
        </h1>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area  

<!-- Start post Area -->
<section class="post-area section-gap">
  <div class="container">
    <div class="row justify-content-center d-flex">
      <div class="col-lg-4 sidebar">
        <?php $this->load->view($user_sidebar); ?>
      </div>
      <div class="col-lg-8 post-list">

         <?php if ($this->session->flashdata('error_update_password')) {
            echo '<div class="alert alert-danger">' . $this->session->flashdata('error_update_password') . '</div>';
          } ?>
          
         <?php if ($this->session->flashdata('update_password_success')) {
            echo '<div class="alert alert-success">' . $this->session->flashdata('update_password_success') . '</div>';
          } ?>

          <?php if ($this->session->flashdata('update_password_failed')) {
            echo '<div class="alert alert-danger">' . $this->session->flashdata('update_password_failed') . '</div>';
          } ?> 

        <?php $attributes = array('id' => 'Change_Password_form', 'method' => 'post'); ?>
        <?php echo form_open('setting/change_password',$attributes);?>

        <div class="profile_job_content col-lg-12">
          <div class="headline">
            <h3> Change Password</h3>
          </div>
          <div class="profile_job_detail">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="submit-field">
                  <h5>Old Password *</h5>
                  <input type="Password" name="old_password" class="form-control">
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="submit-field">
                  <h5>New Password *</h5>
                  <input type="Password" name="new_password" class="form-control">
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="submit-field">
                  <h5>Confirm New Password *</h5>
                  <input type="Password" name="confirm_password" class="form-control">
                </div>
              </div>
              <div class="col-12">
                <div class="submit-field">
                   <input class="btn btn-info px-5 btn-md" value="Update" type="submit" name="submit">
                 </div>
              </div>
            </div>
          </div>
        </div>                             
       <?php echo form_close(); ?>
     </div>
   </div>
 </div>  
</section>
<!-- End post Area -->    