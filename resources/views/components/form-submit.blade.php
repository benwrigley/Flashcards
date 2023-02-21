@props(['label','bgcolor'])

<button type="submit" class="{{ $bgcolor ?? 'bg-gray-700' }} text-white rounded py-2 px-4 hover:animate-pulse hover:bg-blue-500 hover:scale-110 duration-500"> {{ $label }}</button>
