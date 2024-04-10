@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Заправка')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Заправка') }}</div>

        <div class="card-body bg-light">
            <table class="table  table-borderless">
                <tbody>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Дата заправки') }}</th>
                        <td class="text-end">{{ date('d.m.Y', $gas->created_at) }}</a></td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Мотоцикл') }}</th>
                        <td class="text-end"><a class="text-primary" href="{{ route('bike.show', $gas->bike_id) }}">{{ Helper::bikeName($gas->bike) }}</a></td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Название АЗС') }}</th>
                        <td class="text-end">{{ $gas->gas_station ?? ' - ' }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Пробег') }}</th>
                        <td class="text-end">{{ Helper::mileage($gas->mileage) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Литраж') }}</th>
                        <td class="text-end">{{ Helper::liters($gas->volume) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Стоимость') }}</th>
                        <td class="text-end">{{ Helper::price($gas->price) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Описание') }}</th>
                        <td class="text-end">{{ $gas->additional ?? ' - ' }}</td>
                    </tr>
                </tbody>
            </table>

            <form method="post" action="{{ route('gas.destroy', $gas->record_id) }}">
                @csrf
                @method('DELETE')

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('gas.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                    <a href="{{ route('gas.edit', $gas->record_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                    <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить заправку?')" class="btn btn-danger me-1 rounded">Удалить</button>
                    <a href="{{ route('gas.create') }}" class="btn btn-primary rounded">Добавить заправку</a>
                </div>
            </form>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
