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
                      <h4 class="card-title">Categories</h4>
                      <?php if(session('success')): ?>
                          <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                          </div>
                      <?php endif; ?>
                          
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div>
                      <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                <th>Photo</th>
                                    <th>Désignation</th>
                                    <th>N° personnes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    <td>
                                                       
                                                            <a href="<?php echo e(asset($table->photo)); ?>"
                                                                data-toggle="modal" data-target="#imageModal">
                                                                <img src="<?php echo e(asset($table->photo)); ?>"
                                                                    alt="table Image" class="zoomable-image">
                                                            </a>
                                                        </td>
                                        <td><?php echo e($table->designation); ?></td>
                                        <td><?php echo e($table->nbre_personnes); ?></td>
                                        <td style="display: flex; justify-content: space-between;">
                                                   
                                       
                                          <a href="<?php echo e(route('restaurant.resevation.create', ['table_id' => $table->id])); ?>" class="btn btn-success btn-sm">Ajouter Reservation</a>
                                            <a href="<?php echo e(route('restaurant.tables.edit', $table)); ?>" class="btn btn-primary btn-sm col-s">Modifier</a>
                                            <form action="<?php echo e(route('restaurant.tables.destroy', $table)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm col-s" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <tr><td colspan="4"></td></tr>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a href="<?php echo e(route('restaurant.tables.create')); ?>" class="btn btn-primary mb-3">Ajouter table</a>
                          </div>
                          <div class="text-start">
                            <?php echo e($tables->links('vendor.pagination.bootstrap-5')); ?>

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
 <script>
        const images = document.querySelectorAll('.zoomable-image');
        const modalImage = document.querySelector('.modal-image');

        images.forEach(function(image) {
            image.addEventListener('click', function() {
                const imageUrl = image.getAttribute('src');
                modalImage.setAttribute('src', imageUrl);
            });
        });

        $('#imageModal').on('hidden.bs.modal', function() {
            modalImage.setAttribute('src', '');
        });

    </script>
     <?php $__env->stopSection(); ?>

<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/Tables/index.blade.php ENDPATH**/ ?>