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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Liste Familles d'Options</h2>
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par nom.." title="Type in a name">
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="myTable" class="table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                     <th>Nom Famille Option</th>
                                                    <th>Type Famille Option</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $familleOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $familleOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                      <td><?php echo e($familleOption->nom_famille_option); ?></td>
                                                    <td><?php echo e($familleOption->type); ?></td>
                                                    <td>
                                                        <a href="<?php echo e(route('restaurant.famille-options.options', $familleOption->id)); ?>" class="btn btn-success">Options de cette Famille Option</a>
                                                       
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo e(route('restaurant.options.create', ['famille_option_id' => $familleOption->id])); ?>" class="btn btn-success">Ajouter une Option</a>
                                                        <a href="<?php echo e(route('restaurant.famille-options.edit', $familleOption->id)); ?>" class="btn btn-primary">Modifier</a>
                                                        <form action="<?php echo e(route('restaurant.famille-options.destroy', $familleOption->id)); ?>" method="POST" style="display: inline-block;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </form>
                                                        
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-between">
                                            <div class="text-end">
                                                <a href="<?php echo e(route('restaurant.famille-options.create')); ?>" class="btn btn-primary">Ajouter Famille d'Option</a>
                                            </div>
                                            <div class="text-start">
                                               
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

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Product Image" class="modal-image">
                </div>
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
        var found = false; // Flag to check if the search term is found in any cell of the row
        for (var j = 0; j < tr[i].cells.length; j++) { // Start from the second cell to skip the image cell
            td = tr[i].cells[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break; // If found in any cell, break the inner loop
                }
            }
        }
        if (found) {
            tr[i].style.display = ""; // Show the row
        } else {
            tr[i].style.display = "none"; // Hide the row
        }
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/famille-options/index.blade.php ENDPATH**/ ?>