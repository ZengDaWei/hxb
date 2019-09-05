<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <form action="/file" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        请选择<input type="file" name="file" >
        <input type="submit" value="提交">
    </form>
</body>
</html>