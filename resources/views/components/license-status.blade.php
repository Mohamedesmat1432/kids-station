@props(['status'])

@if ($status === 'danger')
    <div class="bg-red-500 hover:bg-red-600 rounded-lg p-1 flex justify-center text-white">
        <span class="mr-2">{{ __('Danger') }}</span>
        <x-icon class="h-6 w-6" name="exclamation-triangle" />
    </div>
@elseif($status === 'warning')
    <div class="bg-yellow-600 hover:bg-yellow-700 rounded-lg p-1 flex justify-center text-white">
        <span class="mr-2">{{ __('Warning') }}</span>
        <x-icon class="h-6 w-6" name="exclamation-triangle" />
    </div>
@elseif($status === 'success')
    <div class="bg-green-500 hover:bg-green-600 rounded-lg p-1 flex justify-center text-white">
        <span class="mr-2">{{ __('Saving') }}</span>
        <x-icon class="h-6 w-6" name="shield-check" />
    </div>
@else
    <div class="bg-gray-500 hover:bg-gray-600 rounded-lg p-1 flex justify-center text-white">
        <span class="mr-2">{{ __('Expired') }}</span>
        <x-icon class="h-6 w-6" name="shield-check" />
    </div>
@endif
