@extends('layouts.app_admin_auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">イベント名</th>
                        <th scope="col">都道府県</th>
                        <th scope="col">開催日</th>
                        <th scope="col">最大人数</th>
                        <th scope="col">アイコン</th>
                        <th scope="col">アクション</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($events as $event)
                    <tr>
                        <th scope="row">{{$event->event_name}}</th>
                        <td>
                            {{$event->prefecture->prefecture_name}}
                        </td>
                        <td>
                            {{$event->event_datetime}}
                        </td>
                        <td>
                            {{$event->max_participants}}
                        </td>
                        <td>
                            <img src="{{url('storage/icons')}}/{{$event->icon}}" alt="画像" style="max-height: 50px;">
                        </td>
                        <td>
                            
                            <a href="{{url('admin/event')}}/{{$event->id}}/edit">
                                <i class="far fa-edit" style="font-size: 30px;"></i>
                            </a>
                            <br>
                            <form action="{{ route('event.destroy', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger delete">削除</button>
                            </form>
                        </td>
                        <!-- <i type="submit" class="fa-solid fa-trash" style="font-size: 30px;">削除</i> -->
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                {{ $events->links() }}
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $('.delete').click(function(){

        if(!confirm('本当に削除しますか？')){

        /* キャンセルの時の処理 */

        return false;

        }else{

        /*　OKの時の処理 */

        }

});
</script>
@endsection
