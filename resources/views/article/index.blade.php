@php
    use App\Libs\Helper;
@endphp

@extends('layouts.app')

@section('title', 'Мои запчасти')

@section('content')
    <div class="card bg-primary text-white">
        <div class="card-header">{{ __('Мои запчасти') }}</div>

        <div class="card-body bg-light">
            <!-- Фильтр -->
            <div class="mmot-margin20">
                @include('components/filter/articles')
            </div>

            <table class="table table-bordered admin-table__adapt admin-table__instrument">
                <thead class="table-secondary">
                <tr>
                    <th class="text-start">Заголовок</th>
                    <th class="text-center">Артикул</th>
                    <th class="text-center">Мотоцикл</th>
                    <th class="text-end">Цена</th>
                    <th class="text-end">Действия</th>
                </tr>
                </thead>

                <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td data-label="Заголовок" class="text-start"><a class="text-primary" href="{{ route('article.show', $article->article_id) }}">{{ $article->title }}</a></td>
                        <td data-label="Артикул" class="text-center"><a class="text-primary" target="_blank" href="https://zap39.ru/price_items/search?oem={{ $article->article }}">{{ $article->article }}</a></td>
                        <td data-label="Мотоцикл" class="text-center"><a class="text-primary" href="{{ route('bike.show', $article->bike_id) }}">{{ Helper::bikeName($article->bike) }}</a></td>
                        <td data-label="Цена" class="text-end">{{ Helper::price($article->price) }}</td>
                        <td data-label="Действия" class="text-end" style="min-width: 160px">
                            <form method="post" action="{{ route('article.destroy', $article->article_id) }}" class="admin-table__nomargin">
                                @csrf
                                @method('DELETE')

                                <div class="mmot-table__action">
                                    <a title="Show" href="{{ route('article.show', $article->article_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-view"></use></svg></a>
                                    <a title="Update" href="{{ route('article.edit', $article->article_id) }}" class="mmot-table__action__one"><svg class="mmot-table_view mmot-table__ico"><use xlink:href="#site-edit"></use></svg></a>
                                    <button type="submit" class="mmot-table__action__one" onclick="return confirm('Вы уверены, что хотите удалить запчасть?')"><svg class="mmot-table__delete mmot-table__ico"><use xlink:href="#site-delete"></use></svg></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="text-center p-1 mb-2 mt-2 bg-secondary bg-gradient text-white">{{ ('Запчасти отсутствуют') }}</div>
                        </td>
                    </tr>
                @endforelse

                <div>
                    {{ $articles->links() }}
                </div>
                </tbody>
            </table>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="{{ route('article.create', ['bike' => request()->bike]) }}" class="btn btn-primary rounded">Добавить запчасть</a>
            </div>

            @if($errors->any())
                <div class="text-center p-2 mb-3 mt-3 bg-danger bg-gradient text-white rounded">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="card-footer bg-light border-0"></div>
    </div>
@endsection
