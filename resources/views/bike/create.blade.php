@extends('layouts.app')

@section('title', 'Добавить мотоцикл')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Добавить мотоцикл') }}</div>

                    <div class="card-body">

                        <form method="post" action="{{ route('bike.store') }}">
                            @csrf
                            @method('POST')

                            <div class="mb-3">
                                <label for="mark_id" class="form-label required">{{ __('Производитель') }}</label>
                                <select  class="form-control form-select" id="mark_id" name="mark_id">
                                    @forelse($marks as $mark)
                                        <option {{ old('mark_id') == $mark['mark_id'] ? 'selected' : '' }} title="{{ $mark['title'] }}" value="{{ $mark['mark_id'] }}">{{ $mark['title'] }}</option>
                                    @empty
                                        <option title="Нет производителей" value="0">Нет производителей</option>
                                    @endforelse
                                </select>
                                @error('mark_id')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="model" class="form-label required">{{ __('Модель') }}</label>
                                <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" aria-describedby="modelHelp" />
                                <div id="modelHelp" class="form-text">{{ __('Модель мотоцикла') }}</div>
                                @error('model')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="year" class="form-label required">{{ __('Год выпуска') }}</label>
                                <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}" />
                                @error('year')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="volume" class="form-label required">{{ __('Объем двигателя') }}</label>
                                <input type="text" class="form-control" id="volume" name="volume" value="{{ old('volume') }}" aria-describedby="volumeHelp" />
                                <div id="volumeHelp" class="form-text">{{ __('Объем двигателя в cm3') }}</div>
                                @error('volume')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label">{{ __('Гос номер') }}</label>
                                <input type="text" class="form-control" id="number" name="number" value="{{ old('number') }}" />
                                @error('number')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="vin" class="form-label">{{ __('Vin номер') }}</label>
                                <input type="text" class="form-control" id="vin" name="vin" value="{{ old('vin') }}" />
                                @error('vin')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="additional" class="form-label">{{ __('Описание мотоцикла') }}</label>
                                <textarea  cols="10" rows="5" class="form-control" id="additional" name="additional" aria-describedby="additionalHelp">{{ old('additional') }}</textarea>
                                <div id="additionalHelp" class="form-text">{{ __('Свободные заметки о мотоцикле') }}</div>
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
