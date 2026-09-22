@include('header')
<body>
<main class="container">
    <form method="GET" action="/home/edit">
        <div role="group">
            <input type="hidden" name="id" value={{$post["id"]}}>
            <button type="button" onclick="window.location.href='/home'">Back</button>
            <label for="title" >Blog Title</label>
            <input type="text" name="title" id="title" value="{{$post['title']}}" >
            <label for="category">Category</label>
            <input type="text" name="category" id="category" value="{{$post['category']}}" >
        </div>
        <textarea
            name="content"
            id="content"
            placeholder="Write your blog post..."
            rows="15"
        >{{$post['content']}}</textarea>   
        <div role="group">
        <button type="submit">Edit</button>
        </div>
    </form>
</main>
</body>