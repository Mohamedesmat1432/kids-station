<div>
    <div wire:click="toggleChat" class="fixed right-10 bottom-20 z-50 bg-indigo-200 p-3 rounded-3xl cursor-pointer">
        <x-icon name="chat-bubble-oval-left-ellipsis" class="h-8 w-8 text-indigo-600" />
    </div>

    @if ($toggle_chat)
        <div wire:transition class="fixed left-0 top-0 min-h-screen xl:w-3/4  lg:w-3/4 md:w-3/4 sm:w-2/4 bg-gray-800 p-2 z-40">
            <div class="flex justify-between">
                <div class="p-2 w-1/2">
                    <h1 class="flex justify-between text-lg mb-5 text-white">
                        <span> {{ __('Group Chat') }}</span>
                        <span class="cursor-pointer" wire:click="$set('toggle_chat',false)">
                            <x-icon name="x-mark" class="h-6 w-6" />
                        </span>
                    </h1>
                    <form wire:submit="sendMessage">
                        @csrf
                        @method('POST')
                        <div>
                            <x-textarea class="w-full" wire:model="message"
                                placeholder="{{ __('Enter Your Message') }}">
                            </x-textarea>
                            <x-input-error for="message" />
                        </div>
                        <div class="mt-3">
                            <x-indigo-button type="submit">
                                {{ __('Send') }}
                            </x-indigo-button>
                        </div>
                    </form>
                </div>
                @if (count($messages) > 0)
                    <div class="overflow-y-scroll p-2 border-l border-l-gray-400 w-1/2" style="height: 550px;" wire:poll>

                        <ul class="list-none">
                            @foreach ($messages as $message)
                                <li
                                    class=" mb-2 w-2/3 text-white py-1 px-2 rounded-lg {{ $message->user_id === auth()->user()->id ? 'text-right bg-indigo-700 float-right' : 'text-left bg-gray-600 float-left' }}">
                                    <div class="py-2">{{ $message->message }}</div>
                                    <div
                                        class="text-sm {{ $message->user_id === auth()->user()->id ? 'text-left' : 'text-right' }}">
                                        By {{ $message->user_id === auth()->user()->id ? 'You' : $message->user->name }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    @endif

</div>
