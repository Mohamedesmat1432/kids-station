<div>

    <div class="relative">
        <div wire:click="toggleChat" class="fixed right-10 bottom-20 z-50 bg-blue-200 p-2 rounded-full cursor-pointer">
            <x-icon name="chat-bubble-oval-left-ellipsis" class="h-8 w-8 text-blue-600" />
        </div>

        @if ($toggle_chat)
            <div wire:transition class="fixed left-0 top-0 min-h-screen w-full bg-gray-800 p-2 z-40">
                <div class="flex justify-between">
                    <div class="p-2 w-1/3">
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
                                <x-input id="chat-message" type="text" class="w-full" wire:model="message"
                                    placeholder="{{ __('Enter Your Message') }}" />

                                <x-input-error for="message" />
                            </div>
                            <div class="mt-3">
                                <x-indigo-button type="submit" class="hidden">
                                    {{ __('Send') }}
                                </x-indigo-button>
                            </div>
                        </form>
                        <div class="emoji mt-3" x-data="{ open: false }">
                            <button class="float-right" style="position: relative; top:-40px; right: 15px;"
                                x-on:click="open = ! open"> &#128512;</button>
                            <div x-show="open" class="overflow-y-scroll h-52">
                                @foreach ($json->emojis as $item)
                                    <span class="cursor-pointer "
                                        onclick="var x = document.getElementById('chat-message').value += '{{ $item->emoji }}';  @this.set('message',x);">
                                        {{ $item->emoji }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if (count($messages) > 0)
                        <div class="overflow-y-scroll p-2 border-l border-l-gray-400 w-2/3" style="height: 550px;"
                            wire:poll>
                            <ul class="list-none">
                                @foreach ($messages as $message)
                                    <li
                                        class=" mb-2 w-2/3 text-white py-1 px-2 rounded-lg overflow-hidden {{ $message->user_id === auth()->user()->id ? 'text-right bg-blue-600 float-right' : 'text-left bg-gray-600 float-left' }}">
                                        <div class="py-2">{{ $message->message }}</div>
                                        <div class="text-sm flex justify-between">
                                            <span>
                                                {{ $message->user_id === auth()->user()->id ? 'You' : $message->user->name }}
                                            </span>
                                            <span>
                                                <x-icon name="check" class="h-4 w-4 text-gray-400" />
                                            </span>
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
</div>
