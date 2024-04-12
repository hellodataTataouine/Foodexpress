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
                      <h4 class="card-title">Categories</h4>
                      <?php if(session('success')): ?>
                          <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                          </div>
                      <?php endif; ?>
              
                      <h1>Modifier Categorie <?php echo e($category->name); ?></h1>

                      <form action="<?php echo e(route('restaurant.categories.update', $category)); ?>" method="POST" enctype="multipart/form-data">
                          <?php echo csrf_field(); ?>
                          <?php echo method_field('PUT'); ?>
              
                          <!-- Add the necessary form fields to edit the category -->
                          <div class="form-group">
                              <label for="name">Nom Categorie:</label>
                              <input type="text" name="name" id="name" class="form-control" value="<?php echo e($category->name); ?>">
                          </div>
                      <div class="form-group">
                                                <img id="produitImage" src="<?php echo e(asset($category->url_image)); ?>" alt="Produit Image" style="width:700px;height:400px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="file" name="image" accept="image/*" class="form-control" onchange="validateImage(this)">
												 <small class="text-muted">Taille maximale du fichier : 2 Mo, Dimensions minimales : 200x200 pixels</small>
                                            </div>
						  <?php if($errors->has('image')): ?>
    <div class="alert alert-danger">
        <?php echo e($errors->first('image')); ?>

    </div>
<?php endif; ?>
                          <button type="submit" class="btn btn-primary">Modifier</button>
                      </form>
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
        $(document).ready(function () {
            // Listen for changes in the file input
            $('input[name="image"]').change(function () {
                // Get the selected file
                var file = $(this).prop('files')[0];

                // Create a URL object from the file
                var imageURL = URL.createObjectURL(file);

                // Update the image source with the new URL
                $('#produitImage').attr('src', imageURL);
            });
        });
    </script>

<script>
    function validateImage(input) {
        const file = input.files[0];

        // Vérifier la taille du fichier (en octets)
        const maxSize = 2 * 1024 * 1024; // 2 Mo
        if (file.size > maxSize) {
            alert('La taille du fichier dépasse 2 Mo. Veuillez choisir un fichier plus petit.');
            input.value = ''; // Effacer le champ de fichier
            return;
        }

        // Vérifier les dimensions de l'image
        const largeurMin = 200;
        const hauteurMin = 200;
        const image = new Image();
        image.src = URL.createObjectURL(file);

        image.onload = function () {
            if (image.width < largeurMin || image.height < hauteurMin) {
                alert('Les dimensions minimales sont de 200x200 pixels. Veuillez choisir une image plus grande.');
                input.value = ''; // Effacer le champ de fichier
            }
        };
    }
</script>

     <?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/categories/edit.blade.php ENDPATH**/ ?>