<div x-show="scoreboard" class="relative items-center rounded bg-gray-400 p-4 grid grid-cols-6 w-56">
    <div class="mr-2 col-span-5">
        Completed Tests:
    </div>
    <div >
        {{auth()->user()->tests->count()}}
    </div>
    <div class="mr-2 col-span-5">
        Avg Score:
    </div>
    <div>
        {{auth()->user()->tests->avg('final_score')}}%
    </div>

</div>
