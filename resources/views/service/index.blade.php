@php
    use Illuminate\Support\Str;
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Моя история обслуживания')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Моя история обслуживания') }}</div>

        <div class="card-body bg-light">
            <!-- Фильтр -->
            <div class="mmot-margin20">
                @include('components/filter/service')
            </div>

            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-start">Дата</th>
                        <th class="text-start">Название</th>
                        <th class="text-center">Мотоцикл</th>
                        <th class="text-center">Пробег</th>
                        <th class="text-center">Статус</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($works as $work)
                        <tr>
                            <td data-label="Дата" class="text-start">{{ date('d.m.Y', $work->created_at) }}</td>
                            <td data-label="Название" class="text-start"><a class="text-primary" href="{{ route('service.show', $work->record_id) }}">{{ Str::limit($work->title, 30) }}</a></td>
                            <td data-label="Мотоцикл" class="text-center"><a class="text-primary" href="{{ route('bike.show', $work->bike->bike_id) }}">{{ Helper::bikeName($work->bike) }}</a></td>
                            <td data-label="Пробег" class="text-center">{{ Helper::mileage($work->mileage) }}</td>
                            <td data-label="Статус" class="text-center">{{ Helper::statusText($work->status) }}</td>
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
                            <td colspan="6">
                                <div class="text-center p-1 mb-2 mt-2 bg-secondary bg-gradient text-white">{{ ('История обслуживания отсутствует') }}</div>
                            </td>
                        </tr>
                    @endforelse

                    <div>
                        {{ $works->links() }}
                    </div>
                </tbody>
            </table>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="{{ route('service.create', ['bike' => request()->bike]) }}" class="btn btn-primary rounded">Добавить запись обслуживания</a>
            </div>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
