@extends('layouts.app')
@section('content')
    @if(auth()->user()->is_admin)
    <a href="{{route('messages.create')}}">
        <button class="btn btn-outline-primary">Створити повідомлення</button>
    </a>
    @endif


    @if($messages->count())
        <div class="d-flex flex-wrap">
        @foreach($messages as $message)
                <div class="card me-2 mt-2" style="width: 40rem;">
                    <div class="card-body ">
                        <h4
                            @switch($message->status)
                                @case('danger')
                                    class="card-title bg-danger p-2 text-center"
                                    @break

                                @case('success')
                                    class="card-title bg-success p-2 text-center"
                                    @break

                                @case('info')
                                    class="card-title bg-info p-2 text-center"
                                @break

                                @case('warning')
                                    class="card-title bg-warning p-2 text-center"
                                @break
                            @endswitch
                        >{{$message->title}}</h4>
                        <h6 class="card-subtitle mb-2 text-muted">
                           <small>{{$message->created_at}}</small>
                        </h6>
                        <p class="card-text">{{$message->description}}</p>
                        @if(auth()->user()->is_admin)
                        <div class="d-flex">
                            <a href="{{route('messages.edit', $message->id)}}" class="card-link">
                                <button class="btn btn-outline-info">Редагувати</button>
                            </a>

                            <form action="{{route('messages.delete', $message->id)}}"
                                  onclick="return confirm('Ви впевнені, що потрібно видалити повідомлення?')"
                                  method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger">Видалити</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
        @endforeach
        </div>

    @else
        <h5 class="text-center mt-5"> Системні повідомлення відсутні</h5>
    @endif

@endsection

