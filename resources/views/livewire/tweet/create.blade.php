<div class="grid grid-cols-1">
    <div class="mb-3">
        <textarea wire:model="body" placeholder="What's happening?" rows="2" cols="50" class="text-slate-900"></textarea>
        @error('body')
            <span class="block text-red-400">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <x-primary-button wire:click="submit">Twitter</x-primary-button>
    </div>
</div>
