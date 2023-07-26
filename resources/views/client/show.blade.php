@php

@endphp

@extends('layouts.app')

@section('title', 'Карточка клиента')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Карточка клиента') }}</div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('ID в базе') }}</th>
                                <th scope="col">#{{ $client->id ?? ' - ' }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ __('Имя') }}</th>
                                <td>{{ $client->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Логин') }}</th>
                                <td>{{ $client->email ?: ' - ' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Год рождения') }}</th>
                                <td>{{ $client->year }} г.</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Номер карты клуба') }}</th>
                                <td>№{{ $client->card_id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Дата регистрации') }}</th>
                                <td>{{ date('d.m.Y', $client->created_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Мотоциклов в гараже') }}</th>
                                <td>{{ count($client->bikes ?: []) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Визитов на сервис') }}</th>
                                <td>{{ $client->visits }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Оставлено в кассе') }}</th>
                                <td>{{ number_format($client->cashed, 0, '.', ' ') }} р.</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('client.edit', $client->id) }}" class="btn btn-warning rounded">Изменить</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
