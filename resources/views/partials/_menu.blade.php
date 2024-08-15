<div class="sidebar__menu-group">
    <ul class="sidebar_nav">

        <li>
            <a href="{{ route('dashboard.demo_one',app()->getLocale()) }}" class="{{ Request::is('/dashboard') ? 'active':'' }}">
                <span class="nav-icon uil uil-create-dashboard"></span>
                <span class="menu-text">{{ trans('menu.dashboard-menu-title') }}</span>
            </a>
        </li>

        <li class="has-child {{ Request::is(app()->getLocale().'/event/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/event/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-folder"></span>
                <span class="menu-text">{{ trans('menu.event-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('event.event_list',app()->getLocale()) }}"
                       class="{{ Request::is(app()->getLocale().'/event/list') ? 'active':'' }}">{{ trans('menu.event-title') }}</a>
                </li>
                <li><a href="{{ route('event.event_detail',app()->getLocale()) }}"
                       class="{{ Request::is(app()->getLocale().'/event/event-detail') ? 'active':'' }}">{{ trans('menu.event-detail') }}</a>
                </li>
            </ul>
        </li>

        <li class="has-child {{ Request::is(app()->getLocale().'/user/*') ? 'open':'' }}">
            <a href="#" class="{{ Request::is(app()->getLocale().'/user/*') ? 'active':'' }}">
                <span class="nav-icon uil uil-users-alt"></span>
                <span class="menu-text">{{ trans('menu.user-menu-title') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('user.user_list',app()->getLocale()) }}"
                       class="{{ Request::is(app()->getLocale().'/user/list') ? 'active':'' }}">{{ trans('menu.user-list') }}</a>
                </li>
            </ul>
        </li>

    </ul>
</div>
