<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Katalog Buket Bunga</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-pink-100 to-white min-h-screen p-10 text-gray-800">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-center text-pink-600 mb-10">Katalog Buket Bunga</h1>
        
        <!-- Pesan Sukses -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Pesan Error -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Input Produk Baru atau Edit -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            @if($editProduk)
                <!-- Form Edit -->
                <h2 class="text-2xl font-semibold text-pink-600 mb-4">Edit Produk</h2>
                <form method="POST" action="{{ route('produk.update', $editProduk->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                            <input 
                                type="text" 
                                name="nama_produk" 
                                id="nama_produk"
                                value="{{ old('nama_produk', $editProduk->nama) }}"
                                required
                                class="w-full px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 @error('nama_produk') border-red-500 @enderror"
                                placeholder="Masukkan nama produk"
                            />
                            @error('nama_produk')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <input 
                                type="number" 
                                name="harga" 
                                id="harga"
                                value="{{ old('harga', $editProduk->harga) }}"
                                required
                                min="0"
                                class="w-full px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 @error('harga') border-red-500 @enderror"
                                placeholder="Masukkan harga"
                            />
                            @error('harga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea 
                            name="deskripsi" 
                            id="deskripsi"
                            rows="3"
                            required
                            class="w-full px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 @error('deskripsi') border-red-500 @enderror"
                            placeholder="Masukkan deskripsi produk"
                        >{{ old('deskripsi', $editProduk->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-between">
                        <a href="{{ url('/list_produk') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded transition duration-200">
                            Batal
                        </a>
                        <button 
                            type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded transition duration-200"
                        >
                            Update Produk
                        </button>
                    </div>
                </form>
            @else
                <!-- Form Tambah Baru -->
                <h2 class="text-2xl font-semibold text-pink-600 mb-4">Tambah Produk Baru</h2>
                <form method="POST" action="{{ route('produk.simpan') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nama_produk" class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                            <input 
                                type="text" 
                                name="nama_produk" 
                                id="nama_produk"
                                value="{{ old('nama_produk') }}"
                                required
                                class="w-full px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 @error('nama_produk') border-red-500 @enderror"
                                placeholder="Masukkan nama produk"
                            />
                            @error('nama_produk')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <input 
                                type="number" 
                                name="harga" 
                                id="harga"
                                value="{{ old('harga') }}"
                                required
                                min="0"
                                class="w-full px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 @error('harga') border-red-500 @enderror"
                                placeholder="Masukkan harga"
                            />
                            @error('harga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea 
                            name="deskripsi" 
                            id="deskripsi"
                            rows="3"
                            required
                            class="w-full px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 @error('deskripsi') border-red-500 @enderror"
                            placeholder="Masukkan deskripsi produk"
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button 
                            type="submit"
                            class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded transition duration-200"
                        >
                            Simpan Produk
                        </button>
                    </div>
                </form>
            @endif
        </div>

        <!-- Form Pencarian & Filter -->
        <form method="GET" action="{{ url('/list_produk') }}" class="mb-8 flex flex-wrap justify-center gap-4">
            <input
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
                placeholder="Cari produk berdasarkan nama..."
                class="px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 w-full max-w-xs"
            />
            <input
                type="number"
                name="harga_min"
                value="{{ request('harga_min') }}"
                placeholder="Harga Min"
                min="0"
                class="px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 w-32"
            />
            <input
                type="number"
                name="harga_max"
                value="{{ request('harga_max') }}"
                placeholder="Harga Max"
                min="0"
                class="px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 w-32"
            />
            <select
                name="sort"
                class="px-4 py-2 border border-pink-300 rounded focus:outline-none focus:ring focus:border-pink-500 w-48"
            >
                <option value="">Urutkan Harga</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Termurah ke Termahal</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Termahal ke Termurah</option>
            </select>
            <button
                type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded transition"
            >
                Cari
            </button>
        </form>

        <!-- Tabel Produk dengan Action Column -->
        <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
            <table class="min-w-full table-auto border-collapse text-sm">
                <thead class="bg-pink-200 text-pink-900 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="py-4 px-6 border-b">No</th>
                        <th class="py-4 px-6 border-b">Nama Produk</th>
                        <th class="py-4 px-6 border-b">Deskripsi</th>
                        <th class="py-4 px-6 border-b">Harga</th>
                        <th class="py-4 px-6 border-b">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-100">
                    @forelse ($data as $index => $produk)
                        <tr class="hover:bg-pink-50 transition-colors">
                            <td class="py-3 px-6">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 font-semibold text-pink-700">{{ $produk->nama }}</td>
                            <td class="py-3 px-6">{{ $produk->deskripsi }}</td>
                            <td class="py-3 px-6 text-pink-600 font-medium">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-6">
                                <div class="flex space-x-2">
                                    <!-- tombol untuk edit (update) -->
                                    <a href="{{ route('produk.edit', $produk->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition duration-200">
                                        Edit
                                    </a>
                                    
                                    <!-- tombol untuk delete -->
                                    <form method="POST" action="{{ route('produk.delete', $produk->id) }}" 
                                          class="inline-block"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition duration-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada produk ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <p class="text-center text-xs text-gray-400 mt-6">© 2025 Bloomify Buket. All rights reserved.</p>
    </div>
</body>
</html>