@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Добавить запчасть')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Добавить запчасть') }}</div>

                    <div class="card-body">

                        <form method="post" action="{{ route('article.store') }}">
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
                                <label for="article" class="form-label required">{{ __('Артикул') }}</label>
                                <input type="text" class="form-control" id="article" name="article" value="{{ old('article') }}" />
                                @error('article')
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
                                <label for="additional" class="form-label">{{ __('Описание') }}</label>
                                <textarea  cols="10" rows="5" class="form-control" id="additional" name="additional">{{ old('additional') }}</textarea>
                                @error('additional')
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
