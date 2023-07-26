@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Мой блокнот')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Мой блокнот') }}</div>

                    <div class="card-body">
                        <!-- Фильтр -->
                        <div class="mmot-margin20">
                            @include('components/filter/notes')
                        </div>

                        <table class="table table-striped table-bordered admin-table__adapt admin-table__instrument">
                            <thead class="table-secondary">
                            <tr>
                                <th class="text-right">#</th>
                                <th class="text-start">Дата</th>
                                <th class="text-start">Заголовок</th>
                                <th class="text-center">Мотоцикл</th>
                                <th class="text-center">Пробег</th>
                                <th class="text-end">Действия</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($notes as $note)
                                <tr>
                                    <td class="text-right">{{ $loop->iteration }}</td>
                                    <td data-label="Дата" class="text-start">{{ date('d.m.Y', $note->created_at) }}</td>
                                    <td data-label="Заголовок" class="text-start"><a class="text-primary" href="{{ route('note.show', $note->note_id) }}">{{ $note->title }}</a></td>
                                    <td data-label="Мотоцикл" class="text-center"><a class="text-primary" href="{{ route('bike.show', $note->bike->bike_id) }}">{{ Helper::bikeName($note->bike) }}</a></td>
                                    <td data-label="Пробег" class="text-center">{{ Helper::mileage(($note->mileage) }}</td>
                                    <td data-label="Действия" class="text-end" style="min-width: 160px">
                                        <form method="post" action="{{ route('note.destroy', $note->note_id) }}" class="admin-table__nomargin">
                                            @csrf
                                            @method('DELETE')

                                            <div class="mmot-table__action">
                                                <a title="Show" href="{{ route('note.show', $note->note_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                                <a title="Update" href="{{ route('note.edit', $note->note_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                                <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить заметку?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="text-center p-2 mb-2 bg-secondary bg-gradient text-white rounded">{{ ('Заметки отсутствуют') }}</div>
                                    </td>
                                </tr>
                            @endforelse

                            <div>
                                {{ $notes->links() }}
                            </div>
                            </tbody>
                        </table>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('note.create') }}" class="btn btn-primary rounded">Добавить заметку</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
