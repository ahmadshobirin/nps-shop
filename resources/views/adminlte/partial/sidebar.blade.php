<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="!#"><i class="fa fa-dashboard"></i> <span>index</span></a> </li>

            <li class="treeview @yield('treeview_master')">
				<a href="#">
					<i class='fa fa-book'></i>
					<span>Master</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>

                <ul class="treeview-menu">
					<li style="padding-left:20px;" class="@yield('treeview_user_approval')">
						<a href="{{ route('customer.index') }}">
							<i class="fa fa-check-square"></i>Customer
						</a>
					</li>

                    <li style="padding-left:20px;" class="@yield('produk')">
						<a href="{{ route('kategori-produk.index') }}">
							<i class="fa fa-check-square"></i> Kategori Produk
						</a>
					</li>
				</ul>

            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
