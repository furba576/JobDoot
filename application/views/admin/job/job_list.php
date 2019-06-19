<div class="row">
  <div class="col-lg-12">
    <?php if ($this->session->flashdata('success')) :?>
    <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <strong>
      <?=$this->session->flashdata('success')?>
      </strong> 
    </div>
    <?php endif;?>

    <section  class="panel">
      <div class="panel-body">
          <h4 class="head3" style="display: inline-block;"> <strong>Manage Jobs</strong></h4> 
          <div class="button-inline pull-right">
              <a href="<?= base_url('admin/job/post')?>" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New Job</a>
          </div>
      </div>
    </section>

    <section  class="panel" id="advanced_search">
        <div class="panel-body">
          <h4 style="display:inline-block;">Advance Search</h4>
          <hr style="margin:5px 0px;" />
        </div>
        <div class="panel-body">
          <?php echo form_open("/",'id="job_search"') ?> 
          <div class="col-md-2">
            <label>Industry:</label>
            <select onchange="job_filter()" name="job_search_industry" class="form-control">
              <option value=""> --Select--</option>
              <?php   foreach ($industries as $industry): ?>
              <option value="<?php echo $industry['id']; ?>"> <?php echo $industry['name']; ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <label>Category:</label>
            <select onchange="job_filter()" name="job_search_category"  class="form-control ">
              <option value=""> --Select--</option>
              <?php   foreach ($categories as $category): ?>
              <option value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <label>Location:</label>
            <select onchange="job_filter()" name="job_search_location"  class="form-control">
              <option value=""> --Select--</option>
              <?php   foreach ($cities as $location): ?>
              <option value="<?php echo $location['id']; ?>"> <?php echo $location['name']; ?> </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <label>Date From:</label>
            <input name="job_search_from" type="text" class="form-control form-control-inline input-medium hr_datepicker" />
          </div>
          <div class="col-md-2">
            <label>Date To:</label>
            <input name="job_search_to" type="text" class="form-control form-control-inline input-medium hr_datepicker" />
          </div>
          <div class="col-md-2 text-right">
            <button type="button" style="margin-top:20px;" onclick="job_filter()" class="btn btn-info">Submit</button>
            <a href="<?= base_url('admin/job'); ?>" class="btn btn-danger" style="margin-top:20px;">
              <i class="fa fa-repeat"></i>
            </a>
          </div>
          <?php echo form_close(); ?>
        </div>
    </section>
    <section class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h4>Manage Jobs</h4>
        </div>
        <div class="adv-table">
          <table  class="mv_datatable display table table-bordered table-striped">
            <thead>
              <tr>
                <th> #</th>
                <th>Title</th>
                <th>Applicants</th>
                <th>Industry</th>
                <th>Location</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- page end--> 
<script src="<?php echo base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
//---------------------------------------------------
	var table =	$('.mv_datatable').DataTable( {
			"processing": true,
			"serverSide": true,
			"pageLength": 25,
			"ajax": "<?=base_url('admin/job/datatable_json')?>",
			"order": [[1,'desc']],
			"columnDefs": [
			  { "targets": 0, "name": "id", 'searchable':false, 'orderable':false},
				{ "targets": 1, "name": "job_title", 'searchable':true, 'orderable':true,'width':'250px'},
				{ "targets": 2, "name": "Applicants", 'searchable':false, 'orderable':true},
				{ "targets": 3, "name": "industry", 'searchable':true, 'orderable':true},
				{ "targets": 4, "name": "city", 'searchable':true, 'orderable':true},
        { "targets": 5, "name": "created_date", 'searchable':true, 'orderable':true},
				{ "targets": 6, "name": "is_status", 'searchable':true, 'orderable':true},
				{ "targets": 7, "name": "action", 'searchable':false, 'orderable':false,'width':'130px'}
			]
		});
		
	//---------------------------------------------------
	function job_filter()
	{
		$.post('<?=base_url('admin/job/search')?>',$('#job_search').serialize(),function(){
			table.ajax.reload( null, false );
		});
	}
	job_filter();
	//----------------------------------------------------------------				
</script>
<script>
    $('li#jobs').addClass('active');
</script>