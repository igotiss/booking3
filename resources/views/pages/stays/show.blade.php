@extends('layouts.app')
@section('content')


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
                    <div class="col-md-8">
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
                                <h5>Рейтинг 9.8</h5>
                            </div>

                            <p class="card-text me-2"><small class="text-muted">Локація: <span
                                        class="stay-location">{{ $stay->location }}</span></small>
                            </p>

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
                            <div class="input-group  mt-3 p-3">
                                <a href="{{route('stays.edit',$stay->id)}}">
                                    <button class="btn btn-outline-success">
                                        Керувати бронюванням
                                    </button>
                                </a>
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

                        </div>
                    </div>
                </div>
            </div>


@endsection
