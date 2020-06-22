<!doctype html>

<html lang="ru">

<head>

    <meta charset="UTF-8">

    <title>Загрузка файлов</title>
    <style>
form div {
    margin-bottom: 20px;
        }
    </style>
</head>
<body>
<h2>Загрузите ваши изображения</h2>
<p>Размер одного файла не больше 3мб</p>
<form method="post" action="form_handler.php"  enctype="multipart/form-data">
    <div>
        <input type="file"  accept="image/*" multiple name="picture[]">
    </div>
    <div>
        <input type="submit" value="Загрузить">
    </div>
</form>
</body>
</html>