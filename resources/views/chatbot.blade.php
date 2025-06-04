<x-layouts.app>
    <x-slot name="title">
        Contratos
    </x-slot>
    <div class="main-content">
        <div class="container mx-auto p-4 max-w-3xl" x-data="chatbot()">
            <!-- Encabezado -->
            <div class="bg-blue-600 text-white p-4 rounded-t-lg shadow">
                <h1 class="text-xl font-bold">Asistente Contable</h1>
                <p class="text-sm">Pregunta sobre partidas, pagos o proveedores</p>
            </div>

            <!-- Historial del Chat -->
            <div class="bg-white p-4 h-96 overflow-y-auto space-y-4" x-ref="chatContainer">
                <template x-for="(message, index) in messages" :key="index">
                    <div class="p-3 rounded-lg max-w-xs"
                        :class="message.role === 'user' ? 'bg-blue-100 ml-auto' : 'bg-gray-200 mr-auto'">
                        <p x-text="message.content"></p>
                    </div>
                </template>
            </div>

            <!-- Formulario de Entrada -->
            <form @submit.prevent="sendMessage" class="bg-white p-4 rounded-b-lg shadow">
                @csrf
                <div class="flex space-x-2">
                    <input x-model="userInput" type="text" placeholder="Escribe tu pregunta..."
                        class="flex-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition"
                        :disabled="loading">
                        <span x-show="!loading">Enviar</span>
                        <span x-show="loading">Procesando...</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- JavaScript del Chatbot -->
        <script>
            function chatbot() {
                return {
                    messages: [],
                    userInput: '',
                    loading: false,

                    init() {
                        // Mensaje inicial del bot
                        this.messages.push({
                            role: 'bot',
                            content: '¡Hola! Soy tu asistente contable. ¿En qué puedo ayudarte?'
                        });
                    },

                    async sendMessage() {
                        if (!this.userInput.trim()) return;

                        // Agregar mensaje del usuario al historial
                        this.messages.push({
                            role: 'user',
                            content: this.userInput
                        });

                        const question = this.userInput;
                        this.userInput = '';
                        this.loading = true;

                        try {
                            // Llamar a la API de Laravel
                            const response = await fetch('/chatbot/ask', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    question
                                })
                            });

                            const data = await response.json();

                            // Agregar respuesta del bot
                            this.messages.push({
                                role: 'bot',
                                content: data.answer ||
                                    'No pude encontrar una respuesta. ¿Puedes reformular la pregunta?'
                            });
                        } catch (error) {
                            console.error('Error:', error);
                            this.messages.push({
                                role: 'bot',
                                content: 'Ocurrió un error. Por favor, intenta nuevamente.'
                            });
                        } finally {
                            this.loading = false;
                            // Scroll al final del chat
                            this.$nextTick(() => {
                                this.$refs.chatContainer.scrollTop = this.$refs.chatContainer.scrollHeight;
                            });
                        }
                    }
                };
            }
        </script>
    </div>

</x-layouts.app>
