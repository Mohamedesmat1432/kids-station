@if (count($this->checkbox_arr) > 0)
    <x-danger-button wire:click="$dispatch('bulk-delete-modal',{arr:'{{ json_encode($this->checkbox_arr) }}'})"
        wire:loading.attr="disabled">
        <x-icon class="w-4 h-4" name="trash" />
        {{ __('site.delete_all') }} ({{ count($this->checkbox_arr) }})
    </x-danger-button>
@endif
