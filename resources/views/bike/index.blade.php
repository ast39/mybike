@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Мой гараж')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Мой гараж') }}</div>

                    <div class="card-body">
                        <!-- Фильтр -->
                        <div class="mmot-margin20">
                            @include('components/filter/bikes')
                        </div>

                        <table class="table table-striped table-bordered admin-table__adapt admin-table__instrument">
                            <thead class="table-secondary">
                            <tr>
                                <th class="text-right">#</th>
                                <th class="text-start">Марка</th>
                                <th class="text-start">Модель</th>
                                <th class="text-center">Год</th>
                                <th class="text-center">Объем</th>
                                <th class="text-center">Текущий владелец</th>
                                <th class="text-center">Гос номер</th>
                                <th class="text-center">Vin номер</th>
                                <th class="text-start">Описание</th>
                                <th class="text-end">Действия</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($bikes as $bike)
                                <tr>
                                    <td class="text-right">{{ $loop->iteration }}</td>
                                    <td data-label="Марка" class="text-start"><a class="text-primary" href="{{ route('bike.show', $bike->bike_id) }}">{{ $bike->mark->title }}</a></td>
                                    <td data-label="Модель" class="text-start">{{ $bike->model }}</td>
                                    <td data-label="Год" class="text-center">{{ $bike->year }}</td>
                                    <td data-label="Объем" class="text-center">{{ $bike->volume }}</td>
                                    <td data-label="Текущий владелец" class="text-center">{{ $bike->owner->name }}</td>
                                    <td data-label="Гос номер" class="text-center">{{ $bike->number ?: ' - ' }}</td>
                                    <td data-label="Vin номер" class="text-center">{{ $bike->vin ?: ' - ' }}</td>
                                    <td data-label="Описание" class="text-start">{{ Str::limit($bike->additional, 30) }}</td>
                                    <td data-label="Действия" class="text-end" style="min-width: 160px">
                                        <form method="post" action="{{ route('bike.destroy', $bike->bike_id) }}" class="admin-table__nomargin">
                                            @csrf
                                            @method('DELETE')

                                            <div class="mmot-table__action">
                                                <a title="Show" href="{{ route('bike.show', $bike->bike_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                <a title="Update" href="{{ route('bike.edit', $bike->bike_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить мотоцикл?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Мотоциклы отсутствуют') }}</div>
                                    </td>
                                </tr>
                            @endforelse

                            <div>
                                {{ $bikes->links() }}
                            </div>
                            </tbody>
                        </table>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('bike.create') }}" class="btn btn-primary rounded">Добавить мотоцикл</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
