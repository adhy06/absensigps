@extends('layout.absensi')

<!-- Header -->
@section('header')
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Buat Izin</div>
    <div class="right"></div>
</div>
@endsection   
<!-- End Header -->

<!-- Content -->
@section('content')

<div class="row" style="margin-top: 4rem">
    {{-- <div class="col">
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
        @endphp

        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ $messagesuccess }}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-danger">
                {{ $messageerror }}
            </div>
        @endif
    </div>   --}}
</div>

<form action="/absensi/storeizin" method="POST" enctype="multipart/form-data" id="formizin" autocomplete="off">
    @csrf
    <div class="col">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" id="datepicker" name="tgl_izin" value="" class="form-control datepicker" placeholder="Tanggal Izin" required>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <select class="form-control" value="" name="status" placeholder="Pilih Status Izin" required>
                    <option value=""> Izin / Sakit</option>
                    <option value="i">Izin</option>
                    <option value="s">Sakit</option>
                </select>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <textarea class="form-control" name="keterangan" id="keterangan" cols="10" rows="5" placeholder="Isi Keterangan" required></textarea>
            </div>
        </div>
        {{-- <div class="custom-file-upload" id="fileUpload1">
            <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg,">
            <label for="fileuploadInput">
                <span>
                    <strong>
                        <ion-icon name="cloud-upload-outline" role="img" class="md hydrated" aria-label="cloud upload outline"></ion-icon>
                        <i>Upload Dokumen yang dibutuhkan</i>
                    </strong>
                </span>
            </label>
        </div> --}}
            <div class="input-wrapper">
                <button type="submit" class="btn btn-primary btn-block">
                    <ion-icon name="save-outline"></ion-icon> Kirim
                </button>
        </div>
    </div>
</form>

<script>
    $("#formizin").submit(function() {

    })
</script>

@endsection