@props(['topic'])


<div class="flex justify-center items-baseline w-2/3">

    <x-topic-button
        href="/"
        label="Main Topics"
        click=""
    />

    @if (isset($topic))
        @foreach($topic->getAncestors() as $ancestor)
            &nbsp;//&nbsp;
            <x-topic-button
                :href="'/topics/' . $ancestor->slug"
                :label="$ancestor->name"
                click=''
            />

        @endforeach
    @endif


</div>
