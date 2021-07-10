<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Hashids;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = null;
    public $showModal = false;
    public $productID;
    public $product;

    protected $listeners = ['deleteProduct'];

    protected $rules = [
        'product.name' => 'required|min:5|max:255',
        'product.description' => 'required|min:5|max:255',
        'product.price' => 'required|numeric',
    ];


    public function render()
    {
        if ($this->search == null) {
            $products = Product::orderBy('id', 'DESC')->simplePaginate(10);
        } else {
            $products = Product::where('name', 'like', '%'.$this->search.'%')
                ->simplePaginate(10);
        }
        return view('livewire.product-list', compact('products'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit($productID)
    {
        $this->resetValidation();
        $this->showModal = true;
        $this->productID = Hashids::connection('product')->decode($productID)[0] ?? null;
        if (is_null($this->productID)) {
            $this->emit('productNotFound');
            $this->showModal = false;
        } else {
            $this->product = Product::find($this->productID);
        }
    }

    public function create()
    {
        $this->resetValidation();
        $this->showModal = true;
        $this->product = null;
        $this->productID = null;
    }

    public function save()
    {
        $this->validate();
        /*
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emit('validation-errors',['errors' => $e]);
            $this->validate();
        }
        */
        if (!is_null($this->productID)) {
            $this->product->save();
            $this->emit('productUpdated');
        } else {
            Product::create($this->product);
            $this->emit('productSaved');
        }
        $this->showModal = false;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function deleteProduct($productID)
    {
        $this->productID = Hashids::connection('product')->decode($productID)[0] ?? null;
        if (is_null($this->productID)) {
            $this->emit('productNotFound');
        } else {
            $this->product = Product::find($this->productID);
            $this->product->delete();
            $this->emit('productDeleted');
        }
    }
}
