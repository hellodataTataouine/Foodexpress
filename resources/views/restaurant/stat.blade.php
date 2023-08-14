
<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                <h3 class="mb-0">{{  DB::table('users') ->where('restaurant_id', function ($query) { $query->select('id')->from('clients')->where('user_id', auth()->user()->id);})->count()}}</h3>
                <p class="text-success ml-2 mb-0 font-weight-medium">+5.5%</p>
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
                @php
                    $subdomain = request()->getHost();
                    $sub = $subdomain.':8000';
                    $client = \App\Models\Client::where('url_platform', $subdomain)->first();
                    $clientId = $client ? $client->id : null;
                @endphp

                <h3 class="mb-0">{{  DB::table('produits_restaurant')
                    ->whereIn('categorie_rest_id', function ($query) use ($clientId) {
                        $query->select('id')
                            ->from('categories_restaurant')
                            ->where('restaurant_id', auth()->user()->id);
                    })
                    ->count() }}
                </h3>

             <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
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
                @php
                    $subdomain = request()->getHost();
                    $sub = $subdomain.':8000';
                    $client = \App\Models\Client::where('url_platform', $sub)->first();
                    $clientId = $client ? $client->id : null;
                @endphp

<h3 class="mb-0">{{ DB::table('commands')->where('restaurant_id', '=', $clientId)->count() }}</h3>

<p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
              </div>
            </div>
            <div class="col-3">
              <div class="icon icon-box-danger">
                <span class="mdi mdi-arrow-bottom-left icon-item"></span>
              </div>
            </div>
          </div>
          <h6 class="text-muted font-weight-normal">Commandes</h6>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex align-items-center align-self-start">
                @php
                    $subdomain = request()->getHost();
                    $sub = $subdomain.':8000';
                    $client = \App\Models\Client::where('url_platform', $sub)->first();
                    $clientId = $client ? $client->id : null;
                @endphp
                <h3 class="mb-0">{{ DB::table('commands')->where('restaurant_id', '=', $clientId)->where('statut', '=', 'Pending')->count() }}</h3>
                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
              </div>
            </div>
            <div class="col-3">
              <div class="icon icon-box-success ">
                <span class="mdi mdi-arrow-top-right icon-item"></span>
              </div>
            </div>
          </div>
          <h6 class="text-muted font-weight-normal">Commandes En cours</h6>
        </div>
      </div>
    </div>
  </div>