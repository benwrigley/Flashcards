@props(['topic'])
<div class="left-14 fixed top-50 bg-gray-800 p-5 rounded w-56 border-gray-900 border-4">
    <div class="text-3xl text-center mb-2">
        Test Me!
    </div>
    <div>
        In this topic and it's subtopics, test me on...
    </div>
    <a href="{{ route('test.store',[$topic->id,'*']) }}">
        <div class="bg-blue-500 p-2 rounded-3xl m-3 text-center hover:bg-blue-400 uppercase">
            Everything!
        </div >
    </a>
    <a href="{{ route('test.store',[$topic->id,'5']) }}">
        <div class="bg-blue-500 p-2 rounded-3xl m-3 text-center hover:bg-blue-400 uppercase">
            My worst 5
        </div>
    </a>
    <a href="{{ route('test.store',[$topic->id,'10']) }}">
        <div class="bg-blue-500 p-2 rounded-3xl m-3 text-center hover:bg-blue-400 uppercase">
            My worst 10
        </div>
    </a>
</div>
