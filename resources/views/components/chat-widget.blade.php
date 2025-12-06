<div id="chatWidget" class="fixed bottom-64 right-6 z-50" style="display: block;">
    <!-- Chat Button -->
    <button 
        id="chatToggle" 
        class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 hover:scale-110"
        onclick="toggleChat()"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
    </button>

    <!-- Chat Window -->
    <div 
        id="chatWindow" 
        class="hidden fixed bottom-72 right-4 w-80 h-[480px] max-h-[80vh] bg-white rounded-lg shadow-2xl flex flex-col border border-gray-200"
        style="max-width: calc(100vw - 2rem);"
    >
        <!-- Chat Header -->
        <div class="bg-blue-600 text-white p-3 rounded-t-lg flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <span class="text-blue-600 font-bold text-lg">AI</span>
                </div>
                <div>
                    <h3 class="font-semibold">PolyTech Assistant</h3>
                    <p class="text-xs text-blue-100">Trợ lý AI của bạn</p>
                </div>
            </div>
            <button onclick="toggleChat()" class="text-white hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Chat Messages -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-3 space-y-3 bg-gray-50">
            <div class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">AI</span>
                </div>
                <div class="flex-1 bg-white rounded-lg p-3 shadow-sm">
                    <p class="text-sm text-gray-800">Xin chào! 👋 Tôi là trợ lý AI của PolyTech Store. Tôi có thể giúp bạn tìm sản phẩm, tư vấn và trả lời câu hỏi. Bạn cần hỗ trợ gì?</p>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="p-3 border-t border-gray-200 bg-white rounded-b-lg">
            <form id="chatForm" onsubmit="sendMessage(event)" class="flex space-x-2">
                <input 
                    type="text" 
                    id="chatInput" 
                    placeholder="Nhập câu hỏi của bạn..." 
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Đảm bảo chỉ load 1 lần
if (typeof window.chatWidgetInitialized === 'undefined') {
    window.chatWidgetInitialized = true;
    
    let chatSessionId = localStorage.getItem('chatSessionId') || null;
    let isLoading = false;

    // Định nghĩa tất cả hàm global để có thể gọi từ onclick
    window.toggleChat = function() {
        const chatWindow = document.getElementById('chatWindow');
        if (!chatWindow) {
            console.error('Chat window not found');
            return;
        }
        
        chatWindow.classList.toggle('hidden');
        
        if (!chatWindow.classList.contains('hidden')) {
            window.loadChatHistory();
        }
    }

    window.loadChatHistory = function() {
    if (!chatSessionId) return;
    
    const messagesContainer = document.getElementById('chatMessages');
    if (!messagesContainer) return;
    
    fetch(`/chat/history?session_id=${chatSessionId}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.messages.length > 0) {
            messagesContainer.innerHTML = '';
            data.messages.forEach(msg => {
                window.addMessageToChat(msg.message, msg.sender, msg.metadata);
            });
        }
    })
    .catch(error => console.error('Error loading chat history:', error));
    }

    window.sendMessage = function(event) {
    event.preventDefault();
    
    if (isLoading) return;
    
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    
    if (!message) return;
    
    // Hiển thị tin nhắn của user
    window.addMessageToChat(message, 'user');
    input.value = '';
    
    isLoading = true;
    window.showLoadingIndicator();
    
    fetch('/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            message: message,
            session_id: chatSessionId
        })
    })
    .then(response => response.json())
    .then(data => {
        isLoading = false;
        window.hideLoadingIndicator();
        
        if (data.success) {
            // Lưu session ID
            if (data.session_id) {
                chatSessionId = data.session_id;
                localStorage.setItem('chatSessionId', chatSessionId);
            }
            
            // Hiển thị phản hồi của bot
            window.addMessageToChat(data.response.message, 'bot', data.response.metadata);
        } else {
            window.addMessageToChat('Xin lỗi, có lỗi xảy ra. Vui lòng thử lại.', 'bot');
        }
    })
    .catch(error => {
        isLoading = false;
        window.hideLoadingIndicator();
        window.addMessageToChat('Xin lỗi, có lỗi xảy ra. Vui lòng thử lại.', 'bot');
        console.error('Error sending message:', error);
    });
    }

    window.addMessageToChat = function(message, sender, metadata = null) {
    const messagesContainer = document.getElementById('chatMessages');
    if (!messagesContainer) return;
    
    const messageDiv = document.createElement('div');
    
    if (sender === 'user') {
        messageDiv.className = 'flex items-start space-x-2 justify-end';
        messageDiv.innerHTML = `
            <div class="flex-1 bg-blue-600 text-white rounded-lg p-3 shadow-sm max-w-[80%] ml-auto">
                <p class="text-sm">${window.escapeHtml(message)}</p>
            </div>
            <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs">U</span>
            </div>
        `;
    } else {
        messageDiv.className = 'flex items-start space-x-2';
        let content = `<p class="text-sm text-gray-800">${window.formatMessage(message)}</p>`;
        
        // Hiển thị sản phẩm nếu có
        if (metadata && metadata.products && metadata.products.length > 0) {
            content += '<div class="mt-3 space-y-2">';
            metadata.products.forEach(product => {
                content += `
                    <div class="border border-gray-200 rounded-lg p-2 hover:bg-gray-50 cursor-pointer" onclick="window.location.href='/products/${product.slug}'">
                        <div class="flex space-x-2">
                            <img src="${product.image}" alt="${product.name}" class="w-16 h-16 object-cover rounded">
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-gray-800">${window.escapeHtml(product.name)}</p>
                                <p class="text-xs text-blue-600 font-bold">${product.price}</p>
                            </div>
                        </div>
                    </div>
                `;
            });
            content += '</div>';
        }
        
        messageDiv.innerHTML = `
            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">AI</span>
            </div>
            <div class="flex-1 bg-white rounded-lg p-3 shadow-sm">
                ${content}
            </div>
        `;
    }
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    window.formatMessage = function(message) {
    // Escape HTML trước
    message = escapeHtml(message);
    
    // Sau đó chuyển \n (đã được escape thành text) thành <br>
    // JSON encode sẽ chuyển \n thành \\n trong string, nhưng khi parse sẽ thành \n thật
    message = message.replace(/\\n/g, '<br>');
    message = message.replace(/\n/g, '<br>');
    
    // Chuyển đổi markdown (sau khi escape)
    message = message.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
    return message;
    }

    window.escapeHtml = function(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
    }

    window.showLoadingIndicator = function() {
    const messagesContainer = document.getElementById('chatMessages');
    const loadingDiv = document.createElement('div');
    loadingDiv.id = 'loadingIndicator';
    loadingDiv.className = 'flex items-start space-x-2';
    loadingDiv.innerHTML = `
        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
            <span class="text-white text-xs font-bold">AI</span>
        </div>
        <div class="flex-1 bg-white rounded-lg p-3 shadow-sm">
            <div class="flex space-x-1">
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
            </div>
        </div>
    `;
    messagesContainer.appendChild(loadingDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    window.hideLoadingIndicator = function() {
    const loadingDiv = document.getElementById('loadingIndicator');
    if (loadingDiv) {
        loadingDiv.remove();
    }
    }

} // Kết thúc if (typeof window.chatWidgetInitialized === 'undefined')
</script>

<style>
#chatMessages::-webkit-scrollbar {
    width: 6px;
}

#chatMessages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#chatMessages::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

#chatMessages::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

<script>
// Đảm bảo chỉ có 1 widget chat - xóa duplicate
(function() {
    const widgets = document.querySelectorAll('#chatWidget');
    if (widgets.length > 1) {
        // Xóa các widget duplicate, chỉ giữ lại cái đầu tiên
        for (let i = 1; i < widgets.length; i++) {
            widgets[i].remove();
        }
    }
    
    // Đảm bảo chỉ có 1 nút toggle
    const toggles = document.querySelectorAll('#chatToggle');
    if (toggles.length > 1) {
        for (let i = 1; i < toggles.length; i++) {
            toggles[i].remove();
        }
    }
})();
</script>

