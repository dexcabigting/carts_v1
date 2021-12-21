<div class="flex flex-col gap-5 p-5">
    <div>
        @forelse($comments as $comment)
            <div class="flex flex-row gap-5">
                <div>{{ $comment->user->name }}</div>
                <div class="flex flex-row gap-5">
                    <div>{{ $comment->comment }}</div>
                    <div>{{ $comment->created_at->diffForHumans() }}</div>
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
                <input wire:model.defer="comment" class="text-black w-full h-10" type="textarea"/>
            </div>

            <div class="mt-4">
                <x-button class="bg-custom-violet text-2xl py-2 font-bold px-6">
                    {{ __('Add Comment') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
