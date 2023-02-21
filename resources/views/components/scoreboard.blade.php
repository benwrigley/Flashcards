<div x-show="scoreboard" x-on:click.outside="scoreboard = false" class="items-center grid grid-cols-2 fixed right-20 p-4 bg-gray-800 border-4 top-12 rounded-b space-y-1.5 mt-3 border-gray-900" style="display:none">
    <div class="mr-2 ">
        Total Flashcards:
    </div>
    <div class="">
        {{ Auth::user()->flashcards->count(); }}
    </div>
    <div class="mr-2 ">
        Total Tests Run:
    </div>
    <div class="">
        {{ Auth::user()->testsCompleted(); }}
    </div>
    <div class="mr-2">
        Avg Score:
    </div>
    <div class="">
        {{ Auth::user()->averageScore(); }}%
    </div>
    @if (Auth::user()->leastTestedTopic())
        <div class="mr-2 ">
            Least Tested:
        </div>
        <div class="underline">
            <a href="/topics/{{ Auth::user()->leastTestedTopic()->slug}}">{{ Auth::user()->leastTestedTopic()->name }}</a>
        </div>
    @endif
</div>
