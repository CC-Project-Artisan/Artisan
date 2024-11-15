@extends('layouts.frontend')
@section('pages')

<div class="listing-form-container">
    <div class="listing-form-section">
        <h1>Add New Product</h1>
        <form id="addProductForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Product Name -->
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="productName" placeholder="Enter product name" autofocus class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <!-- Product Category -->
            <div class="form-group">
                <label for="productCategory">Product Category</label>
                <select id="productCategory" name="productCategory" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    <option value="" disabled selected>Select a category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    <!-- <option value="Art">Art</option>
                    <option value="Craft">Craft</option>
                    <option value="Jewelry">Jewelry</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Other">Other</option> -->
                </select>
            </div>

            <!-- Product Price -->
            <div class="form-group">
                <label for="productPrice">Product Price (Rs.)</label>
                <input type="number" id="productPrice" name="productPrice" placeholder="Enter product price" min="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="productDescription">Product Description</label>
                <textarea id="productDescription" name="productDescription" placeholder="Enter product description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required></textarea>
            </div>

            <!-- Product Images -->
            <div class="form-group">
                <label for="productDescription">Upload Images</label>
                <label>Your advert can contain up to 20 photos. The first image will be the
                    main.</label>
                <div class="sec-box img-up">
                    <div class="image-uploader">
                        <!-- <input type="file" name="productImages" id="image-input" accept="image/*"/> -->
                        <input type="file" name="productImages[]" id="image-input" accept="image/*" multiple />
                        <label for="image-input"><i class="fa-solid fa-plus" style="color: grey;"></i><br>Add photo</label>
                        <div class="image-preview" id="image-preview"></div>
                    </div>
                </div>
            </div>

            <!-- Stock Quantity -->
            <div class="form-group">
                <label for="stockQuantity">Stock Quantity</label>
                <input type="number" id="stockQuantity" name="productQuantity" placeholder="Enter stock quantity" min="1" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <!-- Additional Information -->
            <h2 class="my-2 text-lg">Additional Information</h2>
            <div class="form-group">
                <label for="additionalInfo">Weight (kg)</label>
                <input type="number" id="weight" name="weight" min="1" placeholder="Enter product weight" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div class="form-group">
                <label for="additionalInfo">Dimensions</label>
                <input type="text" id="dimensions" name="dimensions" placeholder="Enter product dimensions" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <!-- Submit Button -->
            <button class="apply-button">Publish the Product</button>
        </form>
    </div>
</div>

<script>
    // image uploader
    document.getElementById('image-input').addEventListener('change', function() {
        const imagePreview = document.getElementById('image-preview');
        const files = Array.from(this.files);

        files.forEach(file => {
            // Check file size
            if (file.size > 2 * 1024 * 1024) {
                alert('Each image must be less than 2MB');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;

                const imageContainer = document.createElement('div');
                imageContainer.classList.add('image-container');

                const removeBtn = document.createElement('button');
                removeBtn.innerText = 'X';
                removeBtn.classList.add('remove-btn');
                removeBtn.addEventListener('click', function() {
                    imageContainer.remove();
                });

                imageContainer.appendChild(img);
                imageContainer.appendChild(removeBtn);
                imagePreview.appendChild(imageContainer);
            };

            reader.readAsDataURL(file);
        });
    });

    // Allow image reordering
    const imagePreview = document.getElementById('image-preview');
    let dragSrcEl = null;

    function handleDragStart(e) {
        dragSrcEl = this;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.dataTransfer.dropEffect = 'move';
        return false;
    }

    function handleDragEnter() {
        this.classList.add('over');
    }

    function handleDragLeave() {
        this.classList.remove('over');
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }

        if (dragSrcEl !== this) {
            dragSrcEl.innerHTML = this.innerHTML;
            this.innerHTML = e.dataTransfer.getData('text/html');
        }

        return false;
    }

    function handleDragEnd() {
        const imageContainers = document.querySelectorAll('.image-preview .image-container');
        imageContainers.forEach(container => {
            container.classList.remove('over');
        });
    }

    function addDnDHandlers(container) {
        container.addEventListener('dragstart', handleDragStart, false);
        container.addEventListener('dragenter', handleDragEnter, false);
        container.addEventListener('dragover', handleDragOver, false);
        container.addEventListener('dragleave', handleDragLeave, false);
        container.addEventListener('drop', handleDrop, false);
        container.addEventListener('dragend', handleDragEnd, false);
    }

    // imagePreview.addEventListener('DOMNodeInserted', function(e) {
    //     if (e.target.className === 'image-container') {
    //         e.target.setAttribute('draggable', 'true');
    //         addDnDHandlers(e.target);
    //     }
    // });

    document.addEventListener('DOMContentLoaded', (event) => {
        // Callback function to execute when mutations are observed
        const callback = function(mutationsList, observer) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'childList') {
                    console.log('A child node has been added or removed.');
                    // Your existing code here
                }
            }
        };

        // Create an observer instance linked to the callback function
        const observer = new MutationObserver(callback);

        // Options for the observer (which mutations to observe)
        const config = {
            childList: true,
            subtree: true
        };

        // Target element to observe
        const imagePreview = document.getElementById('imagePreview');

        // Start observing the target element for configured mutations
        if (imagePreview) {
            observer.observe(imagePreview, config);
        }
    });
</script>
@endsection