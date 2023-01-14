@props(['topics'])

@if ( $topics->count() > 0)
    <div class="lg:grid lg:grid-cols-3">
        @foreach ($topics as $topic)
            <x-topic-button
                :label="$topic->name"
                :href="'/topics/' . $topic->slug"
                click=''
                class="bg-gray-600 hover:bg-gray-400"
            />
        @endforeach
    </div>
@endif
