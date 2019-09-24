<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Contracts\AttributeContract;
use Cart;

class ProductController extends BaseController
{
    protected $productRepository;

    protected $attributeRepository;

    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Show Product Details
     * Author: Shani Singh
     */
    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        return view('site.pages.product', compact('product', 'attributes'));
    }

    /**
     * Add to Cart 
     * Author: Shani Singh
     */
    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->productId);
        $options = $request->except('_token', 'productId', 'price', 'qty');
    
        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);
    
        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
}