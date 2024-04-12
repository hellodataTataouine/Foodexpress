

<?php $__env->startSection('title', 'Meta-data'); ?>

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
                    <h4 class="card-title" style="color: black;">Meta Data</h4>
                      <?php if(session('success')): ?>
                          <div class="alert alert-success">
                              <?php echo e(session('success')); ?>

                          </div>
                      <?php endif; ?>
                    <div class="table-responsive">
                   <form method="POST" action="#" enctype="multipart/form-data">
                          <?php echo csrf_field(); ?>
              
                         
                          <div class="mb-3">
                            <label for="title" class="form-label">Titre du site</label>
                            <input type="text" class="form-control" id="title" placeholder="Le titre doit contenir moins de 70 caractères">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" placeholder="La description doit contenir moins de 150 caractères"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keywords" class="form-label">Mots-clés du site (séparés par des virgules)</label>
                            <textarea class="form-control" id="keywords" rows="3" placeholder="mot-clé 1 , mot-clé 2 , mot-clé 3 ..."></textarea>
                        </div>
                        <label for="robots" class="form-label">Autoriser les robots à indexer votre site Web ?</label>
                        <select class="form-control" id="robots">
                            <option selected>Yes</option>
                            <option value="1">No</option>
                          </select>
                        <label for="followlinks" class="form-label">Autoriser les robots à suivre tous les liens ?</label>
                        <select class="form-control" id="followlinks">
                            <option value="yes" selected>Yes</option>
                            <option value="no">No</option>
                          </select>
                    
                          <label for="contentType" class="form-label">Quel type de contenu votre site affichera-t-il ?</label>
                          <select name="contentType" class="form-control" id="contentType">
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