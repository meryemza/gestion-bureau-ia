@props(['title', 'value', 'change' => null])

<div class="bg-[#1A1F3B] p-4 rounded-2xl shadow-lg">
    <p class="text-sm text-gray-300">{{ $title }}</p>
    <p class="text-2xl font-bold text-[#FBD9FA] mt-1">{{ $value }}</p>

    @if ($change)
        <p class="text-sm mt-1 {{ Str::startsWith($change, '-') ? 'text-red-500' : 'text-green-500' }}">
            {{ $change }}
        </p>
    @endif
</div>
