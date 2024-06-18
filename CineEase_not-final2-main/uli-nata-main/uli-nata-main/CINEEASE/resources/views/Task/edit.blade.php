<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/css/edit.css">
    <title>Document</title>
</head>
<body>
    <h1>Edit a Task </h1>
    <form method='post' action="{{route('task.update', ['task'=> $task ])}}" >
        @csrf
        @method('put')
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Title" value = "{{$task->title}}">
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" placeholder="Description"value = "{{$task->description}}">
        </div>
        <div>
            <label for="completed">Status:</label>
            <input type="text" id="completed" name="completed" placeholder="Status"value = "{{$task->completed}}">
        </div>
        <input type="submit" value="Update"/>
    </form>
</body>
</html>