@props(['topic'])


<div class="flex justify-center items-baseline">

    <x-topic-button label="Main Topics" />

    @if (isset($topic))
        @foreach($topic->getAncestors() as $ancestor)
            &nbsp;//&nbsp;
            <x-topic-button :slug="$ancestor->slug" :label="$ancestor->name"/>

        @endforeach
    @endif


</div>
