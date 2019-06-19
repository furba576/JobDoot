<!-- start banner Area -->
<section class="banner-area relative custom_bg no_search" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="jt-breadcumb">
    <div class="container">
      <p class="link-nav text-left"><a href="<?= base_url(); ?>">Home </a>  
        <span class="lnr lnr-chevron-right"></span>  
        <a href="">Top Companies</a>
        
      </p>
    </div>
  </div>
  <div class="container">
    <div class="d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12 page_heading custom_header">

        <h1 class="">
          Top Companies      
        </h1>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->


<section class="post-area section-gap">
  <div class="container">
    <div class="row">
      <?php 
      foreach($companies as $company): 
        if( $company['company_logo'] != "" || !empty($company['company_logo']) ){
          $logo_url = base_url($company['company_logo']);
        }else{
          $logo_url = base_url()."assets/img/job_icon.png";
        }
      ?>

      <div class="col-lg-3 col-sm-6 col-12 jd_company_page">
        <div class="company-item-list text-center jd_company_logo">
          <a class="my-auto" href="<?= base_url('company/'.$company['company_slug']); ?>"><img src="<?= $logo_url; ?>" alt="<?= $company['company_name'] ?>" title="<?= $company['company_name'] ?>" /></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
     