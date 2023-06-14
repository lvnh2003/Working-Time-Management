<li style="margin: 5px;background-color:
    {{ !$notification->read_at ? 'rgb(231, 231, 231)' : 'white' }} ">

    <a
        href="{{ route('project.index.notification', ['id' => $notification->data['project']['id'], 'idNotification' => $notification->id]) }}">
        <i class="material-icons" style="vertical-align: middle;color:rgb(86, 201, 255)">
          person_add
        </i>
        {{ Auth::user()->getUser->name . 'さんは' . $notification->data['project']['name'] }}
        にアサインしました
        <br>
        <span id="timestamp">{{ $notification->created_at->diffForHumans() }}</span></a>

</li>
