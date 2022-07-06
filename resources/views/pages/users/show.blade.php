@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <div class="user-image mt-3 mb-3">
                        @if ($user->profile_image)
                            <img src="uploads/users/{{$user->profile_image}}" class="card-img-user-profile" alt="{{$user->name}}">
                        @else
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Фото не завантажено</text></svg>
                        @endif
                    </div>
                    <h5 class="card-title">Вітаємо, <strong>{{$user->name}}</strong>!</h5>
                </div>

                <div class="card-body">

                    <h6 class="card-subtitle mb-2 text-muted">Ви зареєстровані в системі
                        <strong>{{$user->created_at->format('d n Y')}}</strong> р., з такими особистими даними:</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Ім'я: <strong>{{$user->name}} </strong></li>
                        <li class="list-group-item">                             Вік: <strong>{{$user->age ??  'не вказано'}}</strong></li>
                        <li class="list-group-item">Країна проживання:
                            <strong>{{$user->location ??  'не вказано'}}</strong></li>

                    </ul>

                    <a href="{{route('profile.edit')}}" class="btn btn-outline-info ">Редагувати особисті
                        дані</a>
                </div>
            </div>

        </div>
    </div>
@endsection
