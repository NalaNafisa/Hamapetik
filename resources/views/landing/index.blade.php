<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HamaPetik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0f2f1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 50px;
            height: 50px;
        }

        .logo h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0 10px;
        }

        .tree-image {
            width: 250px;
            height: 250px;
            margin: 0 auto;
        }

        .button {
            background-color: #4caf50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
        }

        .button:hover {
            background-color: #3e8e41;
        }

        .text {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="" alt="Logo">
            <h1>HamaPetik</h1>
        </div>
        <img src="" alt="Tree" class="tree-image">
        <button class="button">Mulai</button>
        <div class="text">Tanaman anda tanggung
            jawab anda</div>
        
        <a href="{{route('login')}}">Login</a>
    </div>
</body>
</html>