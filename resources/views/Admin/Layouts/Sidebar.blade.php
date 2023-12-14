<div class="sidebar">
    <div class="side-header">
        <h3>L<span>ogo</span></h3>
    </div>

    <div class="side-content">
        <div class="profile">
            <div class="profile-img bg-img" style="background-image: url(img/1.jpeg)"></div>
            <h4>David Green</h4>
            <small>Art Director</small>
        </div>

        <div class="side-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ Route::current()->getName() == 'admin.dashboard' ? 'active' : '' }}">
                        <span class="las la-home"></span>
                        <small>Dashboard</small>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.index') }}"
                        class="{{ Route::current()->getName() == 'user.index' ? 'active' : '' }}">
                        <span class="las la-users"></span>
                        <small>Users</small>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-user-alt"></span>
                        <small>Profile</small>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
