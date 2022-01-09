<?php

namespace App\Http\Livewire\Shop\Carts;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductVariantComment;

use App\Events\ProductVariantCommentCreated;

use Exception;

use Illuminate\Support\Facades\DB;

class CartsCommentIndex extends Component
{
    use WithPagination;

    public $variantId = null;
    public $commentId = null;
    public $userComment = "";
    public $wireSubmit = "addComment";
    public $buttonText = "Add Comment";

    protected $rules = [
        'userComment' => 'required|string|max:150'
    ];

    protected $listeners = [
        'updatedSelectVariantId' => 'newVariantId'
    ];

    public function mount($variantId)
    {
        // dd($variantId);

        $this->variantId = $variantId;
    }

    public function render()
    {
        $comments = $this->comments->paginate(3);

        return view('livewire.shop.carts.carts-comment-index', compact('comments'));
    }

    
    public function getCommentsProperty()
    {
        return ProductVariantComment::where('product_variant_id', $this->variantId)
                                        ->where('id', '!=', $this->commentId)
                                        ->with('user:id,name');
    }

    public function addComment()
    {
        $this->validate();

        try {
            DB::transaction(function() {
                $comment = ProductVariantComment::create([
                    'product_variant_id' => $this->variantId,
                    'user_id' => auth()->user()->id,
                    'comment' => $this->userComment
                ]);

                $comment = $comment->load(['product_variant' => function ($query) {
                                            $query->select('id', 'prd_var_name', 'product_id')
                                                ->with(['product:id,prd_name']);
                                        }, 
                                        'user:id,name']);

                event(new ProductVariantCommentCreated($comment));

                $this->reset('userComment');

                session()->flash('success', 'Comment has been successfully added!');
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function enableEdit(int $id, string $comment)
    {
        $this->commentId = $id;

        $this->wireSubmit = "editComment";

        $this->buttonText = "Update";

        $this->userComment = $comment;
    }

    public function editComment()
    {
        $this->validate();

        try {
            DB::transaction(function() {
                $comment = $this->comment->first();
                
                $comment->update([
                    'comment' => $this->userComment
                ]);

                $this->resetProperties();

                session()->flash('success', 'Comment has been successfully updated!');
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function deleteComment($id)
    {
        if(!empty($this->commentId) && !empty($this->userComment) && ($this->wireSubmit == "editComment") && ($this->buttonText == "Update")) {
            $this->resetProperties();
        }

        try {
            DB::transaction(function() use($id) {
                $this->commentId = $id;

                $this->comment->delete();

                $this->reset(['commentId']);

                session()->flash('success', 'Comment has been successfully deleted!');
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function cancelEdit()
    {
        $this->resetProperties();
    }

    public function getCommentProperty()
    {
        return ProductVariantComment::where('id', $this->commentId);
    }

    protected function resetProperties()
    {
        $this->reset(['commentId', 'userComment', 'wireSubmit', 'buttonText']);
    }

    public function newVariantId($variantId): int
    {
        $this->resetPage();

        return $this->variantId = $variantId;
    }
}
