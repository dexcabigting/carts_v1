<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;

use App\Models\ProductVariantComment;

class CartsCommentIndex extends Component
{
    public $variantId = null;
    public $commentId = null;
    public $editCommentId = null;
    public $userComment = "";
    public $wireSubmit = "addComment";
    public $buttonText = "Add Comment";

    protected $rules = [
        'userComment' => 'required|string|max:150'
    ];

    public function mount($variantId)
    {
        // dd($variantId);

        $this->variantId = $variantId;
    }

    public function render()
    {
        $comments = $this->comments->get();

        return view('livewire.shop.carts.carts-comment-index', compact('comments'));
    }

    
    public function getCommentsProperty()
    {
        return ProductVariantComment::where('product_variant_id', $this->variantId)
                                        ->where('id', '!=', $this->editCommentId)
                                        ->with('user:id,name');
    }

    public function addComment()
    {
        $this->validate();

        ProductVariantComment::create([
            'product_variant_id' => $this->variantId,
            'user_id' => auth()->user()->id,
            'comment' => $this->userComment
        ]);

        $this->reset('userComment');

        session()->flash('success', 'Comment has been successfully added!');
    }

    public function enableEdit(int $id, string $comment)
    {
        $this->editCommentId = $id;

        $this->wireSubmit = "editComment";

        $this->buttonText = "Update Comment";

        $this->userComment = $comment;
    }

    public function editComment()
    {
        $this->validate();

        $this->commentId = $this->editCommentId;

        $comment = $this->comment->first();
        
        $comment->update([
            'comment' => $this->userComment
        ]);

        $this->reset(['commentId', 'editCommentId', 'userComment', 'wireSubmit', 'buttonText']);

        session()->flash('success', 'Comment has been successfully updated!');
    }

    // public function deleteComment($id)
    // {
    //     $this->commentId = $id;

    //     $this->comment->delete();

    //     session()->flash('success', 'Comment has been successfully deleted!');
    // }

    public function getCommentProperty()
    {
        return ProductVariantComment::where('id', $this->commentId);
    }
}
