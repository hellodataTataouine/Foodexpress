

<?php $__env->startSection('title', 'SEO Config'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <?php echo $__env->make('restaurant.left-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
    <?php echo $__env->make('restaurant.top-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <style>
        .flex-container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: normal;
            align-items: normal;
            align-content: normal;
            width: 100%;
            
          }
      </style>
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="color: black;">SEO</h4>
                      <?php if(session('success')): ?>
                          <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                          </div>
                      <?php endif; ?>
                    <div class="table-responsive">
                   <form method="POST" action="<?php echo e(route('restaurant.seo.store')); ?>" enctype="multipart/form-data" style="width: 90%;">
                          <?php echo csrf_field(); ?>
              
                         
                          <div class="mb-3">
                            <label for="title" class="form-label">Titre du site</label>
                            <input type="text" name="title" class="form-control" id="title" maxlength="70" placeholder="Le titre doit contenir moins de 70 caractères" required>
                        </div>
                        <div class="flex-container">
                          <div class="mb-3" style="width: 50%; margin-right: 5px;">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" maxlength="150" placeholder="La description doit contenir moins de 150 caractères" required></textarea>
                        </div>
                        <div class="mb-3" style="width: 50%; margin-left: 5px;">
                            <label for="keywords" class="form-label">Mots-clés du site (séparés par des virgules)</label>
                            <textarea class="form-control" id="keywords" name="keywords" rows="3" placeholder="mot-clé 1 , mot-clé 2 , mot-clé 3 ..." required></textarea>
                        </div>
                      </div>
                       
                        <label for="robots" class="form-label">Autoriser les robots à indexer votre site Web ?</label>
                        <select class="form-control" id="robots" name="robots">
                            <option selected value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                        <label for="followlinks" class="form-label">Autoriser les robots à suivre tous les liens ?</label>
                        <select class="form-control" id="followlinks" name="follow_links">
                            <option value="Yes" selected>Yes</option>
                            <option value="No">No</option>
                          </select>
                    
                          <label for="content_type" class="form-label">Quel type de contenu votre site affichera-t-il ?</label>
                          <select name="content_type" class="form-control" id="contentType">
                            <option value="text/html; charset=utf-8">UTF-8</option>
                            <option value="text/html; charset=utf-16">UTF-16</option>
                            <option value="text/html; charset=iso-8859-1">ISO-8859-1</option>
                            <option value="text/html; charset=windows-1252">WINDOWS-1252</option>
                        </select>
                        <label for="language" class="form-label">Quel type de contenu votre site affichera-t-il ?</label>
                        <select name="language" class="form-control" id="language">
                            <option value="English">English</option>
                            <option value="French">French</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Russian">Russian</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Japanese">Japanese</option>
                            <option value="Korean">Korean</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Portuguese">Portuguese</option>
                            <option value="N/A">No Language Tag</option>
                        </select>
                      
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image" accept="image/png, image/jpg, image/jpeg">
                        <br>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/metadata/create.blade.php ENDPATH**/ ?>