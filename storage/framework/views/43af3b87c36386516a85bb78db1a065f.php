
<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <h3 class="mb-0"><?php echo e($clientCount); ?></h3>
              </div>
            </div>
            <div class="col-3">
              <div class="icon icon-box-success ">
                <span class="mdi mdi-arrow-top-right icon-item"></span>
              </div>
            </div>
          </div>
          <h6 class="text-muted font-weight-normal">Clients</h6>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <?php
                    $subdomain = request()->getHost();
                    $sub = $subdomain;
                    $client = \App\Models\Client::where('url_platform', $subdomain)->first();
                    $clientId = $client ? $client->id : null;
                ?>

                <h3 class="mb-0"><?php echo e($produitsCount); ?>

                </h3>

              </div>
            </div>
            <div class="col-3">
              <div class="icon icon-box-success">
                <span class="mdi mdi-arrow-top-right icon-item"></span>
              </div>
            </div>
          </div>
          <h6 class="text-muted font-weight-normal">Produits</h6>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <?php
                    $subdomain = request()->getHost();
                    $sub = $subdomain;
                    $client = \App\Models\Client::where('url_platform', $sub)->first();
                    $clientId = $client ? $client->id : null;
                ?>

<h3 class="mb-0"> <?php echo e($commandeCount); ?></h3>

<p class="text-danger ml-2 mb-0 font-weight-medium"></p>
              </div>
            </div>
            <div class="col-3">
              <div class="icon icon-box-success ">
                <span class="mdi mdi-arrow-top-right icon-item"></span>
              </div>
            </div>
          </div>
          <h6 class="text-muted font-weight-normal">Commandes </h6>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <?php
                    $subdomain = request()->getHost();
                    $sub = $subdomain;
                    $client = \App\Models\Client::where('url_platform', $sub)->first();
                    $clientId = $client ? $client->id : null;
                ?>
                <h3 class="mb-0"><?php echo e($NouveauCommandeCount); ?></h3>
              </div>
            </div>
            <div class="col-3">
              <div class="icon icon-box-success ">
                <span class="mdi mdi-arrow-top-right icon-item"></span>
              </div>
            </div>
          </div>
          <h6 class="text-muted font-weight-normal">Nouvelles Commandes</h6>
        </div>
      </div>
    </div>
  </div><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/restaurant/stat.blade.php ENDPATH**/ ?>