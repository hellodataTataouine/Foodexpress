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

              <?php echo $__env->make('restaurant.stat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Restaurants</h4>
                      <?php if(session('success')): ?>
                          <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                          </div>
                      <?php endif; ?>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:101%">
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                             
                              <th> Nom </th>
                            
                              <th> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $livraisonMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $LivraisonMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <?php
                                  $livraisonType = \App\Models\LivraisonMethod::find($LivraisonMethod->livraison_id);
                              ?>
                                  <td><?php echo e($livraisonType->methode); ?></td>
                                 
                                 <!-- <td><a  href="<?php echo e(route('restaurant.livraison.edit', ['id' => $LivraisonMethod->id])); ?>"  class="btn btn-primary">Modifier</a></td>-->
                                  
                                 
                                    <td><form action="<?php echo e(route('restaurant.livraison.destroy', $LivraisonMethod)); ?>" method="POST">
                                      <?php echo csrf_field(); ?>
                                      <?php echo method_field('DELETE'); ?>
                                      <button type="submit" class="btn btn-danger">Supprimer</button>
                                  </form></td>
                               
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <tr><td colspan="10"></td></tr>
                          </tbody>
                        </table>

                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="<?php echo e(route('restaurant.livraison.create')); ?>" class="btn btn-primary mb-3">Ajouter  </a>
                          </div>
                          <div class="text-start">
                            <?php echo e($livraisonMethods->links('vendor.pagination.bootstrap-5')); ?>

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
       <script>

        function myFunction() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
            </script>
     <?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/livraison/index.blade.php ENDPATH**/ ?>