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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ajouter Produits</h4>
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>

                                    <div class="table-responsive">
                                        <form action="<?php echo e(route('admin.produits.store')); ?>" method="POST"
                                            enctype="multipart/form-data" id="addProduitForm">
                                            <?php echo csrf_field(); ?>

                                            
                                            <div class="form-group">
                                                <label for="categorie_id">Categorie:</label>
                                                <select name="categorie_id" class="form-control" required>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($category->id); ?>"
                                                            <?php echo e(request()->input('category_id') == $category->id ? 'selected' : ''); ?>>
                                                            <?php echo e($category->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nom_produit">Nom Produit:</label>
                                                <input type="text" name="nom_produit" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <textarea name="description" class="form-control" ></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Image:</label>
                                                <input type="file" name="image" class="form-control" 
                                                    id="imageInput">
                                                <div class="image-preview" ></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="prix">Prix:</label>
                                                <input type="float" name="prix" class="form-control" required>
                                            </div>

                                            <div class="form-group">
    <label for="famille_options">Choisir les familles d'Options correspondants:</label>
    <?php $__currentLoopData = $familleOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $familleOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-check">
            <input type="checkbox" name="famille_options[]" class="form-check-input" value="<?php echo e($familleOption->id); ?>" id="famille_option_<?php echo e($familleOption->id); ?>">
            <label class="form-check-label" for="famille_option_<?php echo e($familleOption->id); ?>"><?php echo e($familleOption->nom_famille_option); ?></label>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


                                            

                                           
                                         
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                            </div>
                                            
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
    <script>
        $(document).ready(function () {
            // Listen for changes in the file input
            $('#imageInput').on('change', function (e) {
                var files = e.target.files;
                var imagePreview = $('.image-preview');
                imagePreview.empty();

                // Loop through the selected files and create an image preview for each
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var image = $('<img style="width:700px;height:400px;">').attr('src', e.target.result).addClass('img-fluid');
                        imagePreview.append(image);
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    <script>
 $(document).ready(function () {
  // Handle change event on family options select
  $('.famille-options-select').on('change', function () {
    var familleOptions = $(this).val();
    var optionsSelect = $('.options-select');

    // Clear existing options
    optionsSelect.empty();

    // Fetch and append options based on selected famille options
    $.ajax({
      url: "<?php echo e(route('admin.getOptionsByFamilleOptions')); ?>",
      method: 'POST',
      data: {
        _token: "<?php echo e(csrf_token()); ?>",
        familleOptions: familleOptions
      },
      success: function (response) {
        try {
          var options = response; // No need to parse JSON, response is already an object/array

          // Append options to the options select
          $.each(options, function (key, value) {
            optionsSelect.append($('<option>', {
              value: value.id,
              text: value.nom_option
            }));
          });
        } catch (error) {
          console.error("Error parsing JSON response:", error);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX request error:", error);
      }
    });
  });
});


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/admin/produits/create.blade.php ENDPATH**/ ?>