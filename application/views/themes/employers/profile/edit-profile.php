<div class="container">
  <?php

      if ($this->session->flashdata('update_success')) {

                echo '<div class="alert alert-success">' . $this->session->flashdata('update_success') . '</div>';

            }

      if($this->session->flashdata('error_update')){

                echo '<div class="alert alert-danger col-md-8">' . $this->session->flashdata('error_update') . '</div>';

          }

    ?>
  <div class="card-body card mt-3 col-sm-8 bg-light">
    <?php $attributes = array('id' => 'update_employers_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>

    <?php echo form_open('employers/profile',$attributes);?>
      <h4>Edit Employer Information</h4>
      <div class="bottom-line"></div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" name="firstname" value="<?= $e_info['firstname']  ?>" placeholder="Enter your first name" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="<?= $e_info['email']  ?>" placeholder="@ozienttechnologies.com" required>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lastname" value="<?= $e_info['lastname']  ?>" placeholder="Enter your last name" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Date of Birth</label>
             <input class="form-control" type="date"  name="dob" value="<?= $e_info['dob']  ?>">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
    
            <label>Gender</label>
            <select class="custom-select" name="gender" >
              <option <?php if($e_info['gender'] == 'Male'){ echo "selected";} ?>>Male</option>
              <option <?php if($e_info['gender'] == 'Female'){ echo "selected";} ?>>Female</option>
              <option <?php if($e_info['gender'] == 'Other'){ echo "selected";} ?>>Other</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Marital Status</label>
            <select class="custom-select"  name="marital_status">
              <option <?php if($e_info['marital_status'] == 'Single'){ echo "selected";} ?> >Single</option>
              <option <?php if($e_info['marital_status'] == 'Married'){ echo "selected";} ?> >Married</option>
              <option <?php if($e_info['marital_status'] == 'Divorced'){ echo "selected";} ?> >Divorced</option>
              <option <?php if($e_info['marital_status'] == 'Widow/er'){ echo "selected";} ?> >Widow/er</option>
              <option <?php if($e_info['marital_status'] == 'Seperated'){ echo "selected";} ?> >Seperated</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Country</label>
            <select class="custom-select" name="country">
              <option <?php if($e_info['country'] == 'Pakistan'){ echo "selected";} ?> >Pakistan</option>
              <option <?php if($e_info['country'] == 'Bangladesh'){ echo "selected";} ?> >Bangladesh</option>
              <option <?php if($e_info['country'] == 'Srilanka'){ echo "selected";} ?> >Srilanka</option>
              <option <?php if($e_info['country'] == 'China'){ echo "selected";} ?> >China</option>
              <option <?php if($e_info['country'] == 'Turkey'){ echo "selected";} ?> >Turkey</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>City</label>
            <select class="custom-select" name="city">
              <option <?php if($e_info['city'] == 'Gujrat'){ echo "selected";} ?> >Gujrat</option>
              <option <?php if($e_info['city'] == 'Lahore'){ echo "selected";} ?> >Lahore</option>
              <option <?php if($e_info['city'] == 'Peshawar'){ echo "selected";} ?> >Peshawar</option>
              <option <?php if($e_info['city'] == 'Rawalpindi'){ echo "selected";} ?> >Rawalpindi</option>
              <option <?php if($e_info['city'] == 'Islamabad'){ echo "selected";} ?> >Islamabad</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Mobile</label>
            <input type="number" class="form-control" name="mobile_no" value="<?= $e_info['mobile_no']  ?>" >
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Postal Address</label>
            <input type="text" class="form-control"  name="address" value="<?= $e_info['address']  ?>"  placeholder="Enter your postal address">
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12 mt-4">
          <input type="submit" class="btn btn-primary px-5 btn-md" name="update" value="save">
          <button class="btn btn-outline-primary px-5" type="button">Cancel</button>
        </div>
      </div>

    <?php echo form_close();?>
  </div>
</div>





<!-- company-information-form-section start -->
<section id="company-info-form">
  <div class="container">
    <?php

      if ($this->session->flashdata('edit_company_info_success')) {

                echo '<div class="alert alert-success">' . $this->session->flashdata('edit_company_info_success') . '</div>';

            }

      if($this->session->flashdata('error_edit_company_info')){

                echo '<div class="alert alert-danger col-md-8">' . $this->session->flashdata('error_edit_company_info') . '</div>';

          }

    ?>
    <div class="row">
      <div class="col-md-8">
        <?php $attributes = array('id' => 'company_info_form', 'method' => 'post' , 'class' => 'form_horizontal'); ?>

            <?php echo form_open('employers/profile/edit',$attributes);?>
          <div class="bg-light card card-body mt-3">
            <h4>Edit Company Information</h4>
            <div class="bottom-line"></div>
            <div class="form-group row mt-4">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Industry:</label>
                <div class="col-sm-9">
                    <input type="text" name="industry" class="form-control" id="" placeholder="Marketing & Advertisement" value="<?= $company_info['industry']  ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Company Name:</label>
                <div class="col-sm-9">
                    <input type="text" name="company_name" class="form-control" id="inputEmail3" placeholder="e.g Ozient Technologies" value="<?= $company_info['company_name']  ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Email ID:</label>
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="e.g @OzientTechnologies.com" value="<?= $company_info['email']  ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Mobile Number:</label>
                <div class="col-sm-9">
                    <input type="text" name="mobile_number" class="form-control" id="inputEmail3" placeholder="e.g 030000000" value="<?= $company_info['mobile_number']  ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Address:</label>
                <div class="col-sm-9">
                    <input type="text" name="address" class="form-control" id="inputEmail3" placeholder="e.g Punjab, Pakistan." value="<?= $company_info['address']  ?>">
                </div>
              </div>
              <div class="form-group row">
                <input type="submit" class="btn btn-success form-control" name="company_info_edit" value="Save">
              </div>
          </div>
        <?php echo form_close();?>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
</section>
<!-- company-information-form-section end -->