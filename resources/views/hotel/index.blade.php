@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">ID: {{ $hotel->id }}</h5>
                            <p class="card-text">Address: {{ $hotel->address }}</p>
                            <a href="https://keyspot.me" target="__blank" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row d-flex justify-content-center mt-4 gap-3">
            @if ($pagination['prev_cursor'])
                <a href="{{ route('hotels.index', ['cursor' => $pagination['prev_cursor']]) }}" class="btn btn-secondary col-md-2">
                    Предыдущая страница
                </a>
            @endif
            @if ($pagination['next_cursor'])
                <a href="{{ route('hotels.index', ['cursor' => $pagination['next_cursor']]) }}" class="btn btn-secondary col-md-2">
                    Следующая страница
                </a>
            @endif
        </div>
    </div>
@endsection
