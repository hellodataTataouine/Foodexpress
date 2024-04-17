

<?php $__env->startSection('title', 'Zone de service'); ?>

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
                      <h4 class="card-title">List Zone de service</h4>
                      <?php if(session('success')): ?>
                          <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                          </div>
                      <?php endif; ?>
                          
                      
                      <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                               
                                    
                                    <th>Code Postal</th>
                                    <th>Mantant minimal requis</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $servicezone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                   
                                      
                                        <td><?php echo e($cp->postal_code); ?></td>
                                        <td><?php echo e($cp->min_cmd); ?></td>
                                     
                                        
                                        <td style="display: flex; justify-content: space-between;">
                                         
                                          
                                            <a href="<?php echo e(route('restaurant.servicezone.edit', $cp->id)); ?>" class="btn btn-warning btn-sm col-s">Modifier</a>
											
                                            <form action="<?php echo e(route('restaurant.servicezone.destroy', $cp->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm col-s" onclick="return confirm('Voulez-vous vraiment supprimer cette zone de service?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <tr><td colspan="4"></td></tr>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="<?php echo e(route('restaurant.servicezone.create')); ?>" class="btn btn-primary mb-3">Ajouter une zone de service</a>
                          </div>
                         
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
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/servicezone/index.blade.php ENDPATH**/ ?>