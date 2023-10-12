@extends('layout.admin.tabler')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <h2 class="page-title">
            Proses Persetujuan Pelanggan
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
                        <div class="row mt-2">
                            <div class="col-12">
                                {{-- <form action="/pelanggan/persetujuan" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" placeholder="Cari Nama Pelanggan" value="{{ Request('nama_pelanggan')}}">
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
                                </form> --}}


                                <form action="/pelanggan/persetujuan" method="GET" autocomplete="off">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-due" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                                    <path d="M16 3v4"></path>
                                                    <path d="M8 3v4"></path>
                                                    <path d="M4 11h16"></path>
                                                    <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                 </svg>
                                                </span>
                                                <input type="text" id="dari" name="dari" value="{{ Request('dari')}}" class="form-control" placeholder="Dari Tanggal">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-due" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                                    <path d="M16 3v4"></path>
                                                    <path d="M8 3v4"></path>
                                                    <path d="M4 11h16"></path>
                                                    <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                 </svg>
                                                </span>
                                                <input type="text" id="sampai" name="sampai" value="{{ Request('sampai')}}" class="form-control" placeholder="Sampai Tanggal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
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
                                                <input type="text" id="nik_ktp" name="nik_ktp" value="{{ Request('nik_ktp')}}" class="form-control" placeholder="NIK KTP">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-icon mb-3">
                                                <span class="input-icon-addon">
                                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                                 </svg>
                                                </span>
                                                <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ Request('nama_pelanggan')}}" class="form-control" placeholder="Nama Pelanggan">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <select name="status_approved" id="status_approved" class="form-select">
                                                    <option value="">Pilih Status</option>
                                                    <option value="0" {{ Request('status_approved') === '0' ? 'selected': '' }}>Pending</option>
                                                    <option value="1" {{ Request('status_approved') == 1 ? 'selected': ''}}>Disetujui</option>
                                                    <option value="2" {{ Request('status_approved') == 2 ? 'selected': ''}}>Ditolak</option>
                                                    <option value="3" {{ Request('status_approved') == 3 ? 'selected': ''}}>Identifikasi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                        <path d="M21 21l-6 -6"></path>
                                                     </svg>
                                                    Cari Data
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
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Whatsapp</th>
                                            <th>Tanggal</th>
                                            <th>Foto KTP</th>
                                            <th>Produk</th>
                                            <th>Foto Profil</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelanggan as $d)
                                        @php
                                            $pathktp = Storage::url('uploads/pelanggan/'.$d->foto_ktp);
                                            $pathprofil = Storage::url('uploads/pelanggan/'.$d->foto);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration + $pelanggan->firstItem()-1 }}</td>
                                            <td>{{ $d->nik_ktp}}</td>
                                            <td>{{ $d->nama_pelanggan}}</td>
                                            <td>{{ $d->no_hp}}</td>
                                            <td>{{ $d->tgl_daftar}}</td>
                                            <td>
                                                @if (empty($d->foto_ktp))
                                                   <img src="{{ asset('assets/img/nofoto.png')}}" class="avatar avatar-lg" alt="">
                                                   @else  
                                                    <img src="{{ url($pathktp)}}" class="avatar avatar-lg" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $d->nama_produk}}</td>
                                            <td>
                                                @if (empty($d->foto))
                                                   <img src="{{ asset('assets/img/nofoto.png')}}" class="avatar avatar-lg" alt="">
                                                   @else  
                                                    <img src="{{ url($pathprofil)}}" class="avatar avatar-lg" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->status_approved==1)
                                                    <span class="badge bg-success text-white">Disetujui</span>
                                                    @elseif($d->status_approved==2)
                                                    <span class="badge bg-danger text-white">Ditolak</span>
                                                    @elseif($d->status_approved==3)
                                                    <span class="badge bg-info text-white">Identifikasi</span>
                                                    @else
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->status_approved==0)
                                                <a href="" class="btn btn-sm bg-primary" id="approve" nik_ktp="{{ $d->nik_ktp }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                     </svg>
                                                     Periksa
                                                </a>
                                                @else
                                                <a href="/pelanggan/{{ $d->nik_ktp }}/batalkan" class="btn btn-sm bg-danger" id="cancel">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                        <path d="M10 10l4 4m0 -4l-4 4"></path>
                                                     </svg>
                                                     Batalkan
                                                    </a>
                                                @endif
                                                
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

{{-- Modal Show Map --}}
<div class="modal modal-blur fade" id="modal-persetujuan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pelanggan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/pelanggan/approvependaftaran" method="POST">
                    @csrf
                    <input type="hidden" id="id_persetujuan_form" name="id_persetujuan_form">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select name="status_approved" id="status_approved" class="form-select">
                                    <option value="1">Disetujui</option>
                                    <option value="2">Ditolak</option>
                                    <option value="3">Identifikasi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 14l11 -11"></path>
                                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                     </svg>
                                     Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
       $("#approve").click(function(e){
        e.preventDefault();
        var nik_ktp = $(this).attr("nik_ktp");
        $("#id_persetujuan_form").val(nik_ktp);
        $("#modal-persetujuan").modal("show");
       });

       $("#dari, #sampai").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });

    $("#tgl_izin").change(function(e) {
        var tgl_izin = $(this).val();
        alert(tgl_izin);
    });
    
  });
</script>
@endpush