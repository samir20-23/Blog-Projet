<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body> 
  <!-- CREATE -->
<form method="POST" action="{{ route('todolist.store') }}">
    @csrf
    <input type="text" name="content">
    <button type="submit">add</button>
</form>

<hr>

<!-- LIST + UPDATE -->
@foreach ($todolist as $todo)
    <form method="POST" action="{{ route('todolist.update', $todo->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="content" value="{{ $todo->content }}">
        <button type="submit">update</button>
    </form>
@endforeach
</body>
</html>