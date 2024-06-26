@php
    use App\Libs\Helper;
@endphp

<form method="get" action="{{ route('gas.index') }}" data-filterline__sandwich>
    <div class="mmot-filterline__sandwich dselect-wrapper" data-filterline_sandwich_parent="filter_planing">
        <div class="mmot-filterline__sandwich__head form-select">Настройки фильтра</div>
    </div>

    <div class="mmot-filterline-justify mmot-filterline__sandwich__list hide" data-filterline_sandwich_child="filter_planing">
        <div class="mmot-filterline">
            <div class="mmot-filterline">
                <div class="mmot-filterline__one" data-input_clear_content>
                    <select name="bike" id="bike" class="form-select form-control">
                        <option title="{{ __('Мотоцикл') }}" {{ (request()->bike ?? 0) == 0 ? 'selected' : '' }} value="0">{{ __('Мотоцикл') }}</option>
                        @forelse($bikes as $bike)
                            <option title="{{ Helper::bikeName($bike) }}" {{ (request()->bike ?? 0) == $bike['bike_id'] ? 'selected' : '' }} value="{{ $bike['bike_id'] }}">{{ Helper::bikeName($bike) }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <div class="mmot-filterline__one" data-input_clear_content>
                    <input type="date" name="period_from" id="period_from" class="form-control" value="{{ request('period_from') }}" placeholder="{{ __('Период от') }}" data-input_clear>
                </div>

                <div class="mmot-filterline__one" data-input_clear_content>
                    <input type="date" name="period_to" id="period_to" class="form-control" value="{{ request('period_to') }}" placeholder="{{ __('Период до') }}" data-input_clear>
                </div>
            </div>
        </div>

        <div class="mmot-filterline">
            <div class="mmot-filterline__one">
                <a href="{{ route('gas.index') }}" type="button" class="btn btn-secondary w block">{{ __('Сбросить') }}</a>
            </div>

            <div class="mmot-filterline__one">
                <button type="submit" class="btn btn-primary block">{{ __('Показать') }}</button>
            </div>
        </div>
    </div>
</form>
