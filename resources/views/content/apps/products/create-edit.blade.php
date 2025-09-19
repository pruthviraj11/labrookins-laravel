@extends('layouts/layoutMaster')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('vendor-style')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        /* ensure editable area has minimum height */
        #editor {
            min-height: 200px;
        }

        .ql-editor {
            min-height: 200px;
        }
    </style>
@endsection
{{-- {{dd($product)}} --}}
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h5>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($product) ? route('store.products.update', encrypt($product->id)) : route('store.products.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($product))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Product Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="product_name"
                        value="{{ old('product_name', $product->product_name ?? '') }}" class="form-control" required>
                    <span class="text-danger">
                        @error('product_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Description</label>
                    <!-- empty editor container; we'll populate via JS safely -->
          <div id="editor" class="form-control">{!! old('product_description', $product->product_description ?? '') !!}</div>

{{-- <textarea name="product_description" id="product_description" class="d-none"></textarea> --}}
<!-- hidden input that will be submitted -->
                    <input type="hidden" name="product_description" id="product_description"
                        value="{{ old('product_description', $product->product_description ?? '') }}">
                    <span class="text-danger">
                        @error('product_description')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Price</label>
                    <input type="text" name="product_price"
                        value="{{ old('product_price', $product->product_price ?? '') }}" class="form-control" required>
                    <span class="text-danger">
                        @error('product_price')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Discount Price</label>
                    <input type="text" name="product_discount_price"
                        value="{{ old('product_discount_price', $product->product_discount_price ?? '') }}"
                        class="form-control">
                    <span class="text-danger">
                        @error('product_discount_price')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="product_image" class="form-control">

                    @if (isset($product) && $product->product_image)
                        <img src="{{ Storage::url($product->product_image) }}" alt="Product Image" class="mt-2"
                            style="max-width: 150px;">
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Files (Download Document)</label>
                    <input type="file" name="download_document" class="form-control">
                    @if (isset($product) && $product->download_document)
                        <a href="{{ Storage::url($product->download_document) }}" target="_blank"
                            class="d-block mt-2">Download Existing File</a>
                    @endif
                </div>

                <div class="form-check form-switch mb-3">
                    <label class="form-check-label">Status</label>
                    <input class="form-check-input" type="checkbox" name="status" value="1"
                        {{ isset($product) && $product->status ? 'checked' : '' }}>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('store.products.list') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

@section('vendor-script')
    {{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> --}}


<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Enter product description...',
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                ['link', 'blockquote', 'code-block', 'image'],
                [{ list: 'ordered' }, { list: 'bullet' }]
            ]
        }
    });

    var textarea = document.getElementById('product_description');

    // set initial textarea value from editor
    textarea.value = quill.root.innerHTML;

    // 🔑 keep textarea updated whenever editor changes
    quill.on('text-change', function () {
      // alert('text change');
        textarea.value = quill.root.innerHTML;
    });

    // safety net: also update on submit
    document.querySelector('form').addEventListener('submit', function () {
        textarea.value = quill.root.innerHTML;
    });
});
</script>


@endsection
