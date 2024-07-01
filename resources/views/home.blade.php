<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
    @auth

        <p>Welcome to my page 😂!</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log Out</button>
        </form>

        <section style='border: 3px solid black'>
            <h2>Create a new post</h2>

            <form action="/create-post" method="POST">
                @csrf
               <label for="title">
                <input type="text" name="title" id="title" placeholder="title">
               </label>
               <label for="body">
                <textarea name="body" id="nody" placeholder="body content..."></textarea>
               </label>
               <button type="submit">Save Post</button>
            </form>
    
        </section>

        <section style='border: 3px solid black; margin:5px;'>
            <h2>Posts</h2>
            @foreach($posts as $post)
            <div style="background-color: gray; padding: 10px; margin:10px;"> 
                <h3>{{$post['title']}} by <span style="color: white"> {{$post->user->name}}</span></h3>
                {{$post['body']}}
                <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                <form action="/delete-post/{{$post->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </div>
            @endforeach
        </section>
    @else
        
   <section style="border: 3px solid black; padding-bottom: 10px">
    <h2>Register</h2>
    
    <form action="/register" method="POST">
        @csrf
        <label for="name">
            Name
            <input type="text" name="name" id="name" placeholder="name">
        </label>
        <label for="email">
            Email
            <input type="text" name="email" id="email" placeholder="email">
        </label>
        <label for="password">
            Password
            <input type="password" name="password" id="password" placeholder="password">
        </label>
        <button type="submit">Register</button>
    </form>
   </section>

   <section style="border: 3px solid black; padding-bottom: 10px">
    <h2>Log in</h2>
    
    <form action="/login" method="POST">
        @csrf
        <label for="name">
            Name
            <input type="text" name="loginname" id="name" placeholder="name">
        </label>
        <label for="email">
        <label for="password">
            Password
            <input type="password" name="loginpassword" id="password" placeholder="password">
        </label>
        <button type="submit">Login</button>
    </form>
   </section>

    @endauth
</body>
</html>