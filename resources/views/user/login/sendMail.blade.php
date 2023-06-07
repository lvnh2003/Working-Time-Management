<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
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

        .button {
            background-color: #3490dc;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <h1>ようこそ。</h1>
    <p>{{ $user->name }}さん  </p>
    <p>サービスに加入していただきありがとうございます</p>
    <p>
        <a href="{{ $link }}" class="button">マイアカウントを有効にする</a>
    </p>
    <p>よろしくお願いします。</p>
</body>
</html>
