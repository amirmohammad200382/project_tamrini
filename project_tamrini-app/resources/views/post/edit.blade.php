<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="m-auto pt-20">
        <form action="{{ route('posts.update', ['id'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <input
                type="text"
                name="title"
                value="{{ $post->title }}"
                class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none">

            <textarea
                name="body"
                class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">{{ $post->body }}</textarea>

            <select name="category_id[]" id="category_id[]" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if($post->category_id == $category->id) selected @endif>{{$category->title}}</option>
                @endforeach
            </select>

            <BR><BR><BR>

            <button
                type="submit"
                class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Update Post
            </button>
        </form>
    </div>
</div>
</body>
</html>
