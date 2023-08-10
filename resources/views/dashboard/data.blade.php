@extends('layouts.home')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Data Siswa</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            {{-- <div class="row">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Orders</p>
                                            <h4 class="mb-0">1,235</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-copy-alt font-size-24"></i>
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
                                            <p class="text-muted fw-medium">Revenue</p>
                                            <h4 class="mb-0">$35, 723</h4>
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
                                            <p class="text-muted fw-medium">Average Price</p>
                                            <h4 class="mb-0">$16.2</h4>
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
                    <!-- end row --> --}}

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    {{-- <form action="{{ route('students.index') }}" method="GET" class="mb-3">
                                        <div class="col-md-6 mt-4 ms-3">
                                          <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Tambah Data UID</a>
                                        </div>
                                      </div>
                                    </form> --}}
                                    <br>
                                    <h4 class="card-title">Data Siswa PKL Aktif</h4>
                                    {{-- <p class="card-title-desc">DataTables has most features enabled by
                                        default, so all you need to do to use it with your own tables is to call
                                        the construction function: <code>$().DataTable();</code>.
                                    </p> --}}

                                    <table id="datasiswa" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>UID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($no = 1)
                                            @foreach ($students as $student)
                                                <tr>
                                                    <th>{{ $no++ }}</th>
                                                    <td>{{ $student->name }}</td>
                                                    {{-- <td>{{ $id_card->uid }}</td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                {{-- </div>
            </div> --}}
            <!-- end row -->


            <!-- end row -->


            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
@section('js')
@endsection