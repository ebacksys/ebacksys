<?php

// ProductTable.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductTable extends Component
{
    public $selectedProductId;
    public $products;
    public $name;
    public $price;
    
    public function mount()
    {
        // Fetch the list of products from the database
        
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.product-table');
    }

    public function updatedSelectedProductId($value)
    {
        $product = Product::find($value);
        $this->name = $product->name;
        $this->price = $product->price;

    }
}
