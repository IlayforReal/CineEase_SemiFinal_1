<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateTask</title>
    <link rel="stylesheet" href="/css/new.css">
</head>
<body>
    <h1>CREATE A TASK</h1>
    <div>
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <form method="post" action="{{ route('task.store') }}">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Title">
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" placeholder="Description">
        </div>
        <div>
            <label for="completed">Status:</label>
            <input type="text" id="completed" name="completed" placeholder="Status">
        </div>
        <input type="submit" value="SAVE A NEW TASK"/>
    </form>
</body>
</html>
