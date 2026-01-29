@extends('Ecommerce.Layout.ecommerce')
@section('content')

<div class="flex h-screen items-center justify-center bg-gray-100 p-4">
    <div class="flex w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="flex flex-col w-full p-6">
            <h2 class="text-xl font-semibold mb-4">Chat with Admin</h2>

            <!-- Messages -->
<div id="chat-box" class="flex-1 overflow-y-auto p-3 bg-gray-50 rounded-lg mb-4 space-y-2 max-h-96">
                <!-- messages will appear here -->
            </div>

            <!-- Input -->
            <form id="chat-form" class="flex space-x-2">
                @csrf
                <input type="hidden" id="receiver_id" value="5">
                <input type="text" id="message" class="flex-1 p-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your message...">
                <button type="submit" class="bg-blue-500 text-white px-5 py-3 rounded-full hover:bg-blue-600 transition">Send</button>
            </form>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadMessages(){
    const adminId = $('#receiver_id').val();
    const authId = {{ Auth::guard('customer')->id() }};

    $.get('/customer/chat/fetch', function(data){
        let html = '';
        data.forEach(msg=>{
            html += `
                <div class="flex ${msg.sender_id==authId?'justify-end':'justify-start'} mb-2">
                    <div class="px-4 py-2 rounded-xl max-w-xs break-words ${msg.sender_id==authId?'bg-blue-500 text-white':'bg-gray-300 text-gray-800'}">
                        ${msg.message}
                    </div>
                </div>
            `;
        });
        $('#chat-box').html(html);
        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        
    });
}

loadMessages();
setInterval(loadMessages,3000);

$('#chat-form').submit(function(e){
    e.preventDefault();
    const adminId = $('#receiver_id').val();
    const message = $('#message').val().trim();
    if(!message) return;

    $.post('/customer/chat/send', {
        _token:'{{ csrf_token() }}',
        receiver_id: adminId,
        message: message
    }, function(){
        $('#message').val('');
        loadMessages();
    });
});
</script>

@endsection
