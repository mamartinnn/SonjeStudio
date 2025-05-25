<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ProductImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Index - List all products
    public function index()
    {
        $products = ProductModel::with('featuredImage')->paginate(10);
        return view('products.index', compact('products'));
    }

    // Create - Show create form
    public function create()
    {
        return view('products.create');
    }

    // Store - Save new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = ProductModel::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('product_images', 'public');
                
                $product->images()->create([
                    'path' => $path,
                    'is_featured' => $key === 0 // Set first image as featured
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    // Show - Display single product
    public function show(ProductModel $product)
    {
        $product->load('images');
        return view('products.show', compact('product'));
    }

    // Edit - Show edit form
    public function edit(ProductModel $product)
    {
        $product->load('images');
        return view('products.edit', compact('product'));
    }

    // Update - Update product
    public function update(Request $request, ProductModel $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->update($validated);

        // Handle image updates
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    // Destroy - Delete product
    public function destroy(ProductModel $product)
    {
        // Delete associated images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }

    // Additional method to set featured image
    public function setFeatured(ProductImageModel $image)
    {
        // Remove current featured
        $image->product->images()->update(['is_featured' => false]);
        
        // Set new featured
        $image->update(['is_featured' => true]);
        
        return back()->with('success', 'Featured image updated!');
    }
}
