@props(['topics'])

@if ( $topics->count() > 0)
    <div class="grid grid-cols-3 text-center">
        @foreach ($topics as $topic)
            <x-topic.button
                :label="$topic->name"
                :description="$topic->description"
                :href="'/topics/' . $topic->slug"
                click=''
                class="{{ isSet($topic->background) ? $topic->background : 'bg-gray-600' }} hover:bg-gray-400"
            />
        @endforeach
    </div>
@endif
