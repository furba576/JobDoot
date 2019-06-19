
<!-- registration-section-starts -->
<div class="container-login100 my-auto">
  <div class="wrap-login100" style="width: 650px;">
    <div class="container">
      <span class="login100-form-title pb-5">
       Sign up <small>(Employers)</small>
      </span>
      
      <div class="line-title-left"></div>
      <?php 
      if($this->session->flashdata('error')){
        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
      }
      ?>

      <?php $attributes = array('id' => 'registeration_form', 'method' => 'post'); ?>
      <?php echo form_open('employers/auth/registration',$attributes); ?>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>First Name *</label>
            <input type="text" name="firstname"value="<?= set_value('firstname') ?>"  class="form-control" placeholder="Enter your first name" required />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Last Name *</label>
            <input type="text" name="lastname" value="<?= set_value('lastname') ?>"  class="form-control" placeholder="Enter your last name" required/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control" placeholder="Enter your email" required/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label>Password*</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" required/>
          </div>
        </div>
        <div class="col-lg-6">      
         <div class="form-group">
          <label>Confirm Password*</label>
          <input type="password" name="confirmpassword" class="form-control" placeholder="Enter your password again" required/>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <h5>Company Information</h5>
        <hr />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label>Company Name *</label>
          <input type="text" name="company_name" value="<?= set_value('company_name') ?>" class="form-control" placeholder="" required/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Organization Type</label>
          <select class="form-control" name="org_type" id="org_type">
            <option value="Private" <?= set_select('org_type', 'Private', TRUE); ?> >Private</option>
            <option value="Public" <?= set_select('org_type', 'Public' ); ?> >Public</option>
            <option value="Government" <?= set_select('org_type', 'Government' ); ?> >Government</option>
            <option value="NGO" <?= set_select('org_type', 'NGO'); ?> >NGO</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label>Address *</label>
          <input type="text" name="address" value="<?= set_value('address') ?>" class="form-control" placeholder="" required/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Country</label>
          <select class="form-control" name="country" id="country">
            <option>Select Country</option>
            <?php foreach($countries as $country):?>
              <option value="<?= $country['id']?>" <?= set_select('country', $country['id']); ?> ><?= $country['name']?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label>City</label>
          <select class="form-control" name="city">
            <option>Select City</option>
            <?php foreach($cities as $city):?>
              <option value="<?= $city['id']?>" <?= set_select('city', $city['id']); ?> ><?= $city['name']?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Phone No.*</label>
          <input type="text" name="phone_no" value="<?= set_value('phone_no') ?>" class="form-control" placeholder="" required/>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label>Website*</label>
          <input type="text" name="website" value="<?= set_value('website') ?>" class="form-control" placeholder="" required/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label>Company Description.*</label>
          <textarea name="description" class="form-control"  placeholder="" required><?= set_value('description') ?></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input type="checkbox" name="termsncondition"> Agree to our <small> Terms and Conditions</small>
        </div>
        <div class="form-group">
          <input type="submit" class="login100-form-btn btn-block" name="submit" value="Register">
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
    <div class="text-center w-full pt-4">
          <span class="txt1">
            Already have an account?
          </span>
          <a class="txt1 bo1 hov1" href="<?= base_url(); ?>employers/auth/login">
            SignIn now             
          </a>
      </div>
  </div>  
</div>  
</div>


<!-- registration-section-Ends -->
