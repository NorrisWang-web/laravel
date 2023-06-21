@extends('layouts.app_admin_auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('イベント情報編集') }}</div>
                    <div class="card-body">
                        <div class="card-body">
                            <form method="POST" action="{{ route('event.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="event_datetime" class="col-md-4 col-form-label text-md-right">{{ __('開催日時') }}</label>

                                    <div class="col-md-6"><input id="event_datetime" type="datetime-local" class="form-control @error('event_datetime') is-invalid @enderror" name="event_datetime"
                                                                 @if(old('event_datetime') !== null)
                                                                 value="{{Carbon\Carbon::parse(old('event_datetime'))->format('Y-m-d\TH:i')}}"
                                                                 @else
                                                                 value="{{$event->event_datetime}}"
                                                                 @endif autocomplete="event_datetime" autofocus>

                                        @error('event_datetime')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="event_name" class="col-md-4 col-form-label text-md-right">{{ __('イベント名') }}</label>

                                    <div class="col-md-6">
                                        <input type="text" value="@if(old('event_name')){{ old('event_name') }}@else{{ $event->event_name }}@endif" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" rows="2" autocomplete="event_name" autofocus>
                                        @error('event_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="prefecture_id" class="col-md-4 col-form-label text-md-right">{{ __('都道府県') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control @error('prefecture_id') is-invalid @enderror" id="prefecture_id" name="prefecture_id">

                                            <option value>選択してください</option>
                                            @foreach ($prefectures as $prefecture)

                                            @if(old('prefecture_id') == $prefecture->id)

                                                <option value='{{$prefecture->id}}' selected>{{$prefecture->prefecture_name}}</option>

                                            @elseif($event->prefecture_id == $prefecture->id)

                                                <option value='{{$prefecture->id}}' selected>{{$prefecture->prefecture_name}}</option>

                                            @else

                                                <option value='{{$prefecture->id}}'>{{$prefecture->prefecture_name}}</option>

                                            @endif
                                            @endforeach

                                        </select>
                                        @error('prefecture_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="max_participants" class="col-md-4 col-form-label text-md-right">{{ __('最大参加人数') }}</label>

                                    <div class="col-md-6">
                                        <input id="max_participants" value="@if(old('max_participants')){{ old('max_participants') }}@else{{ $event->max_participants }}@endif" type="number" max="10000000" min="0" class="form-control @error('max_participants') is-invalid @enderror" name="max_participants" autocomplete="max_participants" autofocus>

                                        @error('max_participants')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('アイコン添付') }}</label>
                                    <div class="col-md-6">
                                        <input type="file" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" onchange="previewImage(this)">
                                        @error('icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3 row d-flex align-items-center justify-content-center">
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                    @if($event->icon)
                                    <img id="preview" src="{{url('storage/icons')}}/{{$event->icon}}" alt="画像" class="mg-fluid" style="max-width:200px;">
                                    @else
                                    <img id="preview" class="mg-fluid" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;" alt="アイコン">

                                    @endif
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('登録') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        function previewImage(obj)
        {
            var fileReader = new FileReader();
            fileReader.onload = (function() {
                document.getElementById('preview').src = fileReader.result;
            });
            fileReader.readAsDataURL(obj.files[0]);
        }

        $(function() {
            $(document).on('change', '#receipt', function(){
                $('#preview').addClass('img-thumbnail');
            });
        });
    </script>
@endsection
