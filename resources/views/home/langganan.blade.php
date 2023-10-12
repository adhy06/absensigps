@extends('layout.home.thome')

<!-- Header -->
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    
<div class="appHeader bg-primary text-light">
    <div class="pageTitle">Langganan</div>
    <div class="right"></div>
</div>
@endsection   
<!-- End Header -->

<!-- Content -->
@section('content')
<div class="page-body" style="margin-top: 4rem">
    <div class="container-xl">
        <div class="row row-cards">
        <div class="col-12">
            <div class="col-md-12">
                @if (Session::get('success'))
                <div class="alert alert-success" >
                    {{ Session::get('success') }}
                </div>                                    
            @endif
            @if (Session::get('warning'))
                <div class="alert alert-warning" >
                    {{ Session::get('warning') }}
                </div>                                    
            @endif
        <form action="/home/storepelanggan"  method="POST" id="frmPelanggan" enctype="multipart/form-data">
                    @csrf
                <div class="card-header">
                    <h3 class="card-title">Pendaftaran Pelanggan</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">NIK</label>
                        <div class="col">
                            <input type="text" id="nik_ktp" name="nik_ktp" class="form-control" placeholder="Isikan NIK KTP" autocomplete="off">
                        </div>  
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required" >Nama Lengkap</label>
                        <div class="col">
                            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Isikan Nama Lengkap" autocomplete="off">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Nomor Whatsapp</label>
                        <div class="col">
                            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Isikan Nomor Whatsapp" autocomplete="off">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Tanggal Pendaftaran</label>
                        <div class="col">
                            <input type="text" id="tgl_daftar" name="tgl_daftar" value="" class="form-control datepicker" placeholder="Tanggal Izin" autocomplete="off">
                    </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Foto KTP</label>
                        <div class="col">
                            <input type="file" name="foto_ktp" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Pilih Produk</label>
                        <div class="col">
                                <select name="kode_produk" class="form-select" id="kode_produk">
                                    <option value="">Produk</option>
                                    @foreach ($produk as $d)
                                    <option {{ Request('kode_produk')==$d->kode_produk ? 'selected' : '' }} value="{{ $d->kode_produk}}">{{ $d->nama_produk}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Foto Profil</label>
                        <div class="col">
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    
                    
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>

            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

    $(document).ready(function() {
        $(".datepicker").datepicker({
            
            format: "yyyy-mm-dd"    
        });
});

</script>   
@endpush