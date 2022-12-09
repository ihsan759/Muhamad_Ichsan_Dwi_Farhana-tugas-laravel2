<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        $title = "Home Products";
        return view('products.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Products";
        return view('products.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'stock' => 'required',
            'harga' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg'
        ]);

        $file = $request->file('gambar');
        $filename = $file->hashName();

        $file->move("gambar", $filename);
        $path = $request->getSchemeAndHttpHost() . "/gambar/" . $filename;

        Product::create([
            'nama' => $request->post('nama'),
            'stock' => $request->post('stock'),
            'harga' => $request->post('harga'),
            'photo' => $path
        ]);


        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $title = "Edit Products";
        return view('products.edit', compact('product', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'nama' => 'required',
            'stock' => 'required',
            'harga' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg'
        ]);

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');
            $filename = $file->hashName();

            $file->move("gambar", $filename);
            $path = $request->getSchemeAndHttpHost() . "/gambar/" . $filename;

            $path_old = str_replace($request->getSchemeAndHttpHost(), "", $product->photo);
            $image_old = public_path($path_old);

            unlink($image_old);

            $product->update([
                'nama' => $request->post('nama'),
                'stock' => $request->post('stock'),
                'harga' => $request->post('harga'),
                'photo' => $path
            ]);
        } else {
            $product->update([
                'nama' => $request->post('nama'),
                'stock' => $request->post('stock'),
                'harga' => $request->post('harga')
            ]);
        }

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        $path_old = str_replace($request->getSchemeAndHttpHost(), "", $product->photo);
        $image_old = public_path($path_old);

        unlink($image_old);

        $product->delete();
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
