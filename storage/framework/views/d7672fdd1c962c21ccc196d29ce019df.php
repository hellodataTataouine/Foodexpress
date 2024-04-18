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
                      <h4 class="card-title">Clients</h4>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="width:101%">
                 
    <table id="myTable" class="table" style="width: 100%">
                                             <thead>
            <tr>
             <th>Prénom</th>
             <th>Nom de famille</th>
             <th>Pays</th>
             <th>Adresse</th>
             <th>Code postal</th>
              <th>Numéro de téléphone</th>
             <th>Email</th>
				  <th>Date d'inscription</th>
             <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $clients ->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($client->FirstName); ?></td>
                    <td><?php echo e($client->LastName); ?></td>
                    <td><?php echo e($client->ville); ?></td>
                    <td><?php echo e($client->Address); ?></td>
                    <td><?php echo e($client->codepostal); ?></td>
                    <td><?php echo e($client->phoneNum1); ?></td>
                    <td><?php echo e($client->email); ?></td>
					 <td><?php echo e($client->created_at); ?></td>
                    <td>
                      <!--<a href="<?php echo e(route('clients.show', $client->id)); ?>" class="btn btn-info">Voir</a>-->
<a href="<?php echo e(route('clients.edit', $client->id)); ?>" class="btn btn-primary">Modifier</a>
<form action="<?php echo e(route('clients.destroy', $client->id)); ?>" method="POST" style="display:inline">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</button>
</form>
</td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="pagination justify-content-between">
                                          <div class="text-end">
                                            <a href="<?php echo e(route('restaurant.clients.create')); ?>" class="btn btn-primary">Ajouter Client</a>
                                          </div>
                                          <div class="text-start">
                                            <?php echo e($clients->links('vendor.pagination.bootstrap-5')); ?>

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

      
     <?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/clients/index.blade.php ENDPATH**/ ?>