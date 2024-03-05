<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Livewire\WithPagination;

class PagesCategories extends Component
{
    use WithPagination;
    public $category ;
    public $posts;
    public $asc = true;
    public $search;
    public function mount($category)
    {
        $this->category = $category;
    }
    public function sort()
    {
        $this->asc = !$this->asc;
        $this->resetPage();


    }
    public function updateee(){
        $this->resetPage();
    }

  public function GetPostsByCategory($cat)
  {

    $cate = Category::where('name', $cat)->first();
//      dd($cate);
//      dd('hh');


      if ($cate) {
        $orderDirection = $this->asc ? 'asc' : 'desc';

        $this->posts = Post::where('category_id', $cate->id)
            ->orderBy('created_at', $orderDirection)
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                });
            })
            ->get();
    } else {
        $this->posts = collect();
    }
}

    public function render()
    {
        $this->GetPostsByCategory($this->category);
        return view('livewire.pages-categories', ['posts' => $this->posts]);
    }
}
