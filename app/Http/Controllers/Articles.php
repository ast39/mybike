<?php

namespace App\Http\Controllers;

use App\Http\Filters\ArticleFilter;
use App\Http\Requests\Article\ArticleFilterRequest;
use App\Http\Requests\Article\ArticleStoreRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Models\Article;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Articles extends Controller {

    use Dictionarable;


    /**
     * Список запчастей
     *
     * @param ArticleFilterRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(ArticleFilterRequest $request): View
    {
        $data = $request->validated();

        $filter = app()->make(ArticleFilter::class, [
            'queryParams' => array_filter($data)
        ]);

        return view('article.index', [
            'articles' => Article::with('bike')
                ->filter($filter)
                ->orderBy('title')
                ->paginate(20),
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Форма добавления запчасти
     *
     * @return View
     */
    public function create(): View
    {
        return view('article.create', [
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Сохранение новой запчасти
     *
     * @param ArticleStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['client_id'] = Auth::id();

        return redirect()->route('article.show', Article::create($data)->article_id);
    }

    /**
     * Страница запчасти
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $article = Article::with(['bike'])
            ->findOrFail($id);

        return view('article.show', [
            'article' => $article,
        ]);
    }

    /**
     * Страница редактирования запчасти
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);

        return view('article.edit', [
            'article' => $article,
            'bikes'   => $this->bikes(),
        ]);
    }

    /**
     * Обновление данных о запчасти
     *
     * @param ArticleUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ArticleUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $article = Article::find($id);

        if (is_null($article)) {
            return back()->withErrors(['action' => 'Запчасть не найдена']);
        }

        if ($article->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужую запчасть']);
        }

        $article->update($data);

        return redirect()->route('article.show', $id);
    }

    /**
     * Удаление запчасти
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $article = Article::find($id);

        if (is_null($article)) {
            return back()->withErrors(['action' => 'Запчасть не найдена']);
        }

        if ($article->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя удалять чужую запчасть']);
        }

        $article->delete();

        return redirect()->route('article.index');
    }
}
