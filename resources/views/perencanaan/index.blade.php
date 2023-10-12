@extends('layout.admin.tabler')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <h2 class="page-title">
            Data Perencanaan
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
                                <a href="#" class="btn btn-primary" id="btnTambahPerencanaan">
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
                                <form action="/perencanaan" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" placeholder="Cari Nama Karyawan" value="{{ Request('nama_karyawan')}}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                     </svg>Cari Karyawan
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
                                            <th>Kode Perencanaan</th>
                                            <th>Nama Perencanaan</th>
                                            <th>Tanggal</th>
                                            <th>Penjelasan</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($perencanaan as $d)
                                        @php
                                            $path = Storage::url('uploads/perencanaan/'.$d->foto);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration + $perencanaan->firstItem()-1 }}</td>
                                            <td>{{ $d->kode_perencanaan}}</td>
                                            <td>{{ $d->judul_perencanaan}}</td>
                                            <td>{{ date('d-m-Y', strtotime($d->tgl_perencanaan)) }}</td>
                                            <td>{{ $d->isi_perencanaan}}</td>
                                            <td>
                                                @if (empty($d->foto))
                                                   <img src="{{ asset('assets/img/nofoto.png')}}" class="avatar avatar-lg" alt="">
                                                   @else  
                                                    <img src="{{ url($path)}}" class="avatar avatar-lg" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">

                                                    <div class="col-3 col-sm-4 col-md-2 col-xl-auto py-3" >
                                                        <a href="#" kode_perencanaan="{{ $d->kode_perencanaan }}" class="edit btn btn-tabler w-100 btn-icon" aria-label="Tabler">
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
                                                        <form action="/perencanaan/{{ $d->kode_perencanaan }}/delete" method="POST" style="margin-left: 5px">
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
                                {{ $perencanaan->links('vendor.pagination.bootstrap-5')}}
                            </div>
                            </div>
                        </div>     
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Data Modals Input Perencanaan --}}
<div class="modal modal-blur fade" id="modal-inputperencanaan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Perencanaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/perencanaan/store"  method="POST" id="frmPerencanaan" enctype="multipart/form-data">
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
                            <input type="text" id="kode_perencanaan" name="kode_perencanaan" value="" class="form-control" placeholder="NIK (Nomor Induk Karyawan)">
                          </div>

                          <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-producthunt" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 16v-8h2.5a2.5 2.5 0 1 1 0 5h-2.5"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                             </svg>
                            </span>
                            <input type="text" id="judul_perencanaan" name="judul_perencanaan" value="" class="form-control" placeholder="Judul Jerencanaan">
                          </div>

                          <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-due" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                <path d="M16 3v4"></path>
                                <path d="M8 3v4"></path>
                                <path d="M4 11h16"></path>
                                <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                             </svg>
                            </span>
                            <input type="text" id="tgl_perencanaan" name="tgl_perencanaan" value="" class="form-control datepicker" placeholder="Tanggal Perencanaan">
            
                          </div>

                          <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                <path d="M3 6l0 13"></path>
                                <path d="M12 6l0 13"></path>
                                <path d="M21 6l0 13"></path>
                             </svg>
                            </span>
                            <textarea class="form-control" name="isi_perencanaan" id="isi_perencanaan" cols="10" rows="5" placeholder="Isi Perencanaan"></textarea>
            
                          </div>
                        </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
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
                                             Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
        </div>
      </div>
    </div>
</div>


  {{-- Edit Input Karyawan --}}
<div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Karyawan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">

        </div>
        </div>
    </div>
</div>

@endsection

@push('myscript')
<script>
    $(function(){
        $("#btnTambahPerencanaan").click(function(){
            $("#modal-inputperencanaan").modal("show");
        });
    });
    var currYear = (new Date()).getFullYear();

    $(document).ready(function() {
        $(".datepicker").datepicker({
            
            format: "yyyy-mm-dd"    
        });

    $("#frmPerencanaan").submit(function() {
        var kode_perencanaan    = $("#kode_perencanaan").val();
        var judul_perencanaan      = $("#judul_perencanaan").val();
        var tgl_perencanaan  = $("#tgl_perencanaan").val();
        var isi_perencanaan  = $("#isi_perencanaan").val();
        if (kode_perencanaan == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Kode Perencanaan Harus Di Isi',
                icon: 'Warning',
            });  
            return false;         
        } else if (judul_perencanaan == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Judul Harus Di Isi',
                icon: 'Warning',
            }); 
            return false; 
        } else if (tgl_perencanaan == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Tanggal Harus Di Isi',
                icon: 'Warning',
            }); 
            return false; 
        } else if (isi_perencanaan == "") {
            Swal.fire({
                title: 'Oops !',
                text: 'Isi Perencanaan Harus Di Isi',
                icon: 'Warning',
            }); 
            return false; 
        }
    
    });
});

</script>   
@endpush