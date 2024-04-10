@php
    use App\Libs\Helper;
    use App\Libs\GasolineHelper;
@endphp

@extends('layouts.app')

@section('title', 'Карточка автомобиля')

@section('content')
    <div class="card bg-primary text-white">

        <div class="card-header">{{ __('Карточка автомобиля') }}</div>

        <div class="card-body bg-light">

            <table class="table table-borderless">
                <tbody>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Модель') }}</th>
                    <td class="text-end">{{ Helper::bikeName($bike) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Год выпуска') }}</th>
                    <td class="text-end">{{ $bike->year }} г.</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Объем') }}</th>
                    <td class="text-end">{{ Helper::volume($bike->volume) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Гос номер') }}</th>
                    <td class="text-end">{{ strtolower($bike->number ?: ' - ') }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Vin номер') }}</th>
                    <td class="text-end">{{ $bike->vin ?: ' - ' }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Описание мотоцикла') }}</th>
                    <td class="text-end">{{ $bike->additional ?: ' - ' }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Последний зафиксированный пробег') }}</th>
                    <td class="text-end">{{ Helper::mileage($bike->max_mileage) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Пробег во владении') }}</th>
                    <td class="text-end">{{ Helper::mileage($bike->bike_mileage) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Расход топлива') }}</th>
                    <td class="text-end">{{ GasolineHelper::avgLiterToKm($bike->fuel_expenses) }}</td>
                </tr>

                <tr class="border-bottom"><td colspan="2" class="bg-light"></td></tr>

                <tr class="border-bottom">
                    <th class="text-start">{{ __('Налоги и страховки') }}</th>
                    <td class="text-end">{{ Helper::price($bike->osago_expensed + $bike->rasko_expensed + $bike->tax_expensed) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Штрафы') }}</th>
                    <td class="text-end">{{ Helper::price($bike->penalty_expensed) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Паркинг') }}</th>
                    <td class="text-end">{{ Helper::price($bike->parking_expensed) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Мойка') }}</th>
                    <td class="text-end">{{ Helper::price($bike->washing_expensed) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Платежи по кредиту') }}</th>
                    <td class="text-end">{{ Helper::price($bike->credit_expensed) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Потрачено на ремонт') }}</th>
                    <td class="text-end">{{ Helper::price($bike->service_expensed) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Потрачено на топливо') }}</th>
                    <td class="text-end">{{ Helper::price($bike->fuel_expensed) }}</td>
                </tr>
                <tr class="border-bottom">
                    <th class="text-start">{{ __('Стоимость 1км') }}</th>
                    <td class="text-end">{{ Helper::price($bike->km_price, true) }}</td>
                </tr>
                </tbody>
            </table>

            <form method="post" action="{{ route('bike.destroy', $bike->bike_id) }}">
                @csrf
                @method('DELETE')

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('bike.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                    <a href="{{ route('bike.edit', $bike->bike_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                    <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить мотоцикл?')" class="btn btn-danger me-1 rounded">Удалить</button>
                    <a href="{{ route('bike.create') }}" class="btn btn-primary rounded">Добавить мотоцикл</a>
                </div>
            </form>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>
    </div>
@endsection
