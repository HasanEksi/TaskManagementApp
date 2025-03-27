@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
])

<div class="space-y-2">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    <div class="flex flex-wrap gap-2">
        @foreach($options as $value => $label)
            <label class="relative cursor-pointer">
                <input type="radio"
                    name="{{ $name }}"
                    value="{{ $value }}"
                    class="peer sr-only"
                    {{ $selected === $value ? 'checked' : '' }}
                    {{ $attributes->merge(['class' => '']) }}>
                <div class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50 peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:text-primary-700 peer-checked:ring-2 peer-checked:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 peer-checked:dark:border-primary-500 peer-checked:dark:bg-primary-900/20 peer-checked:dark:text-primary-400 peer-checked:dark:ring-primary-500">
                    <span>{{ ucfirst($label) }}</span>
                </div>
            </label>
        @endforeach
    </div>
</div>
