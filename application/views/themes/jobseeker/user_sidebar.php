 <div class="single-slidebar d-none d-md-block">
  <figure>
    <?php 
    $profile_pic = $this->session->userdata('pro_pic');

    if( $profile_pic != "" || !empty($profile_pic)  ){
      $pro_pic_url = $profile_pic;
    }else{
      $pro_pic_url = base_url()."assets/img/user.png";
    }

    ?>


    <a href="#" class="employer-dashboard-thumb" data-toggle="modal" data-target="#profile-pic"><img class="jd_profile_pic" src="<?= $pro_pic_url ?>" alt=""/></a>
    <figcaption>
      <?php if( isset( $user_info ) ): ?>
        <h2><?= $user_info['firstname']." ".$user_info['lastname'] ?></h2>
        <span> <?= $user_info['job_title'] ?> </span>
      <?php endif; ?>
    </figcaption>
  </figure>
  <ul class="cat-list">
    <li>
      <a class="text_active" href="<?= base_url('profile'); ?>"><p><i class="fa fa-user-o pr-2"></i> My Profile</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('myjobs'); ?>"><p><i class="fa fa-file-word-o pr-2"></i> My Applications</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('myjobs/matching'); ?>"><p><i class="fa fa-briefcase pr-2"></i> Matching jobs</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('setting/change_password'); ?>"><p><i class="fa fa-lock pr-2"></i> Change Password</p></a>
    </li>
    <li>
      <a class="" href="<?= base_url('auth/logout')?>"><p><i class="fa fa-sign-out pr-2"></i> Logout</p></a>
    </li>
  </ul>
</div> 


<div class="modal fade" id="profile-pic" tabindex="-1" role="dialog" aria-labelledby="signUpOptions" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-body position-relative">
            <span class="float-right d-block close-modal-span" data-dismiss="modal"><i class="lnr lnr-cross"></i></span>
            
            <div class="row">
              <div class="col-12 position-relative cropper-wrapper mt-5">
                <img src="#" class="onjob-profile-pic">
              </div>

              <div class="col-12 mt-5">
                <div class="row justify-content-center">
                  <div class="col-5 position-relative overflow-hidden">
                    <input type="file" id="pro_pic_input" class="sel_image_input" accept="image/*" >
                    <button type="button" class="btn btn-primary sel_image_btn">Select New Image</button>
                  </div>
                  
                  <div class="col-4 ml-auto">
                    <button type="button" id="upload_res" class="btn btn-success float-right">Upload</button>
                  </div>
                  
                </div>
              </div>
            </div>

          </div>
      </div>
    </div>
</div>

<script type="text/javascript">
  function base_url(){
    return '<?= base_url(); ?>';
  }
</script>