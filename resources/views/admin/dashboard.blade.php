@extends('admin.layout')
@section('admin-layout')
<div class="header mb-7">
    <h6 class="text-md font-bold">Last Update 10 Product</h6>
</div>

<div class="body">
    <table id="productTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Thumbnail</th>
                <th>Stock</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->purchase_price }}</td>
                    <td>{{ $product->selling_price }}</td>
                    <td>
                        <button class="px-2 py-1 rounded-md text-sm text-primary cursor-pointer" data-hs-overlay="#modalThumbnail{{ $product->id }}" type="button">Thumbnail Preview</button>

                        <div id="modalThumbnail{{ $product->id }}" class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
                            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                                    <div class="flex justify-between items-center py-3 px-4 border-b">
                                        <h3 class="font-bold text-gray-800">
                                            Product Thumbnail for {{ $product->name }}
                                        </h3>
                                        <button type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm" data-hs-overlay="#modalThumbnail{{ $product->id }}">
                                            <span class="sr-only">Close</span>
                                        </button>
                                    </div>
                                    <div class="p-4 overflow-y-auto">
                                        <img class="w-full" src="{{ URL::asset('storage/thumbnail/'.$product->thumbnail) }}" alt="">
                                    </div>
                                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                                        <button type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm" data-hs-overlay="#modalThumbnail{{ $product->id }}">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $product->stock }}</td>
                    <td class="flex gap-2">
                        <button class="px-2 py-1 rounded-md text-sm bg-primary text-white cursor-pointer" data-hs-overlay="#modalDetail{{ $product->id }}">Detail</button>
                    </td>


                    <div id="modalDetail{{ $product->id }}" class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
                        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                                <div class="flex justify-between items-center py-3 px-4 border-b">
                                    <h3 class="font-bold text-gray-800">
                                        Product Detail for {{ $product->name }}
                                    </h3>
                                    <button type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm" data-hs-overlay="#modalDetail{{ $product->id }}">
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                <div class="p-4 overflow-y-auto">
                                    <div class="mb-5 flex flex-col gap-2">
                                        <label class="text-md" for="name">Product Name</label>
                                        <input disabled class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('name') border-danger @enderror" type="text" id="name" name="name" value="{{ $product->name }}" required>
                                        @error('name')
                                            <span class=" text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-5 flex flex-col gap-2">
                                        <label class="text-md" for="purchasePrice">Purchase Price</label>
                                        <input disabled class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('purchasePrice') border-danger @enderror" type="number" id="purchasePrice" name="purchasePrice" value="{{ $product->purchase_price }}" min="0" max="999999999" placeholder="Max: 999999999" required>
                                        @error('purchasePrice')
                                            <span class=" text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-5 flex flex-col gap-2">
                                        <label class="text-md" for="sellingPrice">Selling Price</label>
                                        <input disabled class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('sellingPrice') border-danger @enderror" type="number" id="sellingPrice" name="sellingPrice" value="{{ $product->selling_price }}" min="0" max="999999999" placeholder="Max: 999999999" required>
                                        @error('sellingPrice')
                                            <span class=" text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-5 flex flex-col gap-2">
                                        <label class="text-md" for="stock">Stock</label>
                                        <input disabled class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('stock') border-danger @enderror" type="number" id="stock" name="stock" value="{{ $product->stock }}" min="0" max="999999999" placeholder="Max: 999999999" required>
                                        @error('stock')
                                            <span class=" text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-5 flex flex-col gap-2">
                                        <label class="text-md" for="thumbnail">Thumbnail</label>
                                        <img src="{{ URL::asset('storage/thumbnail/'.$product->thumbnail) }}" alt="" width="100">
                                    </div>
                                </div>
                                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                                    <button type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm" data-hs-overlay="#modalUpdate{{ $product->id }}">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Thumbnail</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
            </tr>
        </tfoot>
    </table>
</div>
@push('js')
<script>
    new DataTable('#productTable');
</script>
@endpush
@endsection
