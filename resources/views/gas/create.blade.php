@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Добавить заправку')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Добавить заправку') }}</div>

        <div class="card-body bg-light">
            <form method="post" action="{{ route('gas.store') }}">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="bike_id" class="form-label required">{{ __('Мотоцикл') }}</label>
                    <select  class="form-control form-select" id="bike_id" name="bike_id">
                        @forelse($bikes as $bike)
                            <option title="{{ Helper::bikeName($bike) }}" value="{{ $bike['bike_id'] }}" {{ request()->bike == $bike['bike_id'] ? 'selected' : null }}>{{ Helper::bikeName($bike) }}</option>
                        @empty
                            <option title="Нет мотоциклов" value="0">Нет мотоциклов</option>
                        @endforelse
                    </select>
                    @error('bike_id')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gas_date" class="form-label">{{ __('Дата заправки') }}</label>
                    <input type="date" class="form-control" id="gas_date" name="gas_date" value="{{ old('gas_date') ?? date('Y-m-d', time()) }}" />
                    @error('gas_date')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mileage" class="form-label required">{{ __('Пробег (км)') }}</label>
                    <input type="text" class="form-control" id="mileage" name="mileage" value="{{ old('mileage') }}" />
                    @error('number')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="volume" class="form-label required">{{ __('Литры') }}</label>
                    <input type="text" class="form-control" id="volume" name="volume" value="{{ old('volume') }}" />
                    @error('volume')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label required">{{ __('Стоимость') }}</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" />
                    @error('price')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gas_station" class="form-label">{{ __('Станция') }}</label>
                    <input type="text" class="form-control" id="gas_station" name="gas_station" value="{{ old('gas_station') }}" aria-describedby="stationHelp" />
                    <div id="titleHelp" class="form-text">{{ __('Название АЗС') }}</div>
                    @error('station')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="additional" class="form-label">{{ __('Примечание') }}</label>
                    <textarea  cols="10" rows="5" class="form-control" id="additional" name="additional">{{ old('additional') }}</textarea>
                    @error('additional')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-1 rounded">{{ __('Назад') }}</a>
                    <button type="submit" class="btn btn-primary rounded">{{ __('Добавить') }}</button>
                </div>
            </form>
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
