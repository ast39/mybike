@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Запись о техническом обслуживании')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Запчасть') }}</div>

        <div class="card-body bg-light">
            <table class="table table-striped table-borderless">
                <tbody>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Мотоцикл') }}</th>
                        <td class="text-end"><a class="text-primary" href="{{ route('bike.show', $work->record_id) }}">{{ Helper::bikeName($work->bike) }}</a></td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Статус') }}</th>
                        <td class="text-end">{{ Helper::statusText($work->status) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Заголовок') }}</th>
                        <td class="text-end">{{ $work->title }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Описание работ') }}</th>
                        <td class="text-end">{{ $work->work_list }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Название сервиса') }}</th>
                        <td class="text-end">{{ $work->service_title }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Цена') }}</th>
                        <td class="text-end">{{ Helper::price($work->price) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Пробег') }}</th>
                        <td class="text-end">{{ Helper::mileage($work->mileage) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Комментарий') }}</th>
                        <td class="text-end">{{ $work->additional ?? ' - ' }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Дата ремонта') }}</th>
                        <td class="text-end">{{ date('d.m.Y', $work->created_at) }}</a></td>
                    </tr>
                </tbody>
            </table>

            <form method="post" action="{{ route('service.destroy', $work->record_id) }}">
                @csrf
                @method('DELETE')

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('service.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                    <a href="{{ route('service.edit', $work->record_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                    <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить запись?')" class="btn btn-danger me-1 rounded">Удалить</button>
                    <a href="{{ route('service.create') }}" class="btn btn-primary rounded">Добавить ТО</a>
                </div>
            </form>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
