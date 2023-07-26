<form method="get" action="{{ route('bike.index') }}" data-filterline__sandwich>
    <div class="mmot-filterline__sandwich dselect-wrapper" data-filterline_sandwich_parent="filter_planing">
        <div class="mmot-filterline__sandwich__head form-select">Настройки фильтра</div>
    </div>

    <div class="mmot-filterline-justify mmot-filterline__sandwich__list hide" data-filterline_sandwich_child="filter_planing">
        <div class="mmot-filterline">
            <div class="mmot-filterline">
                <div class="mmot-filterline__one" data-input_clear_content>
                    <select name="mark" id="mark" class="form-select form-control">
                        <option title="{{ __('Производитель') }}" {{ (request()->mark ?? 0) == 0 ? 'selected' : '' }} value="0">{{ __('Производитель') }}</option>
                        @forelse($marks as $mark)
                            <option title="{{ $mark['title'] }}" {{ (request()->mark ?? 0) == $mark['mark_id'] ? 'selected' : '' }} value="{{ $mark['mark_id'] }}">{{ $mark['title'] }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>

                <div class="mmot-filterline__one" data-input_clear_content>
                    <input type="text" name="year" id="year" class="form-control" value="{{ request('year') }}" placeholder="{{ __('Год выпуска') }}" data-input_clear>
                </div>

                <div class="mmot-filterline__one" data-input_clear_content>
                    <input type="text" name="vin" id="vin" class="form-control" value="{{ request('vin') }}" placeholder="{{ __('VIN номер') }}" data-input_clear>
                </div>
            </div>
        </div>

        <div class="mmot-filterline">
            <div class="mmot-filterline__one">
                <a href="{{ route('bike.index') }}" type="button" class="btn btn-secondary w block">{{ __('Сбросить') }}</a>
            </div>

            <div class="mmot-filterline__one">
                <button type="submit" class="btn btn-primary block">{{ __('Показать') }}</button>
            </div>
        </div>
    </div>
</form>
