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
        $relevant_products = $this->productRepository->findRelevantProductsBySlug($slug);

        return view('site.pages.product', compact('product', 'attributes','relevant_products'));
    }

    /**
     * Add to Cart 
     * Author: Shani Singh
     */
    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->productId);
        $options = $request->except('_token', 'productId', 'price', 'qty');
        // dd($options);
        Cart::add(
            array(
                'id'                => uniqid(), 
                'name'              => $product->name, 
                'price'             => $request->input('price'), 
                'quantity'          => $request->input('qty'), 
                'attributes'        => $options, 
                'conditions'        => $product->images->first()->full ?? 'https://via.placeholder.com/176'
            )
        );
    
        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
}