<div>
    <div class="chat-container">
        <x-layouts.app>
            <div class="sm:ml-64 flex flex-col h-screen bg-gray-900 relative">
                <!-- Header -->
                <div class="fixed w-full z-50 bg-gray-800 text-white p-4 shadow-lg border-b border-gray-700 flex items-center">
                    <img src="{{ $user->avatar ?? '' }}" alt="{{ $user->name }}"
                        class="w-10 h-10 rounded-full mr-3 object-cover">
                    <div>
                        <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                        <p class="text-xs text-gray-400">En línea</p>
                    </div>
                </div>

                <!-- Mensajes -->

                <div class="flex-1 p-4 space-y-6 bg-gray-900 ">
                    @foreach ($messages as $message)
                        <div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <!-- Mensaje -->
                            <div class="flex items-start max-w-xs md:max-w-md lg:max-w-lg">
                                <!-- Avatar -->
                                @if ($message->sender_id != Auth::id())
                                    <img src="{{ $message->sender->avatar ?? '' }}"
                                        alt="{{ $message->sender->name }}"
                                        class="w-8 h-8 rounded-full mr-2 object-cover">
                                @endif

                                <div class="flex flex-col">
                                    <!-- Nombre del remitente -->
                                    @if ($message->sender_id != Auth::id())
                                        <span class="text-xs text-gray-400 mb-1 ml-8">
                                            {{ $message->sender->name }}
                                        </span>
                                    @endif

                                    <!-- Cuerpo del mensaje -->
                                    <div
                                        class="{{ $message->sender_id == Auth::id() ? 'bg-blue-600 text-white ml-auto' : 'bg-gray-800 text-gray-100' }} 
                                                px-4 py-3 rounded-2xl shadow-lg relative">
                                        {{ $message->message }}
                                    </div>

                                    <!-- Fecha de envío -->
                                    <span class="text-xs text-gray-500 mt-1 self-end">
                                        {{ $message->created_at->format('H:i') }}
                                    </span>
                                </div>

                                <!-- Avatar del propio usuario -->
                                @if ($message->sender_id == Auth::id())
                                    <img src="{{ Auth::user()->avatar ?? '' }}" alt="Tú"
                                        class="w-8 h-8 rounded-full ml-2 object-cover">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- Input fijo -->
                <form wire:submit.prevent="sendMessage" class="p-4 bg-gray-800 border-t border-gray-700 shadow-inner">
                    <div class="flex items-center space-x-2">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>                    
                            <input wire:model.defer="message"
                                type="text" 
                                id="input-message"
                                placeholder="Escribe un mensaje..."
                                class="block w-full pl-10 pr-3 py-2 text-gray-900 rounded-full 
                                        bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-blue-500 
                                        focus:border-blue-500 transition-all duration-200 outline-none"
                                autocomplete="off">
                        </div>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full 
                                    focus:outline-none focus:ring-2 focus:ring-blue-500 
                                    transition-colors duration-200 shadow-md">
                            <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </x-layouts.app>
    </div>

    
    <script type="module">
        let typingTimeout;
        const chatContainer = document.querySelector('.chat-container');
        const inputMessage = document.getElementById('input-message');

        Livewire.on('message-sent', () => {
            scrollToBottom();
        });

        window.onload = () => {
            scrollToBottom();
        };

        function scrollToBottom() {
            window.scrollTo(0, chatContainer.scrollHeight);
        }
        
        // inputMessage.addEventListener('keydown', ()=>{
        //     console.log('typing');
        // })

        // window.Echo.private(`chat.{{ $senderId }}`).listen('UserTypingEvent', (e) => {
        //     const messageInput = document.getElementById('input-message');
        //     if(messageInput){
        //         messageInput.placeholder = 'Escribiendo...';
        //     }
            
        //     clearTimeout(typingTimeout);
        //     typingTimeout = setTimeout(() => {
        //         if(messageInput){
        //             messageInput.placeholder = 'Escribe un mensaje...';
        //         }
        //     }, 1000);
        // })
    </script>
    
</div>
