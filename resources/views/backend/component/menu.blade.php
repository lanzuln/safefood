<div class="menu-container flex-grow-1">
    <ul id="menu" class="menu">
        {{-- dashboard  --}}
        <li>
            <a href="{{ route('dashboard') }}">
                <i data-cs-icon="shop" class="icon" data-cs-size="18"></i>
                <span class="label">Dashboard</span>
            </a>
        </li>
        {{-- category  --}}
        <li>
            <a href="#categories">
                <i data-cs-icon="cupcake" class="icon" data-cs-size="18"></i>
                <span class="label">Category</span>
            </a>
            <ul id="categories">
                <li>
                    <a href="{{ route('category.index') }}">
                        <span class="label">All category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.create') }}">
                        <span class="label">Create category</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- sub category  --}}
        <li>
            <a href="#categories">
                <i data-cs-icon="cupcake" class="icon" data-cs-size="18"></i>
                <span class="label">Sub Category</span>
            </a>
            <ul id="categories">
                <li>
                    <a href="{{ route('sub-category.index') }}">
                        <span class="label">All sub category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sub-category.create') }}">
                        <span class="label">Create sub category</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- product --}}
        <li>
            <a href="#Product">
                <i data-cs-icon="cupcake" class="icon" data-cs-size="18"></i>
                <span class="label">Product</span>
            </a>
            <ul id="Product">
                <li>
                    <a href="{{ route('product.index') }}">
                        <span class="label">All Product</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product.create') }}">
                        <span class="label">Create Product</span>
                    </a>
                </li>
            </ul>
        </li>
         {{-- slider --}}
         <li>
            <a href="#slider">
                <i data-cs-icon="cupcake" class="icon" data-cs-size="18"></i>
                <span class="label">Slider</span>
            </a>
            <ul id="slider">
                <li>
                    <a href="{{ route('slider.index') }}">
                        <span class="label">All Product</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('slider.create') }}">
                        <span class="label">Create Product</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>
