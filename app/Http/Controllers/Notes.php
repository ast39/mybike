<?php

namespace App\Http\Controllers;

use App\Http\Filters\NoteFilter;
use App\Http\Requests\Note\NoteFilterRequest;
use App\Http\Requests\Note\NoteStoreRequest;
use App\Http\Requests\Note\NoteUpdateRequest;
use App\Http\Traits\Dictionarable;
use App\Libs\Helper;
use App\Models\Note;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Notes extends Controller {

    use Dictionarable;


    /**
     * Список заметок
     *
     * @param NoteFilterRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(NoteFilterRequest $request): View
    {
        $data = $request->validated();

        $filter = app()->make(NoteFilter::class, [
            'queryParams' => array_filter($data)
        ]);

        $notes = Helper::isAdmin()
            ? Note::with('bike')
                ->filter($filter)
                ->orderByDesc('created_at')
                ->paginate(config('limits.notes'))
            : Note::with('bike')
                ->where('client_id', Auth::id())
                ->filter($filter)
                ->orderByDesc('created_at')
                ->paginate(config('limits.notes'));

        return view('note.index', [
            'notes' => $notes,
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Форма добавления заметки
     *
     * @return View
     */
    public function create(): View
    {
        return view('note.create', [
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Сохранение новой заметки
     *
     * @param NoteStoreRequest $request
     * @return RedirectResponse
     */
    public function store(NoteStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['client_id'] = Auth::id();
        if (!is_null($data['note_date'] ?: null)) {
            $data['created_at'] = strtotime($data['note_date']);
        }

        return redirect()->route('note.show', Note::create($data)->note_id);
    }

    /**
     * Страница заметки
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $note = Helper::isAdmin()
            ? Note::with(['client', 'bike'])
                ->findOrFail($id)
            : Note::with(['client', 'bike'])
                ->where('client_id', Auth::id())
                ->findOrFail($id);

        return view('note.show', [
            'note' => $note,
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Страница редактирования заметки
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $note = Note::where('client_id', Auth::id())
            ->findOrFail($id);

        return view('note.edit', [
            'note' => $note,
            'bikes' => $this->bikes(),
        ]);
    }

    /**
     * Обновление заметки
     *
     * @param NoteUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(NoteUpdateRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        if (!is_null($data['note_date'] ?: null)) {
            $data['created_at'] = strtotime($data['note_date']);
        }

        $note = Note::find($id);

        if (is_null($note)) {
            return back()->withErrors(['action' => 'Заметка не найдена']);
        }

        if ($note->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя изменять чужую заметку']);
        }

        $note->update($data);

        return redirect()->route('note.show', $id);
    }

    /**
     * Удаление заметки
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $note = Note::find($id);

        if (is_null($note)) {
            return back()->withErrors(['action' => 'Заметка не найдена']);
        }

        if ($note->client_id != Auth::id()) {
            return back()->withErrors(['action' => 'Нельзя удалять чужую заметку']);
        }

        $note->delete();

        return redirect()->route('note.index');
    }
}
