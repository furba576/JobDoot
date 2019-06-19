<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit City</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/city'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  City List</a>
          <a href="<?= base_url('admin/city/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New City</a>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <?php validation_errors(); ?>
          <?php echo form_open(base_url('admin/city/edit/'.$city['id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="city_name" class="col-sm-2 control-label">City Name</label>

                <div class="col-sm-9">
                  <input type="text" name="city" value="<?= $city['name']; ?>" class="form-control" id="city" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update city" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 


<script>
  $("#city").addClass('active');
  </script>