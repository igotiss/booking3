@extends('layouts.app')
@section('content')

        <h3 class="text-center text-secondary"> Редагування відгуку до помешкання <strong> {{$feedback->stay->title}}</strong></h3>

        <form action="{{route('feedback.update',$feedback->id)}}" class="row justify-content-md-center" method="post" >
            @method('PATCH')
            @csrf

            <div class="col-md-8 mt-3">
                <div class="mb-3 col-md-6 ">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Оцініть помешкання</span>
                        <select class="form-control form-select" id="mark" name="mark" required>
                            <option  selected disabled>оберіть оцінку з списку...</option>
                            <option value=5>Найкраще!!! :)))</option>
                            <option value=4>Добре! :)</option>
                            <option value=3>Посередньо</option>
                            <option value=2>Погано :(</option>
                            <option value=1>Найгірше :(((</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3  ">
                    <label for="exampleFormControlTextarea1" class="form-label">Напишіть ваш відгук</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$feedback->description}}</textarea>
                </div>
                <input type="hidden" name="stay_id" value="{{$feedback->stay_id}}">
                <input type="hidden" name="owner_id" value="{{$feedback->owner_id}}">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-info">Зберегти зміни</button>
            </div>
        </form>

        <hr>

        <h4 class="text-center text-secondary"> Деталі помешкання: </h4>

        <div class="card mb-3">
            <div class="row g-0">

                @if ($feedback->stay->image)
                    <img src="/uploads/stays/{{$feedback->stay->image}}" class="card-img-stays p-2" alt="{{$feedback->stay->title}}">
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
                            <h3 class="card-title">{{$feedback->stay->title}}</h3>
                            <p class="card-text">
                                <small class="text-muted">Тип помешкання:
                                    @if ($feedback->stay->type === 'hotel')
                                        <strong> Готель </strong></small>
                                @elseif($feedback->stay->type === 'apartment')
                                    <strong> Квартира </strong></small>
                                @elseif($feedback->stay->type === 'resort')
                                    <strong> Курорт </strong></small>
                                @elseif($feedback->stay->type === 'villa')
                                    <strong> Вілла </strong></small>
                                @else()
                                    <strong> Котедж </strong></small>
                                @endif

                            </p>

                            <show-rating
                                :auth-voted="{{$feedback->stay->checkIsUserVoted()}}"
                                :rating="{{$feedback->stay->getAvgRating()}}"
                                :stay-id="{{$feedback->stay->id}}"
                                :auth-id="{{auth()->id()}}"
                            ></show-rating>
                        </div>

                        <p class="card-text me-2"><small class="text-muted">Локація: <span
                                    class="stay-location">{{ $feedback->stay->location }}</span></small>
                        </p>

                        <p class="card-text"><span>Опис: </span><i>{{$feedback->stay->description}}</i></p>

                        <p class="card-text"><span>Зручності: </span>
                            @if($feedback->stay->amenities)
                                <i>{{$feedback->stay->amenities}}</i>
                            @else
                                <i>відсутні</i>
                            @endif
                            <span class="card-text p-2"><span>Кімнат: </span><strong>{{$feedback->stay->rooms}}</strong>

                            <span class="card-text p-2"><span>Ліжок: </span><strong>{{$feedback->stay->beds}}</strong></span>
                            </span>
                        </p>

                        <h5 class="card-text stay-price">Ціна: <strong> {{$feedback->stay->price}} грн.</strong></h5>


                    </div>
                </div>
            </div>
        </div>

@endsection
