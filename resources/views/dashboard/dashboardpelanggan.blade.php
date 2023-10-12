@extends('layout.pelanggan.pelanggan')
@section('content')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css"> --}}
<link href="{{ asset('assets/dist/css/tabler.min.css?1692870487')}} " rel="stylesheet"/>
    <link href="{{ asset('assets/dist/css/tabler-flags.min.css?1692870487')}} " rel="stylesheet"/>
    <link href="{{ asset('assets/dist/css/tabler-payments.min.css?1692870487')}} " rel="stylesheet"/>
    <link href="{{ asset('assets/dist/css/tabler-vendors.min.css?1692870487')}} " rel="stylesheet"/>
    <link href="{{ asset('assets/dist/css/demo.min.css?1692870487')}} " rel="stylesheet"/>

<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            @if (!@empty(Auth::guard('pelanggan')->user()->foto))
            @php
                $path = Storage::url('uploads/pelanggan/'.Auth::guard('pelanggan')->user()->foto);   
            @endphp
            <img src="{{ url($path)}}" alt="avatar" class="imaged w64" style="height: 60px absolut">
            @else
            <img src="{{ asset('/assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar" class="imaged w64 rounded">
            @endif
            
        </div>
        <div id="user-info">
            <h2 id="user-role">{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</h2>
            <span id="user-name">{{ Auth::guard('pelanggan')->user()->nik_ktp }}</span>
        </div>
        
    </div>
</div>

<div class="section" id="menu-section">
  <div class="card">
    <div class="card-body">
      <div class="list-menu">
        <div class="col-8 col-sm-6 text-start">
          <span class="avatar avatar-sm" style="background-image: url({{ asset('/assets/img/login.png') }})"></span>
            IMBONSO - {{ $pelanggan->kapasitas}}           
        </div>
        <div class="col-auto align-self-center">
          <div class="badge {{ $pelanggan->keaktifan < "Online" ? "bg-danger" : "bg-success"}}"></div>
          {{ $pelanggan->keaktifan}} 
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row" style="margin-top: 2.5rem">
    <div class="col-12">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-6 col-sm-6">
            <button class="btn btn-danger w-100">Gangguan</button>
          </div>
          <div class="col-6 col-sm-6">
            <button class="btn btn-danger w-100">Gangguan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row" style="margin-top: 1rem">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
          <p class="text-bold">Penawaran Kami</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-6 col-sm-6">
            <div class="card card-md">
              <img src="{{ asset('/assets/img/produk/mangga.png') }}">
            </div>
          </div>
          <div class="col-6 col-sm-6">
            <div class="card card-md">
              <img src="{{ asset('/assets/img/produk/anggur.png') }}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row" style="margin-top: 1rem">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
          <h4>Penawaran Khusu</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-6 col-sm-6">
            <div class="card card-md">
              <img src="{{ asset('/assets/img/produk/apel.png') }}">
            </div>
          </div>
          <div class="col-6 col-sm-6">
            <div class="card card-md">
              <img src="{{ asset('/assets/img/produk/durian.png') }}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row" style="margin-top: 2rem">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
          <h4>Info Terkini</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card" style="height: 28rem">
        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
          <div class="divide-y">

            <div>
              <div class="row">
                <div class="col-auto">
                  <span class="avatar" style="background-image: url(./static/avatars/002m.jpg)"></span>
                </div>
                <div class="col">
                  <div class="text-truncate">
                    It's <strong>Mallory Hulme</strong>'s birthday. Wish him well!
                  </div>
                  <div class="text-secondary">2 days ago</div>
                </div>
                <div class="col-auto align-self-center">
                  <div class="badge bg-primary"></div>
                </div>
              </div>
            </div>
            
            <div>
              <div class="row">
                <div class="col-auto">
                  <span class="avatar" style="background-image: url(./static/avatars/009m.jpg)"></span>
                </div>
                <div class="col">
                  <div class="text-truncate">
                    <strong>Geoffry Flaunders</strong> made a <strong>$10</strong> donation.
                  </div>
                  <div class="text-secondary">2 days ago</div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container" style="margin-top: 8rem">
  <div class="row">
    <div class="col-12">
      --------
    </div>
  </div>
</div>

@endsection