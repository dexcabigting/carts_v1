<div class="flex flex-col gap-5 p-5">
    <x-success-fail-message />
    <x-validation-errors :errors="$errors" />

    <div class="flex flex-col gap-5">
        @forelse($comments as $comment)
            <div wire:key="{{ $loop->index }}-comment" class="flex flex-row gap-5">
                <div class="w-full">
                    <div class="flex justify-between">
                        <x-label value="{{ $comment->user->name }}" />
                        <x-label value="{{ $comment->created_at->diffForHumans() }}" />
                    </div>
                    <input value="{{ $comment->comment }}" class="text-black h-10 w-full" type="textarea"/>
                </div>
            </div>
        @empty
            <div>
                This variant has no comments yet.
            </div>
        @endforelse
    </div>

    <div>
        <form wire:submit.prevent="addComment">
            <div>
                <x-label :value="__('Comment')" />
                <input wire:model.defer="userComment" class="text-black w-full h-10" type="textarea"/>
            </div>

            <div class="mt-4">
                <x-button class="bg-custom-violet text-2xl py-2 font-bold px-6">
                    {{ __('Add Comment') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
