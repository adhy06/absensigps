<form action="/pelanggan/{{ $pelanggan->nik_ktp }}/update"  method="POST" id="loadeditform" enctype="multipart/form-data">
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
                <input type="text" id="nik_ktp" name="nik_ktp" readonly value="{{ $pelanggan->nik_ktp }}" class="form-control" placeholder="NIK KTP">
            </div>

            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                </span>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" class="form-control" placeholder="Nama Lengkap">
            </div>

            <div class="input-icon mb-3">
              <span class="input-icon-addon">
                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                  <path d="M15 6h6m-3 -3v6"></path>
               </svg></span>
              <input type="text" id="no_hp" name="no_hp" value="{{ $pelanggan->no_hp }}" class="form-control" placeholder="Nama Lengkap">
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
              <input type="text" id="tgl_daftar" name="tgl_daftar" value="{{ $pelanggan->tgl_daftar }}" class="form-control datepicker" placeholder="Tanggal Izin" autocomplete="off">
            </div>
            
            <div class="row mt-2">
              <div class="col-12">
                  <input type="file" name="foto_ktp" class="form-control">
                  <input type="hidden" name="old_foto_ktp" value="{{ $pelanggan->foto_ktp }}">
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-12">
                <select name="kode_produk" class="form-select" id="kode_produk">
                    <option value="">Produk</option>
                    @foreach ($produk as $d)
                    <option {{ $pelanggan->kode_produk == $d->kode_produk ? 'selected' : '' }} value="{{ $d->kode_produk}}">{{ $d->nama_produk}}</option>
                    @endforeach
                </select>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-12">
                  <input type="file" name="foto" class="form-control">
                  <input type="hidden" name="old_foto" value="{{ $pelanggan->foto }}">
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
        </div>
    </div>
</form>


<script>
  var currYear = (new Date()).getFullYear();

$(document).ready(function() {
  $(".datepicker").datepicker({
      
      format: "yyyy-mm-dd"    
  });
});
</script>