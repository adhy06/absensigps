@extends('layout.home.thome')

<!-- Header -->
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    
<div class="appHeader bg-primary text-light">
    <div class="pageTitle">Produk Penawaran Kami</div>
    <div class="right"></div>
</div>
@endsection   
<!-- End Header -->

<!-- Content -->
@section('content')

<div class="row" style="margin-top: 4rem">
    <div class="col-12">
        <div class="container-xl">
            <div class="row row-cards">
              <div class="col-sm-6 col-lg-3">
                <div class="card card-md">
                    <div class="ribbon ribbon-top ribbon-bookmark bg-yellow ">
                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                      </div>
                  <div class="card-body text-center">
                    <div class="text-uppercase text-secondary font-weight-medium fw-bold">Mangga</div>
                    <div class="display-5 fw-bold my-3">10 Mb</div>
                    <ul class="list-unstyled lh-lg">
                      <li>Rp. <strong>150.000</strong></li><br>
                      <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        Biaya Pemasangan
                      </li>
                      <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        Penanganan Cepat
                      </li>
                    </ul>
                    <div class="text-center mt-4">
                      <a href="mangga" class="btn w-100 {{ request()->is('mangga') ? 'btn-green' : '' }} ">Pesan Sekarang</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card card-md">
                  <div class="ribbon ribbon-top ribbon-bookmark bg-purple">
                    <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                  </div>
                  <div class="card-body text-center">
                    <div class="text-uppercase text-secondary font-weight-medium">Anggur</div>
                    <div class="display-5 fw-bold my-3">20 Mb</div>
                    <ul class="list-unstyled lh-lg">
                        <li>Rp. <strong>200.000</strong></li><br>
                        <li>
                          <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                          Biaya Pemasangan
                        </li>
                        <li>
                          <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                          Penanganan Cepat
                        </li>
                    </ul>
                    <div class="text-center mt-4">
                      <a href="/anggur" class="btn w-100  {{ request()->is('anggur') ? 'btn-green' : '' }} ">Pesan Sekarang </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card card-md">
                    <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                      </div>
                  <div class="card-body text-center">
                    <div class="text-uppercase text-secondary font-weight-medium fw-bold">Apel</div>
                    <div class="display-5 fw-bold my-3">30 Mb</div>
                    <ul class="list-unstyled lh-lg">
                      <li>Rp. <strong>250.000</strong></li><br>
                      <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        Biaya Pemasangan
                      </li>
                      <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        Penanganan Cepat
                      </li>
                    </ul>
                    <div class="text-center mt-4">
                      <a href="apel" class="btn w-100 {{ request()->is('apel') ? 'btn-green' : '' }} ">Pesan Sekarang</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="card card-md">
                    <div class="ribbon ribbon-top ribbon-bookmark bg-orange">
                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                      </div>
                  <div class="card-body text-center">
                    <div class="text-uppercase text-secondary font-weight-medium fw-bold">Durian</div>
                    <div class="display-5 fw-bold my-3">50 Mb</div>
                    <ul class="list-unstyled lh-lg">
                      <li>Rp. <strong>400.000</strong></li><br>
                      <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        Biaya Pemasangan
                      </li>
                      <li>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        Penanganan Cepat
                      </li>
                    </ul>
                    <div class="text-center mt-4">
                      <a href="/durian" class="btn w-100 {{ request()->is('durian') ? 'btn-green' : '' }} ">Pesan Sekarang</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card card-md">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <h2 class="h3">Silahkan Hubungi Admin untuk menanyakan terkait pemasangan dan biaya.</h2>
                        </div>
                      <div class="col-auto">
                        <a target="blank" href="https://api.whatsapp.com/send?phone=6287709193076&text=Halo%20Admin%20Saya%20Mau%20Bertanya!!" class="btn btn-danger">
                          Hubungi Admin
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>


<div class="row" style="margin-top: 2rem">
  <div class="col-12">
      <div class="container-xl">
          <div class="card">
              <div class="card-title text-center" style="margin-top: 1rem">

              </div>
          </div>
      </div>
  </div>
</div>


@endsection