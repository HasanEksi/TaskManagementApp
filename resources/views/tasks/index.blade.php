<x-layouts.app :title="__('Görevler')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Görevlerim</h1>

            <flux:link href="{{ route('tasks.create') }}">
                <flux:button variant="primary">
                    Yeni Görev
                </flux:button>
            </flux:link>

        </div>

        <!-- Filtreler -->
        <div class="rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-gray-800">
            <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-col gap-4 sm:flex-row sm:items-end">
                <div class="flex-1 space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:items-end">
                    <div class="flex-1">
                        <x-forms.radio-group
                            name="status"
                            label="Durum"
                            :options="App\Enums\TaskStatus::toSelectArray()"
                            :selected="request('status')"
                        />
                    </div>
                    <div class="flex-1">
                        <x-forms.radio-group
                            name="priority"
                            label="Öncelik"
                            :options="App\Enums\TaskPriority::toSelectArray()"
                            :selected="request('priority')"
                        />
                    </div>
                </div>
                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">
                        Filtrele
                    </flux:button>
                    @if(request('status') || request('priority'))
                        <flux:link href="{{ route('tasks.index') }}">
                           <flux:button>
                            Filtreleri Temizle
                           </flux:button>
                        </flux:link>
                    @endif
                </div>
            </form>
        </div>

        <!-- Görev Tablosu -->
        <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Başlık</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Durum</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Öncelik</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Oluşturulma Tarihi</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">İşlemler</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($tasks as $task)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $task->title }}</div>
                                    @if($task->description)
                                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($task->description, 50) }}</div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @php
                                        $status = $task->status;
                                    @endphp
                                    <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium {{ $status->badgeClasses() }}">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            {!! $status->icon() !!}
                                        </svg>
                                        {{ $status->label() }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @php
                                        $priority = $task->priority;
                                    @endphp
                                    <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-xs font-medium {{ $priority->badgeClasses() }}">
                                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            {!! $priority->icon() !!}
                                        </svg>
                                        {{ $priority->label() }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $task->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                    <div class="flex justify-end gap-2">
                                        @if($task->status !== \App\Enums\TaskStatus::COMPLETED)
                                            <flux:modal.trigger name="confirm-task-completion-{{ $task->id }}">
                                                <flux:button variant="primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </flux:button>
                                            </flux:modal.trigger>
                                        @endif
                                        <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('tasks.show', $task) }}" class="inline-flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:ring-gray-600 dark:hover:bg-gray-600">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                              </svg>


                                        </a>
                                        <flux:modal.trigger name="confirm-task-deletion-{{ $task->id }}">
                                            <flux:button variant="danger">Sil</flux:button>
                                        </flux:modal.trigger>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Görev bulunamadı</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Yeni bir görev oluşturarak başlayın.</p>
                                        <div class="mt-6">
                                            <flux:link href="{{ route('tasks.create') }}">
                                                <flux:button variant="primary">
                                                    Yeni Görev Oluştur
                                                </flux:button>
                                            </flux:link>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sayfalama -->
        @if($tasks->hasPages())
            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        @endif
    </div>

    <!-- Silme Onay Modalı -->
    @foreach($tasks as $task)
        <x-forms.delete-modal
            :name="'confirm-task-deletion-' . $task->id"
            title="Görevi Silmek İstediğinize Emin Misiniz?"
            :description="$task->title . ' görevi kalıcı olarak silinecektir.'"
            :action="route('tasks.destroy', $task)"
        />

        @if($task->status !== \App\Enums\TaskStatus::COMPLETED)
            <x-forms.complete-modal
                :name="'confirm-task-completion-' . $task->id"
                title="Görevi Tamamlandı Olarak İşaretlemek İstediğinize Emin Misiniz?"
                :description="$task->title . ' görevi tamamlandı olarak işaretlenecektir.'"
                :action="route('tasks.complete', $task)"
            />
        @endif
    @endforeach
</x-layouts.app>
