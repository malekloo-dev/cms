<aside class="side-left  pos-abs @if ($ltr) left-0 @else right-0 @endif   disBlock padding-t-full">
    <ul class="sidebar no-margin no-padding" style="margin-bottom: 3em !important">

        <li class="no-margin">
            <a class="no-margin  @if (!$ltr) text-right @endif" href="/admin">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-home"></i>
                <span class="sidebar-text">@lang('messages.home')</span>
            </a>
        </li>
        <li class="divider"></li>




        <li class="no-margin">
            <a href="{{ route('contents.type.show', ['type' => 'article']) }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-folder-o"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.content')</span>
            </a>
        </li>
        <li class="no-margin">
            <a href="{{ route('contents.type.show', ['type' => 'product']) }}"
                class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-shopping-cart"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.products')</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="{{ route('category.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-bars"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.category')</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="{{ route('category.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-bars"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.attribute')</span>
            </a>
        </li>
        <li class="divider"></li>




        <li class="no-margin">
            <a href="{{ route('comment.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-comments"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.Comments')</span>
                @isset($commentCount)
                    <span class="budget ">{{ $commentCount ?? 0 }}</span>
                @endisset
            </a>

        </li>
        <li class="no-margin">
            <a href="{{ route('contact.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-envelope"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.contact')</span>
            </a>
        </li>

        {{-- <li class="no-margin">
            <a class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-bars"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">llll</span>
            </a>
            <ul class="sidebar-child">
                <li>
                    <a href="{{ route('category.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                        <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-bars"></i>
                        <span class="sidebar-text @if (!$ltr) text-right @endif">llllll</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/menu?menu=1" class="no-margin @if (!$ltr) text-right @endif">
                        <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-bars"></i>
                        <span class="sidebar-text @if (!$ltr) text-right @endif">llllllll</span>

                    </a>
                </li>
            </ul>
        </li> --}}


        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('seo.redirectUrl.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-unlink"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.Redirect Url')</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="/admin/menu?menu=1" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-envelope"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.menu')</span>
            </a>
        </li>
        <li class="no-margin">
            <a href="{{ route('seo.websiteSetting.edit') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-bar-chart"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.setting')</span>
            </a>
        </li>

        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('moduleBuilder.edit', ['fileName' => 'Home']) }}"
                class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-wrench"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.module config')</span>
            </a>
        </li>
        <li class="divider"></li>
        <li class="no-margin">
            <a href="{{ route('admin.company.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-user"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.companies')</span>
            </a>
        </li>

        <li class="no-margin">
            <a href="{{ route('users.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-users"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.users')</span>
            </a>
        </li>
        <li class="no-margin">
            <a href="{{ route('role.index') }}" class="no-margin @if (!$ltr) text-right @endif">
                <i class="sidebar-icon @if (!$ltr) pull-right @endif fa fa-address-card"></i>
                <span class="sidebar-text @if (!$ltr) text-right @endif">@lang('messages.role')</span>
            </a>
        </li>
        <li dir="ltr " class="">
            <p class="text-white" style="padding-left:1em">
                v1.0.0<br>
                &copy; {{ date('Y') }} CMS
            </p>
        </li>
    </ul>

</aside>
