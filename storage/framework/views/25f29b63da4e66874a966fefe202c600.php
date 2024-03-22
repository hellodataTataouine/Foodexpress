<?php $__env->startSection('title', 'Welcome'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <?php echo $__env->make('admin.left-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
      <?php echo $__env->make('admin.top-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

              <?php echo $__env->make('admin.stat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h2 class="text-center">Liste des Restaurants</h2>
                      <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                      <?php endif; ?>
                      <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms.." title="Type in a name">
                    </div>
                      <div class="table-responsive"  style="max-width:100%">
                        <table class="table" id="myTable">
                          <thead>
                            <tr>
                              <th> Logo </th>
                              <th> Nom </th>
                              <th> N° Tél </th>
                              <th> Adresse </th>
                              <th> URL Platform </th>
                              <th> N° Des Produits</th>
                              <th> N° Des Commandes </th>
                              <th> Montant Dernier Commande </th>
                              <th> Date Dernier Commande</th>
                              <th>Status</th>
                          
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clientInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td>
                                    <a href="<?php echo e(asset($clientInfo->logo)); ?>"
                                        data-toggle="modal" data-target="#imageModal">
                                        <img src="<?php echo e(asset($clientInfo->logo)); ?>"
                                            alt="Product Image" class="zoomable-image">
                                    </a>
                                </td>
                                  
                                  <td><?php echo e($clientInfo->name); ?></td>
                                  <td><?php echo e($clientInfo->phoneNum1); ?></td>
                                  <td><?php echo e($clientInfo->localisation); ?></td>
                                  <td><?php echo e($clientInfo->url_platform); ?></td>
                                  <td><?php echo e($clientInfo->products_count > 0 ? $clientInfo->products_count : 0); ?></td>
                                  <td>  
                                    <?php
                                      $orderCount = DB::table('commands')
                                          ->where('restaurant_id', $clientInfo->id)
                                          ->count();
                                      echo $orderCount;
                                    ?> 
                                  </td>
                                  <td>
                                    <?php
                                        $lastOrder = DB::table('commands')
                                            ->where('restaurant_id', $clientInfo->id)
                                            ->orderBy('created_at', 'desc')
                                            ->first();
                        
                                        if ($lastOrder) {
                                            echo $lastOrder->prix_total;
                                        } else {
                                            echo 'N/A';
                                        }
                                    ?>
                                  </td>
                                 
                                  <td>
                                      <?php
                                          if ($lastOrder) {
                                              echo $lastOrder->created_at;
                                          } else {
                                              echo 'N/A';
                                          }
                                      ?>
                                  </td>
                                  <td>
                                    <button class="btn update-status-btn <?php echo e($clientInfo->status == 1 ? 'btn-success' : 'btn-danger'); ?>" data-id="<?php echo e($clientInfo->id); ?>">
                                        <span id="status_<?php echo e($clientInfo->id); ?>"><?php echo e($clientInfo->status == 1 ? 'active' : 'inactive'); ?></span>
                                    </button>
                                </td> 
                                  <td>
                                    <a href="<?php echo e(route('admin.clients.edit', ['id' => $clientInfo->id])); ?>" class="btn btn-primary">Modifier</a>
                                    <form action="<?php echo e(route('admin.clients.destroy', ['id' => $clientInfo->id])); ?>" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">
                                      <?php echo csrf_field(); ?>
                                      <?php echo method_field('DELETE'); ?>
                                      <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                  </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <tr><td colspan="10"></td></tr>
                          </tbody>
                        </table>
                        <div class="pagination justify-content-between">
                          <div class="text-end">
                            <a aling="rigth" href="<?php echo e(url('admin/clients/create')); ?>" class="btn btn-primary mb-2">Ajouter Restaurant</a>
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

       
       <script>
        $(document).ready(function() {
            // Handle the button click event
            $('.update-status-btn').click(function() {
                var button = $(this);
                var clientInfo = button.data('id');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '<?php echo e(route("admin.clients.updateStatus", ":id")); ?>'.replace(':id', clientInfo),
                    data: {
                        '_token': '<?php echo e(csrf_token()); ?>',
                    },
                    success: function(response) {
                        // Update the status displayed in the button after the status is updated
                        var newStatus = response.newStatus;
                        var statusSpan = button.find('#status_' + clientInfo);
                        statusSpan.text(newStatus == 1 ? 'active' : 'inactive');
                        // Update the button class to change its color based on the new status
                        button.removeClass('btn-success btn-danger');
                        button.addClass(newStatus == 1 ? 'btn-success' : 'btn-danger');
                    },
                    error: function(xhr, status, error) {
                        console.log('An error occurred during the AJAX request.');
                    }
                   })});
                 });
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
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/admin/clients/index.blade.php ENDPATH**/ ?>