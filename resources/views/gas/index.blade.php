@php
    use App\Libs\Helper;
    use App\Libs\GasolineHelper;
@endphp

@extends('layouts.app')

@section('title', 'Мои заправки')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Мои заправки') }}</div>

        <div class="card-body bg-light">
            <!-- Фильтр -->
            <div class="mmot-margin20">
                @include('components/filter/gas')
            </div>

            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                <thead class="table-secondary">
                <tr>
                    <th class="text-start">Дата</th>
                    <th class="text-center">Мотоцикл</th>
                    <th class="text-center">Станция</th>
                    <th class="text-center">Пробег</th>
                    <th class="text-center">Литры</th>
                    <th class="text-end">Сумма</th>
                    <th class="text-end">Действия</th>
                </tr>
                </thead>

                <tbody>
                @forelse($gasoline as $gas)
                    <tr>
                        <td data-label="Дата" class="text-start"><a class="text-primary" href="{{ route('gas.show', $gas->record_id) }}">{{ date('d.m.Y', $gas->created_at) }}</a></td>
                        <td data-label="Мотоцикл" class="text-center"><a class="text-primary" href="{{ route('bike.show', $gas->bike->bike_id) }}">{{ Helper::bikeName($gas->bike) }}</a></td>
                        <td data-label="Станция" class="text-center">{{ $gas->gas_station ?? ' - ' }}</td>
                        <td data-label="Пробег" class="text-center">{{ Helper::mileage($gas->mileage) }}</td>
                        <td data-label="Литры" class="text-center">{{ Helper::liters($gas->volume) }}</td>
                        <td data-label="Сумма" class="text-end">{{ Helper::price($gas->price) }}</td>
                        <td data-label="Действия" class="text-end" style="min-width: 160px">
                            <form method="post" action="{{ route('gas.destroy', $gas->record_id) }}" class="admin-table__nomargin">
                                @csrf
                                @method('DELETE')

                                <div class="mmot-table__action">
                                    <a title="Show" href="{{ route('gas.show', $gas->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                    <a title="Update" href="{{ route('gas.edit', $gas->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                    <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить заправку?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="text-center p-1 mb-2 mt-2 bg-secondary bg-gradient text-white">{{ ('Заправки отсутствуют') }}</div>
                        </td>
                    </tr>
                @endforelse

                <div>
                    {{ $gasoline->links() }}
                </div>

                </tbody>
            </table>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="{{ route('gas.create', ['bike' => request()->bike]) }}" class="btn btn-primary rounded">Добавить заправку</a>
            </div>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif

            <table class="table table-borderless mt-3">
                <thead>
                    <tr class="border-bottom">
                        <th colspan="2" class="bg-primary text-white text-center">Сальдо по заправкам</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Количество заправок') }}</th>
                        <td class="text-end">{{ count($gasoline_all) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Количество литров') }}</th>
                        <td class="text-end">{{ Helper::liters(GasolineHelper::periodLiters($gasoline_all->toArray())) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Сумма заправок') }}</th>
                        <td class="text-end">{{ Helper::price(GasolineHelper::periodPrice($gasoline_all->toArray())) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td colspan="2" class="bg-light"></td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Средняя стоимость литра') }}</th>
                        <td class="text-end">{{ Helper::price(GasolineHelper::avgLiterPrice($gasoline_all->toArray()), true) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Средняя заправка в л.') }}</th>
                        <td class="text-end">{{ Helper::liters(GasolineHelper::avgGasLiters($gasoline_all->toArray())) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Средняя заправка в р.') }}</th>
                        <td class="text-end">{{ Helper::price(GasolineHelper::avgGasPrice($gasoline_all->toArray())) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
