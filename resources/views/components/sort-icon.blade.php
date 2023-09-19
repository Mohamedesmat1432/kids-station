@props(['sort_by', 'sort_asc', 'sort_field'])

@if ($sort_by == $sort_field)
    @if ($sort_asc)
        <x-icon class="w-4 h-4" name="arrow-small-up" />
    @endif

    @if (!$sort_asc)
        <x-icon class="w-4 h-4" name="arrow-small-down" />
    @endif
@endif
