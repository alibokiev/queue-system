<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-title">Главное меню</li>
            <li class="nav-item">
                <a class="nav-link" href="/monitor">
                    <i class="nav-icon icon-feed"></i>
                    Монитор
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/reception') }}">
                    <i class="nav-icon icon-share"></i>
                    Очередь
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/cabinet') }}">
                    <i class="nav-icon icon-briefcase"></i>
                    Кабинет
                </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/clients') }}"><i class="nav-icon icon-people"></i> Клиенты</a></li>

           <li class="nav-item"><a class="nav-link" href="{{ url('admin/services') }}"><i class="nav-icon icon-graduation"></i> Услуги</a></li>

            <li class="nav-title">Управление доступом</li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/categories') }}"><i class="nav-icon icon-crop"></i> Категории</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}


            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/admin-users') }}">
                    <i class="nav-icon icon-user"></i>
                    Пользователи
                </a>
            </li>


            {{--Do not delete me :) I'm also used for auto-generation menu items--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
