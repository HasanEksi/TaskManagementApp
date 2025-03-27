<x-layouts.app :title="__('Yeni Görev Oluştur')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Yeni Görev</h1>

            <flux:link href="{{ route('tasks.index') }}">
                <flux:button variant="primary">
                    Geri Dön
                </flux:button>
            </flux:link>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-gray-800">
            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <x-flux::input id="title" label="Başlık" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                    <x-flux::error :message="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-flux::textarea id="description" label="Açıklama" name="description" class="mt-1 block w-full" rows="4">{{ old('description') }}</x-flux::textarea>
                    <x-flux::error :message="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                         <x-flux::select id="status" label="Durum" name="status" class="mt-1 block w-full">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Beklemede</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>Devam Ediyor</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                        </x-flux::select>
                        <x-flux::error :message="$errors->get('status')" class="mt-2" />
                    </div>

                    <div>
                        <x-flux::select id="priority" label="Öncelik" name="priority" class="mt-1 block w-full">
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Düşük</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Orta</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Yüksek</option>
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
                        Görevi Oluştur
                    </flux:button>

                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
