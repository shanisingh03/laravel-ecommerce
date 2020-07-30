<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\AttributeContract;
use App\Contracts\CategoryContract;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    protected $productRepository;

    protected $attributeRepository;

    protected $categoryRepository;

    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository, CategoryContract $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get Home Page of Site
     * @author Shani Singh
     */
    public function getHomePage()
    {
        // Random Products
        $top_products = $this->productRepository->getTopThreeProducts();

        // Featured Categories
        $featured_categories = $this->categoryRepository->getFeaturedCategory();

        // Featured Products
        $featured_products = $this->productRepository->getFeaturedProducts();
        
        // Recently Added 
        $new_products = $this->productRepository->getNewProducts();
        

        return view('site.pages.homepage')->with([
            'top_products'          => $top_products,
            'featured_categories'   => $featured_categories,
            'featured_products'     => $featured_products,
            'new_products'          => $new_products,
        ]);
    }

}
