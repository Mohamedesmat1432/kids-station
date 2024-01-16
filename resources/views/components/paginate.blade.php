@props(['dataLinks' => null])

@if ($this->page_element > 10)
<div class="paginate">
    <div class="mt-4">
        {{-- <x-label for="page_element" value="{{ __('Per Page') }}" /> --}}
        <x-select class="py-1" wire:model.live="page_element">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </x-select>
    </div>
    <div class="mt-2">
        {!! $dataLinks !!}
    </div>
</div>
@endif
