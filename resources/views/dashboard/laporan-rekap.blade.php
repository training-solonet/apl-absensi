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
                            <form action="{{ route('laporan.show', 1) }}" method="GET">
                                <div class="row mb-3" style="margin-top: 3%">
                                    <div class="col-md-4">
                                        <label for="nama" class="form-label">Pilih Nama:</label>
                                        <select class="form-select" id="nama" name="nama">
                                            <option value="" selected disabled>{{ old('nama',$nama) }}</option>
                                            @foreach ($siswa as $siswa)
                                                <option  value="{{ $siswa->name }}">{{ $siswa->name }}</option required>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal_dari" class="form-label">Tanggal Dari:</label>
                                        <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari" value="{{$dari}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal_sampai" class="form-label">Tanggal Sampai:</label>
                                        <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai" value="{{$sampai}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-1"> 
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </form>
                                    </div>
                                    <div class="col-1" style="margin-left: -2%"> 
                                        <form action="{{ route('laporan.index') }}">
                                            <button type="submit" class="btn btn-warning">Kembali</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center justify-content-between">
                                        <p>Hadir : {{$hadir}}</p>
                                        <p>Terlambat : {{$terlambat}}</p>
                                        <p>Alfa : {{$alfa}}</p>
                                        <p>Ijin : {{$ijin}}</p>
                                    </div>
                                </div>
                            </div>
                          
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Tanggal Absen</th>
                                        <th>Keterangan</th>
                                        <th>Validasi</th></th>
                                        <!-- Tambahkan field lain yang ingin ditampilkan -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensis as $index => $absensi)
                                    <tr class="text-center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $absensi->tanggal }}</td>
                                        <td>{{ $absensi->keterangan }}</td>
                                        @if (auth()->user()->name == 'ConnectisJati' && ($absensi->keterangan == 'alfa' || $absensi->keterangan == ''))
                                            <td>
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#validationModal{{ $index }}">Validasi</button>
                                            </td>
                                        @else
                                            <td>
                                                <!-- Tombol tidak aktif karena tidak memenuhi kondisi -->
                                                <button class="btn btn-success" disabled>Validasi</button>
                                            </td>
                                        @endif
                                    </tr>
                                
                                    <!-- Modal untuk Form Validasi -->
                                    <div class="modal fade" id="validationModal{{ $index }}" tabindex="-1" aria-labelledby="validationModalLabel{{ $index }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="validationModalLabel{{ $index }}">Validasi Absensi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Tambahkan Form Validasi Sesuai Kebutuhan -->
                                                    <form method="POST" action="{{ route('laporan.update', $absensi->id) }}">
                                                    @method('put')
                                                       @csrf
                                                       <label for="txtuid" class="col-sm-3 col-form-label">Keterangan :</label>
                                                       <div class="row mb-3">
                                                        <div class="col-sm-4">
                                                          <select class="form-select form-select-sm" name="ket" id="ket">
                                                              <option value="" selected>-Pilih Keterangan-</option>
                                                              <option value="Panggilan Teknisi">Panggilan Teknisi</option>
                                                              <option value="Sakit">Sakit</option>
                                                              <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                                          </select>
                                                      </div>
                                                      </div>
                                              
                                                      <div class="row mb-3">
                                                        <div class="col-sm-6">
                                                          <button type="submit" class="btn btn-sm btn-success"  aria-label="Close">
                                                            Simpan
                                                          </button>
                                                        </div>
                                                      </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                            
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
