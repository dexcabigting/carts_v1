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
                    <div>
                        <input value="{{ $comment->comment }}" class="text-black h-10 w-full" type="textarea"/>
                    </div>
                    <div wire:key="{{ $loop->index }}-comment-edit" class="float-right">
                        @if($comment->user_id == auth()->user()->id)
                            <x-button wire:click.prevent="enableEdit({{ $comment->id }},  '{{ $comment->comment }}' )" type="button" class="bg-custom-violet text-md p-1">
                                {{ __('Edit') }}
                            </x-button>
                            <x-button wire:click.prevent="deleteComment({{ $comment->id }})" type="button" class="bg-red-500 text-md p-1">
                                {{ __('Delete') }}
                            </x-button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div>
                @if(empty($commentId))
                    This variant has no comments yet.
                @endif
            </div>
        @endforelse
    </div>

    <div>
        <form wire:submit.prevent="{{ $wireSubmit }}">
            <div>
                <x-label :value="__('Comment')" />
                <input wire:model.defer="userComment" class="text-black w-full h-10" type="textarea"/>
            </div>

            <div class="mt-4 flex flex-row gap-5">
                @if(!empty($commentId))
                <div wire:key="{{ mt_rand(000, 999) }}-cancel">
                    <x-button wire:click.prevent="cancelEdit" class="bg-red-500 text-2xl py-2 font-bold px-12">
                        {{ __('Cancel') }}
                    </x-button>
                </div>
                @endif
                <div wire:key="{{ mt_rand(000, 999) }}-update">
                    <x-button class="bg-custom-violet text-2xl py-2 font-bold px-6">
                        {{ $buttonText }}
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</div>
