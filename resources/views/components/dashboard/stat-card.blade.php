@props(['title', 'value', 'color' => 'primary'])

<div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
    <div class="flex flex-col items-center justify-center">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
        <p class="mt-2 text-3xl font-bold text-{{ $color }}-600">{{ $value }}</p>
    </div>
</div>
