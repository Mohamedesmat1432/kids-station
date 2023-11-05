<?php

namespace App\Livewire\Chat;

use App\Models\Chat;
use Livewire\Component;

class GroupChat extends Component
{
    public $message = '';
    public $user_id = '';
    public $reciver_id = '';
    public $toggle_chat = false;

    public function toggleChat()
    {
        $this->reset('message');
        $this->resetValidation();
        $this->toggle_chat = !$this->toggle_chat;
    }

    public function sendMessage()
    {
        $validated = $this->validate([
            'message' => 'required|min:1|max:500'
        ]);

        $validated['user_id'] = auth()->user()->id;

        Chat::create($validated);
        $this->reset('message');
        $this->resetValidation();
    }

    public function render()
    {
        $json = json_decode(file_get_contents(public_path() .'/json/emojis.json'));
        
        return view('livewire.chat.group-chat', [
            'messages' => Chat::with('user')->get(),
            'json' => $json
        ]);
    }
}
