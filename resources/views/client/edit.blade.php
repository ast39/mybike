@php

@endphp

@extends('layouts.app')

@section('title', 'Редактирование профиля')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Редактирование профиля') }}</div>

        <div class="card-body bg-light">
            <form method="post" action="{{ route('client.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label required">{{ __('Имя') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $client->name ?? '' }}" />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label required">{{ __('Логин') }}</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $client->email ?? '' }}" />
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-1 rounded">{{ __('Назад') }}</a>
                    <button type="submit" class="btn btn-primary rounded">{{ __('Сохранить') }}</button>
                </div>
            </form>
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
