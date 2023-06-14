<li style="margin: 5px;background-color:
    {{ !$notification->read_at ? 'rgb(231, 231, 231)' : 'white' }} ">

    <a
        href="{{route('client.read',$notification->id)}}">
        <i class="material-icons" style="vertical-align: middle;color:rgb(221, 28, 28)">
          delete_forever
        </i>
        {{'プロジェクト'. $notification->data['project']['name'] }}
        は削除されました
        <br>
        <span id="timestamp">{{ $notification->created_at->diffForHumans() }}</span></a>

</li>
