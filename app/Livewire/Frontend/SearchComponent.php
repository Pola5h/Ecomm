<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchComponent extends Component
{



    public function render(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%");
        })->get();
        return view('livewire.frontend.search-component', ['products' => $products, 'query' => $query]);
    }
}
