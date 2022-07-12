@extends('layouts.app')
@section('content')

    @if($stays->isEmpty())
        <div class="row justify-content-center">
            <h5 class="text-center">На даний час ви не зареєстрували жодного помешкання, але це не проблема ;)</h5>
            <button type="button" class="btn btn-warning m-2 col col-lg-2">
                <a href="{{route('create')}}">Зареєструвати помешкання</a>
            </button>
        </div>

    @else
        <h5 class="mt-3">
            Вами опубліковано {{$stays->count()}} помешкань. Із них:
            <a href="{{route('booking.index')}}">
            <button type="button"  class="btn btn-primary position-relative m-3">
                Заброньовано:     {{$bookings->count()}}

            </button>
            @if($bookingsPending->count())
            <button type="button" class="btn btn-warning position-relative">
                потребують підтвердження
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{$bookingsPending->count()}}
                </span>
            </button>
            </a>
            @endif
        </h5>

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

                    <div class="col">
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
                                    <show-rating :rating="{{$stay->getAvgRating()}}"></show-rating>
                                </a>
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

                            <p class="card-text">
                                Опис:
                                <i>{{$stay->description}}</i>
                            </p>

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
                                <a href="{{route('stays.edit',$stay->id)}}">
                                    <button class="btn btn-outline-success">
                                        Забронювати
                                    </button>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endif
@endsection
