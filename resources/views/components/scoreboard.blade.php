<div x-show="scoreboard" class="items-center rounded bg-gray-400 grid grid-cols-6 w-100 fixed top-20 right-20 p-4">
    <div class="mr-2 col-span-4">
        Total Tests:
    </div>
    <div class="col-span-2">
        {{ Auth::user()->testsCompleted(); }}
    </div>
    <div class="mr-2 col-span-4">
        Avg Score:
    </div>
    <div class="col-span-2">
        {{ Auth::user()->averageScore(); }}%
    </div>

</div>
