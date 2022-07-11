@extends('layouts.app')
@section('content')

        @if($bookings->count())
            <h3 class="text-center mb-3"> Ваші помешкання користуються попитом! </h3>
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Помешкання</th>
                        <th scope="col">Користувач</th>
                        <th scope="col">Дата заїзду</th>
                        <th scope="col">Дата виїзду</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Адміністрування</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td> {{$booking->id}}</td>
                            <td> {{$booking->stay->title}}</td>
                            <td> {{$booking->user->name}}</td>
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
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">

                                    @if($booking->status != 'active')
                                    <form action="{{route('booking.change')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="active">
                                        <input type="hidden" name="id" value="{{$booking->id}}">
                                        <button type="submit" class="btn btn-success">Підтвердити</button>
                                    </form>
                                    @endif

                                    @if($booking->status != 'decline')
                                    <form action="{{route('booking.change')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="decline">
                                        <input type="hidden" name="id" value="{{$booking->id}}">
                                        <button type="submit" class="btn btn-danger">Відхилити</button>
                                    </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        @else
            <h5 class="text-center"> Ваші об'єкти ще ніхто не бронював :(</h5>
        @endif

@endsection

