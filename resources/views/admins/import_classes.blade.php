@extends('admins.dashboard')
@section('content')
<div class="results">
    @if(Session::get('fail'))
    <div class="alert alert-danger">
        {{ Session::get('fail') }}
    </div>
    @endif
</div>
    <div class="results">
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
         @endif
   </div>
<div class="col-md-12">
    <form class="row g-3" action="/import_classes" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-auto">
          <label class="visually-hidden">Excel</label>
          <input type="file" class="form-control" name="excel_file" >
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-2">Insérer le fichier</button>
        </div>
        @error('excel_file')
       <span class="text-danger">{{ $message }}</span>
       @enderror
      </form>
</div>

@endsection