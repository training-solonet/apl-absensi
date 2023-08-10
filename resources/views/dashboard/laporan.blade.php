@extends('layouts.home')
@section('content')
    
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Laporan Absensi</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card" style="margin-right: -1%">
                        <div class="card-body">
                            <h4 class="card-title">Data Absensi</h4>
                            @php
                                Session_start();
                            @endphp
                            <form action="{{ url('/laporan/cari.store') }}" method="GET">
                                <div class="row mb-3" style="margin-top: 3%">
                                    <div class="col-md-4">
                                        <label for="nama" class="form-label">Pilih Nama:</label>
                                        <select class="form-select" id="nama" name="nama">
                                            <option value="">Pilih Nama</option>
                                            @foreach ($siswaList as $siswa)
                                                <option value="{{ $siswa->name }}">{{ $siswa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal_dari" class="form-label">Tanggal Dari:</label>
                                        <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal_sampai" class="form-label">Tanggal Sampai:</label>
                                        <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-bottom: 2%">Filter</button>
                            </form>
                          <div class="table-responsive">
                            <table id="datatable" class="table table-bordered border-dark">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2" style="vertical-align: middle;">No</th>
                                        <th rowspan="2" colspan="2" style="vertical-align: middle; width:2%;">Nama</th>
                                        @foreach ($date as $data)
                                            <th colspan="2">{{ $data }}</th>
                                        @endforeach
                                    </tr>
                                    <tr class="text-center">
                                        @foreach ($date as $data)
                                            <td>Datang</td>
                                            <td>Pulang</td>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1; // Variabel untuk increment angka
                                    @endphp
                                  @foreach ($absen as $data)
                                  <tr class="text-center">
                                      <td rowspan="2" style="vertical-align: middle;">{{ $no++ }}</td>
                                      <td colspan="2" style="vertical-align: middle">{{ $data->name }}</td>
                                            @foreach ($data->absensi as $monday)
                                            @php
                                                $waktuMasuk = strtotime($monday->waktu_masuk);
                                                $waktuKeluar = strtotime($monday->waktu_keluar);
                                            @endphp
                                            @if ($waktuMasuk)
                                                <td>{{ date('H:i:s', $waktuMasuk) }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if ($waktuKeluar)
                                                <td>{{ date('H:i:s', $waktuKeluar) }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                        @endforeach
                                        @php
                                            $menghitungkolom = 12 - count($data->absensi) * 2; // jumlah dapul - jumlah data *2
                                        @endphp
                                        @for ($i = 0; $i < $menghitungkolom; $i++)
                                            <td></td>
                                        @endfor
                                    </tr>
                                  <tr class="text-center">
                                      <td colspan="2">Keterangan</td>
                                      @foreach ($data->absensi as $monday)
                                        @php
                                            $keteranganClass = '';
                                            switch ($monday->keterangan) {
                                                case 'Terlambat':
                                            $keteranganClass = 'table-warning';
                                                break;
                                            case 'Hadir':
                                            $keteranganClass = 'table-success';
                                                break;
                                            case 'alfa':
                                            $keteranganClass = 'table-danger';
                                                break;
                                            default:
                                                $keteranganClass = '';
                                                break;
                                            }
                                        @endphp                               
                                        <td colspan="2" class="{{ $keteranganClass }}">{{ $monday->keterangan }}</td>
                                    @endforeach
                                      {{-- Add columns for "Keterangan" here if needed --}}
                                  </tr>
                              @endforeach
                                </tbody>
                            </table>
                          </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
@section('js')
@endsection
