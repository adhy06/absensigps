<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  @page { size: A4 
  }
  #title {
  font-family: Arial, Helvetica, sans-serif;
  font-size:16px;
  font-weight:bolt;
  }
  .tabeldatakaryawan {
    margin-top: 40px;
  }

  .tabeldatakaryawan tr td {
    padding: 5px;
  }
  .tabelpresensi {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
  }
  .tabelpresensi  tr th {
    border: 1px solid #000000;
    padding: 8px;
    background-color: aliceblue;
  }
  .tabelpresensi  tr td {
    border: 1px solid #000000;
    padding: 5px;
    font-size: 12px;
  }
  .foto {
    width: 50px;
    height: 50px;
  }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

@php
     function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }
@endphp
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{ asset('assets/img/ibs.png')}}" width="70" height="70" alt="">
            </td>
            <td>
                <span id="title">
                  PT. IMBONSO MEDIATECH<br>
                  LAPORAN ABSENSI KARYAWAN<br>
                  PERIODE BULAN {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                </span>
                <span><i><u>Alamat Perumahan Winong Pratama Boyolali</u></i></span> 
            </td>
        </tr>
    </table>
    <table class="tabeldatakaryawan">
      <tr>
        <td rowspan="6">
          @php
              $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
          @endphp
          <img src="{{ url($path)}}" alt="" width="120" height="170">
        </td>
      </tr>
      <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $karyawan->nik }}</td>
      </tr>
      <tr>
        <td>Nama Karyawan</td>
        <td>:</td>
        <td>{{ $karyawan->nama_lengkap }}</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $karyawan->jabatan }}</td>
      </tr>
      <tr>
        <td>Deprtemen</td>
        <td>:</td>
        <td>{{ $karyawan->nama_dept }}</td>
      </tr>
      <tr>
        <td>Nomor WA</td>
        <td>:</td>
        <td>{{ $karyawan->no_hp }}</td>
      </tr>
    </table>
    <table class="tabelpresensi">
      <tr>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Foto masuk</th>
        <th>Jam Pulang</th>
        <th>Foto Pulang</th>
        <th>Keterangan</th>
        <th>Jam Kerja</th>
      </tr>
      @foreach ($absensi as $d)
      @php
          $path_in = Storage::url('uploads/presensi/'.$d->foto_masuk);
          $path_out = Storage::url('uploads/presensi/'.$d->foto_pulang);
      @endphp
      <tr>
        <td>{{ $loop->iteration}}</td>
        <td>{{ date("d-m-Y",strtotime($d->tgl_absensi)) }}</td>
        <td>{{ $d->jam_masuk}}</td>
        <td>
          {{-- <img src="{{ url($path_in)}}" alt="" class="foto"> --}}
            @if ($d->jam_masuk != null)
              <img src="{{ url($path_in)}}" class="foto" alt="">
              @else
                <img src="{{ asset('assets/img/nofoto.png')}}" class="foto" alt="">
            @endif
        </td>
        <td>{{ $d->jam_pulang != null ? $d->jam_pulang : 'Tidak Absen'}}</td>
        <td>
          {{-- <img src="{{ url($path_in)}}" alt="" class="foto"> --}}
            @if ($d->jam_pulang != null)
              <img src="{{ url($path_out)}}" class="foto" alt="">
            @else
              <img src="{{ asset('assets/img/nofoto.png')}}" class="foto" alt="">
            @endif
        </td>
        <td>
          @if ($d->jam_masuk >= '08:00')
          @php
          $jamterlambat = selisih('08:00:00',$d->jam_masuk)
          @endphp
          <span class="badge bg-danger text-white">Terlambat {{ $jamterlambat }}</span>
          @else 
          <span class="badge bg-success text-white">Tepat Waktu</span>
          @endif   
        </td>
        <td>
          @if ($d->jam_pulang != null)
            @php
                $jmljamkerja = selisih($d->jam_masuk,$d->jam_pulang);
            @endphp
              @else
              @php
                $jmljamkerja = 0;
              @endphp
            {{ $jmljamkerja}}
          @endif
        </td>
      </tr>
      @endforeach
    </table>
    <table width="100%" style="margin-top: 100px">
      <tr>
        <td colspan="2" style="text-align: right">Boyolali, {{ date('d-m-Y')}}</td>
      </tr>
      <tr>
        <td style="text-align: center; vertical-align:bottom" height="100px">
          <u>Mas Joko</u><br>
          <i><b>HRD Manager</b></i>
        </td>
        <td style="text-align: center; vertical-align:bottom">
          <u>Mas Budi</u><br>
          <i><b>Direktur</b></i>
        </td>
      </tr>
    </table>
  </section>

</body>

</html>