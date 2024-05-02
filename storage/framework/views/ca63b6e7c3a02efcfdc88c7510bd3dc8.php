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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center">Ajouter Categorie</h2>
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session('success')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                                               placeholder="Search for names.." title="Type in a name">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="myTable">
                                            <thead>
                                            <tr>
                                              
                                                <th>Nom</th>
                                                <th>Date de Création</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr data-category-id="<?php echo e($category->id); ?>">
                                                 
                                                    <td class="category-name"
                                                        value="<?php echo e($category->name); ?>"><?php echo e($category->name); ?></td>
                                                    <td><?php echo e($category->date_creation); ?></td>
                                                    <td style="display: flex; justify-content: space-between;">
                                                        <button type="button" class="btn btn-success btn-sm"
                                                                onclick="openModal(<?php echo e($category->id); ?>, '<?php echo e($category->name); ?>')">
                                                            Ajouter Cette Categorie
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td colspan="4"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="justify-content-between">
                                            <div class="text-end">
                                            <button type="button" class="btn btn-primary btn-sm"
                                                               >
                                                                Ajouter une catégorie 
                                                        </button>
                                                    </div>

                                           <!-- <div class="text-end">
                                                <a href="<?php echo e(route('restaurant.categories.create')); ?>"
                                                   class="btn btn-primary mb-3">Ajouter une categorie spécifique</a>
                                            </div>-->
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

    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Ajouter catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryNameInput" class="form-label">Nom de catégorie</label>
                        <input type="text" class="form-control" id="categoryNameInput">
                    </div>
                    <div id="productCheckboxes"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="confirmAddCategory()">Ajouter</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="specifiquecategoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Ajouter une categorie spécifique</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('restaurant.categories.specifique.create')); ?>" method="POST" enctype="multipart/form-data" id="addProduitForm">
                <div class="modal-body">
                    <!-- Input field for "nom de categorie" -->
                    <div class="form-group">
                        <label for="categoryName">Nom de categorie:</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Nom de categorie" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" class="form-control" 
                            id="imageInput" accept="image/*" onchange="validateImage(this)">
						 
                        <div class="image-preview" ></div>
                                                               
												 <small class="text-muted">Taille maximale du fichier : 2 Mo, Dimensions minimales : 200x200 pixels</small>
                                            </div>
						  <?php if($errors->has('image')): ?>
    <div class="alert alert-danger">
        <?php echo e($errors->first('image')); ?>

    </div>
<?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary customizeBtn" >Enregistrer</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        function openModal(categoryId, categoryName) {
            $('#categoryNameInput').val(categoryName);
            $('#categoryId').val(categoryId);
            $('#categoryName').val(categoryName);

            $.ajax({
                url: "<?php echo e(route('fetch.products')); ?>",
                type: "GET",
                data: {categoryId: categoryId},
                success: function (response) {
                    var productCheckboxes = '';
                    response.products.forEach(function (product) {
                        var checked = product.selected ? 'checked' : '';
                        productCheckboxes += '<div class="form-check">';
                        productCheckboxes += '<input class="form-check-input" type="checkbox" name="products[]" value="' + product.id + '" ' + checked + '>';
                        productCheckboxes += '<input type="text" class="form-control" name="nom_produit[]" value="' + product.nom_produit + '" placeholder="nom produit">';
                        productCheckboxes += '<input type="text" class="form-control" name="descriptions[]" value="' + product.description + '" placeholder="Description">';
                        productCheckboxes += '<input type="text" class="form-control" name="id_produit[]" value="' + product.id + '"  style="display:none;" >';
                        productCheckboxes += '<input type="text" class="form-control" name="image_urls[]" value="' + product.url_image + '" style="display:none;" >';
                        productCheckboxes += '<input type="text" class="form-control" name="prices[]" value="' + product.prix + '" placeholder="Price">';
                        productCheckboxes += '</div>';
                    });

                    $('#productCheckboxes').html(productCheckboxes);

                    $('#categoryModal').modal('show');
                },
                error: function () {
                    alert('Failed to fetch products. Please try again.');
                }
            });
        }


        function confirmAddCategory() {
            var categoryId = $('#categoryId').val();
            var categoryName = $('#categoryNameInput').val();

            var checkedProducts = $('input[name="products[]"]:checked').map(function () {
                return {
                    id_produit: $(this).siblings('input[name="id_produit[]"]').val(),
                    nom_produit: $(this).siblings('input[name="nom_produit[]"]').val(),
                    description: $(this).siblings('input[name="descriptions[]"]').val(),
                    url_image: $(this).siblings('input[name="image_urls[]"]').val(),
                    prix: $(this).siblings('input[name="prices[]"]').val(),
                    categorie_id: categoryId
                };
            }).get();

            var formData = {
                _token: "<?php echo e(csrf_token()); ?>",
                categoryId: categoryId,
                categoryName: categoryName,
                products: checkedProducts
            };

            $.ajax({
                url: "<?php echo e(route('restaurant.categories.store')); ?>",
                type: "POST",
                data: formData,
                success: function (response) {
                    console.log(response);
                    window.location.href = "<?php echo e(route('restaurant.categories.index')); ?>";
                },
                error: function () {
                    alert(' This category already exists in your categories list.');
                }
            });

            $('#categoryModal').modal('hide');
        }

      

        $(document).ready(function () {
        function openModalAddCategory() {
            // Show the modal
            $('#specifiquecategoryModal').modal('show');
        }
    });
   
    </script>
    <script>
        $(document).ready(function () {
            // Use event delegation for dynamically added elements
            $(document).on('click', 'button.btn.btn-primary.btn-sm', function () {
                openModalAddCategory();
            });
    
            function openModalAddCategory() {
                // Show the modal
                $('#specifiquecategoryModal').modal('show');
            }
             
      $('.customizeBtn').click(function() {
        saveCategory();
    });
    
    function saveCategory() {
    // Retrieve the category name from the input field
    var categoryName = document.getElementById("categoryName").value;
    var imageData = new FormData();
    var imageInput = $('#imageInput')[0].files[0];
    imageData.append('categoryName', categoryName);
    imageData.append('image', imageInput);
    $.ajax({
        url: '<?php echo e(route('restaurant.categories.specifique.create')); ?>',
        method: 'POST',
      
        data: imageData,
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                },
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            // Handle the success response from the server
            //var categoryModal = new bootstrap.Modal(document.getElementById("specifiquecategoryModal"));
           // categoryModal.hide();
		 $('#specifiquecategoryModal').modal('hide');
		// window.location.href = '<?php echo e(route('restaurant.categories.index')); ?>';
		  var successMessage = 'catégorie ajoutée avec succès!';
        var encodedMessage = encodeURIComponent(successMessage);
        var redirectUrl = '<?php echo e(route('restaurant.categories.index')); ?>?success=' + encodedMessage;
		  window.location.href = redirectUrl;
       
        },
        error: function (error) {
            // Handle the error response from the server
            console.error('Error adding category:', error);
			  $('#specifiquecategoryModal').modal('hide');
           // var categoryModal = new bootstrap.Modal(document.getElementById("specifiquecategoryModal"));
           // categoryModal.hide();
        }
    });
}

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

<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/categories/create.blade.php ENDPATH**/ ?>