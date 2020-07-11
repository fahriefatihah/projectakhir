@extends('template.index')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail Pertanyaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail pertanyaan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        {{--  pertanyaan  --}}
        <div class="container">
            <div class="row ml-3">
                <div class="card" style="width: 5rem;">                    
                    <div class="card-body"  title="vote pertanyaan ini">
                        <form action="{{url('upvote/pertanyaan/'.$questions->id)}}" method="post">@csrf
                            <input type="hidden" name="quest_id" value="{{$questions->id}}">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-caret-up"></i></button>
                        </form>
                        <div class="text-center">{{$upvote}}</div>
                        <form action="{{ url('downvote/pertanyaan/'.$questions->id) }}" method="post">@csrf
                        <input type="hidden" name="quest_id" value="{{$questions->id}}">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-caret-down"></i></button>
                        </form>
                    </div>
                </div>
                <div class="card" style="width: 60rem;">
                    <div class="card-body">
                        <h3 class="d-inline">{{$questions->judul}}</h3>
                        <div class="float-right text-muted">
                            <a href="">{{ $questions->users->name}}</a>
                            <div>{{$questions->created_at->diffForHumans()}}</div>
                        </div><hr>
                        <p class="card-text">{!!$questions->isi !!}</p>
                        @if($questions->tag == '')
                            
                          @else
                            @foreach(Str::of($questions->tag)->explode(',') as $key => $value)
                                <a href="#" class="btn btn-secondary btn-sm">
                                {{ $value}}
                                </a>
                            @endforeach
                          @endif
                            @foreach($comments as $key => $value)
                                 <div href="#" class="text-muted">
                                    {!! $value->isi_pertanyaan !!}
                                </div>
                            @endforeach
                        <form action="{{ url('komentar/pertanyaan/'.$questions->id)}}" method="post">@csrf
                            <div class="input-group mt-3 mb-3">
                                <input type="text" class="form-control" name="komentar" placeholder="isi komentar kamu disini"i id="komentar">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="sumbit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <h3 class="ml-3">{{$questions->answers_count}} Jawaban</h3>   
            <div class="row ml-3">
                @foreach($questions->answers as $jawaban)
                    <div class="card" style="width: 5rem;">                    
                        <div class="card-body"  title="vote pertanyaan ini">
                            <form action="{{ url('upvote/answer/'.$jawaban->id) }}" method="post">@csrf
                                <input type="hidden" name="answer_id" value="{{$jawaban->id}}">
                                <button type="submit" class="btn btn-secondary" title="jawaban ini berguna"><i class="fas fa-caret-up"></i></button>
                            </form>
                            <div class="text-center">{{$questions->answers_count}}</div>
                            <form action="{{ url('downvote/answer/'.$jawaban->id) }}" method="post">@csrf
                                <input type="hidden" name="answer_id" value="{{$jawaban->id}}">
                                <button type="submit" class="btn btn-secondary" title="jawaban ini tidak berguna"><i class="fas fa-caret-down"></i></button>
                            </form>
                            <div title="jawaban ini benar">
                                @if($jawaban->selected == 1) <i class="fa fa-check text-success"></i> @endif
                            </div>
                            @if($questions->user_id == Auth()->user()->id)
                                <form method="post" action="{{url('answer/benar/'.$jawaban->id)}}">@csrf @method('put')
                                    <div class="mt-1 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success">Benar</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="card" style="width: 60rem;">
                        <div class="card-body">
                            <div class="float-right text-muted">
                                <a href="">{{ $jawaban->users->name}}</a>
                                <div>{{$jawaban->created_at->diffForHumans()}}</div>
                            </div>
                            <p class="card-text d-inline">{!! $jawaban->isi !!}</p>
                            <div class="text-muted">
                                 @foreach($Komentar as $key => $komentar)
                                    @if($jawaban->id == $komentar->id)
                                        {{$komentar->isi_jawaban}}
                                    @endif
                                 @endforeach
                            </div>
                        <form action="{{url('komentar/answer/'.$jawaban->id)}}" method="post">@csrf
                            <div class="input-group mt-3 mb-3">
                                <input type="text" class="form-control" name="komentar" placeholder="isi komentar kamu disini"i id="komentar">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="sumbit">Simpan</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        
                    </div>
                @endforeach
                <form action="{{ route('answer.store') }}" method="post">@csrf
                <input type="hidden" name="id_question" value="{{$questions->id}}">
                    <div class="form-group">
                        <label for="jawaban">Ketik Jawaban anda</label>
                        <div class="card" style="width: 65rem;">
                            <textarea class="form-control" rows="5" name="jawaban" id="jawaban" style="width: 65rem;">{{ old('jawaban') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
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
        CKEDITOR.replace( 'jawaban', {
            filebrowserImageBrowseUrl: 'public/ckeditor/samples/img?type=Images',
            filebrowserImageUploadUrl: 'public/ckeditor/samples/upload?type=Images&_token=',
            filebrowserBrowseUrl: 'public/ckeditor/samples?type=Files',
            filebrowserUploadUrl: 'public/ckeditor/samples/upload?type=Files&_token='
        });
    </script>
@endpush