@extends('layouts.home')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Jumlah Siswa PKL</p>
                                            @php
                                                $jumlahsiswa = DB::connection('mysql2')->table('students')->where('status', '=', 'Aktif')->count()
                                            @endphp
                                            <h4 class="mb-0">{{ $jumlahsiswa }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                                      </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Hadir</p>
                                            @php
                                                $tanggalHariIni = date('Y-m-d');
                                                $jumlahhadir = DB::connection('mysql')->table('absen')->where('waktu_masuk', 'LIKE', $tanggalHariIni . '%')
                                                                                                    ->whereNotNull('waktu_masuk')
                                                                                                    ->count();
                                            @endphp
                                            <h4 class="mb-0">{{ $jumlahhadir }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-archive-in font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Belum/Tidak Hadir</p>
                                            @php
                                                 $tidakhadir = DB::connection('mysql2')->table('students')->where('status', '=', 'Aktif')->count() -
                                                                DB::connection('mysql')->table('absen')->where('waktu_masuk', 'LIKE', $tanggalHariIni . '%')
                                                                                                    ->whereNotNull('waktu_masuk')
                                                                                                    ->count();
                                            @endphp
                                            <h4 class="mb-0">{{ $tidakhadir }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Table Riwayat Absen</h4>
                                    <p class="card-title-desc">Tabel ini merecap data asben selama 1 minggu</p>

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2" style="vertical-align: middle;">No</th>
                                                <th rowspan="2" colspan="2" style="vertical-align: middle;">Nama</th>
                                                <th colspan="2"></th>
                                                <th colspan="2"></th>
                                                <th colspan="2"></th>
                                                <th colspan="2"></th>
                                                <th colspan="2"></th>
                                                <th colspan="2"></th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>Datang</th>
                                                <th>Pulang</th>
                                                <th>Datang</th>
                                                <th>Pulang</th>
                                                <th>Datang</th>
                                                <th>Pulang</th>
                                                <th>Datang</th>
                                                <th>Pulang</th>
                                                <th>Datang</th>
                                                <th>Pulang</th>
                                                <th>Datang</th>
                                                <th>Pulang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td rowspan="2" style="vertical-align: middle;">1</td>
                                                <td colspan="2">Leo Putra Pratama</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="text-center">
                                                <td colspan="2">Keterangan</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                
                                            </tr>
                                            <!-- Add more rows here if needed -->
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row --> --}}
                </div>
            
            <!-- end row -->


            <!-- end row -->


            <!-- end row -->
        
        <!-- container-fluid -->
    @php
        $today = now()->toDateString();
        $siswaTerlambat = DB::connection('mysql')
                                ->table('absen')
                                ->join('students', 'absen.id_siswa', '=', 'students.id')
                                ->select('students.name', 'absen.waktu_masuk')
                                ->where('absen.keterangan', 'Terlambat')
                                ->whereDate('absen.waktu_masuk', $today)
                                ->get();
    @endphp
    <div class="container mt-5">
        @if($siswaTerlambat->count() > 0)
        <div class="row row-cols-3">
            @foreach($siswaTerlambat as $lateStudent)
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            </svg>
                        </div>
                        <div>
                            <h5 class="card-title">{{ $lateStudent->nama }}</h5>
                            <p class="card-text text-danger text-size-large">Terlambat Hari Ini</p>
                            {{-- <p class="card-text">Datang jam : {{ $lateStudent->waktu_masuk}}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col text-center">
                <p>Tidak ada siswa yang terlambat hari ini.</p>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
    <!-- End Page-content -->
@endsection
@section('js')
@endsection
