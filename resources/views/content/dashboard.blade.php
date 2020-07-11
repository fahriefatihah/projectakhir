@extends('template.index')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container container-fluid">
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
      <div class="container container-fluid">
        <div class="row">
            <div class="col">                
                <div class="float-right btn btn-outline-primary rounded-pill mt-4">
                    <a href="/question/create">Add Question</a>
                </div>
                <h1> Daftar Pertanyaan</h1>
                <p class="text-muted">@foreach($users as $key => $value)
                    {{ $value->questions_count}}
                @endforeach pertanyaan</p>
            </div>
        </div>
        <hr>
        @foreach($questions as $key => $data)
            <div class="row">
                <div class="col-lg-2">
                    <div class="card-body text-center">
                        <div class="text-center">
                          {{$vote}}
                        </div>
                        <span> Votes </span>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            {{ $data->answers_count }}
                        </div>
                        <span> Answers </span>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card-body">
                        <a href="{{ route('question.show', $data->id) }}">
                            <h3 class="">{{$data->judul}}</h3>
                        </a>
                        <div class="d-flex justify-content-left">                            
                          <a href="{{ route('question.edit', $data->id) }}" class="btn btn-success btn-sm mr-2" title="Edit Pertanyaan"><i class="fa fa-edit"></i></a>
                          <form action="{{ route('question.destroy', $data->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger btn-sm" title="Hapus Pertanyaan" onclick="return confirm('Yakin data ini akan dihapus?')"><i class="fa fa-trash"></i></button>
                          </form>               
                        </div>
                        <p class="card-text">
                          {!! $data->isi !!}
                        </p>
                          @if($data->tag == '')
                            
                          @else
                            @foreach(Str::of($data->tag)->explode(',') as $key => $value)
                            <a href="#" class="btn btn-primary btn-sm">
                              {{ $value}}
                            </a>
                          @endforeach
                          @endif
                        <div class="mt-1">
                            <a href="">{{$data->users->name}}</a>
                            <p class="text-muted">{{ $data->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-8 -->
            </div>
            <hr>
        @endforeach

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection