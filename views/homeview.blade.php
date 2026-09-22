@include('header')
<body>
<main class="container">
    <div>
        <form method="GET" action="/add">
            <button type=submit>Add new blog</button>
        </form>
        <form method="GET" action="/home/search">
            <div role="group">
                @if ($backButton)
                    <button type="button" onclick="window.location.href='/home'">Back</button>
                @endif
                <input type="text" name="search" id="search" placeholder="search for blog">
            </div>
            <button type=submit>Search</button>
        </form>
    </div>
    @if (empty($blogs))
        <article>
            <h3>No blog yet. Create one.</h3>
        </article>
    @else
        @foreach ($blogs as $blog)
            <article>
                <div role="group">
                    <div role="group">
                    <span>{{$blog["title"]}}</span>
                    <span>{{$blog["category"]}}</span>
                    </div>
                    <form method="GET" action="/home/delete">
                        <input type="hidden" name="id" value={{$blog["id"]}}>
                        <button type="submit">Delete</button>
                    </form>
                    <form method="GET" action="/edit">
                        <input type="hidden" name="id" value={{$blog["id"]}}>
                        <button type="submit">Edit</button>
                    </form>
                </div>
                <hr>
                <p>
                {{$blog["content"]}}
                </p>
            </article>
        @endforeach
    @endif
</main>
</body>