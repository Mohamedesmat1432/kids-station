@props(['id' => null, 'maxWidth' => null, 'submit' => null, 'method' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    @if ($submit)
        <form wire:submit="{{ $submit }}">
            @csrf
            @method($method)
    @endif
    <div class="px-6 py-4">
        <div class="text-2xl font-medium text-gray-900 flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-8 h-8 text-red-600 rounded mx-2 border">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-gray-600">
            {{ $content }}
        </div>
    </div>

    <div class="flex px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
    @if ($submit)
        </form>
    @endif
</x-modal>
