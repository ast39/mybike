@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Редактирование заметки')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Редактирование заметки') }}</div>

        <div class="card-body bg-light">
            <form method="post" action="{{ route('note.update', $note->note_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="bike_id" class="form-label required">{{ __('Мотоцикл') }}</label>
                    <select  class="form-control form-select" id="bike_id" name="bike_id">
                        @forelse($bikes as $bike)
                            <option {{ $bike['bike_id'] == $note->bike_id ? 'selected' : '' }} title="{{ Helper::bikeName($bike) }}" value="{{ $bike['bike_id'] }}">{{ Helper::bikeName($bike) }}</option>
                        @empty
                            <option title="Нет мотоциклов" value="0">Нет мотоциклов</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label for="note_date" class="form-label">{{ __('Дата заметки') }}</label>
                    <input type="date" class="form-control" id="note_date" name="note_date" value="{{ date('Y-m-d', $note->created_at ?? time()) }}" />
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label required">{{ __('Заголовок') }}</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $note->title ?? '' }}" aria-describedby="titleHelp" />
                    <div id="titleHelp" class="form-text">{{ __('Краткое название') }}</div>
                </div>

                <div class="mb-3">
                    <label for="additional" class="form-label required">{{ __('Описание') }}</label>
                    <textarea  cols="10" rows="5" class="form-control" id="additional" name="additional">{{ $note->additional }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="mileage" class="form-label">{{ __('Пробег (км)') }}</label>
                    <input type="text" class="form-control" id="mileage" name="mileage" value="{{ $note->mileage ?? '' }}" />
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
