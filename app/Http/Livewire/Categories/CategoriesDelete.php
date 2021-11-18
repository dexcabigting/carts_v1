<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

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
            $flash = 'Category has been deleted successfully!';
        } else {
            $flash = 'Categories have been deleted successfully!';
        }
            
        Category::whereIn('id', $this->categories)->delete();

        $this->emitUp('unsetCheckedCategories', $this->categories);

        $this->emitUp('cleanse');

        $this->emitUp('refreshParent');

        session()->flash('success', $flash);

        $this->categories = [];

        $this->promptDelete = 0;
        $this->promptDeleted = 1;
    }

    public function closeDeleteModal()
    {
        $this->dispatchBrowserEvent('deleteModalDisplayNone');
        $this->emitUp('closeDeleteModal');
    }
}
