@extends('layouts.app')
@section('content')

    @if($stays->isEmpty())
        <h5>На даний час немає жодного опублікованого помешкання</h5>
    @else
        <h5 class="mt-3">Вами опубліковано {{$stays->count()}} помешкань. Із них заброньовано {{$stays->count()}} </h5>

        @foreach($stays as $stay)
            <div class="card mb-3">
                <div class="row ">
                    <a href="{{route('stays.show', $stay->id)}}" class="col-md-3" >
                    @if ($stay->image)
                        <img src="../uploads/stays/{{$stay->image}}" class="card-img-stays " alt="{{$stay->title}}">
                    @else
                        <div class="stay-image card-img-stays p-2">
                            <svg class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250"
                                 xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image"
                                 preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                                <rect width="400px" height="300px" fill="#868e96"></rect>
                                <text x="45%" y="50%" fill="#dee2e6" dy=".1em">No Image</text>
                            </svg>
                        </div>
                        @endif
                    </a>

                    <div class="col-md-8">
                        <div class="card-body pb-2">
                            <div class="d-flex flex-row justify-content-between align-items-baseline">
                                <a href="{{route('stays.show', $stay->id)}}" class="">
                                    <h3 class="card-title">{{$stay->title}}</h3>
                                </a>
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
                                <a href="{{route('stays.show', $stay->id)}}">
                                    <h5>Рейтинг 9.8</h5>
                                    4 відгуки
                                </a>
                            </div>

                            <p class="card-text me-2">
                                <small class="text-muted"> Локація:
                                    <span>{{ $stay->location }}</span>
                                </small>
                            </p>

                            <p class="card-text">
                                Опис:
                                <i>{{$stay->description}}</i></p>

                            <p class="card-text">
                                Зручності:
                                @if($stay->amenities)
                                <i>{{$stay->amenities}}</i>
                                @else
                                    <i>відсутні</i>
                                @endif


                            </p>
                            <p class="card-text ">
                                Кімнат:
                                <strong>{{$stay->rooms}}</strong>

                            <span class="card-text p-2">
                                Ліжок:
                                <strong>{{$stay->beds}}</strong>
                            </span>
                            </p>


                            <h5 class="card-text stay-price">Ціна: <strong> {{$stay->price}} грн.</strong></h5>
                            <div class="input-group  mt-3 p-3">

                                <a href="{{route('stays.edit',$stay->id)}}">
                                    <button class="btn btn-outline-success">
                                        Керувати бронюванням
                                    </button>
                                </a>
                                <a href="{{route('stays.edit',$stay->id)}}">
                                    <button class="btn btn-outline-primary">
                                        Редагувати
                                    </button>
                                </a>

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

                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endif
@endsection
