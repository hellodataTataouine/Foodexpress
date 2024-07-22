@extends('base')

@section('title', 'Visites')

@section('content')
<style>
    .charts_orb {
      display: flex;
      align-items: flex-start;
      justify-content: left;
      flex-wrap: wrap;
      font-family: arial;
      color: white;
    }
    .charts_orb .orb {
      padding: 20px;
    }
    .charts_orb .orb .orb_graphic {
      position: relative;
    }
    .charts_orb .orb .orb_graphic .orb_value {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5em;
      font-weight: bold;
    }
    .charts_orb .orb .orb_label {
      text-transform: uppercase;
      text-align: center;
      margin-top: 1em;
    }
    .charts_orb svg {
      width: 110px;
      height: 110px;
    }
    .charts_orb svg circle {
      transform: rotate(-90deg);
      transform-origin: 50% 50%;
      stroke-dasharray: 314.16, 314.16;
      stroke-width: 2;
      fill: transparent;
      r: 50;
      cx: 55;
      cy: 55;
    }
    .charts_orb svg circle.fill {
      stroke: #d3d3d3;
    }
    .charts_orb svg circle.progress {
      stroke: #ff6b00;
      transition: stroke-dashoffset 0.35s;
      stroke-dashoffset: 214.16;
      -webkit-animation: NAME-YOUR-ANIMATION 1.5s forwards;
      -webkit-animation-timing-function: linear;
    }
    @-webkit-keyframes NAME-YOUR-ANIMATION {
      0% {
        stroke-dashoffset: 314.16;
      }
      100% {
        stroke-dashoffset: 0;
      }
    }

    .orb_label{
        color: #ffffff;
    }
    .orb_value{
        color: #ffffff;
    }
    </style>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('restaurant.left-menu')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
      @include('restaurant.top-menu')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Visites</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif

                      {{-- <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div> --}}
                    @foreach ($countries as $countryCode => $countryData)
                    <span style="display: flex; margin: 15px;">
                        <img src="{{ $countryData['flag'] }}" alt="{{ $countryData['name'] }}" style="width: 45px; height: 30px;">
                        <h2 style="display: inline;">{{$countryData['name']}}</h2>
                    </span>
                    <section class="charts_orb">
                        <article class="orb">
                            <div class="orb_graphic">
                                <svg>
                                    <circle class="fill"></circle>
                                    <circle class="progress"></circle>
                                </svg>
                                <div class="orb_value count">
                                    {{$countryData['today'] ?? 0}}
                                </div>
                            </div>
                            <div class="orb_label">
                                Ce Jour
                            </div>
                        </article>

                        <article class="orb">
                            <div class="orb_graphic">
                                <svg>
                                    <circle class="fill"></circle>
                                    <circle class="progress"></circle>
                                </svg>
                                <div class="orb_value count">
                                    {{ $countryData['week'] ?? 0 }}
                                </div>
                            </div>
                            <div class="orb_label">
                                Cette Semaine
                            </div>
                        </article>

                        <article class="orb">
                            <div class="orb_graphic">
                                <svg>
                                    <circle class="fill"></circle>
                                    <circle class="progress"></circle>
                                </svg>
                                <div class="orb_value count">
                                    {{ $countryData['year'] ?? 0 }}
                                </div>
                            </div>
                            <div class="orb_label">
                               Cette année
                            </div>
                        </article>


                    </section>
                    @endforeach
                  </div>
                </div>
              </div>
          </div>
          @include('footer')
        </div>
          </div>
       </div>
