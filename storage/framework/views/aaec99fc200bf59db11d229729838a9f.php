

<?php $__env->startSection('title', 'Meta-data'); ?>

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
                    <h4 class="card-title" style="color: black;">Zones de service</h4>
                      <?php if(session('success')): ?>
                          <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                          </div>
                      <?php endif; ?>
                    <div class="table-responsive">
                   <form method="POST" action="#" enctype="multipart/form-data">
                          <?php echo csrf_field(); ?>
              
                         
                        <div class="mb-3">
                            <label for="postalcode" class="form-label">Code postale</label>
                            <input class="form-control" type="number" placeholder="Example 75000"  min="0" max="100000" id="postalcode"/>
                        </div>
                        <div class="mb-3">
                            <label for="mincmd" class="form-label">Montant minimal requis pour une commande</label>
                            <input class="form-control" type="number" placeholder="Example 50.0"  min="0" max="100000" id="mincmd"/>
                        </div>
                        <button class="btn btn-primary" type="submit">Ajouter</button>
                      </form>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/servicezone/create.blade.php ENDPATH**/ ?>