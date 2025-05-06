<?php
declare( strict_types = 1 );

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Events\MessageSentEvent;    
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Events\UserTypingEvent;

use Livewire\Component;

class Chat extends Component
{
    public object $user;
    public object $messages;
    public $message;
    public $senderId;
    public $receiverId;

    public function mount(int $userId): void {
        $this->dispatch('message-sent');
        $this->user = User::find($userId);
        $this->senderId = Auth::user()->id;
        $this->receiverId = $userId;
        $this->message = null;
        $this->messages = $this->getMessages();
    }

    //#[On('userTyping')]
    public function userTyping(){
 
        broadcast(new  UserTypingEvent($this->senderId, $this->receiverId));
    }

    public function getMessages() : object {
        return Message::where(function ($query) {
            $query->where('sender_id', $this->senderId)
                ->where('receiver_id', $this->receiverId);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiverId)
                ->where('receiver_id', $this->senderId);
        })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();    
    }

    public function sendMessage() {
        $this->message = $this->saveMessage();
        $this->messages[] = $this->message;
        MessageSentEvent::dispatch($this->message);
        $this->message = null;
        $this->dispatch('message-sent');
    }

    public function saveMessage() : Message{
        return Message::create([
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
            'file_path' => null,
            'file_name' => null,
            'file_type' => null,
            'is_read' => false
        ]);
    }

    #[On('echo-private:chat.{senderId},MessageSentEvent')]
    public function onMessageSent($event){
        $newMessage = Message::find($event['message']['id'])->load('sender', 'receiver');
        $this->messages[] = $newMessage;
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
