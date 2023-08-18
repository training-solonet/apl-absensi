@extends('layouts.home')
@section('content')
<div class="page-content">
  <div class="container-fluid">

  <div class="card">
    <div class="card-header">
      <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ url('data') }}'">
        Kembali
      </button>
    </div>
    <div class="card-body"> 
      
      {{-- untuk validasi form
        @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif --}}
      <h4 class="card-title">Edit Data UID Siswa PKL</h4>
      <br>
      <form method="POST" action="{{ route('edit.store') }}">
        @csrf
        <div class="row mb-3">
          <label for="txtid" class="col-sm-2 col-form-label">Nama Siswa PKL</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" name="txtid" value="{{ $student->name }}" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <label for="txtuid" class="col-sm-2 col-form-label">UID</label>
          <div class="col-sm-4">
            <select class="form-select form-select-sm" name="txtuid" id="txtuid">
                <option value="" selected>-Pilih-</option>
                @foreach($uid as $uid)
                <option value="{{ $uid->uid }}">{{ $uid->uid }}</option>
                @endforeach
            </select>
        </div>
        </div>

        <div class="row mb-3">
          <label for="" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-6">
            <button type="submit" class="btn btn-sm btn-success">
              Simpan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
</div>

@endsection