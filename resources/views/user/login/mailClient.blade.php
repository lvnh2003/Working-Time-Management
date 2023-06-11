<!DOCTYPE html>
<html>
<head>
    {{-- <title>Success Notification</title> --}}
    <style>
        /* CSS để tùy chỉnh giao diện email */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .password {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <p>{{$user->getUser->name}}　さん</p>
    <p>タレントマネジメントシステムへの登録が完了しました。</p>
    <p>
        ログインURL：: <span class="password">{{ route('login') }}</span>
    </p>
    <p>
        メールアドレス： <span class="password">{{ $user->email  }}</span>
    </p>
    <p>
        パスワード： <span class="password">{{ $password }}</span>
    </p>

    <p>Please keep this password secure and change it after logging in for the first time.</p>
    <p>Best regards,</p>
    <p>Your Website Team</p>
</body>
</html>
