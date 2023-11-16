<div>
    <div class="relative">
        <div wire:click="toggleChat" class="fixed right-10 bottom-10 z-50 bg-blue-200 p-2 rounded-full cursor-pointer">
            <x-icon name="chat-bubble-oval-left-ellipsis" class="h-8 w-8 text-blue-600" />
        </div>

        @if ($toggle_chat)
            <div class="fixed left-0 top-0 h-screen w-full bg-gray-100 z-30 opacity-50"></div>
            <div class="fixed left-0 top-0 h-screen w-full z-40">
                <div class="flex z-40">
                    <div class="w-1/3 p-2 bg-gray-800 h-screen">
                        <h1 class="flex justify-between text-lg mb-5 text-white font-bold">
                            <span> {{ __('Chat with ') }} {{ App\Models\User::find($reciever_id)->name ?? '' }}</span>
                            <span class="cursor-pointer" wire:click="toggleChat">
                                <x-icon name="x-mark" class="h-6 w-6" />
                            </span>
                        </h1>

                        <div class="users-list overflow-y-auto">
                            <x-input class="w-full mb-3" type="search" wire:model.live.debounce.500ms="search"
                                placeholder="{{ __('Search ...') }}" />

                            <hr class="border-gray-400" />

                            @foreach ($users as $user)
                                <a href="#" class="flex text-white py-3 border-b border-gray-400"
                                    wire:click="$set('reciever_id',{{ $user->id }})">
                                    <img class="w-8 h-8 rounded-full mr-2" src="{{ $user->profile_photo_url }}"
                                        alt="{{ $user->name }}" />
                                    <span>{{ $user->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @if ($reciever_id)
                        <div class="w-2/3 p-2 bg-gray-800 h-screen">
                            @if (count($messages) > 0)
                                <div class="overflow-y-auto end-auto p-2 border-l border-l-gray-400"
                                    style="height: 450px;" wire:poll>
                                    <ul class="list-none" id="chat-messages">
                                        @foreach ($messages as $message)
                                            <li
                                                class="mb-2 w-2/3 text-white py-1 px-2 rounded-xl overflow-hidden {{ $message->user_id === auth()->user()->id ? 'text-right bg-blue-600 float-right' : 'text-left bg-gray-600 float-left' }}">
                                                <div class="py-2">{{ $message->message }}</div>
                                                <div class="text-sm flex justify-between">
                                                    <span>
                                                        {{-- {{ $message->user_id === auth()->user()->id ? 'You' : $message->user->name }} --}}
                                                        @if ($message->user_id === auth()->user()->id)
                                                            <img class="w-6 h-6 rounded-full"
                                                                src="{{ auth()->user()->profile_photo_url }}"
                                                                alt="{{ auth()->user()->name }}" />
                                                        @else
                                                            <img class="w-6 h-6 rounded-full"
                                                                src="{{ $message->user->profile_photo_url }}"
                                                                alt="{{ $message->user->name }}" />
                                                        @endif
                                                    </span>
                                                    <span>
                                                        <x-icon name="check" class="h-4 w-4 text-gray-200" />
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                @if ($messages->hasMorePages())
                                    <div class="w-full text-center text-white">
                                        <button wire:click="loadMore">
                                            <div role="status" wire:loading wire:target="loadMore">
                                                <svg aria-hidden="true"
                                                    class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                    viewBox="0 0 100 101" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="currentFill" />
                                                </svg>
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            Load more
                                        </button>
                                    </div>
                                @endif
                            @endif

                            <div class="chat-input-message w-2/3 fixed bottom-2">
                                <div class="w-2/3 mx-auto">
                                    <form wire:submit="sendMessage">
                                        @csrf
                                        @method('POST')
                                        <div>
                                            <x-input type="hidden" class="w-full" wire:model="reciever_id" />

                                            <x-input id="chat-message" type="text" class="w-full"
                                                wire:model="message" placeholder="{{ __('Enter Your Message') }}" />

                                            <x-input-error for="message" />
                                        </div>
                                        <div class="mt-3">
                                            <x-indigo-button type="submit" class="hidden">
                                                {{ __('Send') }}
                                            </x-indigo-button>
                                        </div>
                                    </form>

                                    <div class="emoji" x-data="{ open: false }">
                                        <button class="float-right" style="position: relative; top:-40px; right: 15px;"
                                            x-on:click="open = ! open"> &#128512;</button>
                                        <div x-show="open" class="overflow-y-auto h-52 bg-gray-800"
                                            wire:transition.duration.300ms>
                                            @foreach ($json->emojis as $item)
                                                <span class="cursor-pointer"
                                                    onclick="var emojis = document.getElementById('chat-message').value += '{{ $item->emoji }}';  @this.set('message',emojis);">
                                                    {{ $item->emoji }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
