

<?php $__env->startSection('title', 'Seo Modifier'); ?>

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
            
            
          }
          input#image {
              padding: inherit;
              margin: auto;
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
                   <form method="POST" action="<?php echo e(route('restaurant.seo.update',$metadata->id)); ?>" enctype="multipart/form-data" style="width: 90%;">
                          <?php echo csrf_field(); ?>
              
                         
                          <div class="mb-3">
                            <label for="title" class="form-label">Titre du site</label>
                            <input type="text" class="form-control" id="title" maxlength="70" placeholder="Le titre doit contenir moins de 70 caractères" value="<?php echo e($metadata->title); ?>" required>
                        </div>
                        <div class="flex-container">
                          <div class="mb-3" style="width: 50%; margin-right: 5px;">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" maxlength="150" placeholder="La description doit contenir moins de 150 caractères"  required ><?php echo e($metadata->description); ?></textarea>
                        </div>
                        <div class="mb-3" style="width: 50%; margin-left: 5px;">
                            <label for="keywords" class="form-label">Mots-clés du site (séparés par des virgules)</label>
                            <textarea class="form-control" id="keywords" rows="3" placeholder="mot-clé 1 , mot-clé 2 , mot-clé 3 ..." required><?php echo e($metadata->keywords); ?></textarea>
                        </div>
                        </div>
                        <div class="flex-container">
                          <div class="mb-3" style="width: 50%; margin-right: 5px;">
                            <label for="robots" class="form-label">Autoriser les robots à indexer votre site Web ?</label>
                            <select class="form-control" id="robots">
                                <?php if($metadata->robots =="Yes"): ?>
                                    <option selected value="Yes">Yes</option>
                                    <option value="No">No</option>
                                <?php else: ?>
                                    <option value="Yes">Yes</option>
                                    <option selected value="No">No</option>
                                <?php endif; ?>
                                
                              </select>
                          </div>
                          <div class="mb-3" style="width: 50%; margin-left: 5px;">
                            <label for="followlinks" class="form-label">Autoriser les robots à suivre tous les liens ?</label>
                            <select class="form-control" id="followlinks">
                                <?php if($metadata->follow_links=="Yes"): ?>
                                    <option value="Yes" selected>Yes</option>
                                    <option value="No">No</option>
                                <?php else: ?>
                                    <option value="Yes">Yes</option>
                                    <option value="No" selected>No</option>
                                <?php endif; ?>
                                
                              </select>
                          </div>
                        
                        </div>
                        <div class="flex-container">
                          <div class="mb-3" style="width: 50%; margin-right: 5px;">
                            <label for="content_type" class="form-label">Quel type de contenu votre site affichera-t-il ?</label>
                            <select name="content_type" class="form-control" id="content_type">
                              <?php if($metadata->content_type == "text/html; charset=utf-8"): ?>
                                  <option value="text/html; charset=utf-8" selected>UTF-8</option>
                              <?php else: ?>
                                  <option value="text/html; charset=utf-8">UTF-8</option> 
                              <?php endif; ?>
                              <?php if($metadata->content_type =="text/html; charset=utf-16"): ?>
                                  <option value="text/html; charset=utf-16" selected>UTF-16</option>
                              <?php else: ?>
                                  <option value="text/html; charset=utf-16">UTF-16</option>
                              <?php endif; ?>
                              <?php if($metadata->content_type == "text/html; charset=iso-8859-1"): ?>
                                  <option value="text/html; charset=iso-8859-1" selected>ISO-8859-1</option>
                              <?php else: ?>
                                  <option value="text/html; charset=iso-8859-1">ISO-8859-1</option>
                              <?php endif; ?>
                              <?php if($metadata->content_type == "text/html; charset=windows-1252"): ?>
                                  <option value="text/html; charset=windows-1252" selected>WINDOWS-1252</option>
                              <?php else: ?>
                                  <option value="text/html; charset=windows-1252">WINDOWS-1252</option>
                              <?php endif; ?>
                              
                            </select>
                        </div>
                          <div class="mb-3" style="width: 50%; margin-left: 5px;">
                            <label for="language" class="form-label">Quel type de contenu votre site affichera-t-il ?</label>
                            <select name="language" class="form-control" id="language">
                                <?php if($metadata->language =="English"): ?>
                                  <option value="English" selected>English</option>
                                <?php else: ?>
                                  <option value="English">English</option>
                                <?php endif; ?>
                                <?php if($metadata->language =="French"): ?>
                                  <option value="French" selected>French</option>
                                <?php else: ?>
                                  <option value="French">French</option>
                                <?php endif; ?>
                                <?php if($metadata->language =="N/A"): ?>
                                  <option value="N/A" selected>No Language Tag</option>
                                <?php else: ?>
                                  <option value="N/A">No Language Tag</option>
                                <?php endif; ?>
                                
                                
                            </select>
                          </div>
                        </div>
                        <div class="flex-container">
                          <div style="width: 50%; margin-right: 5px;">
                            <label for="image" class="form-label">Image</label>
                            <input  name="image" class="form-control form-control-sm" type="file" id="image" accept="image/png, image/jpg, image/jpeg">
                          </div>
                          <div class="mb-3" style="width: 50%; margin-left: 5px;">
                                <?php if($metadata->image==null): ?>
                                    <img src="/uploads/seo/No_Image_Available.jpg" alt="">
                                <?php else: ?>
                                <img src="/uploads/seo/<?php echo e($metadata->image); ?>" alt="" width="70%" height="150px">
                                <?php endif; ?>
                          </div>
                        </div>
                        
                        
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
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/metadata/update.blade.php ENDPATH**/ ?>