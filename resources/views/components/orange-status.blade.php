@props(['status'])

@if($status === 'cancelled')
    <div class="bg-yellow-600 hover:bg-yellow-700 rounded-lg p-1 flex justify-center text-white">
        <span class="mr-2">{{ __('Cancelled') }}</span>
        <x-icon class="h-6 w-6" name="exclamation-triangle" />
    </div>
@elseif($status === 'active')
    <div class="bg-green-500 hover:bg-green-600 rounded-lg p-1 flex justify-center text-white">
        <span class="mr-2">{{ __('Active') }}</span>
        <x-icon class="h-6 w-6" name="shield-check" />
    </div>
@else
    <div class="bg-gray-500 hover:bg-gray-600 rounded-lg p-1 flex justify-center text-white">
        <span class="mr-2">{{ __('Pendding') }}</span>
        <x-icon class="h-6 w-6" name="shield-check" />
    </div>
@endif
