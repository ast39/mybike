@php
    use App\Libs\Helper;
    use App\Libs\GasolineHelper;
@endphp

@extends('layouts.app')

@section('title', 'Мои траты')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Мои траты') }}</div>

        <div class="card-body bg-light">
            <!-- Фильтр -->
            <div class="mmot-margin20">
                @include('components/filter/payment')
            </div>

            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                <thead class="table-secondary">
                <tr>
                    <th class="text-start">Дата</th>
                    <th class="text-center">Мотоцикл</th>
                    <th class="text-center">Категория</th>
                    <th class="text-start">Название</th>
                    <th class="text-center">Пробег</th>
                    <th class="text-end">Сумма</th>
                    <th class="text-end">Действия</th>
                </tr>
                </thead>

                <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td data-label="Дата" class="text-start"><a class="text-primary" href="{{ route('payment.show', $payment->payment_id) }}">{{ date('d.m.Y', $payment->created_at) }}</a></td>
                        <td data-label="Мотоцикл" class="text-center"><a class="text-primary" href="{{ route('payment.show', $payment->bike->bike_id) }}">{{ Helper::bikeName($payment->bike) }}</a></td>
                        <td data-label="Категория" class="text-center">{{ $payment->type->title }}</td>
                        <td data-label="Название" class="text-start">{{ $payment->title }}</td>
                        <td data-label="Пробег" class="text-center">{{ Helper::mileage($payment->mileage) }}</td>
                        <td data-label="Сумма" class="text-end">{{ Helper::price($payment->price) }}</td>
                        <td data-label="Действия" class="text-end" style="min-width: 160px">
                            <form method="post" action="{{ route('payment.destroy', $payment->payment_id) }}" class="admin-table__nomargin">
                                @csrf
                                @method('DELETE')

                                <div class="mmot-table__action">
                                    <a title="Show" href="{{ route('payment.show', $payment->payment_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                    <a title="Update" href="{{ route('payment.edit', $payment->payment_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                    <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить трату?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="text-center p-1 mb-2 mt-2 bg-secondary bg-gradient text-white">{{ ('Траты отсутствуют') }}</div>
                        </td>
                    </tr>
                @endforelse

                <div>
                    {{ $payments->links() }}
                </div>

                </tbody>
            </table>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="{{ route('payment.create', ['bike' => request()->bike]) }}" class="btn btn-primary rounded">Добавить трату</a>
            </div>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif

            <table class="table table-borderless mt-3">
                <thead>
                    <tr class="border-bottom">
                        <th colspan="2" class="bg-primary text-white text-center">Сальдо по тратам</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Количество трат') }}</th>
                        <td class="text-end">{{ count($payments_all) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Сумма трат') }}</th>
                        <td class="text-end">{{ Helper::price(GasolineHelper::periodPrice($payments_all->toArray())) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
