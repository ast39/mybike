@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Редактирование заправки')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Редактирование заправки') }}</div>

        <div class="card-body bg-light">
            <form method="post" action="{{ route('gas.update', $gas->record_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="bike_id" class="form-label required">{{ __('Мотоцикл') }}</label>
                    <select  class="form-control form-select" id="bike_id" name="bike_id">
                        @forelse($bikes as $bike)
                            <option {{ $bike['bike_id'] == $gas->bike_id ? 'selected' : '' }} title="{{ Helper::bikeName($bike) }}" value="{{ $bike['bike_id'] }}">{{ Helper::bikeName($bike) }}</option>
                        @empty
                            <option title="Нет мотоциклов" value="0">Нет мотоциклов</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label for="gas_date" class="form-label">{{ __('Дата заправки') }}</label>
                    <input type="date" class="form-control" id="gas_date" name="gas_date" value="{{ date('Y-m-d', $gas->created_at ?? time()) }}" />
                </div>

                <div class="mb-3">
                    <label for="mileage" class="form-label required">{{ __('Пробег (км)') }}</label>
                    <input type="text" class="form-control" id="mileage" name="mileage" value="{{ $gas->mileage ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="volume" class="form-label required">{{ __('Литры') }}</label>
                    <input type="text" class="form-control" id="volume" name="volume" value="{{ $gas->volume ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label required">{{ __('Стоимость') }}</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ $gas->price ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="gas_station" class="form-label">{{ __('Станция') }}</label>
                    <input type="text" class="form-control" id="gas_station" name="gas_station" value="{{ $gas->gas_station ?? ''  }}" />
                </div>

                <div class="mb-3">
                    <label for="additional" class="form-label">{{ __('Примечание') }}</label>
                    <textarea  cols="10" rows="5" class="form-control" id="additional" name="additional">{{ old('additional') }}</textarea>
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
