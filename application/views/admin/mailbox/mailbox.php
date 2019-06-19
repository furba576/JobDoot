 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; <?= $title?$title : "Untitled Page" ?></h4>
        </div>
        
      </div>
    </div>
  </div> 

   <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="na_datatable" class="table table-bordered table-striped" width="100%">
        <thead>
        <tr>
          <th>User Name</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Date</th>
          <th style="width: 150px;" class="text-right">Action</th>
        </tr>
        </thead>

        <tbody>

        	<?php 
        	if( isset($mails) ):
        		foreach( $mails as $mail ): ?>

		        	<tr>
		        		<td> <?= $mail['username'] ?> </td>
		        		<td> <?= $mail['email'] ?> </td>
		        		<td> <?= $mail['subject'] ?> </td>
		        		<td> <?= date('Y/m/d', strtotime($mail['created_date'])) ?> </td>
		        		<td> <a href="<?= base_url('admin/Mailbox/viewMail/').$mail['id']; ?>"> <i class="fa fa-eye btn btn-warning"></i></a> </td>
		        	</tr>

	        	<?php 
		        endforeach;
		    endif;
        	?>

        </tbody>

      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section> 