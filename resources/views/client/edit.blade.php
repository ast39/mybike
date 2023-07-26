@php

@endphp

@extends('layouts.app')

@section('title', 'Редактирование профиля')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактирование профиля') }}</div>

                    <div class="card-body">

                        <form method="post" action="{{ route('client.update', $client->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Имя') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $client->name ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Логин') }}</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $client->email ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="year" class="form-label">{{ __('Год рождения') }}</label>
                                <input type="text" class="form-control" id="year" name="year" value="{{ $client->year ?? '' }}" />
                            </div>

                            <div class="mb-3">
                                <label for="card_id" class="form-label">{{ __('Номер карты клуба') }}</label>
                                <input type="text" class="form-control" id="card_id" name="card_id" value="{{ $client->card_id ?? '' }}" />
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-1 rounded">{{ __('Назад') }}</a>
                                <button type="submit" class="btn btn-primary rounded">{{ __('Сохранить') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
