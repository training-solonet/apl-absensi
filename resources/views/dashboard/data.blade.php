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
            <div class="row">
                <div class="col-12">
                    <div class="card" style="margin-right: -1%">
                        <div class="card-body">
                            <h4 class="card-title" style="margin-bottom: 3%; margin-left: 1%;">Data Siswa PKL Aktif</h4>
                                <table id="datasiswa" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>UID</th>
                                            @if(auth()->user()->name == 'ConnectisJati')
                                                <th>Action</th>
                                            @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $no = 1;
                                            @endphp
                                            @foreach ($student as $siswa)
                                                <tr class="text-center">
                                                    <th>{{ $no++ }}</th>
                                                    <td>{{ $siswa->name }}</td>
                                                    <td>
                                                        @if ($siswa->uid != null)
                                                            {{ $siswa->uid->uid }}
                                                        @else
                                                            UID tidak ditemukan
                                                        @endif
                                                    </td>
                                                @if(auth()->user()->name == 'ConnectisJati')
                                                    <td>
                                                        <a href="{{ route('edit.form', ['name' => $siswa->name]) }}" class="btn btn-primary">Edit</a>
                                                    </td>
                                                @endif
                                                   
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