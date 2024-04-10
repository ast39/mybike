@php

@endphp

@extends('layouts.app')

@section('title', 'Редактирование автомобиля')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Редактирование автомобиля') }}</div>

        <div class="card-body bg-light">
            <form method="post" action="{{ route('bike.update', $bike->bike_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="mark_id" class="form-label required">{{ __('Производитель') }}</label>
                    <select  class="form-control form-select" id="mark_id" name="mark_id">
                        @forelse($marks as $mark)
                            <option {{ $bike->mark_id == $mark['mark_id'] ? 'selected' : '' }} title="{{ $mark['title'] }}" value="{{ $mark['mark_id'] }}">{{ $mark['title'] }}</option>
                        @empty
                            <option title="Нет производителей" value="0">Нет производителей</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label required">{{ __('Модель') }}</label>
                    <input type="text" class="form-control" id="model" name="model" value="{{ $bike->model ?? '' }}" aria-describedby="modelHelp" />
                    <div id="modelHelp" class="form-text">{{ __('Модель автомобиля') }}</div>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label required">{{ __('Год выпуска') }}</label>
                    <input type="text" class="form-control" id="year" name="year" value="{{ $bike->year ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="volume" class="form-label required">{{ __('Объем двигателя') }}</label>
                    <input type="text" class="form-control" id="volume" name="volume" value="{{ $bike->volume ?? '' }}" aria-describedby="volumeHelp" />
                    <div id="volumeHelp" class="form-text">{{ __('Объем двигателя в cm3') }}</div>
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">{{ __('Гос номер') }}</label>
                    <input type="text" class="form-control" id="number" name="number" value="{{ strtolower($bike->number ?? '') }}" />
                </div>

                <div class="mb-3">
                    <label for="vin" class="form-label">{{ __('Vin номер') }}</label>
                    <input type="text" class="form-control" id="vin" name="vin" value="{{ $bike->vin ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="additional" class="form-label">{{ __('Описание мотоцикла') }}</label>
                    <textarea class="form-control" cols="10" rows="5" id="additional" name="additional" aria-describedby="additionalHelp">{{ $bike->additional }}</textarea>
                    <div id="additionalHelp" class="form-text">{{ __('Свободные заметки о мотоцикле') }}</div>
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
    </div>
@endsection
