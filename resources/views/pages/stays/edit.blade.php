@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title text-center">Створення нового оголошення</h4>

                <form action="{{route('stays.update', $stay->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Назва помешкання</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{$stay->title}}" required>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group input-group mb-3">
                            <span class="input-group-text col-4">Фото помешкання</span>
                            <input name="image" type="file"
                                   value=""
                                   class="form-control"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="type">Тип помешкання</label>
                            <select class="form-select mb-3 mt-2 " name="type" required >
                                <option selected value="{{$stay->type}}">
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
                                </option>
                                <option value="hotel">Готель</option>
                                <option value="apartment">Квартира</option>
                                <option value="resort">Курорт</option>
                                <option value="villa">Вілла</option>
                                <option value="cottage">Котедж</option>
                            </select >
                        </div>
                        <div class="col-md-4">
                            <label for="location" class="form-label">Локація (населений пункт)</label>
                            <input type="text" name="location" class="form-control" id="location" value="{{$stay->location}}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="price" class="form-label">Вкажіть бажану ціну ренти за добу</label>
                            <input type="number" name="price" class="form-control" id="location" value="{{$stay->price}}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Опис помешкання</label>
                        <textarea name="description" class="form-control">{{$stay->description}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Зручності</label>
                        <textarea name="amenities" class="form-control">{{$stay->amenities}}</textarea>
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-3">
                            <label for="location" class="form-label">Кількіст кімнат</label>
                            <input type="number" name="rooms" class="form-control" id="rooms" value="{{$stay->rooms}}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">Кількіст ліжок</label>
                            <input type="number" name="beds" class="form-control" id="beds" value="{{$stay->beds}}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Зберегти зміни</button>
                </form>
            </div>
        </div>
    </div>
@endsection
