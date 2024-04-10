@php
    use Illuminate\Support\Str;
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Мой гараж')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Мой гараж') }}</div>

        <div class="card-body bg-light">
            <!-- Фильтр -->
            <div class="mmot-margin20">
                @include('components/filter/bikes')
            </div>

            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-start">Мотоцикл</th>
                        <th class="text-center">Год</th>
                        <th class="text-center">Объем</th>
                        <th class="text-center">VIN</th>
                        <th class="text-start">Описание</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bikes as $bike)
                        <tr>
                            <td data-label="Марка" class="text-start"><a class="text-primary" href="{{ route('bike.show', $bike->bike_id) }}">{{ Helper::bikeName($bike) }}</a></td>
                            <td data-label="Год" class="text-center">{{ Helper::year($bike->year) }}</td>
                            <td data-label="Объем" class="text-center">{{ Helper::volume($bike->volume) }}</td>
                            <td data-label="VIN" class="text-center">{{ strtoupper($bike->vin ?? ' - ') }}</td>
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
                            <td colspan="6">
                                <div class="text-center p-1 mb-2 mt-2 bg-secondary bg-gradient text-white">{{ ('Автомобили отсутствуют') }}</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="{{ route('bike.create') }}" class="btn btn-primary rounded">Добавить мотоцикл</a>
            </div>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
