@if (count($this->form->checkbox_arr) > 0)
    <x-danger-button wire:click="$dispatch('bulk-delete-modal',{arr:'{{ implode(',', $this->form->checkbox_arr) }}'})"
        wire:loading.attr="disabled">
        <x-icon class="w-4 h-4" name="trash" />
        {{ __('Delete All') }} ({{ count($this->form->checkbox_arr) }})
    </x-danger-button>
@endif
