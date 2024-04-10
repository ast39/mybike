@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Редактирование запчасти')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Редактирование запчасти') }}</div>

        <div class="card-body bg-light">
            <form method="post" action="{{ route('article.update', $article->article_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="bike_id" class="form-label required">{{ __('Мотоцикл') }}</label>
                    <select  class="form-control form-select" id="bike_id" name="bike_id">
                        @forelse($bikes as $bike)
                            <option {{ $bike['bike_id'] == $article->bike_id ? 'selected' : '' }} title="{{ Helper::bikeName($bike) }}" value="{{ $bike['bike_id'] }}">{{ Helper::bikeName($bike) }}</option>
                        @empty
                            <option title="Нет мотоциклов" value="0">Нет мотоциклов</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label for="article" class="form-label required">{{ __('Артикул') }}</label>
                    <input type="text" class="form-control" id="article" name="article" value="{{ $article->article ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label required">{{ __('Заголовок') }}</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $article->title ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="additional" class="form-label">{{ __('Описание') }}</label>
                    <textarea  cols="10" rows="5" class="form-control" id="additional" name="additional">{{ $article->additional }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">{{ __('Цена (р.)') }}</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ number_format($article->price ?? 0, 2, '.', '') }}" />
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-1 rounded">{{ __('Назад') }}</a>
                    <button type="submit" class="btn btn-primary rounded">{{ __('Сохранить') }}</button>
                </div>
            </form>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
