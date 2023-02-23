@props(['title','method','action'])

<section class="px-6 py-3 lg:py-8">
    <div>
        <main class="mx-auto mt-6 lg:mt-20 space-y-6 bg-gray-800 p-3 rounded flex flex-col items-center max-w-4xl">

            <div class="text-2xl lg:text-3xl text-center mt-3 lg:mb-3">
                {{ $title }}
            </div>

            <div class="w-full mt-4">
                <form method="{{ $method }}" action="{{ $action }}" class="flex flex-col items-center">
                    @csrf

                    {{ $slot }}

                </form>
            </div>

        </main>
    </div>
</section>
