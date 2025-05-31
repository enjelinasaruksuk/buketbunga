<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Produk;

class ListProdukController extends Controller
{
    public function show(Request $request)
    {
        $query = Produk::query();
       
        if ($request->filled('keyword')) {
            $query->where('nama', 'like', '%' . $request->keyword . '%');
        }
       
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }
       
        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }
       
        if ($request->filled('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('harga', $request->sort);
        }
       
        $data = $query->get();
        
        // Cek jika ada parameter edit
        $editProduk = null;
        if ($request->filled('edit')) {
            $editProduk = Produk::find($request->edit);
        }
       
        return view('list_produk', compact('data', 'editProduk'));
    }
   
    public function simpan(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string'
        ]);
       
        // Membuat produk baru
        $produk = new Produk();
        $produk->nama = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->deskripsi = $request->deskripsi;
        $produk->save();
       
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // Function DELETE 
    public function delete($id)
    {
        // Cari produk berdasarkan ID
        $produk = Produk::where('id', $id)->first();
        
        // Gunakan if untuk menghindari error 
        if ($produk) {
            $produk->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }
    }

    // Function UPDATE 
    public function edit($id)
    {
        return redirect('/list_produk?edit=' . $id);
    }

    // Function UPDATE
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string'
        ]);

        $produk = Produk::where('id', $id)->first();
        
        if ($produk) {
            $produk->nama = $request->nama_produk;
            $produk->harga = $request->harga;
            $produk->deskripsi = $request->deskripsi;
            $produk->save();
            
            return redirect('/list_produk')->with('success', 'Produk berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }
    }
}