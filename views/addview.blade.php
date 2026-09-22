@include('header')
<body>
<main class="container">
    <form method="post" action="/add/post">
        <div role="group">
            <button onclick="window.location.href='/home'">Back</button>
            <label for="title">Blog Title</label>
            <input type="text" name="title" id="title" required>
            <label for="category">Category</label>
            <input type="text" name="category" id="category">
        </div>
        <textarea
            name="content"
            id="content"
            placeholder="Write your blog post..."
            rows="15"
        ></textarea>   
        <div role="group">
        <button type="submit">Post</button>
        </div>
        <div role="group">
            <select name="tags[]" multiple>
                @foreach ($tags as $tag) {
                    <option value="{{$tag['id']}}">{{$tag['name']}}</option>
                }
                @endforeach
            </select>
        </div> 
    </form>
    <div role="group">
        <form method="POST" action="/add/newtag">
            <input placeholder="New tag..." name="newtag" id="newtag" required>
            <button type="submit">New Tag</button>
        </form>
    </div>
</main>
</body>