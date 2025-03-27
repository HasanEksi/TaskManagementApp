@props(['name', 'title', 'description', 'action', 'method' => 'PATCH'])

<flux:modal :name="$name">
    <form action="{{ $action }}" method="POST" class="p-6">
        @csrf
        @method($method)

        <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <flux:modal.close>
                <flux:button>
                    İptal
                </flux:button>
            </flux:modal.close>

            <flux:button type="submit" variant="primary">
                Tamamla
            </flux:button>
        </div>
    </form>
</flux:modal>
