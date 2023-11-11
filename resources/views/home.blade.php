<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
</head>
<body>
    @auth
    <p>Congrats you are loged in.</p>
    <form action="/logout" method="POST">
        @csrf  
        <button>Log out</button> 
    </form><br>
    <div style="border: 3px solid blue;">
        <h2>Create a new post</h2>
        <form action="/create-post" method="POST" enctype="multipart/form-data">
            @csrf  
            <input type="text" name="title" placeholder="post title" style="margin: 10px"/>
            <textarea name="body" placeholder="body content ..." style="margin: 10px"></textarea>
            <div>
                <label>Picture</label>
                <input type="file" name="image"  />
            </div>

            <button style="margin: 10px">Save Post</button>
          
        </form>

    </div><br>

    <div style="border: 3px solid blue;">
        <h2>All Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: rgb(176, 204, 230); padding: 10px; margin: 10px;">
            <h3>{{$post['title']}} by {{$post->user->name}}&nbsp;&nbsp;{{$post['updated_at']}} &nbsp UTC</h3>
            <p><img src={{asset('images/'. $post->image_path)}} alt="" width=10% ></p>
            <p>{{$post['body']}}</p>
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>


    @else
    <div style="border: 3px solid blue;"  >
         <h2 style="margin: 10px">Register</h2>
        <form action="/register" method="POST" >  
            @csrf  
            <input name="name" type="text" placeholder="name" style="margin: 10px">
            <input name="email" type="text" placeholder="email" style="margin: 10px">
            <input name="password" type="password" placeholder="password" style="margin: 10px">
            <button style="margin: 10px">Register</button>
        </form>
    </div><br>
    <div style="border: 3px solid blue;"> 
        <h2 style="margin: 10px">Login</h2>
        <form action="/login" method="POST">  
            @csrf  
            <input name="loginname" type="text" placeholder="name" style="margin: 10px">           
            <input name="loginpassword" type="password" placeholder="password" style="margin: 10px">
            <button>Log in</button>
        </form>
    </div><br>
    <div style="border: 3px solid blue;">
        <h2 style="margin: 10px">All Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: rgb(204, 176, 230); padding: 10px; margin: 10px;">
            <h3>{{$post['title']}} by {{$post->user->name}}&nbsp;&nbsp;{{$post['updated_at']}} &nbsp UTC </h3>
            <img src={{asset('images/'. $post->image_path)}} alt="" width=10% >
            <p>{{$post['body']}}</p>

        </div>
        @endforeach
    </div>


    @endauth

    
</body>
</html>
