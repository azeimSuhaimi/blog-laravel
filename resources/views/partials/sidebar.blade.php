        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('dashboard') || Request::is('roles') ? 'active':'' }}">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            @can('admin')
                
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
            <div class="sidebar-heading">
                ADMIN
            </div>

            <!-- Nav Item - roles -->
            <li class="nav-item {{  Request::is('roles') ? 'active':'' }}">
                <a class="nav-link" href="{{route('user.roles')}}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>ROLES</span></a>
            </li>

            
            <!-- Nav Item - roles -->
            <li class="nav-item {{  Request::is('postsPicker') ? 'active':'' }}">
                <a class="nav-link" href="{{route('postsPicker')}}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>posts Picker</span></a>
            </li>

            <!-- Nav Item - roles -->
            <li class="nav-item {{  Request::is('menagePosts') ? 'active':'' }}">
                <a class="nav-link" href="{{route('menagePosts.show')}}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>manage posts</span></a>
            </li>

            <!-- Nav Item - roles -->
            <li class="nav-item {{  Request::is('msgsub') ? 'active':'' }}">
                <a class="nav-link" href="{{route('msgsub')}}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>messege subscriber</span></a>
            </li>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item {{ (Request::is('create_product') || Request::is('show_product')) || (Request::is('edit_product') )? 'active':'' }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product"
                        aria-expanded="true" aria-controls="product">
                        <i class="fas fa-fw fa-pen"></i>
                        <span>my product</span>
                    </a>
                    <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom product:</h6>
                            <a class="collapse-item {{ Request::is('create_product') ? 'active':'' }}" href="{{route('products.create')}}">create product</a>
                            <a class="collapse-item {{ (Request::is('show_product') || Request::is('show_product') ) || Request::is('edit_product') ? 'active':''}}" href="{{route('products.show')}}">show posts</a>
                        </div>
                    </div>
                </li>


                <li class="nav-item {{ Request::is('order_list') || Request::is('order_status') ? 'active':'' }}">
                    <a class="nav-link" href="{{route('orders.index')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>order list</span></a>
                </li>

            

            @endcan


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item {{ (Request::is('createPost') || Request::is('showPost')) || (Request::is('editPost') )? 'active':'' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Posts"
                    aria-expanded="true" aria-controls="Posts">
                    <i class="fas fa-fw fa-pen"></i>
                    <span>My Posts</span>
                </a>
                <div id="Posts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Post:</h6>
                        <a class="collapse-item {{ Request::is('createPost') ? 'active':'' }}" href="{{route('createPost')}}">create posts</a>
                        <a class="collapse-item {{ (Request::is('createPost') || Request::is('editPost')) ? 'active':'' }}" href="{{route('showPost')}}">show posts</a>
                    </div>
                </div>
            </li>

            @can('access', 'open')
                


           

            @endcan
                
            <!-- Divider -->
            <hr class="sidebar-divider">






        </ul>
        <!-- End of Sidebar -->