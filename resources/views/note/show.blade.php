@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Заметка')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Заметка') }}</div>

        <div class="card-body bg-light">
            <table class="table table-borderless">
                <tbody>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Мотоцикл') }}</th>
                        <td class="text-end"><a class="text-primary" href="{{ route('bike.show', $note->bike_id) }}">{{ Helper::bikeName($note->bike) }}</a></td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Заголовок') }}</th>
                        <td class="text-end">{{ $note->title }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Описание') }}</th>
                        <td class="text-end">{{ $note->additional }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Пробег') }}</th>
                        <td class="text-end">{{ Helper::mileage($note->mileage) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <th class="text-start">{{ __('Дата размещения') }}</th>
                        <td class="text-end">{{ date('d.m.Y', $note->created_at) }}</a></td>
                    </tr>
                </tbody>
            </table>

            <form method="post" action="{{ route('note.destroy', $note->note_id) }}">
                @csrf
                @method('DELETE')

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('note.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                    <a href="{{ route('note.edit', $note->note_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                    <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить заметку?')" class="btn btn-danger me-1 rounded">Удалить</button>
                    <a href="{{ route('note.create') }}" class="btn btn-primary rounded">Добавить заметку</a>
                </div>
            </form>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
