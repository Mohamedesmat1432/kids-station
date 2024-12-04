<div>
    @props(['status'])
    <label for="toggle" class="flex items-center cursor-pointer">
        <!-- The toggle switch -->
        <div class="relative">
            <input type="checkbox" id="toggle" wire:click="toggleStatus" class="sr-only"
                @checked($status)>
            <div class="block w-14 h-8 rounded-full {{ $status ? 'bg-green-400' : 'bg-gray-400' }}" ></div>
            <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform duration-300 ease-in-out {{ $status ? 'transform translate-x-6' : '' }}">
            </div>
        </div>
        <!-- Status Text -->
        @if ($status)
            <span class="ml-2 text-sm text-green-500">
                {{ __('site.active') }}
            </span>
        @else
            <span class="ml-2 text-sm text-red-500">
                {{ __('site.not_active') }}
            </span>
        @endif
    </label>
</div>