<aside class="side-left full-height pos-abs @if($ltr) left-0 @else right-0 @endif  bottom-0 disBlock padding-t-full">
    <ul class="sidebar no-margin no-padding">

        <li class="no-margin">
            <a class="no-margin  @if(!$ltr) text-right @endif" href="/admin">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-home"></i>
                <span class="sidebar-text">@lang('messages.home')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('contents.show',['type'=>'article']) }}" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-folder-o"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.content')</span>
            </a>
        </li>
        <li class="no-margin">
            <a href="{{ route('contents.show',['type'=>'product']) }}" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-shopping-cart"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.products')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('comment.index') }}" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-comments"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.Comments')</span>
            </a>
        </li>
        <li class="no-margin">
            <a href="{{ route('contact.index') }}" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-envelope"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.contact')</span>
            </a>
        </li>
        <li class="divider"></li>

        <li class="no-margin">
            <a href="{{ route('category.index') }}" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-bars"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.category')</span>
            </a>
        </li>

        {{-- <li class="no-margin">
            <a class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-bars"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">llll</span>
            </a>
            <ul class="sidebar-child">
                <li>
                    <a href="{{ route('category.index') }}" class="no-margin @if(!$ltr) text-right @endif">
                        <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-bars"></i>
                        <span class="sidebar-text @if(!$ltr) text-right @endif">llllll</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/menu?menu=1" class="no-margin @if(!$ltr) text-right @endif">
                        <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-bars"></i>
                        <span class="sidebar-text @if(!$ltr) text-right @endif">llllllll</span>

                    </a>
                </li>
            </ul>
        </li> --}}


        <li class="no-margin">
            <a href="/admin/menu?menu=1" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-envelope"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.menu')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('seo.redirectUrl.index') }}" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-unlink"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.Redirect Url')</span>
            </a>
        </li>
        <li class="no-margin">
            <a href="{{ route('seo.websiteSetting.edit') }}" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-bar-chart"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.seo setting')</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="/admin/indexConfig" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-wrench"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.home config')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('users.index') }}" class="no-margin @if(!$ltr) text-right @endif">
                <i class="sidebar-icon @if(!$ltr) pull-right @endif fa fa-users"></i>
                <span class="sidebar-text @if(!$ltr) text-right @endif">@lang('messages.users')</span>
            </a>
        </li>

    </ul>

    <p class="copyright-container @if(!$ltr) text-right @endif pos-abs bottom-0 right-0 left-0 padding-full no-margin text-white">&copy; {{date('Y')}} CMS.</p>
</aside>
