@extends('layouts.app')
@section('content')

    @if($feedbacks_user->count())
        <h3 class="text-center mb-3 text-secondary"> Відгуки написані по вашим помешканням <small>({{$feedbacks_user->count()}})</small></h3>
        <table class="table table-hover text-center">
            <thead class="bg-secondary text-light">
            <tr>
                <th scope="col">#</th>

                <th scope="col">Помешкання</th>
                <th scope="col">Текст відгуку</th>
                <th scope="col">Відвідувач</th>
                <th scope="col">Оцінка</th>
                <th scope="col">Дата відгуку</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            @foreach($feedbacks_user as $feedback)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>

                    <td class="text-decoration-underline">
                        <a href="{{route('stays.show',$feedback->stay->id)}}">
                            {{$feedback->stay->title}}
                        </a>
                    </td>
                    <td> {{$feedback->description}}</td>
                    <td>
                            {{$feedback->user->name}}
                    </td>
                    <td>
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
                    </td>
                    <td> {{$feedback->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="text-center"> По вашим помешканням ще не залишали відгуків</h5>
    @endif


    @if($feedbacks_owner->count())
        <h3 class="text-center mb-3 mt-5 text-secondary"> Відгуки написані Вами по відвіданим помешканням <small>({{$feedbacks_owner->count()}})</small></h3>
        <table class="table table-hover text-center">
            <thead class="bg-secondary text-light">
            <tr>
                <th scope="col">#</th>

                <th scope="col">Помешкання</th>
                <th scope="col">Текст відгуку</th>
                <th scope="col">Відвідувач</th>
                <th scope="col">Оцінка</th>
                <th scope="col">Дата відгуку</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            @foreach($feedbacks_owner as $feedback)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>

                    <td class="text-decoration-underline">
                        <a href="{{route('stays.show',$feedback->stay->id)}}">
                            {{$feedback->stay->title}}
                        </a>
                    </td>
                    <td> {{$feedback->description}}</td>
                    <td>
                        {{$feedback->user->name}}
                    </td>
                    <td>
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
                    </td>
                    <td> {{$feedback->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5 class="text-center mt-5"> Ви ще не залишали відгуків по жодному помешканню</h5>
    @endif

@endsection

