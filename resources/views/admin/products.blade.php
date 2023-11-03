@extends('admin.layout')
@section('admin-layout')
<div class="header mb-7">
    <button class="py-2 px-3 rounded-lg bg-primary text-white text-sm" data-hs-overlay="#modalUpload"><i class="bi bi-plus-lg me-2"></i> New Product</button>
</div>

<div id="modalUpload" class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="flex justify-between items-center py-3 px-4 border-b">
                <h3 class="font-bold text-gray-800">
                    Add New Product
                </h3>
                <button type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm" data-hs-overlay="#modalUpload">
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="p-4 overflow-y-auto">
                <form action="{{ route('admin.products.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5 flex flex-col gap-2">
                        <label class="text-md" for="name">Product Name</label>
                        <input class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('name') border-danger @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class=" text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5 flex flex-col gap-2">
                        <label class="text-md" for="purchasePrice">Purchase Price</label>
                        <input class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('purchasePrice') border-danger @enderror" type="number" id="purchasePrice" name="purchasePrice" value="{{ old('purchasePrice') }}" min="0" max="999999999" placeholder="Max: 999999999" required>
                        @error('purchasePrice')
                            <span class=" text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5 flex flex-col gap-2">
                        <label class="text-md" for="sellingPrice">Selling Price</label>
                        <input class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('sellingPrice') border-danger @enderror" type="number" id="sellingPrice" name="sellingPrice" value="{{ old('sellingPrice') }}" min="0" max="999999999" placeholder="Max: 999999999" required>
                        @error('sellingPrice')
                            <span class=" text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5 flex flex-col gap-2">
                        <label class="text-md" for="stock">Stock</label>
                        <input class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('stock') border-danger @enderror" type="number" id="stock" name="stock" min="0" max="999999999" placeholder="Max: 999999999" value="{{ old('stock') }}" required>
                        @error('stock')
                            <span class=" text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5 flex flex-col gap-2">
                        <label class="text-md" for="thumbnail">Thumbnail</label>
                        <input class="border lg:border-light-color rounded-lg focus:outline-primary file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-3 file:px-4 cursor-pointer @error('thumbnail') border-danger @enderror" type="file" id="thumbnail" name="thumbnail" accept="image/png, image/jpg" required>
                        @error('thumbnail')
                            <span class=" text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                <button type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm" data-hs-overlay="#modalUpload">
                    Close
                </button>
                <button class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-primary text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all text-sm" href="#">
                    Create
                </button>
                </form>
            </div>
        </div>
    </div>
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
                        <button type="button" class="px-2 py-1 rounded-md text-sm bg-warning text-white cursor-pointer" data-hs-overlay="#modalUpdate{{ $product->id }}"><i class="bi bi-pencil-square me-2"></i> Update</button>
                        <button onclick="confirmdelete({{ $product->id }})" class="px-2 py-1 rounded-md text-sm bg-danger text-white cursor-pointer"><i class="bi bi-trash me-2"></i> Delete</button>
                    </td>

                    <div id="modalUpdate{{ $product->id }}" class="hs-overlay hidden w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
                        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                                <div class="flex justify-between items-center py-3 px-4 border-b">
                                    <h3 class="font-bold text-gray-800">
                                        Update for {{ $product->name }}
                                    </h3>
                                    <button type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm" data-hs-overlay="#modalUpdate{{ $product->id }}">
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                <div class="p-4 overflow-y-auto">
                                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-5 flex flex-col gap-2">
                                            <label class="text-md" for="name">Product Name</label>
                                            <input class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('name') border-danger @enderror" type="text" id="name" name="name" value="{{ $product->name }}" required>
                                            @error('name')
                                                <span class=" text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-5 flex flex-col gap-2">
                                            <label class="text-md" for="purchasePrice">Purchase Price</label>
                                            <input class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('purchasePrice') border-danger @enderror" type="number" id="purchasePrice" name="purchasePrice" value="{{ $product->purchase_price }}" min="0" max="999999999" placeholder="Max: 999999999" required>
                                            @error('purchasePrice')
                                                <span class=" text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-5 flex flex-col gap-2">
                                            <label class="text-md" for="sellingPrice">Selling Price</label>
                                            <input class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('sellingPrice') border-danger @enderror" type="number" id="sellingPrice" name="sellingPrice" value="{{ $product->selling_price }}" min="0" max="999999999" placeholder="Max: 999999999" required>
                                            @error('sellingPrice')
                                                <span class=" text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-5 flex flex-col gap-2">
                                            <label class="text-md" for="stock">Stock</label>
                                            <input class="border lg:border-light-color py-2 px-3 rounded-lg focus:outline-primary @error('stock') border-danger @enderror" type="number" id="stock" name="stock" value="{{ $product->stock }}" min="0" max="999999999" placeholder="Max: 999999999" required>
                                            @error('stock')
                                                <span class=" text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-5 flex flex-col gap-2">
                                            <label class="text-md" for="thumbnail">Thumbnail</label>
                                            <input class="border lg:border-light-color rounded-lg focus:outline-primary file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-3 file:px-4 cursor-pointer @error('thumbnail') border-danger @enderror" type="file" id="thumbnail" name="thumbnail"  accept="image/png, image/jpg" required>
                                            @error('thumbnail')
                                                <span class=" text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-5 flex flex-col gap-2">
                                            <label class="text-md" for="thumbnail">Previous Thumb</label>
                                            <img src="{{ URL::asset('storage/thumbnail/'.$product->thumbnail) }}" alt="" width="100">
                                        </div>
                                </div>
                                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                                    <button type="button" class="hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm" data-hs-overlay="#modalUpdate{{ $product->id }}">
                                        Close
                                    </button>
                                    <button class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-warning text-white hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-warning focus:ring-offset-2 transition-all text-sm" href="#">
                                        Update
                                    </button>
                                    </form>
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
<form id="formDelete" action="{{ route('admin.products.delete') }}" method="POST">
    @csrf
    <input type="hidden" id="productId" name="productId">
</form>
<script>

function confirmdelete(id){
        $('#productId').val(id);
        Swal.fire({
            title: 'Delete Product?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4253F0',
            cancelButtonColor: '#F05742',
            confirmButtonText: 'Delete Product'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formDelete').submit();
            }
        })
    }
</script>
@push('js')
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Error!',
        text: `
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            `
    })
</script>
@endif
<script>
    new DataTable('#productTable');
</script>
@endpush
@endsection
