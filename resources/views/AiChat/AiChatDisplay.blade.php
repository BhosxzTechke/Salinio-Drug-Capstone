@extends('admin_dashboard')
@section('admin')

<br>

<textarea id="message" class="w-full border p-2"></textarea>
<button onclick="sendMessage()" class="btn btn-primary mt-2">
    Ask AI
</button>

<div id="reply" class="mt-4 p-3 border"></div>

<script>
        function sendMessage() {
            fetch('{{ route("ai.admin.ask") }}', {  // use route helper for safety
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message: document.getElementById('message').value
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('reply').innerText = data.reply;
            })
            .catch(err => console.error('Error:', err));
        }

</script>




@endsection