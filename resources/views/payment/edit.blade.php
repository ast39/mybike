@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Редактирование траты')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Редактирование траты') }}</div>

        <div class="card-body bg-light">
            <form method="post" action="{{ route('payment.update', $payment->payment_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="bike_id" class="form-label required">{{ __('Мотоцикл') }}</label>
                    <select  class="form-control form-select" id="bike_id" name="bike_id">
                        @forelse($bikes as $bike)
                            <option {{ $bike['bike_id'] == $payment->bike_id ? 'selected' : '' }} title="{{ Helper::bikeName($bike) }}" value="{{ $bike['bike_id'] }}">{{ Helper::bikeName($bike) }}</option>
                        @empty
                            <option title="Нет мотоциклов" value="0">Нет мотоциклов</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label for="type_id" class="form-label required">{{ __('Категория') }}</label>
                    <select  class="form-control form-select" id="type_id" name="type_id">
                        @forelse($types as $type)
                            <option {{ $type['type_id'] == $payment->type_id ? 'selected' : '' }} title="{{$type['title'] }}" value="{{ $type['type_id'] }}">{{ $type['title'] }}</option>
                        @empty
                            <option title="Нет категорий" value="0">Нет категорий</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label required">{{ __('Название') }}</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $payment->title ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="payment_date" class="form-label">{{ __('Дата заправки') }}</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ date('Y-m-d', $payment->created_at ?? time()) }}" />
                </div>

                <div class="mb-3">
                    <label for="mileage" class="form-label">{{ __('Пробег (км)') }}</label>
                    <input type="text" class="form-control" id="mileage" name="mileage" value="{{ $payment->mileage ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label required">{{ __('Стоимость') }}</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ $payment->price ?? '' }}" />
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
