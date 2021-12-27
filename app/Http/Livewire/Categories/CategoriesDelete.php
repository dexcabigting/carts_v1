<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;

use App\Models\Category;

use Exception;

use Illuminate\Support\Facades\DB;

class CategoriesDelete extends Component
{
    public $categories = [];

    public $promptDelete = 1;
    public $promptDeleted = 0;

    public function mount(...$id)
    {
        $this->categories = collect($id)->flatten()->toArray();
    }

    public function render()
    {
        return view('livewire.categories.categories-delete');
    }

    public function deleteCategories()
    {
        if (count($this->categories) == 1) {
            $flash = 'Category has been successfully deleted!';
        } else {
            $flash = 'Categories have been successfully deleted!';
        }

        try {
            DB::transaction(function() use($flash) {
                Category::whereIn('id', $this->categories)->delete();

                $this->emitUp('unsetCheckedCategories', $this->categories);

                $this->emitUp('cleanse');

                $this->emitUp('refreshParent');

                session()->flash('success', $flash);

                $this->categories = [];

                $this->promptDelete = 0;
                $this->promptDeleted = 1;
            });
        } catch(Exception $error) {
            session()->flash('fail', 'An error occured! ' . $error);
        }
    }

    public function closeDeleteModal()
    {
        $this->dispatchBrowserEvent('deleteModalDisplayNone');
        $this->emitUp('closeDeleteModal');
    }
}
