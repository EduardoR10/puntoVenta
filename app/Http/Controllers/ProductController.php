<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar todos los productos activos
    public function showProducts()
    {
        $products = Product::active()->get();
        return view('products.index', compact('products'));
    }

    // Mostrar formulario para crear un nuevo producto
    public function create()
    {
        return view('products.create');
    }

    // Almacenar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'unitprice' => 'required|numeric',
            'code' => 'required|string|unique:products',
            'stock' => 'required|integer',
            'stockmin' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagen opcional
        ]);

        // Subir la imagen si se ha proporcionado
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            $imagePath = null; // No se sube imagen
        }

        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'unitprice' => $request->unitprice,
            'code' => $request->code,
            'stock' => $request->stock,
            'stockmin' => $request->stockmin,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // Mostrar formulario para editar un producto
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Actualizar los datos del producto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'unitprice' => 'required|numeric',
            'code' => 'required|string|unique:products,code,' . $product->id,
            'stock' => 'required|integer',
            'stockmin' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Si se sube una nueva imagen, actualizar la ruta
        if ($request->hasFile('image')) {
            // Eliminar la imagen vieja si existe
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }

            // Subir nueva imagen
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            $imagePath = $product->image; // Mantener la imagen existente si no se sube una nueva
        }

        // Actualizar los campos del producto
        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'unitprice' => $request->unitprice,
            'code' => $request->code,
            'stock' => $request->stock,
            'stockmin' => $request->stockmin,
            'image' => $imagePath,  // Guardar la ruta de la imagen
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Eliminar un producto (eliminación falsa)
    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);
        return redirect()->route('products.index')->with('success', 'Product disabled successfully!');
    }
}
