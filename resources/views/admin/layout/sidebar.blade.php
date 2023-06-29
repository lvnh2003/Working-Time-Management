<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="{{asset('/assets/img/sidebar-1.jpg')}}">
    <!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            CT
        </a>
        <a href="#" class="simple-text logo-normal">
            ホーム
        </a>
    </div>
    <div class="sidebar-wrapper ps-container ps-theme-default ps-active-y"
        data-ps-id="6f1874f3-df21-9116-baf1-656ebd153405">
        <div class="user">
            <div class="photo">
                <img src="{{asset('/assets/img/faces/avatar.jpg')}}">
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        Admin
                    </span>
                </a>
               
            </div>
        </div>
        <ul class="nav">
            <li class="{{Route::currentRouteName() == ('admin.index') ? "active" : "" }}">
                <a href="{{route('admin.index')}}" >
                    <i class="material-icons">
                        person
                        </i>
                    <p> クリエイター管理 </p>
                </a>
            </li>
            <li  class="{{Route::currentRouteName() == ('admin.customer')? "active" : "" }}">
                <a href="{{route('admin.customer')}}">
                    <i class="material-icons ">
                        groups
                        </i>
                    <p> クライアント管理</p>
                </a>
            </li>
            <li >
                <a href="{{route('logout')}}">
                    <i class="material-icons ">
                        logout
                        </i>
                    <p> ログアウト</p>
                </a>
            </li>
            
        </ul>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 560px; right: 0px;">
            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 483px;"></div>
        </div>
    </div>
    <div class="sidebar-background" style="background-image: url('{{asset('assets/img/sidebar-1.jpg')}}') "></div>
</div>
