@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Заметка')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Заметка') }}</div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('ID в базе') }}</th>
                                    <th scope="col">#{{ $note->note_id ?? ' - ' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{ __('Мотоцикл') }}</th>
                                    <td>{{ Helper::bikeName($note->bike) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Заголовок') }}</th>
                                    <td>{{ $note->title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Описание') }}</th>
                                    <td>{{ $note->additional }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Пробег') }}</th>
                                    <td>{{ (Helper::mileage($note->mileage) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Дата размещения') }}</th>
                                    <td>{{ date('d.m.Y', $note->created_at) }}</a></td>
                                </tr>
                            </tbody>
                        </table>

                        <form method="post" action="{{ route('note.destroy', $note->note_id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('note.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                                <a href="{{ route('note.edit', $note->note_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                                <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить заметку?')" class="btn btn-danger rounded">Удалить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
