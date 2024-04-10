@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Добавить трату')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Добавить трату') }}</div>

        <div class="card-body bg-light">
            <form method="post" action="{{ route('payment.store') }}">
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
                    <label for="type_id" class="form-label required">{{ __('Категория') }}</label>
                    <select  class="form-control form-select" id="type_id" name="type_id">
                        @forelse($types as $type)
                            <option title="{{ $type['title'] }}" value="{{ $type['type_id'] }}">{{ $type['title'] }}</option>
                        @empty
                            <option title="Нет мотоциклов" value="0">Нет категорий</option>
                        @endforelse
                    </select>
                    @error('type_id')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label required">{{ __('Название') }}</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
                    @error('title')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="payment_date" class="form-label">{{ __('Дата траты') }}</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ old('payment_date') ?? date('Y-m-d', time()) }}" />
                    @error('payment_date')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mileage" class="form-label">{{ __('Пробег (км)') }}</label>
                    <input type="text" class="form-control" id="mileage" name="mileage" value="{{ old('mileage') }}" />
                    @error('mileage')
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
