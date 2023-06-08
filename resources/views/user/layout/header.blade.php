<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=" ../dashboard.html ">Material Dashboard Pro</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{Route::currentRouteName() == ('signup') ? "active" : "" }}">
                    <a href="{{route('signup')}}">
                        <i class="material-icons">person_add</i> サインアップ
                    </a>
                </li>
                <li class="{{Route::currentRouteName() == ('login') ? "active" : "" }}">
                    <a href="{{route('login')}}">
                        <i class="material-icons">fingerprint</i> ログイン
                    </a>
                </li>
                <li class="{{(Route::currentRouteName() == ('forgot') || Route::currentRouteName() == ('reset')) ? "active" : "" }}">
                    <a href="{{route('forgot')}}">
                        <i class="material-icons">lock_open</i> パスワードを忘れた場合
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>