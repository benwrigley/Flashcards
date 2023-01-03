@props(['topics'])

@if ( $topics->count() > 0)
    <div class="lg:grid lg:grid-cols-3">
        @foreach ($topics as $topic)
            <x-topic-button :slug="$topic->slug" :label="$topic->name" class="bg-gray-600"/>
        @endforeach
    </div>
@endif
