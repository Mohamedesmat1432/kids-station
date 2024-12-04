@if (count($this->checkbox_arr) > 0)
    <x-indigo-button wire:click="$dispatch('note-modal',{arr:'{{ json_encode($this->checkbox_arr) }}'})"
        wire:loading.attr="disabled">
        <x-icon class="w-4 h-4" name="clipboard-document-list" />
        {{ __('site.update_note_orders') }} ({{ count($this->checkbox_arr) }})
    </x-indigo-button>
@endif
