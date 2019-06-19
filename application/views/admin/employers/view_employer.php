
  <style type="text/css">
  	.control-label{
	    display: inline-table;
	    width: 100%;
	}
  </style>

  <!-- page start-->
  <div class="row">
		
		
		<aside class="profile-nav col-lg-3">
		  <section class="panel">
			  <div class="user-heading round">
				  <a href="#">
					  <img src="http://codeglamour.com/nauman-hr-admin/public/img/profile-avatar.jpg" alt="">
				  </a>
				  <h1><?php echo $company_info->company_name?></h1>
				  <p><i class="fa fa-message"> </i><?php echo $company_info->email; ?></p>
			  </div>

			  <ul class="nav nav-pills nav-stacked">
				  <li class="active"><a href="profile.html"> <i class="fa fa-user"></i> Profile</a></li>
			  </ul>

		  </section>
		</aside>
	  
	  
	  <aside class="profile-info col-lg-9">
	
		  <section class="panel">
			  <div class="bio-graph-heading">
				  Complete Employer Profile
			  </div>
			  <div class="panel-body bio-graph-info">
				  <h1>Profile</h1>
				  
				  <div class="row">
				  	 <form class="form-horizontal" role="form" action="add" method="post">
					
					  <?php $firstname = isset($employer_detail)?$employer_detail['firstname']:'' ?>			  
					  <div class="bio-row">
						 <div class="form-group">
										  <label class="col-lg-2 control-label">First Name</label>
										  <div class="col-lg-12">
										  	 <p><strong><?= $firstname ?></strong></p>
										  	  
										  </div>
						  </div>
					  </div>
					  <?php $lastname = isset($employer_detail)?$employer_detail['lastname']:'' ?>
					  <div class="bio-row">
						 <div class="form-group">
										  <label class="col-lg-2 control-label">Last Name</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $lastname ?></strong></p>
										  	  
										  </div>
						  </div>
					  </div>
					  <?php $email = isset($employer_detail)?$employer_detail['email']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">Email</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $email ?></strong></p>
										  	  
										  </div>
						  </div>
					  </div>
					  <?php $mobile_no = isset($employer_detail)?$employer_detail['mobile_no']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">Telephone Number</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $mobile_no ?></strong></p>
										  	  
										  </div>
						  </div>
					  </div>
					  <?php $fax_no = isset($employer_detail)?$employer_detail['fax_no']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">Fax Number</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $fax_no ?></strong></p>
										  	  
										  </div>
						  </div>
					  </div>
					  <?php $country = isset($employer_detail)?$employer_detail['country']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">Country</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $country ?></strong></p>
										  	  
										  </div>
						  </div>
					  </div>
					  <?php $city = isset($employer_detail)?$employer_detail['city']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">City</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $city ?></strong></p>
										  	  										  
										  </div>
						  </div>
					  </div>
					  <?php $company_id = isset($employer_detail)?$employer_detail['company_id']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">Company</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $company_id ?></strong></p>
										  	  
										  </div>
						  </div>
					  </div>
					  <?php $pobox = isset($employer_detail)?$employer_detail['pobox']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">P O Box</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $pobox ?></strong></p>

										  </div>
						  </div>
					  </div>
					  <?php $website = isset($employer_detail)?$employer_detail['website']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">Website</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $website ?></strong></p>
										  	  
										  </div>
						  </div>
					  </div>
					  <?php $address = isset($employer_detail)?$employer_detail['address']:'' ?>
					  <div class="col-md-12">
						  <div class="form-group">
										  <label class="col-lg-2 control-label">Address</label>
										  <div class="col-lg-12">
										  	  <p><strong><?= $address ?></strong></p>
						  </div>
					  </div>
					  
					
				  </div>
			  </div>
		  </section>
		
	  </aside>
	  	
  </div>
  
  
  <div class="row">
	<div class="col-md-12">
		<div class="panel">
		  <header class="panel-heading tab-bg-dark-navy-blue ">
			  <ul class="nav nav-tabs">
				
				  <li class="active">
					  <a data-toggle="tab" href="#email">Send Email</a>
				  </li>
				 
			  </ul>
		  </header>
		  <div class="panel-body">
			  <div class="tab-content">
				 
				 <!-- Email Tab -->
				 <div id="email" class="tab-pane active">
					<div class="col-lg-6">
						  <section class="panel">
							  <header class="panel-heading">
								  Send Email to Customer
								
							  </header>
							  <div class="panel-body">
								<form class="form-horizontal" role="form" id="email_from" method="post">
									  <div class="form-group">
										  <label class="col-lg-2 control-label">To</label>
										  <div class="col-lg-10">
											  <input type="text" class="form-control" name="email" id="inputEmail1" value="naumanahmedcs@gmail.com" placeholder="">
										  </div>
									  </div>
									  <div class="form-group">
										  <label class="col-lg-2 control-label">Cc / Bcc</label>
										  <div class="col-lg-10">
											  <input type="text" class="form-control" name="cc" id="cc" placeholder="">
										  </div>
									  </div>
									  <div class="form-group">
										  <label class="col-lg-2 control-label">Subject</label>
										  <div class="col-lg-10">
											  <input type="text" class="form-control" name="subject" id="inputPassword1" placeholder="">
										  </div>
									  </div>
									  <div class="form-group">
										  <label class="col-lg-2 control-label">Message</label>
										  <div class="col-lg-10">
											  <textarea id="" class="form-control" name="message" cols="30" rows="3"></textarea>
										  </div>
									  </div>
									  <div class="form-group">
										  <div class="col-lg-offset-2 col-lg-10">
											 
											  <button type="button" class="btn btn-success" id="btn_send_email">Send</button>
										  </div>
									  </div>
								  </form>
								</div>
							</section>
						</div>		
				</div>
				<!-- Email Tab -->
			  </div>
		  </div>
		</div>
	</div>
  </div>
  
  <!-- page end-->

	 
  </div>


	
	
	
	
	
