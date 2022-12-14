<x-layout>

    <title> Blog post </title>

    <x-slot name="content">

        <article>
            <h1> {!! $post->title !!} </h1>

            <div> {!!$post->body !!}</div>

            <p><a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a></p>

        </article>



    </x-slot>

    <x-slot name="homelink">

        <a href="/">Go back</a>

    </x-slot>

</x-layout>