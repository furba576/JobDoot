<!-- start banner Area -->
      <section class="banner-area relative custom_bg no_search" id="home">  
        <div class="overlay overlay-bg"></div>
        <div class="jt-breadcumb">
          <div class="container">
            <p class="link-nav text-left"><a href="<?= base_url(); ?>">Home </a>  
              <span class="lnr lnr-chevron-right"></span>  
              <a href="">Jobs by Category</a>
            </p>
          </div>
        </div>
        <div class="container">
          <div class="d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12 page_heading custom_header">

              <h1 class="">
                Jobs by Category     
              </h1>
            </div>                      
          </div>
        </div>
      </section>
      <!-- End banner Area -->

<section class="post-area section-gap">
  <div class="container">
    <div class="row">
      <?php foreach($categories as $category): ?>
      <div class="col-12 col-md-4 col-lg-3">
        <div class="box-item-single text-center">
          <h5 class="title"><a href="<?= base_url('jobs/category/'.get_category_slug($category['category_id'])); ?>"> <?= get_category_name($category['category_id']); ?></a></h5>
          <span class="count"><a href="<?= base_url('jobs/category/'.get_category_slug($category['category_id'])); ?>">(<?= $category['total_jobs']; ?>)</a></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
     