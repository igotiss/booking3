@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-6 mt-3">
            <form class="form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="col-xs-12">
                    <div class="form-group input-group mb-3">
                        <span class="input-group-text col-4">Ім'я</span>
                        <input name="name" type="text"
                               value="{{$user->name}}"
                               class="form-control"/>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group input-group mb-3">
                        <span class="input-group-text col-4">Фото профіля</span>
                        <input name="image" type="file"
                               value=""
                               class="form-control"/>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group input-group mb-3">
                        <span class="input-group-text col-4">Вік</span>
                        <input name="age" type="text"
                               value="{{$user->age}}"
                               class="form-control"/>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group input-group mb-3">
                        <span class="input-group-text col-4">Країна проживання</span>
                        <input name="location" type="text"
                               value="{{$user->location}}"
                               class="form-control"/>
                    </div>
                </div>


                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-outline-dark" value="Зберегти реєстраційні дані"/>
                </div>

            </form>

        </div>
    </div>
@endsection
