@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Запчасть')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Запчасть') }}</div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('ID в базе') }}</th>
                                    <th scope="col">#{{ $article->article_id ?? ' - ' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{ __('Мотоцикл') }}</th>
                                    <td>{{ Helper::bikeName($article->bike) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Артикул') }}</th>
                                    <td><a target="_blank" href="https://zap39.ru/price_items/search?oem={{ $article->article }}">{{ $article->article }}</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Заголовок') }}</th>
                                    <td>{{ $article->title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Описание') }}</th>
                                    <td>{{ $article->additional }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Цена') }}</th>
                                    <td>{{ number_format($article->price ?: 0, 2, '.', ' ') }} р.</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Дата размещения') }}</th>
                                    <td>{{ date('d.m.Y', $article->created_at) }}</a></td>
                                </tr>
                            </tbody>
                        </table>

                        <form method="post" action="{{ route('article.destroy', $article->article_id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('article.index') }}" class="btn btn-secondary me-1 rounded">Назад</a>
                                <a href="{{ route('article.edit', $article->article_id) }}" class="btn btn-warning me-1 rounded">Изменить</a>
                                <button type="submit" title="Delete" onclick="return confirm('Вы уверены, что хотите удалить заметку?')" class="btn btn-danger rounded">Удалить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
