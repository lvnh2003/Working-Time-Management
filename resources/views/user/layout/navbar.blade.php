<nav class="navbar navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini">view_list</i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> Profile </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons" style="color:#555">notifications</i>
                        @auth
                            @if (count(Auth::user()->getUser->unreadNotifications)>0)
                            <span class="notification">{{ count(Auth::user()->getUser->unreadNotifications) }}</span>
                            @endif
                        @endauth
                        <p class="hidden-lg hidden-md">
                            Notifications
                            <b class="caret"></b>
                        </p>
                    </a>
                    <ul class="dropdown-menu">
                        @auth
                            @foreach (Auth::user()->getUser->notifications as $notification)
                                <li style="margin: 5px;background-color:
                                {{(!$notification->read_at)?'rgb(231, 231, 231)':'white' }} ">
                                    <a href="{{route('project.index.notification',['id'=>$notification->data['project']['id'],'idNotification'=>$notification->id])}}">{{Auth::user()->getUser->name .'さんは'.$notification->data['project']['name']}} にアサインしました</a>
                                </li>
                            @endforeach
                        @endauth
                                


                    </ul>
                </li>
                <li class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons"  style="color:#555">person</i>
                        <p class="hidden-lg hidden-md">Profile</p>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{route('logout')}}">ログアウト</a>
                        </li>
                    </ul>
                </li>
                <li class="separator hidden-lg hidden-md"></li>
            </ul>
        </div>
    </div>
</nav>
