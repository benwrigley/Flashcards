@props(['topic'])


<div class="flex justify-center items-baseline">

    <x-topic-button label="Main Topics" />

    @php
        $originalTopic = $topic;
    @endphp


    @if (!is_null($topic))

        @while ($topic->parent()->exists())

                &nbsp;//&nbsp;
                <x-topic-button :slug="$topic->parent->slug" :label="$topic->parent->name"/>
                @php
                    $topic = $topic->parent;
                @endphp
        @endwhile

        &nbsp;//&nbsp;
        <x-topic-button :slug="$originalTopic->slug" :label="$originalTopic->name" />
    @endif

</div>
