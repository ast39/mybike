@php
    use App\Libs\Helper;
    use App\Enums\WorkStatusEnum;
@endphp

@extends('layouts.app')

@section('title', 'Добавить запись об обслуживании')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Добавить запись об обслуживании') }}</div>

                    <div class="card-body">

                        <form method="post" action="{{ route('service.store') }}">
                            @csrf
                            @method('POST')

                            <div class="mb-3">
                                <label for="bike_id" class="form-label required">{{ __('Мотоцикл') }}</label>
                                <select  class="form-control form-select" id="bike_id" name="bike_id">
                                    @forelse($bikes as $bike)
                                        <option title="{{ Helper::bikeName($bike) }}" value="{{ $bike['bike_id'] }}">{{ Helper::bikeName($bike) }}</option>
                                    @empty
                                        <option title="Нет мотоциклов" value="0">Нет мотоциклов</option>
                                    @endforelse
                                </select>
                                @error('bike_id')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label required">{{ __('Статус') }}</label>
                                <select  class="form-control form-select" id="status" name="status">
                                    <option title="{{ Helper::statusText(WorkStatusEnum::Planned->value) }}" {{ old('status') == WorkStatusEnum::Planned->value ? 'selected' : '' }} value="{{ WorkStatusEnum::Planned->value }}">{{ Helper::statusText(WorkStatusEnum::Planned->value) }}</option>
                                    <option title="{{ Helper::statusText(WorkStatusEnum::InWork->value) }}" {{ old('status') == WorkStatusEnum::InWork->value ? 'selected' : '' }} value="{{ WorkStatusEnum::InWork->value }}">{{ Helper::statusText(WorkStatusEnum::InWork->value) }}</option>
                                    <option title="{{ Helper::statusText(WorkStatusEnum::Completed->value) }}" {{ old('status') == WorkStatusEnum::Completed->value ? 'selected' : '' }} value="{{ WorkStatusEnum::Completed->value }}">{{ Helper::statusText(WorkStatusEnum::Completed->value) }}</option>
                                </select>
                                @error('status')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label required">{{ __('Заголовок') }}</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
                                @error('title')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="work_list" class="form-label">{{ __('Описание работ') }}</label>
                                <textarea  cols="10" rows="5" class="form-control" id="work_list" name="work_list">{{ old('work_list') }}</textarea>
                                @error('work_list')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="service_title" class="form-label">{{ __('Название сервиса') }}</label>
                                <input type="text" class="form-control" id="service_title" name="service_title" value="{{ old('service_title') }}" />
                                @error('service_title')
                                <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">{{ __('Цена') }}</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" />
                                @error('price')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mileage" class="form-label">{{ __('Пробег') }}</label>
                                <input type="text" class="form-control" id="mileage" name="mileage" value="{{ old('mileage') }}" />
                                @error('mileage')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="additional" class="form-label">{{ __('Комментарии') }}</label>
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
                </div>
            </div>
        </div>
    </div>
@endsection
