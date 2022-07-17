@extends('layouts.app')
@section('content')

    @if($bookings->count())
        <h3 class="text-center mb-3"> Ваші бронювання! </h3>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Помешкання</th>
                <th scope="col">Власник</th>
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
                    <td class="text-decoration-underline">
                        <a href="{{route('stays.show',$booking->stay->id)}}">
                            {{$booking->stay->title}}
                        </a>
                    </td>
                    <td> {{$booking->stay->user->name}}</td>
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
        <h5 class="text-center"> Ви  ще нічого не бронювали :(</h5>
    @endif

@endsection

