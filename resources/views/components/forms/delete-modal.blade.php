@props(['name', 'title' => 'Silme İşlemi', 'description' => 'Bu öğeyi silmek istediğinize emin misiniz?', 'action'])

<flux:modal name="{{ $name }}" class="min-w-[30rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $title }}</flux:heading>
            <flux:text class="mt-2">
                <p>{!! $description !!}</p>
            </flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <form method="post" action="{{ $action }}" class="p-6">
                <flux:modal.close>
                    <flux:button variant="ghost">İptal</flux:button>
                </flux:modal.close>

                @csrf
                @method('delete')
                <flux:button type="submit" variant="danger">Sil</flux:button>
            </form>
        </div>
    </div>
</flux:modal>