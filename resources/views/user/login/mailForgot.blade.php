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
            background-color: #f5c730c9;
            border: none;
            color: #fff !important;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #ac8e2cc9;
        }
        .ii a[href]
        {
            color:#fff
        }
    </style>
</head>
<body>
    <h1>こんにちは。</h1>
    <p>パスワードを変更できます</p>
    <p>
        <a href="{{ $link }}" class="button">パスワードを変える</a>
    </p>
    <p>よろしくお願いします。</p>
</body>
</html>
