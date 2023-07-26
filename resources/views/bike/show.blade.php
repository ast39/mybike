@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Карточка мотоцикла')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Карточка мотоцикла') }}</div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('ID в базе') }}</th>
                                <th scope="col">#{{ $bike->bike_id ?? ' - ' }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{ __('Производитель') }}</th>
                                <td>{{ $bike->mark->title }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Модель') }}</th>
                                <td>{{ $bike->model }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Год выпуска') }}</th>
                                <td>{{ $bike->year }} г.</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Объем') }}</th>
                                <td>{{ $bike->volume }} cm3</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Текущий владелец') }}</th>
                                <td><a class="text-primary" href="{{ route('client.show', $bike->owner->id) }}">{{ $bike->owner->name }}</a></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Гос номер') }}</th>
                                <td>{{ $bike->number ?: ' - ' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Vin номер') }}</th>
                                <td>{{ $bike->vin ?: ' - ' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Описание мотоцикла') }}</th>
                                <td>{{ $bike->additional }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Дата регистрации') }}</th>
                                <td>{{ date('d.m.Y', $bike->created_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Визитов на сервис') }}</th>
                                <td>{{ $bike->visits }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Оставлено в кассе') }}</th>
                                <td>{{ number_format($bike->cashed, 0, '.', ' ') }} р.</td>
                            </tr>
                            </tbody>
                        </table>

                        <form method="post" action="{{ route('bike.destroy', $bike->bike_id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('bike.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                                <a href="{{ route('bike.edit', $bike->bike_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                                <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить мотоцикл?')" class="btn btn-danger rounded">Удалить</button>
                                <a href="{{ route('service.create', ['bike' => $bike->bike_id]) }}" class="btn btn-primary">{{ __('Добавить ТО') }}</a>
                            </div>

                        </form>

                        {{-- История обслуживания байка --}}
                        <div class="accordion">
                            <div class="accordion-item mt-3">
                                <h2 class="accordion-header shadow-sm" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                        {{ __('История обслуживания') }}
                                    </button>
                                </h2>

                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body">
                                        <table class="table table-striped table-bordered admin-table__adapt admin-table__instrument">
                                            <thead>
                                            <tr>
                                                <th class="text-end">#</th>
                                                <th class="text-start">Дата</th>
                                                <th class="text-start">Название</th>
                                                <th class="text-start">Клиент</th>
                                                <th class="text-start">Сервис</th>
                                                <th class="text-end">Пробег</th>
                                                <th class="text-end">Стоимость</th>
                                                <th class="text-end">Действия</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @forelse($bike->works as $work)
                                                <tr>
                                                    <td class="text-end">{{ $loop->iteration }}</td>
                                                    <td data-label="Дата" class="text-start">{{ date('d.m.Y', $work->created_at) }}</td>
                                                    <td data-label="Название" class="text-start"><a class="text-primary" href="{{ route('service.show', $work->record_id) }}">{{ Str::limit($work->title, 30) }}</a></td>
                                                    <td data-label="Клиент" class="text-left"><a class="text-primary" href="{{ route('client.show', $bike->owner->id) }}">{{ $work->client->name }}</a></td>
                                                    <td data-label="Сервис" class="text-left">{{ $work->service_title ?: ' - ' }}</td>
                                                    <td data-label="Пробег" class="text-end">{{ Helper::mileage($work->mileage) }}</td>
                                                    <td data-label="Стоимость" class="text-end">{{ number_format($work->price, 0, '.', ' ') }} р.</td>
                                                    <td data-label="Действия" class="text-end" style="min-width: 160px">
                                                        <form method="post" action="{{ route('service.destroy', $work->record_id) }}" class="admin-table__nomargin">
                                                            @csrf
                                                            @method('DELETE')

                                                            <div class="mmot-table__action">
                                                                <a title="Show" href="{{ route('service.show', $work->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                                <a title="Update" href="{{ route('service.edit', $work->record_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                                <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить запись?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8">
                                                        <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Список работ пуст') }}</div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>

                                        {{-- Ошибки если есть --}}
                                        @if(count($errors) > 0)
                                            <div class="alert alert-danger mt-3">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
