<li style="margin: 5px;background-color:
    {{ !$notification->read_at ? 'rgb(231, 231, 231)' : 'white' }} ">
    <a href="{{route('client.read',$notification->id)}}">
        <span class="material-icons"  style="vertical-align: middle;color:rgb(86, 201, 255)">
            add_task
            </span>
        {{'プロジェクト' . $notification->data['project']['name'] . 'を作成しました。' }}
        <br>
        <span id="timestamp">{{ $notification->created_at->diffForHumans() }}</span></a>
</li>
