
  <style type="text/css">
  	.control-label{
	    display: inline-table;
	    width: 100%;
	    margin-top: 10px;
	}
	.profile-img img{
		border-radius: 50%;
	    border: 5px solid #41cac0;
	    width: 100px;
	}
	.profile-img input{
	    margin-top: 15px;
	    display: -webkit-inline-box;
	}
  </style>

  <!-- page start-->
  <div class="row">
	  
	  <aside class="profile-info col-lg-12">
	
		  <section class="panel">
			  <div class="panel-body bio-graph-info">
				  
				  <div class="panel-body">	

				    <?php echo validation_errors(); ?>

				  	 <?php $formaction = ($stati=='edit')?'admin/employer/edit/'.$employer_detail['id']:'admin/employer/add/';  ?>
				  	 <form class="" role="form" action="<?= base_url($formaction) ?>" method="post">
					
					  <?php $firstname = isset($employer_detail)?$employer_detail['firstname']:'' ?>			  
					  <div class="bio-row">
						 <div class="form-group">
							  <label class="col-lg-2 control-label">First Name</label>
							  <div class="col-lg-12">
								  <input type="text" class="form-control" name="firstname" value="<?= $firstname ?>" required placeholder="">
							  </div>
						  </div>
					  </div>
					  <?php $lastname = isset($employer_detail)?$employer_detail['lastname']:'' ?>
					  <div class="bio-row">
						 <div class="form-group">
							  <label class="col-lg-2 control-label">Last Name</label>
							  <div class="col-lg-12">
								  <input type="text" class="form-control" name="lastname" value="<?= $lastname ?>" required placeholder="">
							  </div>
						  </div>
					  </div>
					  <?php $email = isset($employer_detail)?$employer_detail['email']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">Email</label>
							  <div class="col-lg-12">
								  <input type="email" class="form-control" name="email" value="<?= $email ?>" required placeholder="">
							  </div>
						  </div>
					  </div>
					  <?php $mobile_no = isset($employer_detail)?$employer_detail['mobile_no']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">Telephone Number</label>
							  <div class="col-lg-12">
								  <input type="text" class="form-control" name="mobile_no" value="<?= $mobile_no ?>" required placeholder="">
							  </div>
						  </div>
					  </div>
					  <?php $fax_no = isset($employer_detail)?$employer_detail['fax_no']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">Fax Number</label>
							  <div class="col-lg-12">
								  <input type="text" class="form-control" name="fax_no" value="<?= $fax_no ?>" required placeholder="">
							  </div>
						  </div>
					  </div>
					  <?php $countryselect = isset($employer_detail)?$employer_detail['country']:0 ?>
					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">Country</label>
							  <div class="col-lg-12">
							  	  <select class="form-control" name="country" required >
								  <option value=0>Select Country</option>
								  	<?php foreach($countryDD as $value): ?>									<?php if($value['id']==$countryselect){ ?>
								  		<option value="<?= $value['id'] ?>" selected><?= $value['country'] ?></option>
								  	<?php }else{ ?>
								  		<option value="<?= $value['id'] ?>"><?= $value['country'] ?></option>
								  	<?php } ?>
								  	
								  <?php endforeach; ?>
								  </select>
								  
							  </div>
						  </div>
					  </div>
					  <?php $city = isset($employer_detail)?$employer_detail['city']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">City</label>
							  <div class="col-lg-12">
								  <input type="text" class="form-control" name="city" value="<?= $city ?>" required placeholder="">										  
							  </div>
						  </div>
					  </div>
					  <?php $company_id = isset($employer_detail['company_id'])?$employer_detail['company_id']:0 ?>

					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">Company</label>
							  <div class="col-lg-12">
								  <select class="form-control" name="company_id" required >
								  	<option value=0>Select Company</option>
								  	<?php foreach($companyDD as $value): ?>											  	
								  		<?php if($value['id']==$company_id){ ?>
								  		<option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
								  	<?php }else{ ?>
								  		<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
								  	<?php } ?>
								  	
								  <?php endforeach; ?>
								  </select>
							  </div>
						  </div>
					  </div>
					  <?php $pobox = isset($employer_detail)?$employer_detail['pobox']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">P O Box</label>
							  <div class="col-lg-12">
								  <input type="text" class="form-control" name="pobox" value="<?= $pobox ?>" required placeholder="">
							  
							  </div>
						  </div>
					  </div>
					  <?php $website = isset($employer_detail)?$employer_detail['website']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">Website</label>
							  <div class="col-lg-12">
								  <input type="text" class="form-control" name="website" value="<?= $website ?>" required placeholder="">
								  
							  </div>
						  </div>
					  </div>
					  <?php $address = isset($employer_detail)?$employer_detail['address']:'' ?>
					  <div class="bio-row">
						  <div class="form-group">
							  <label class="col-lg-2 control-label">Address</label>
							  <div class="col-lg-12">
								  <textarea  class="form-control" name="address" required ><?= $address ?></textarea>
							  </div>
										  
						  </div>
					  </div>
					  
					  <div class="col-md-12">
						  <div class="form-group"><br/>
						  <?php if($stati=='view'){ $buttonvalue="Edit Employer";}else if($stati=='edit'){ $buttonvalue="Edit Employer"; }else{ $buttonvalue="Add Employer"; } ?>
						  	<input type="submit" name="submit" class="btn btn-info pull-right" value="<?= $buttonvalue ?>">
						  </div>
					  </div>
					  </form>
					
				  </div>
			  </div>
		  </section>
		
	  </aside>
	  	
  </div>
  
  
  


	
	
	
	
	
