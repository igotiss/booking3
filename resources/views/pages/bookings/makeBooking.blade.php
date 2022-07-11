@extends('layouts.app')
@section('content')
    <div class="row justify-content-md-center">
    <div class="card  col-md-8" >
        <div class="m-3 d-flex justify-content-center " >
            @if ($stay->image)
                <img src="/uploads/stays/{{$stay->image}}" class="card-img-stays " alt="{{$stay->title}}">
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
                <div class="card-body">
                    <h5 class="card-title">Об'єкт: <strong>{{$stay->title}}</strong></h5>
                    <p class="card-text">Опис: <i>{{$stay->description}}</i></p>
                    <p class="card-text">Локація: <strong>{{$stay->location}}</strong></p>
                    <p class="card-text">Власник: <strong>{{$stay->user->name}}</strong></p>
                    <p class="card-text">Ціна за добу: <strong>{{$stay->price}} грн.</strong></p>
                </div>

        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <form action="{{route('booking.store')}}" method="post" class="d-flex ">
                    @csrf
                    <h5 class="col-md-5">Оберіть період бронювання: </h5>
                    <input type="text" name="start_date" placeholder="Дата заїзду" class="form-control " onfocus="(this.type = 'date')">
                    <input type="text" name="end_date" placeholder="Дата виїзду" class="form-control " onfocus="(this.type = 'date')">
                    <input type="hidden" name="stay_id" value="{{$stay->id}}">
                    <input type="hidden" name="owner_id" value="{{$stay->user_id}}">

                    <submit> <button class="btn btn-outline-success">Забронювати</button> </submit>

                </form>
            </li>
            <li class="list-group-item">
                @if ($bookings->count())
                <h5 class="text-center">Статус бронюваннь: </h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Дата заїзду</th>
                    <th scope="col">Дата виїзду</th>
                    <th scope="col">Статус</th>
                </tr>
                </thead>
                <tbody>

                @foreach($bookings as $booking)

                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{$booking->id}}</td>
                    <td> {{$booking->start_date}}</td>
                    <td> {{$booking->end_date}}</td>
                    <td>
                        @switch($booking->status)
                            @case('active')
                                <span class="badge bg-success"> Заброньовано </span>
                                @break

                            @case('decline')
                                <span class="badge bg-danger"> Відхилено </span>
                                @break

                            @default
                                <span class="badge bg-secondary"> На розгляді власника... </span>
                        @endswitch
                    </td>
                </tr>


                @endforeach
                </tbody>
            </table>
                @else
                   <h5 class="text-center">Ви не бронювали це помешкання</h5>
                @endif
            </li>
        </ul>
        <div class="card-body ">

        </div>
    </div>
    </div>

@endsection

