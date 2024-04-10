@php
    use App\Libs\Helper;
@endphp

<div class="col-md-3">
    <div class="card bg-primary text-white">
        @forelse($bikes ?? [] as $bike)
            <div class="card-header">
                <a href="{{ route('bike.show', $bike->bike_id) }}" class="text-decoration-none {{ request()->route()->getName() == 'bike.show' && $bike_id == $bike->bike_id ? 'text-dark' : 'text-white' }}">
                    {{ Helper::bikeName($bike) }} ({{ $bike->year }})
                </a>
            </div>
            <div class="card-body bg-light p-0">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start border-0 border-bottom">
                        <div class="ms-2 me-auto"><a href="{{ route('service.index', ['bike' => $bike->bike_id]) }}" class="list-group-item-action text-decoration-none {{ stripos(request()->route()->getName(), 'service') !== false && request()->bike == $bike->bike_id ? 'text-primary' : '' }}">{{ __('Сервис') }}</a></div>
                        <span class="badge bg-primary rounded-pill pt-1">{{ count($bike->works) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start border-0 border-bottom">
                        <div class="ms-2 me-auto"><a href="{{ route('article.index', ['bike' => $bike->bike_id]) }}" class="list-group-item-action text-decoration-none {{ stripos(request()->route()->getName(), 'article') !== false && request()->bike == $bike->bike_id ? 'text-primary' : '' }}">{{ __('Запчасти') }}</a></div>
                        <span class="badge bg-primary rounded-pill pt-1">{{ count($bike->catalog) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start border-0 border-bottom">
                        <div class="ms-2 me-auto"><a href="{{ route('gas.index', ['bike' => $bike->bike_id]) }}" class="list-group-item-action text-decoration-none {{ stripos(request()->route()->getName(), 'gas') !== false && request()->bike == $bike->bike_id ? 'text-primary' : '' }}">{{ __('Топливо') }}</a></div>
                        <span class="badge bg-primary rounded-pill pt-1">{{ count($bike->gasoline) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start border-0 border-bottom">
                        <div class="ms-2 me-auto"><a href="{{ route('payment.index', ['bike' => $bike->bike_id]) }}" class="list-group-item-action text-decoration-none {{ stripos(request()->route()->getName(), 'payment') !== false && request()->bike == $bike->bike_id ? 'text-primary' : '' }}">{{ __('Траты') }}</a></div>
                        <span class="badge bg-primary rounded-pill pt-1">{{ count($bike->payments) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                        <div class="ms-2 me-auto"><a href="{{ route('note.index', ['bike' => $bike->bike_id]) }}" class="list-group-item-action text-decoration-none {{ stripos(request()->route()->getName(), 'note') !== false && request()->bike == $bike->bike_id ? 'text-primary' : '' }}">{{ __('Блокнот') }}</a></div>
                        <span class="badge bg-primary rounded-pill pt-1">{{ count($bike->notes) }}</span>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-light border-0"></div>
        @empty
            <div class="card-header">{{ __('Гараж пуст') }}</div>
        @endforelse
    </div>

    <div class="d-grid gap-2 d-md-flex mt-3 mb-3 justify-content-md-center">
        <a href="{{ route('bike.create') }}" class="btn btn-primary rounded">Добавить мотоцикл</a>
    </div>
</div>
