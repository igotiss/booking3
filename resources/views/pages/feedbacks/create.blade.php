@extends('layouts.app')
@section('content')

    <h3 class="text-center text-secondary"> Створення відгуку до помешкання <strong> {{$stay->title}}</strong></h3>

        <form action="{{route('feedback.store')}}" method="post" class="row justify-content-md-center">
            @csrf
            <div class="col-md-8 mt-3">
                <div class="mb-3 col-md-6 ">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Оцініть помешкання</span>
                        <select class="form-control form-select" id="mark" name="mark" required>
                            <option  selected disabled>оберіть оцінку з списку...</option>
                            <option value="best">Найкраще!!! :)))</option>
                            <option value="good">Добре! :)</option>
                            <option value="middle">Посередньо</option>
                            <option value="badly">Погано :(</option>
                            <option value="worst">Найгірше :(((</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3  ">
                    <label for="exampleFormControlTextarea1" class="form-label">Напишіть ваш відгук</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{old('description')}}</textarea>
                </div>
                <input type="hidden" name="stay_id" value="{{$stay->id}}">
                <input type="hidden" name="owner_id" value="{{$stay->user_id}}">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-info">Залишити відгук</button>
            </div>
        </form>

    <hr>

    <h4 class="text-center text-secondary"> Деталі помешкання: </h4>

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

                        <show-rating
                            :auth-voted="{{$stay->checkIsUserVoted()}}"
                            :rating="{{$stay->getAvgRating()}}"
                            :stay-id="{{$stay->id}}"
                            :auth-id="{{auth()->id()}}"
                        ></show-rating>
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

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
