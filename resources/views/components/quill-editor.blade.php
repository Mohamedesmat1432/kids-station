@props(['name' => null, 'body' => null])

<div>
    <input type="hidden" wire:model="{{ $name }}"/>
    
    <div wire:ignore x-data x-ref="editor" x-init="const quill = new Quill($refs.editor, {
        theme: 'snow',
    });
    quill.on('text-change', () => {
        $dispatch('input', quill.root.innerHTML);
    });" wire:model="{{ $name }}">
        {!! $body !!}
    </div>
</div>
