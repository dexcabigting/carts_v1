<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;

use App\Models\ProductVariantComment;

class CartsCommentIndex extends Component
{
    public $variantId = null;
    public $commentId = null;
    public $userComment = "";

    protected $rules = [
        'comment' => 'required|string|max:150'
    ];

    public function mount($variantId)
    {
        $this->$variantId = $variantId;
    }

    public function render()
    {
        $comments = $this->comments->get()->toArray();

        return view('livewire.shop.carts.carts-comment-index', compact('comments'));
    }

    public function addComment()
    {
        $this->validate();

        ProductVariantComment::create([
            'user_id' => auth()->user()->id,
            'comment' => $this->userComment
        ]);

        session()->flash('success', 'Comment has been successfully added!');
    }

    public function editComment($id)
    {
        $this->validate();

        $this->commentId = $id;

        $comment = $this->comment->findorFail();
        
        $comment->update([
            'comment' => $this->userComment
        ]);

        session()->flash('success', 'Comment has been successfully updated!');
    }

    public function deleteComment($id)
    {
        $this->commentId = $id;

        $this->comment->delete();

        session()->flash('success', 'Comment has been successfully deleted!');
    }

    public function getCommentProperty()
    {
        return ProductVariantComment::where('id', $this->commentId);
    }

    public function getCommentsProperty()
    {
        return ProductVariantComment::where('product_variant_id', $this->variantId)
                                        ->with('user:id,name');
    }
}
