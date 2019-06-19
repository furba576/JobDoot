 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">   

 <section class="content">
   <div class="row">
    <div class="col-md-12">
       <?php if($this->session->flashdata('success')):?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?= $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; <?= $title ?></h4>
        </div>
      </div>
    </div>
  </div>

   <div class="box border-top-solid">
    <!-- /.box-header -->
    <div class="box-body">
       
    	<h4>Select Expertise Level</h4>
    	<?php $attributes = array('id' => 'cat_by_el', 'method' => 'post');
			echo form_open('admin/category/category_by_expertise_level',$attributes);?>

	    	<div class="row">
		    	<div class="col-md-4">
			    	<select class="form-control" name="expertise_level">
			    		<?php
			    		$el_id = $selected_el_id? $selected_el_id : '';
			    		foreach( $expertise_level as $el ): ?>
			    			<option value="<?= $el['el_id'] ?>" <?= ( $el['el_id'] == $el_id )? "selected" : ""  ?> > <?= $el['el_name'] ?> </option>
			    		<?php 
			    		endforeach; ?>
			    	</select>
		    	</div>

		    	<div class="col-md-3">
		    		<input type="submit" name="select_el" class="btn btn-primary" value="Select"/>
		    	</div>
	    	</div>

	    	<div class="row">
	    		<div class="col-md-5">
	    			<h5>Currently added Categories</h5>
	    			<ul class="list-group">
	    				<?php 
	    				foreach( $category_of_el as $cat_o_el ): ?>
	    					<li class="list-group-item">
	    						<input name="current_cat[]" value="<?= $cat_o_el['slug'] ?>" type="checkbox"/> 
	    						<label> <?= $cat_o_el['name'] ?> </label>
	    					</li>
	    				<?php endforeach; ?>
	    			</ul>
	    			<input type="submit" name="remove_cat" class="btn btn-danger" value="Remove Selected Categories"/>
	    		</div>
	    		<div class="col-md-1"></div>

	    		<div class="col-md-5 mr-auto">
	    			<h5>Available Categories</h5>
	    			<ul class="list-group">
	    			<?php 
	    			foreach( $other_categories as $oc ): ?>
	    				<li class="list-group-item">
	    					<input name="other_cat[]" value="<?= $oc['slug'] ?>" type="checkbox"/> 
	    					<label> <?= $oc['name'] ?> </label>
	    				</li>
	    			<?php endforeach; ?>
	    			</ul>
	    			<input type="submit" name="add_cat" class="btn btn-success" value="Add Selected Categories"/>
	    		</div>
	    	</div>
		<?php echo form_close(); ?>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>