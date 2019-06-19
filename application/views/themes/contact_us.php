<!-- start banner Area -->
<section class="banner-area relative custom_bg no_search" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="jt-breadcumb">
    <div class="container">
      <p class="link-nav text-left"><a href="<?= base_url(); ?>">Home </a>  
        <span class="lnr lnr-chevron-right"></span>  
        <a href="#">Contact Us</a>
      </p>
    </div>
  </div>
  <div class="container">
    <div class="d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12 page_heading custom_header">

        <h1 class="">
          Contact Us     
        </h1>
      </div>                      
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
  <div class="container">
    <div class="row justify-content-center">
     <!--  <div class="col-lg-4 d-flex flex-column">
        
      </div> -->
      <div class="col-lg-8">
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <?=$this->session->flashdata('success')?>
          </div>
        <?php  endif; ?>
   
        <?php $attributes = array('id' => '', 'method' => 'post' , 'class' => 'form-area contact-form text-right'); ?>
        <?php echo form_open('contact',$attributes);?>  
          <div class="row"> 
            <div class="col-lg-12 form-group">
              <input name="username" placeholder="Your Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" required="" type="text">
            
              <input name="email" placeholder="Email Address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required="" type="email">

              <input name="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your subject'" class="common-input mb-20 form-control" required="" type="text">

              <textarea class="common-textarea mt-10 form-control" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
              <input type="submit" name="submit" value="Send Message" class="border primary-btn mt-20" style="float: right;" />
            </div>
          </div>
        </form> 
      </div>
    </div>
  </div>  
</section>
<!-- End contact-page Area -->