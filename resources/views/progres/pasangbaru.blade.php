@extends('layout.admin.tabler')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <h2 class="page-title">
            Data Pasang Baru
          </h2>
        </div>
      </div>
    </div>
  </div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahPelanggan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M16 19h6"></path>
                                        <path d="M19 16v6"></path>
                                     </svg>
                                    Tambah Data
                                  </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/progres/pasangbaru" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nik_ktp" id="nik_ktp" class="form-control" placeholder="Cari Nama Pelanggan" value="{{ Request('nama_lengkap')}}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                     </svg>Cari Pelanggan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row  mt-3">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Karyawan</th>
                                            <th>Approve</th>
                                            <th>Status</th>
                                            <th>Tanggal Pasang</th>
                                            <th>Dokumentasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelanggan as $d)
                                        {{-- @php
                                            $pathktp = Storage::url('uploads/pelanggan/'.$d->foto_ktp);
                                        @endphp --}}
                                        <tr>
                                            <td>{{ $loop->iteration + $pelanggan->firstItem()-1 }}</td>
                                            <td>{{ $d->nama_pelanggan}}</td>
                                            <td>{{ $d->nama_lengkap}}</td>
                                            <td>{{ $d->no_hp}}</td>
                                            <td>{{ $d->nama_produk}}</td>
                                            <td>
                                                {{-- @if (empty($d->foto))
                                                   <img src="{{ asset('assets/img/nofoto.png')}}" class="avatar avatar-lg" alt="">
                                                   @else  
                                                    <img src="{{ url($pathprofil)}}" class="avatar avatar-lg" alt="">
                                                @endif --}}
                                            </td>
                                            <td>
                                                <div class="btn-group">

                                                    <div class="col-3 col-sm-4 col-md-2 col-xl-auto py-3" >
                                                        <a href="#" nik_ktp="{{ $d->nik_ktp }}" class="edit btn btn-tabler w-100 btn-icon" aria-label="Tabler">
                                                          <!-- Download SVG icon from http://tabler-icons.io/i/brand-tabler -->
                                                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                         </svg>
                                                        </a>
                                                      </div>
                                                      <div class="col-3 col-sm-4 col-md-2 col-xl-auto py-3" >
                                                        <form action="/pelanggan/{{ $d->nik_ktp }}/delete" method="POST" style="margin-left: 5px">
                                                            @csrf
                                                            <a class="btn btn-danger w-100 btn-icon delete-confirm" aria-label="Tabler">
                                                                <!-- Download SVG icon from http://tabler-icons.io/i/brand-tabler -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M10 11l0 6"></path>
                                                                    <path d="M14 11l0 6"></path>
                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                 </svg>
                                                              </a>
                                                        </form>
                                                      </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $pelanggan->links('vendor.pagination.bootstrap-5')}}
                            </div>
                            </div>
                        </div>     
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Data Modals Input Pelanggan --}}
<div class="modal modal-blur fade" id="modal-inputpelanggan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/pelanggan/store"  method="POST" id="frmPelanggan" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                                    <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                                    <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M5 11h1v2h-1z"></path>
                                    <path d="M10 11l0 2"></path>
                                    <path d="M14 11h1v2h-1z"></path>
                                    <path d="M19 11l0 2"></path>
                                </svg>
                            </span>
                            <input type="text" id="nik_ktp" name="nik_ktp" value="" class="form-control" placeholder="NIK KTP" autocomplete="off">
                        </div>

                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                <path d="M15 6h6m-3 -3v6"></path>
                             </svg>
                            </span>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="" class="form-control" placeholder="Nama Lengkap" autocomplete="off">
                        </div>

                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                <path d="M15 6h6m-3 -3v6"></path>
                             </svg>
                            </span>
                            <input type="text" id="no_hp" name="no_hp" value="" class="form-control" placeholder="Nomor Whatsapp" autocomplete="off">
                        </div>

                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-bolt" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M13.5 21h-7.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5"></path>
                                <path d="M16 3v4"></path>
                                <path d="M8 3v4"></path>
                                <path d="M4 11h16"></path>
                                <path d="M19 16l-2 3h4l-2 3"></path>
                             </svg>
                            </span>
                            <input type="text" id="tgl_daftar" name="tgl_daftar" value="" class="form-control datepicker" placeholder="Tanggal Izin" autocomplete="off">
                        </div>

                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 12h3v4h-3z"></path>
                                <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6"></path>
                                <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                                <path d="M14 16h2"></path>
                                <path d="M14 12h4"></path>
                             </svg>
                            </span>
                            <input type="file" name="foto_ktp" class="form-control">
                        </div>

                        <div class="input-icon mb-3">
                            <div class="col-12">
                                
                                <div class="col-md-11">
                                    <select name="kode_produk" class="form-select" id="kode_produk">
                                        <option value="">Pilih Produk</option>
                                        @foreach ($produk as $d)
                                        <option {{ Request('kode_produk')==$d->kode_produk ? 'selected' : '' }} value="{{ $d->kode_produk}}">{{ $d->nama_produk}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M17 17h-11v-14h-2"></path>
                                        <path d="M6 5l14 1l-1 7h-13"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 8h.01"></path>
                                <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z"></path>
                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path>
                                <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path>
                             </svg>
                            </span>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 14l11 -11"></path>
                                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                    </svg>
                                        Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>


  {{-- Edit Input Karyawan --}}
<div class="modal modal-blur fade" id="modal-editpelanggan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">
            

        </div>
        </div>
    </div>
</div>

@endsection

@push('myscript')
{{-- <script src="{{ asset('tabler/dist/js/tabler.min.js?1692870487')}}" defer></script>
<script src="{{ asset('tabler/dist/js/demo.min.js?1692870487')}}" defer></script> --}}

<script>
    $(function(){
        $("#btnTambahPelanggan").click(function(){
            $("#modal-inputpelanggan").modal("show");
        });

        $(".edit").click(function(){
            var nik_ktp = $(this).attr('nik_ktp');
            $.ajax({
                type    :'POST',
                url     :'/pelanggan/edit',
                cache   :false,
                data    : {
                        _token  : "{{ csrf_token(); }}",
                        nik_ktp     : nik_ktp
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editpelanggan").modal("show");
        });

        $(".delete-confirm").click(function(e){
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
                title: 'Yakin Hapus Data ini?',
                text: "Jika Ya Data Akan Terhapus Permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data ini !'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                    'Deleted!',
                    'Data Berhasil Di Hapus',
                    'success'
                    )
                }
                })
        });

    $("#frmPelanggan").submit(function(){
        var nik_ktp         = $("#nik_ktp").val();
        var nama_lengkap            = $("#nama_lengkap").val();
        var no_hp           = $("#no_hp").val();
        var tgl_daftar           = $("#tgl_daftar").val();
        var kode_produk       = $("frmPelanggan").find("#kode_produk").val();
        if (nik_ktp ==""){
            Swal.fire({
                title: 'warning!',
                text: 'NIK KTP Harus Diisi !',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return false;
        // } else if (nama_lengkap ==""){
        //     Swal.fire({
        //         title: 'warning!',
        //         text: 'Nama Harus Diisi !',
        //         icon: 'warning',
        //         confirmButtonText: 'OK'
        //     }).then((result) => {
        //          $("#nama_lengkap").focus();
        //     });
        //     return false;
        } else if (no_hp==""){
            Swal.fire({
                title: 'warning!',
                text: 'Nomor Handphone Harus Diisi !',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then((result) => {
                 $("#no_hp").focus();
            });
            return false;
        } else if (tgl_daftar==""){
            Swal.fire({
                title: 'warning!',
                text: 'Tanggal Harus Diisi !',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then((result) => {
                 $("#tgl_daftar").focus();
            });
            return false;
        } else if (kode_produk ==""){
            Swal.fire({
                title: 'warning!',
                text: 'Produk Harus Diisi !',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then((result) => {
                 $("#kode_produk").focus();
            });
            return false;
        }

    });

});

</script>
<script>
    var currYear = (new Date()).getFullYear();

$(document).ready(function() {
    $(".datepicker").datepicker({
        
        format: "yyyy-mm-dd"    
    });
});
</script>
@endpush