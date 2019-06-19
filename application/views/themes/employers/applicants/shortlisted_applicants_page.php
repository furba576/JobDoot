<!-- start banner Area -->
<section class="banner-area relative custom_bg no_search" id="home">  
  <div class="overlay overlay-bg"></div>
  <div class="jt-breadcumb">
    <div class="container">
      <p class="link-nav text-left"><a href="<?= base_url('employers'); ?>">Home </a>  
        <span class="lnr lnr-chevron-right"></span>  
        <a href="">Shortlisted Resumes</a>
        
      </p>
    </div>
  </div>
  <div class="container">
    <div class="d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12 page_heading custom_header">

        <h1 class="">
          Shortlisted Resumes      
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
        <div class="profile_job_content col-lg-12">
         <div class="headline">
          <div class="row">
           <div class="col-md-8 col-sm-8">
            <h3> Shortlisted Resumes</h3>
          </div>
          <!-- <div class="col-sm-4 col-md-4 mb-2">
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-append">
              <a class="btn btn-white"><i class="fa fa-search"></i></a>  
            </div>
          </div>   
        </div> -->
      </div>	
    </div>
    <div class="profile_job_detail">
      <div class="row">
        <?php if(empty($applicants)): ?>
          <p class="text-gray"><strong>Sorry,</strong> there is no shortlisted application.</p>
        <?php endif; ?>
        <?php foreach($applicants as $applicant): ?>
         <div class="col-md-6 col-sm-12 mb-20">
          <div class="onjob-employer-resumes-wrap">
            <figure class="pp">
              <figcaption>
                <h2 class="title"><a href="#"><?= $applicant['firstname']; ?> <?= $applicant['lastname']; ?></a> <a href="#" class="onjob-resumes-download"><i class="lnr lnr-download"></i> Download CV</a></h2>
                <span class="onjob-resumes-subtitle"><?= $applicant['job_title']; ?></span>
                <ul>
                  <li>
                    <span>Location:</span>
                    <?= get_city_name($applicant['city']); ?>, <?= get_country_name($applicant['country']); ?>
                  </li>
                  <li>
                    <span>Current Salary:</span>
                    NPR <?= $applicant['current_salary']; ?>/<small>p.a minimum</small>
                  </li>
                </ul>
              </figcaption>
            </figure>
            <ul class="onjob-resumes-options">
              <li><a href="#" data-toggle="modal" data-target="#emailModal" data-whatever="<?= $applicant['email']; ?>"><i class="lnr lnr-envelope"></i> Message</a></li>
              <li><a href="#" data-toggle="modal" data-target="#emailModal" data-whatever="<?= $applicant['email']; ?>"><i class="lnr lnr-user"></i> Interview</a></li>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</div>													

</div>

</div>
</div>	
</section>
<!-- End post Area -->


<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open("/",'class="email-form"') ?>
        <input type="hidden" name="email" class="form-control" id="email">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Subject:</label>
          <input type="text" name="subject" class="form-control" id="subject">
        </div>
        <div class="form-group">
          <label for="message-text" class="col-form-label">Message:</label>
          <textarea name="message" class="form-control" id="message"></textarea>
        </div>
        <div class="form-group">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="submit" class="btn btn-primary send_email" name="submit" value="Send Message">
       </div>
       <?php form_close(); ?>
     </div>
     
   </div>
 </div>
</div>


<script type="text/javascript">
  /* ----------------- Email ------------------*/

  $('#emailModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body #email').val(recipient);

    $('.send_email').click(function(e) {

      var _form = $(".email-form").serialize();
      $.ajax({
        data: _form,
        type: 'POST',
        url: '<?php echo base_url();?>employers/applicants/email',
        success: function(response){
          modal.find('.modal-title').text(response);
          $(".email-from").trigger('reset');
          $('.close').trigger('click');
        }
      });
      e.preventDefault();
    }); 
    
  });

</script>