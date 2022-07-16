@extends('layouts.app')
@section('content')

    <form action="{{route('messages.update', $message->id)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок повідомлення</label>
            <input type="text" class="form-control" id="title" placeholder="Введіть заголовок" name="title" value="{{$message->title}}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" >Оцініть помешкання</span>
            <select class="form-control form-select" name="status" required>
                <option  selected disabled>оберіть статус зі списку...</option>
                <option value='danger'>Небезпека</option>
                <option value='success'>Успіх</option>
                <option value='info'>Інформаційне</option>
                <option value='warning'> До уваги</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"></label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$message->description}}</textarea>
        </div>
        <button class="btn btn-outline-primary" type="submit">Зберегти зміни</button>
    </form>
@endsection
