<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Index Blog";
        $data = Blog::with('kategori')->withCount('like', 'komentar')->latest()->get();

        return view('blog.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Buat Blog";
        $kategori = Kategori::all();
        return view('blog.create', compact('title', 'kategori'));
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
            'judul' => 'required',
            'cover' => 'required|file|image|mimes:jpeg,png,jpg',
            'kategori' => 'required|integer',
            'konten' => 'required',
        ]);

        $file = $request->file('cover');
        $filename = $file->hashName();

        $file->move("cover", $filename);
        $path = $request->getSchemeAndHttpHost() . "/cover/" . $filename;

        Blog::create([
            'judul' => $request->post('judul'),
            'cover' => $path,
            'id_kategori' => $request->post('kategori'),
            'konten' => $request->post('konten')
        ]);


        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $title = "Detail Blog";
        return view('blog.show', compact('blog', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $kategori = Kategori::all();
        $title = "Edit Blog";
        return view('blog.edit', compact('blog', 'title', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'judul' => 'required',
            'cover' => 'file|image|mimes:jpeg,png,jpg',
            'kategori' => 'required|integer',
            'konten' => 'required',
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $file->hashName();

            $file->move("cover", $filename);
            $path = $request->getSchemeAndHttpHost() . "/cover/" . $filename;

            $path_old = str_replace($request->getSchemeAndHttpHost(), "", $blog->cover);
            $cover_old = public_path($path_old);

            unlink($cover_old);

            $blog->update([
                'judul' => $request->post('judul'),
                'cover' => $path,
                'id_kategori' => $request->post('kategori'),
                'konten' => $request->post('konten')
            ]);
        } else {
            $blog->update([
                'judul' => $request->post('judul'),
                'id_kategori' => $request->post('kategori'),
                'konten' => $request->post('konten')
            ]);
        }

        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
