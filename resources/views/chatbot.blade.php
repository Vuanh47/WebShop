<div id="chatbot-container">
    <div id="chatbot-messages"></div>
    <textarea id="chatbot-input" placeholder="Nhập câu hỏi..."></textarea>
    <button id="send-message">Gửi</button>
</div>

<style>
    #chatbot-container {
        width: 300px; height: 400px; border: 1px solid #ccc; position: fixed;
        bottom: 20px; right: 20px; background: #fff; padding: 10px; border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); z-index: 1000;
    }
    #chatbot-messages { height: 300px; overflow-y: auto; margin-bottom: 10px; }
    #chatbot-input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
    #send-message { margin-top: 5px; width: 100%; padding: 8px; background: #007bff; color: white; border: none; border-radius: 4px; }
</style>

@section('footer')

@endsection