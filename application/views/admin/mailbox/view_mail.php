  
 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> <?= $title?$title : "Untitled" ?></h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/mailbox'); ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> back to inbox </a>
        </div>
        
      </div>
    </div>
  </div> 

   <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      
      <div class="col-12 mail-header pb-4 border-bottom">
        
          <p class="text-muted">From : <?= $mail['email'] ?></p>
          <p class="text-muted">Date : <?= date('Y/m/d', strtotime($mail['created_date'])) ?></p>
          <p class="text-muted">Subject : <?= $mail['subject'] ?></p>




      </div>

      <div class="col-12">
        <hr/>
        <?= $mail['message']; ?>
      </div>

    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  


