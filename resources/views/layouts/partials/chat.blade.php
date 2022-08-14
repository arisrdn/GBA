<div class="chat-item" style=""><img src="../assets/img/avatar/avatar-5.png">
    <div class="chat-details">
        <div class="chat-text">No Message</div>
    </div>
    @foreach ($data2 as $chat)
        @if ($chat->from_id == Auth::user()->id)
            <div class="chat-item chat-right" style=""><img src="../assets/img/avatar/avatar-2.png">
                <div class="chat-details">
                    <div class="chat-text">{{ $chat->message }}</div>
                    <div class="chat-time">{{ $chat->created_at }}</div>
                </div>
            </div>
        @else
            <div class="chat-item chat-left" style=""><img src="../assets/img/avatar/avatar-5.png">
                <div class="chat-details">
                    <div class="chat-text">{{ $chat->message }}</div>
                    <div class="chat-time">{{ $chat->created_at }}</div>
                </div>
            </div>
        @endif
    @endforeach
