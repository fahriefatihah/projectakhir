@extends('template.index')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Home Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">list pertanyaan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('question/'.$question->id)}}" method="post">
                        @csrf
                        @method('put')
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <small class="text-secondary">Isi judul pertanyaan kamu</small>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="masukkan judul pertanyaan" value="{{ $question->judul }}">
                                @error('judul')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pertanyaan">Pertanyaan</label>
                                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan" rows="3">{{ $question->isi }}</textarea>
                                @error('pertanyaan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tag">Tag</label>
                                 
                                <input type="text" class="form-control @error('tag') is-invalid @enderror" id="tag" name="tag" placeholder="php, javascript, laravel" 
                                value="{{$question->tag}}">                                
                                @error('tag')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col-md-8 -->
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

@endsection

@push('ckeditor')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'pertanyaan', {
            filebrowserImageBrowseUrl: 'public/ckeditor/samples/img?type=Images',
            filebrowserImageUploadUrl: 'public/ckeditor/samples/upload?type=Images&_token=',
            filebrowserBrowseUrl: 'public/ckeditor/samples?type=Files',
            filebrowserUploadUrl: 'public/ckeditor/samples/upload?type=Files&_token='
        });
    </script>
@endpush