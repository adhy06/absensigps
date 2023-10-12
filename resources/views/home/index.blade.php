@extends('layout.home.thome')

<!-- Header -->
@section('header')
   
{{-- <div class="appHeader bg-primary text-light">
    <div class="pageTitle">Halaman Utama</div>
    <div class="right"></div>
</div> --}}
@endsection   
<!-- End Header -->

<!-- Content -->
@section('content')
<div class="row" style="margin-top: 1rem">
  <div class="col-lg-12">
      <div class="card">
        <div class="pageTitle text-center">Wilayah Pengembangan</div>
      </div>
  </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d40730.01114686115!2d110.54634812366099!3d-7.521066893526232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1696768176227!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
</div>





@endsection