@php
    use App\Libs\Helper;
    use App\Enums\WorkStatusEnum;
@endphp

@extends('layouts.app')

@section('title', 'Запись о техническом обслуживании')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Запчасть') }}</div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('ID в базе') }}</th>
                                    <th scope="col">#{{ $work->record_id ?? ' - ' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{ __('Мотоцикл') }}</th>
                                    <td><a href="{{ route('bike.show', $work->record_id) }}">{{ Helper::bikeName($work->bike) }}</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Статус') }}</th>
                                    <td>{{ Helper::statusText($work->status) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Заголовок') }}</th>
                                    <td>{{ $work->title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Описание работ') }}</th>
                                    <td>{{ $work->work_list }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Название сервиса') }}</th>
                                    <td>{{ $work->service_title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Цена') }}</th>
                                    <td>{{ number_format($work->price ?: 0, 2, '.', ' ') }} р.</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Пробег') }}</th>
                                    <td>{{ Helper::mileage($work->mileage) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Комментарий') }}</th>
                                    <td>{{ $work->additional }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Дата размещения') }}</th>
                                    <td>{{ date('d.m.Y', $work->created_at) }}</a></td>
                                </tr>
                            </tbody>
                        </table>

                        <form method="post" action="{{ route('service.destroy', $work->record_id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('service.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                                <a href="{{ route('service.edit', $work->record_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                                <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить запись?')" class="btn btn-danger rounded">Удалить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
