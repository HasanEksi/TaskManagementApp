<x-layouts.app :title="$task->title">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-col gap-2">
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-neutral-100">{{ $task->title }}</h1>
                <div class="flex items-center gap-2">
                    <x-badge :color="$task->priority->color()" class="text-sm">{{ $task->priority->label() }}</x-badge>
                    <x-badge :color="$task->status->color()" class="text-sm">{{ $task->status->label() }}</x-badge>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <flux:link href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center gap-2">
                    <flux:button variant="filled" class="inline-flex items-center gap-2">
                        Düzenle
                    </flux:button>
                </flux:link>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <flux:button type="submit" variant="danger" class="inline-flex items-center gap-2" onclick="return confirm('Bu görevi silmek istediğinizden emin misiniz?')">
                        Sil
                    </flux:button>
                </form>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center gap-2 mb-3">
                    <h2 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Görev Açıklaması</h2>
                </div>
                <p class="text-neutral-700 dark:text-neutral-300 leading-relaxed">{{ $task->description }}</p>
            </div>

            <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">

                <div class="flex items-center gap-3">
                     <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                          </svg>
                     </div>
                    <div class="flex flex-col">
                        <span class="font-medium text-neutral-900 dark:text-neutral-100">{{ $task->user->name }}</span>
                        <span class="text-sm text-neutral-500 dark:text-neutral-400">Görev Sorumlusu</span>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
                <div class="flex items-center gap-2 mb-3">
                    <h2 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Durum Bilgileri</h2>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-neutral-500 dark:text-neutral-400">Oluşturulma</span>
                        <span class="text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $task->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    @if($task->completed_at)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">Tamamlanma</span>
                            <span class="text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $task->completed_at->format('d.m.Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
