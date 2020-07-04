<aside class="side-left full-height pos-abs right-0 left-0 bottom-0 disBlock padding-t-full">
    <ul class="sidebar no-margin no-padding">

        <li class="no-margin">
            <a class="no-margin text-left" href="/admin">
                <i class="sidebar-icon pull-left fa fa-home"></i>
                <span class="sidebar-text">Home</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="{{ route('users.index') }}" class="no-margin text-left">
                <i class="sidebar-icon pull-left fa fa-users"></i>
                <span class="sidebar-text text-left">Operators</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="{{ route('contents.show',['type'=>'article']) }}" class="no-margin text-left">
                <i class="sidebar-icon pull-left fa fa-folder-o"></i>
                <span class="sidebar-text text-left">Article List</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="{{ route('contents.show',['type'=>'product']) }}" class="no-margin text-left">
                <i class="sidebar-icon pull-left fa fa-folder-o"></i>
                <span class="sidebar-text text-left">Product List</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="{{ route('category.index') }}" class="no-margin text-left">
                <i class="sidebar-icon pull-left fa fa-bars"></i>
                <span class="sidebar-text text-left">Category List</span>

            </a>
        </li>

        <li class="no-margin">
            <a href="/admin/menu?menu=1" class="no-margin text-left">
                <i class="sidebar-icon pull-left fa fa-bars"></i>
                <span class="sidebar-text text-left">Menu</span>

            </a>
        </li>
    </ul>

    <p class="copyright-container text-left pos-abs bottom-0 right-0 left-0 padding-full no-margin text-white">&copy; {{date('Y')}} CMS.</p>
</aside>
