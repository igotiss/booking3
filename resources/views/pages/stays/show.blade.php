@extends('layouts.app')
@section('content')


    <!--Stay-->

    <div class="card mb-3">
                <div class="row g-0">
                    @if ($stay->image)
                        <img src="../uploads/stays/{{$stay->image}}" class="card-img-stays p-2" alt="{{$stay->title}}">
                    @else
                        <div class="col-md-4 stay-image card-img-stays p-2">
                            <svg class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250"
                                 xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image"
                                 preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                                <rect width="400px" height="300px" fill="#868e96"></rect>
                                <text x="45%" y="50%" fill="#dee2e6" dy=".1em">No Image</text>
                            </svg>
                        </div>
                    @endif
                    <div class="col">
                        <div class="card-body pb-2">
                            <div class="d-flex flex-row justify-content-between align-items-baseline">
                                <h3 class="card-title">{{$stay->title}}</h3>
                                <p class="card-text">
                                    <small class="text-muted">Тип помешкання:
                                        @if ($stay->type === 'hotel')
                                            <strong> Готель </strong></small>
                                    @elseif($stay->type === 'apartment')
                                        <strong> Квартира </strong></small>
                                    @elseif($stay->type === 'resort')
                                        <strong> Курорт </strong></small>
                                    @elseif($stay->type === 'villa')
                                        <strong> Вілла </strong></small>
                                    @else($stay->type === 'cottage')
                                        <strong> Котедж </strong></small>
                                    @endif

                                </p>

                                <show-rating
                                    :auth-voted="{{$authVoted}}"
                                    :rating="{{$avgRating}}"
                                    :stay-id="{{$stay->id}}"
                                    :auth-id="{{auth()->id()}}"
                                ></show-rating>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="card-text me-2"><small class="text-muted">
                                        Локація:
                                        <span class="stay-location">{{ $stay->location }}</span></small>
                                </p>
                                <p class="card-text mt-2 text-secondary">
                                        Відгуків:
                                        <span class="stay-location">{{$stay->feedbacks->count()}} </span>
                                </p>
                            </div>


                            <p class="card-text"><span>Опис: </span><i>{{$stay->description}}</i></p>

                            <p class="card-text"><span>Зручності: </span>
                                @if($stay->amenities)
                                    <i>{{$stay->amenities}}</i>
                                @else
                                    <i>відсутні</i>
                                @endif
                                <span class="card-text p-2"><span>Кімнат: </span><strong>{{$stay->rooms}}</strong>

                            <span class="card-text p-2"><span>Ліжок: </span><strong>{{$stay->beds}}</strong></span>
                            </span>
                            </p>


                            <h5 class="card-text stay-price">Ціна: <strong> {{$stay->price}} грн.</strong></h5>


                                @if ($stay->user_id === auth()->id())
                                <div class="input-group  mt-3 p-3">
                                <button class="btn btn-outline-primary">
                                    <a href="{{route('stays.edit',$stay->id)}}">Редагувати</a>
                                </button>

                                <form action="{{route('stays.destroy',$stay->id)}}" method="post">
                                    <button class="btn btn-outline-danger"
                                            onclick="return confirm('Ви впевнені, що потрібно видалити об*яву?')"
                                            type="submit">
                                        Видалити
                                    </button>
                                    @method('delete')
                                    @csrf
                                </form >
                                </div>
                                @else
                                    <a href="{{route('booking.create',$stay->id)}}">
                                        <button class="btn btn-outline-success">
                                            Забронювати
                                        </button>
                                    </a>
                                <a href="{{route('feedback.create',$stay->id)}}">
                                    <button class="btn btn-outline-info">
                                        Залишити відгук
                                    </button>
                                </a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>


    <!--Feedbacks-->

    <h4>Відгуки: {{$stay->feedbacks->count()}}</h4>
    <div class="d-flex flex-wrap">
        @if ($stay->feedbacks->count())
            @foreach($feedbacks as $feedback)
            <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    {{$feedback->description}}
                </h5>
            </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">

                        @switch($feedback->mark)
                            @case('best')
                                <span class="badge bg-success">Дуже добре!!! :)))</span>
                                @break
                            @case('good')
                                <span class="badge bg-success bg-opacity-75">Добре! :)</span>
                                @break
                            @case('middle')
                                <span class="badge bg-warning">Посередньо :|</span>
                                @break
                            @case('badly')
                                <span class="badge bg-danger bg-opacity-75">Погано! :(</span>
                                @break
                            @case('worst')
                                <span class="badge bg-danger">Дуже погано!!! :(((</span>
                                @break
                        @endswitch
                    </li>
                    <li class="list-group-item"><small>Користувач: <i>{{$feedback->user->name}}</i></small></li>
                    <li class="list-group-item"><small>Дата: <i>{{$feedback->created_at}}</i></small></li>
                </ul>
                @if($feedback->user->id===auth()->id())
                <div class="card-body d-flex">
                    <a href="{{route('feedback.edit', $feedback->id)}}" class="card-link">
                       <button class="btn btn-outline-info">Редагувати</button>
                    </a>
                    <form action="{{route('feedback.delete', $feedback->id)}}"
                          onclick="return confirm('Ви впевнені, що потрібно видалити відгук?')"
                          method="post">
                        @csrf
                        @method('delete')
                            <button type="submit" class="btn btn-outline-danger">Видалити</button>
                    </form>

                </div>
                @endif

            </div>
            @endforeach
    </div>
        @else
            коментарів ще не залишив жоден користувач
        @endif


@endsection

