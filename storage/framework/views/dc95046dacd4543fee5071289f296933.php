
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
                    <h4 class="card-title">Messages</h4>
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                  </div>
                  <div class="table-responsive"  style="width:100%">
                    <table class="table" id="myTable">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Nom </th>
                          <th> N° Télp </th>
                          <th> Adresse E-mail </th>
                          <th> Sujet</th>
                          <th> Message</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($message->id); ?></td>
                              <td><?php echo e($message->name); ?></td>
                              <td><?php echo e($message->phone_number); ?></td>
                              <td><?php echo e($message->email); ?></td>
                              <td><?php echo e($message->subject); ?></td>
                              <td><?php echo e($message->message); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                </div>
          </div>
        </div>

    </div>
</div>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/admin/messages/index.blade.php ENDPATH**/ ?>