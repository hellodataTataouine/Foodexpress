<?php $__env->startSection('title', 'Welcome'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <?php echo $__env->make('restaurant.left-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
      <?php echo $__env->make('restaurant.top-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

           
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Seo config</h4>
                      <?php if(session('success')): ?>
                          <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                          </div>
                      <?php endif; ?>
                          
                      
                      <div class="table-responsive">
                        <?php if( isset($metadata) ): ?>
                        <table class="table" id="myTable">
                            
                            <tbody>
                                    <tr>
                                   
                                       
                                   
                                        <td>Titre du site</td>
                                        <td><?php echo e($metadata->title); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><?php echo e($metadata->description); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mots-clés du site</td>
                                        <td><?php echo e($metadata->keywords); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Autoriser les robots à indexer votre site Web ?</td>
                                        <td><?php echo e($metadata->robots); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Autoriser les robots à suivre tous les liens ?</td>
                                        <td><?php echo e($metadata->follow_links); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Type de contenu</td>
                                        <td><?php echo e($metadata->content_type); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Language du site</td>
                                        <td><?php echo e($metadata->language); ?></td>
                                    </tr>
                                

                                <tr><td colspan="4"></td></tr>
                                
                            </tbody>
                        </table>
                        <br>
                        <div class="text-end">
                            <a href="<?php echo e(route('restaurant.seo.edit', $metadata)); ?>" class="btn btn-warning mb-3">Modifier</a>
                          </div>
                          
                        
                        
                        <?php endif; ?>
                        
                        
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
          </div>
       </div>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\Foodexpress\resources\views/restaurant/metadata/index.blade.php ENDPATH**/ ?>