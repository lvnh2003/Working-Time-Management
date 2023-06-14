<li style="margin: 5px;background-color:
    {{ !$notification->read_at ? 'rgb(231, 231, 231)' : 'white' }} ">
    <a
        href="{{ route('project.index.notification', ['id' => $notification->data['project']['id'], 'idNotification' => $notification->id]) }}">
        <i class="material-icons" style="vertical-align: middle; color:
        {{ $notification->data['project']['finished'] ? 'red' : 'green' }}">
            {{ $notification->data['project']['finished'] ? 'toggle_off' : 'toggle_on' }}
        </i>
        {{ $notification->data['project']['name'] . 'は' }}
        {{ $notification->data['project']['finished'] ? '終わりました。' : '継続されています。' }}
        <br>
        <span id="timestamp">{{ $notification->created_at->diffForHumans() }}</span></a>
</li>
