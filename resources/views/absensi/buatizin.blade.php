@extends('layout.absensi')

<!-- Header -->
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    
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
    <div class="col">
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
    </div>  
</div>

<form action="/absensi/storeizin" method="POST" id="frmIzin" autocomplete="off">
    @csrf
    <div class="col">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" id="tgl_izin" name="tgl_izin" value="" class="form-control datepicker" placeholder="Tanggal Izin">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <select class="form-control" value="" name="status" id="status">
                    <option value=""> Izin / Sakit</option>
                    <option value="i">Izin</option>
                    <option value="s">Sakit</option>
                </select>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <textarea class="form-control" name="keterangan" id="keterangan" cols="10" rows="5" placeholder="Isi Keterangan"></textarea>
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




@endsection

@push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

    $(document).ready(function() {
        $(".datepicker").datepicker({
            
            format: "yyyy-mm-dd"    
        });

    $("#frmIzin").submit(function() {
        var tgl_izin    = $("#tgl_izin").val();
        var status      = $("#status").val();
        var keterangan  = $("#keterangan").val();
        if (tgl_izin == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Tanggal Harus Di Isi',
                icon: 'Warning',
            });  
            return false;         
        } else if (status == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Status Harus Di Isi',
                icon: 'Warning',
            }); 
            return false; 
        } else if (keterangan == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Keterangan Harus Di Isi',
                icon: 'Warning',
            }); 
            return false; 
        }
    });
});

</script>   
@endpush