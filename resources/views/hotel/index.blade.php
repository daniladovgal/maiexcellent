@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <form class="d-flex mb-4" method="GET" action="{{ route('hotels.index') }}">
                <div class="form-group me-2">
                    <input type="text" name="search" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Введите запрос">
                </div>
                <button type="submit" class="btn btn-primary">Поиск</button>
            </form>
        </div>
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">ID: {{ $hotel->id }}</h5>
                            <h5 class="card-title">Code: {{ $hotel->code }}</h5>
                            <p class="card-text">Address: {{ $hotel->address }}</p>
                            <a href="https://keyspot.me" target="__blank" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row d-flex justify-content-center mt-4 gap-3">
            @if ($pagination['prev_cursor'])
                <a href="{{ route('hotels.index', ['cursor' => $pagination['prev_cursor'], 'search' => $search]) }}"
                    class="btn btn-secondary col-md-2">
                    Предыдущая страница
                </a>
            @endif
            @if ($pagination['next_cursor'])
                <a href="{{ route('hotels.index', ['cursor' => $pagination['next_cursor'], 'search' => $search]) }}"
                    class="btn btn-secondary col-md-2">
                    Следующая страница
                </a>
            @endif
        </div>
    </div>
@endsection
