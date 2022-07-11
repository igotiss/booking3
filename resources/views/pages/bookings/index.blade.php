@extends('layouts.app')
@section('content')


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


@endsection

