<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit User Education</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/education'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Education List</a>
          <a href="<?= base_url('admin/education/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Education</a>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Education</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
           
            <?php echo form_open(base_url('admin/education/edit/'.$education['id']), 'class="form-horizontal"' )?> 
              <div class="form-education">
                <label for="type" class="col-sm-2 control-label">Education Name</label>

                <div class="col-sm-9">
                  <input type="text" name="type" value="<?= $education['type']; ?>" class="form-control" id="type" placeholder="">
                </div>
              </div>
              <div class="form-education">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update education" class="btn btn-info pull-right">
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
    $("#education").addClass('active');
  </script>