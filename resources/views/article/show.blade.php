@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Запчасть')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Запчасть') }}</div>

        <div class="card-body bg-light">
            <table class="table table-striped table-borderless">
                <tbody>
                    <tr>
                        <th class="text-start">{{ __('Мотоцикл') }}</th>
                        <td class="text-end"><a class="text-primary" href="{{ route('bike.show', $article->bike_id) }}">{{ Helper::bikeName($article->bike) }}</a></td>
                    </tr>
                    <tr>
                        <th class="text-start">{{ __('Артикул') }}</th>
                        <td class="text-end"><a class="text-primary" target="_blank" href="https://zap39.ru/price_items/search?oem={{ $article->article }}">{{ $article->article }}</a></td>
                    </tr>
                    <tr>
                        <th class="text-start">{{ __('Заголовок') }}</th>
                        <td class="text-end">{{ $article->title }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">{{ __('Описание') }}</th>
                        <td class="text-end">{{ $article->additional ?? ' - ' }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">{{ __('Цена') }}</th>
                        <td class="text-end">{{ Helper::price($article->price) }}</td>
                    </tr>
                    <tr>
                        <th class="text-start">{{ __('Дата размещения') }}</th>
                        <td class="text-end">{{ date('d.m.Y', $article->created_at) }}</a></td>
                    </tr>
                </tbody>
            </table>

            <form method="post" action="{{ route('article.destroy', $article->article_id) }}">
                @csrf
                @method('DELETE')

                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('article.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                    <a href="{{ route('article.edit', $article->article_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                    <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить заметку?')" class="btn btn-danger me-1 rounded">Удалить</button>
                    <a href="{{ route('article.create') }}" class="btn btn-primary rounded">Добавить запчасть</a>
                </div>
            </form>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
