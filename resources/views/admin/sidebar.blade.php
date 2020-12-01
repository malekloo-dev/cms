<aside class="side-left full-height pos-abs right-0  bottom-0 disBlock padding-t-full">
    <ul class="sidebar no-margin no-padding">

        <li class="no-margin">
            <a class="no-margin text-right" href="/admin">
                <i class="sidebar-icon pull-right fa fa-home"></i>
                <span class="sidebar-text">@lang('messages.home')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('contents.show',['type'=>'article']) }}" class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-folder-o"></i>
                <span class="sidebar-text text-right">@lang('messages.content')</span>
            </a>
        </li>
        <li class="no-margin">
            <a href="{{ route('contents.show',['type'=>'product']) }}" class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-shopping-cart"></i>
                <span class="sidebar-text text-right">@lang('messages.products')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('comment.index') }}" class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-envelope"></i>
                <span class="sidebar-text text-right">@lang('messages.Comments')</span>
            </a>
        </li>
        <li class="divider"></li>

        <li class="no-margin">
            <a href="{{ route('category.index') }}" class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-bars"></i>
                <span class="sidebar-text text-right">@lang('messages.category')</span>
            </a>
        </li>

        {{-- <li class="no-margin">
            <a class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-bars"></i>
                <span class="sidebar-text text-right">دسته بندی</span>
            </a>
            <ul class="sidebar-child">
                <li>
                    <a href="{{ route('category.index') }}" class="no-margin text-right">
                        <i class="sidebar-icon pull-right fa fa-bars"></i>
                        <span class="sidebar-text text-right">دسته بندی</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/menu?menu=1" class="no-margin text-right">
                        <i class="sidebar-icon pull-right fa fa-bars"></i>
                        <span class="sidebar-text text-right">منو</span>

                    </a>
                </li>
            </ul>
        </li> --}}


        <li class="no-margin">
            <a href="/admin/menu?menu=1" class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-envelope"></i>
                <span class="sidebar-text text-right">@lang('messages.menu')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('seo.redirectUrl.index') }}" class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-unlink"></i>
                <span class="sidebar-text text-right">@lang('messages.Redirect Url')</span>
            </a>
        </li>
        <li class="no-margin">
            <a href="{{ route('seo.websiteSetting.edit') }}" class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-bar-chart"></i>
                <span class="sidebar-text text-right">@lang('messages.seo setting')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('users.index') }}" class="no-margin text-right">
                <i class="sidebar-icon pull-right fa fa-users"></i>
                <span class="sidebar-text text-right">@lang('messages.users')</span>
            </a>
        </li>

    </ul>

    <p class="copyright-container text-right pos-abs bottom-0 right-0 left-0 padding-full no-margin text-white">&copy; {{date('Y')}} CMS.</p>
</aside>
