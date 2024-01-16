<?php

namespace App\Livewire\Chat;

use App\Models\Chat;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class GroupChat extends Component
{
    use WithPagination;

    public $message = '';
    public $reciever_id;
    public $group_chat = false;
    public $toggle_chat = false;
    public $perPage = 10;

    #[Url('')]
    public $search = '';

    public function toggleChat()
    {
        $this->reset(['message', 'reciever_id']);
        $this->resetValidation();
        $this->toggle_chat = !$this->toggle_chat;
    }

    public function sendMessage()
    {
        $validated = $this->validate([
            'message' => 'required|min:1|max:500'
        ]);

        $validated['user_id'] = auth()->user()->id;
        $validated['reciever_id'] = $this->reciever_id;

        Chat::create($validated);
        $this->reset(['message']);
        $this->resetValidation();
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $json = json_decode(file_get_contents(public_path() . '/json/emojis.json'));

        $ids = [auth()->user()->id, $this->reciever_id];

        $users = User::where('id', '!=', auth()->user()->id)
            ->where('name', 'like', '%' . $this->search . '%')->get();

        $messages = Chat::with('user')->whereIn('user_id', $ids)
            ->whereIn('reciever_id', $ids)->latest()->paginate($this->perPage);

        $count_messages = Chat::count();


        return view('livewire.chat.group-chat', [
            'messages' => $messages,
            'json' => $json,
            'count_messages' => $count_messages,
            'users' => $users
        ]);
    }
}
