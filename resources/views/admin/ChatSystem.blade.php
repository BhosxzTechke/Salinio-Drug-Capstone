@extends('admin_dashboard')
@section('admin')

<div class="row" style="height:80vh;">
    <!-- LEFT: Customer List -->
    <div class="col-md-4 border-end p-3 bg-light rounded">
        <h5>Customers</h5>
        <div class="list-group overflow-auto" style="max-height:100%;">
            @foreach($customers as $customer)
                <button class="list-group-item customer" data-id="{{ $customer->id }}">
                    {{ $customer->name }}
                </button>
            @endforeach
        </div>
    </div>

<!-- RIGHT: Chat Box -->
<div class="col-md-8 d-flex flex-column p-3" style="height:80vh;">
    <div id="chat-box" class="flex-grow-1 mb-3 p-3 border rounded overflow-auto bg-light" style="max-height:600px;">
        <!-- messages appear here -->
    </div>

    <form id="chat-form" class="d-flex">
        @csrf
        <input type="hidden" id="receiver_id">
        <input type="text" id="message" class="form-control me-2 rounded-pill" placeholder="Type a message...">
        <button class="btn btn-primary rounded-pill px-4">Send</button>
    </form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let activeUser = null;

$(document).on('click', '.customer', function(){
    activeUser = $(this).data('id');
    $('#receiver_id').val(activeUser);
    loadMessages();
});

function loadMessages(){
    if(!activeUser) return;

    const authId = {{ Auth::guard('web')->id() }};
    $.get('/admin/chat/fetch/' + activeUser, function(data){
        let html = '';
        data.forEach(msg=>{
            html += `
                <div class="d-flex ${msg.sender_id==authId?'justify-content-end':'justify-content-start'} mb-2">
                    <div class="px-3 py-2 rounded-pill ${msg.sender_id==authId?'bg-primary text-white':'bg-secondary text-white'}">
                        ${msg.message}
                    </div>
                </div>
            `;
        });
        $('#chat-box').html(html);
        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
    });
}

setInterval(loadMessages,3000);

$('#chat-form').submit(function(e){
    e.preventDefault();
    if(!activeUser) return alert('Select a customer first');

    $.post('/admin/chat/send', {
        _token:'{{ csrf_token() }}',
        receiver_id: activeUser,
        message: $('#message').val()
    }, function(){
        $('#message').val('');
        loadMessages();
    });
});
</script>

@endsection
