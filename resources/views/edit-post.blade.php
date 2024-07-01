<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit post</title>
</head>
<body>
    <h1>Edit Post</h1>

    <form action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">
            <input type="text" name="title" id="title" value="{{$post->title}}" placeholder="update title">
        </label>
        <label for="body">
            <textarea name="body" id="body" placeholder="update body...">{{$post->body}}</textarea>
        </label>
        <button>Save changes</button>
    </form>
</body>
</html>