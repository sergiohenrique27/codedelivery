<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                @if( Auth::Check ())
                    <p>{{ Auth::user()->name }}</p>
            @endif
            <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->

            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>Home</span></a></li>


            @if( Auth::user()->role == "admin")
                <li><a href="{{ route('admin.categories.index') }}"><i class='fa fa-link'></i>
                        <span>Categorias</span></a></li>
                <li><a href="{{ route('admin.products.index') }}"><i class='fa fa-link'></i>
                        <span>Produtos</span></a></li>
                <li><a href="{{ route('admin.clients.index') }}"><i class='fa fa-link'></i>
                        <span>Clientes</span></a></li>
                <li><a href="{{ route('admin.orders.index') }}"><i class='fa fa-link'></i> <span>Pedidos</span></a>
                </li>
                <li><a href="{{ route('admin.cupoms.index') }}"><i class='fa fa-link'></i> <span>Cupoms</span></a>
                </li>
            @elseif(Auth::user()->role == "client")
                <li><a href="{{ route('customer.order.index') }}"><i class='fa fa-link'></i>
                        <span>Meus Pedidos</span></a></li>
            @elseif(Auth::user()->role == "employee")
                <li><a href="{{ route('employee.checkin.index') }}"><i class='fa fa-link'></i>
                        <span>Realizar Checkin</span></a>
                </li><li><a href="{{ route('employee.checkin.find') }}"><i class='fa fa-link'></i>
                        <span>Localizar Checkin</span></a></li>
        @endif


        <!--
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
            -->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
