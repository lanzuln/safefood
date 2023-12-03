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
                    <a href="">
                        <span class="label">All category</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="label">Create category</span>
                    </a>
                </li>
            </ul>
        </li>
         {{-- category  --}}
         <li>
            <a href="#product">
                <i data-cs-icon="cupcake" class="icon" data-cs-size="18"></i>
                <span class="label">product</span>
            </a>
            <ul id="product">
                <li>
                    <a href="">
                        <span class="label">All category</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="label">Create category</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
