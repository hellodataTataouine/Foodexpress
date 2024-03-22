    <!DOCTYPE html>
    <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <!-- plugins:css -->

         
        <link rel="stylesheet" href="<?php echo e(asset('vendors/mdi/css/materialdesignicons.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('vendors/css/vendor.bundle.base.css')); ?>">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="<?php echo e(asset('vendors/jvectormap/jquery-jvectormap.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('vendors/owl-carousel-2/owl.carousel.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('vendors/owl-carousel-2/owl.theme.default.min.css')); ?>">      
        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
        <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.png')); ?>" />
		          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

      </head>
      <body>
            <?php echo $__env->yieldContent('content'); ?>
            <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
        <script src="<?php echo e(asset('vendors/js/vendor.bundle.base.js')); ?>"></script>


        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="<?php echo e(asset('vendors/chart.js/Chart.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/progressbar.js/progressbar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/jvectormap/jquery-jvectormap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/owl-carousel-2/owl.carousel.min.js')); ?>"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="<?php echo e(asset('js/off-canvas.js')); ?>"></script>
        <script src="<?php echo e(asset('js/hoverable-collapse.js')); ?>"></script>
        <script src="<?php echo e(asset('js/misc.js')); ?>"></script>
        <script src="<?php echo e(asset('js/settings.js')); ?>"></script>
        <script src="<?php echo e(asset('js/todolist.js')); ?>"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>

      <script>
        // Remove active class from all li elements
        setTimeout(function(){
          $('#sidebar .nav-item.menu-items').removeClass('active');
          $('#sidebar .nav-item.menu-items div.collapse.show').removeClass('show');

        }, 10);
    </script>
    
        <!-- End custom js for this page -->
      </body>
    </html><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/base.blade.php ENDPATH**/ ?>