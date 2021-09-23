<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-title">Management</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i class='nav-icon la la-stamp'></i> Categories</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tag') }}'><i class='nav-icon la la-tags'></i> Tags</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('external-shop') }}'><i class='nav-icon la la-store-alt'></i> External shops</a></li>
<li class="nav-title">Catalog</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('discount') }}'><i class='nav-icon la la-percentage'></i> Discounts</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon la la-boxes'></i> Products</a></li>
<li class="nav-title">Other</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cogs"></i> Advanced</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}\"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> Settings</a></li>
    </ul>
</li>
