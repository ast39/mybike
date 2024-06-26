@php
    use App\Libs\Helper;
    use App\Enums\WorkStatusEnum;
@endphp

<form method="get" action="{{ route('service.index') }}" data-filterline__sandwich>
    <div class="mmot-filterline__sandwich dselect-wrapper" data-filterline_sandwich_parent="filter_planing">
        <div class="mmot-filterline__sandwich__head form-select">Настройки фильтра</div>
    </div>

    <div class="mmot-filterline-justify mmot-filterline__sandwich__list hide" data-filterline_sandwich_child="filter_planing">
        <div class="mmot-filterline">
            <div class="mmot-filterline">
                <div class="mmot-filterline__one" data-input_clear_content>
                    <select name="car" id="car" class="form-select form-control">
                        <option title="{{ __('Мотоцикл') }}" {{ (request()->bike ?? 0) == 0 ? 'selected' : '' }} value="0">{{ __('Мотоцикл') }}</option>
                        @forelse($bikes as $bike)
                            <option title="{{ Helper::bikeName($bike) }}" {{ (request()->bike ?? 0) == $bike['bike_id'] ? 'selected' : '' }} value="{{ $bike['bike_id'] }}">{{ Helper::bikeName($bike) }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <div class="mmot-filterline__one" data-input_clear_content>
                    <input type="text" name="service" id="service" class="form-control" value="{{ request('service') }}" placeholder="{{ __('Сервис') }}" data-input_clear>
                </div>

                <div class="mmot-filterline__one" data-input_clear_content>
                    <select name="status" id="status" class="form-select form-control">
                        <option title="{{ __('Статус') }}" {{ (request()->bike ?? 0) == 0 ? 'selected' : '' }} value="0">{{ __('Статус') }}</option>
                        <option title="{{ Helper::statusText(WorkStatusEnum::Planned->value) }}" {{ (request()->status ?? 0) == WorkStatusEnum::Planned->value ? 'selected' : '' }} value="{{ WorkStatusEnum::Planned->value }}">{{ Helper::statusText(WorkStatusEnum::Planned->value) }}</option>
                        <option title="{{ Helper::statusText(WorkStatusEnum::InWork->value) }}" {{ (request()->status ?? 0) == WorkStatusEnum::InWork->value ? 'selected' : '' }} value="{{ WorkStatusEnum::InWork->value }}">{{ Helper::statusText(WorkStatusEnum::InWork->value) }}</option>
                        <option title="{{ Helper::statusText(WorkStatusEnum::Completed->value) }}" {{ (request()->status ?? 0) == WorkStatusEnum::Completed->value ? 'selected' : '' }} value="{{ WorkStatusEnum::Completed->value }}">{{ Helper::statusText(WorkStatusEnum::Completed->value) }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mmot-filterline">
            <div class="mmot-filterline__one">
                <a href="{{ route('service.index') }}" type="button" class="btn btn-secondary w block">{{ __('Сбросить') }}</a>
            </div>

            <div class="mmot-filterline__one">
                <button type="submit" class="btn btn-primary block">{{ __('Показать') }}</button>
            </div>
        </div>
    </div>
</form>
