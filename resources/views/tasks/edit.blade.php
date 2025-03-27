<x-layouts.app :title="__('Görevi Düzenle')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Görevi Düzenle</h1>

            <flux:link href="{{ route('tasks.index') }}">
                <flux:button variant="primary">
                    Geri Dön
                </flux:button>
            </flux:link>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-gray-800">
            <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-flux::input id="title" label="Başlık" name="title" type="text" class="mt-1 block w-full" :value="old('title', $task->title)" required autofocus />
                    <x-flux::error :message="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-flux::textarea id="description" label="Açıklama" name="description" class="mt-1 block w-full" rows="4">{{ old('description', $task->description) }}</x-flux::textarea>
                    <x-flux::error :message="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                         <x-flux::select id="status" label="Durum" name="status" class="mt-1 block w-full">
                            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Beklemede</option>
                            <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>Devam Ediyor</option>
                            <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                        </x-flux::select>
                        <x-flux::error :message="$errors->get('status')" class="mt-2" />
                    </div>

                    <div>
                        <x-flux::select id="priority" label="Öncelik" name="priority" class="mt-1 block w-full">
                            <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Düşük</option>
                            <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Orta</option>
                            <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Yüksek</option>
                        </x-flux::select>
                        <x-flux::error :message="$errors->get('priority')" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <flux:link href="{{ route('tasks.index') }}">
                        <flux:button variant="filled">
                            İptal
                        </flux:button>
                    </flux:link>

                    <flux:button type="submit" variant="primary">
                        Görevi Güncelle
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
