<!-- ======== sidebar-nav start =========== -->
<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="logo" />
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z"/>
                            <path d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z"/>
                        </svg>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            @if(auth()->guard('admin')->user()->is_admin)
            <li class="nav-item">
                <a href="{{ route('orders') }}" class="{{ request()->routeIs('orders') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.33334 3.35442C3.33334 2.4223 4.07954 1.66666 5.00001 1.66666H15C15.9205 1.66666 16.6667 2.4223 16.6667 3.35442V16.8565C16.6667 17.5519 15.8827 17.9489 15.3333 17.5317L13.8333 16.3924C13.537 16.1673 13.1297 16.1673 12.8333 16.3924L10.5 18.1646C10.2037 18.3896 9.79634 18.3896 9.50001 18.1646L7.16668 16.3924C6.87038 16.1673 6.46298 16.1673 6.16668 16.3924L4.66668 17.5317C4.11731 17.9489 3.33334 17.5519 3.33334 16.8565V3.35442Z"/>
                        </svg>
                    </span>
                    <span class="text">All Orders</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin-users') }}" class="{{ request()->routeIs('admin-users') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 1.66669C5.39763 1.66669 1.66667 5.39765 1.66667 10C1.66667 14.6024 5.39763 18.3334 10 18.3334C14.6024 18.3334 18.3333 14.6024 18.3333 10C18.3333 5.39765 14.6024 1.66669 10 1.66669Z"/>
                        </svg>
                    </span>
                    <span class="text">Admin Users</span>
                </a>
            </li>
            @endif

            @if(auth()->guard('admin')->user()->hasRole('picker'))
            <li class="nav-item">
                <a href="{{ route('picker.orders') }}" class="{{ request()->routeIs('picker.orders') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 3.33333H2.5C1.57953 3.33333 0.833336 4.07953 0.833336 5V15C0.833336 15.9205 1.57953 16.6667 2.5 16.6667H17.5C18.4205 16.6667 19.1667 15.9205 19.1667 15V5C19.1667 4.07953 18.4205 3.33333 17.5 3.33333Z M7.5 11.6667L5 9.16667L7.5 6.66667 M12.5 11.6667L15 9.16667L12.5 6.66667"/>
                        </svg>
                    </span>
                    <span class="text">My Orders</span>
                </a>
            </li>
            @endif

            @if(auth()->guard('admin')->user()->hasRole('packer'))
            <li class="nav-item">
                <a href="{{ route('packer.orders') }}" class="{{ request()->routeIs('packer.orders') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 5.83333H2.5C1.57953 5.83333 0.833336 6.57953 0.833336 7.5V15.8333C0.833336 16.7538 1.57953 17.5 2.5 17.5H17.5C18.4205 17.5 19.1667 16.7538 19.1667 15.8333V7.5C19.1667 6.57953 18.4205 5.83333 17.5 5.83333Z M5 2.5H15M10 2.5V5.83333"/>
                        </svg>
                    </span>
                    <span class="text">My Packing</span>
                </a>
            </li>
            @endif

            @if(auth()->guard('admin')->user()->is_admin)
            <span class="divider"><hr /></span>

            <li class="nav-item">
                <a href="{{ route('forms') }}" class="{{ request()->routeIs('forms') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.66666 5.41669C1.66666 3.34562 3.34559 1.66669 5.41666 1.66669C7.48772 1.66669 9.16666 3.34562 9.16666 5.41669C9.16666 7.48775 7.48772 9.16669 5.41666 9.16669C3.34559 9.16669 1.66666 7.48775 1.66666 5.41669Z"/>
                        </svg>
                    </span>
                    <span class="text">Forms</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('imageform') }}" class="{{ request()->routeIs('imageform') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6667 5H3.33333C2.41286 5 1.66667 5.74619 1.66667 6.66667V15C1.66667 15.9205 2.41286 16.6667 3.33333 16.6667H16.6667C17.5872 16.6667 18.3333 15.9205 18.3333 15V6.66667C18.3333 5.74619 17.5872 5 16.6667 5Z"/>
                        </svg>
                    </span>
                    <span class="text">Image Form</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('report') }}" class="{{ request()->routeIs('report') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 1.66669C5.39763 1.66669 1.66667 5.39765 1.66667 10C1.66667 14.6024 5.39763 18.3334 10 18.3334C14.6024 18.3334 18.3333 14.6024 18.3333 10C18.3333 5.39765 14.6024 1.66669 10 1.66669Z"/>
                        </svg>
                    </span>
                    <span class="text">Reports</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('shipping') }}" class="{{ request()->routeIs('shipping') ? 'active' : '' }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 8.33333H2.5C1.57953 8.33333 0.833336 9.07953 0.833336 10V16.6667C0.833336 17.5872 1.57953 18.3333 2.5 18.3333H17.5C18.4205 18.3333 19.1667 17.5872 19.1667 16.6667V10C19.1667 9.07953 18.4205 8.33333 17.5 8.33333Z"/>
                        </svg>
                    </span>
                    <span class="text">Shipping</span>
                </a>
            </li>
            @endif
        </ul>
    </nav>
</aside>
<div class="overlay"></div>
<!-- ======== sidebar-nav end =========== -->