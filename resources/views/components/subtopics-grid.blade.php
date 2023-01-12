@props(['topics'])

@if ( $topics->count() > 0)
    <div class="lg:grid lg:grid-cols-3">
        @foreach ($topics as $topic)
            <x-topic-button
                :label="$topic->name"
                :href="'/topics/' . $topic->slug"
                click=''
                class="bg-gray-600"
            />
        @endforeach
    </div>
@endif
