
@php($adminPrefix = config('laraconsent.routes.admin.prefix'))
@php($userPrefix = config('laraconsent.routes.user.prefix'))
<li class="nav-main-item{{ request()->is([$adminPrefix.'*', $userPrefix."*"]) ? ' open' : '' }}">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
        <i class="nav-main-link-icon fa fa-check-square"></i>
        <span class="nav-main-link-name">Contracts</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a class="nav-main-link{{ request()->is($adminPrefix) ? ' active' : '' }}" href="{{route( $adminPrefix.".index")}}">
                <i class="nav-main-link-icon fa fa-table"></i>
                <span class="nav-main-link-name">Contract Templates</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link{{ request()->is($adminPrefix."/create") ? ' active' : '' }}" href="{{route( $adminPrefix.".create")}}">
                <i class="nav-main-link-icon fa fa-plus-circle"></i>
                <span class="nav-main-link-name">Add New Contract</span>
            </a>
        </li>

        <li class="nav-main-item">
            <a class="nav-main-link{{ request()->is($userPrefix) ? ' active' : '' }}" href="{{route( $userPrefix.".index")}}">
                <i class="nav-main-link-icon fa fa-file-signature"></i>
                <span class="nav-main-link-name">Signed Contracts</span>
            </a>
        </li>

        <li class="nav-main-item">
            <a class="nav-main-link{{ request()->is($userPrefix."/my-consents") ? ' active' : '' }}" href="{{route( $userPrefix.".show")}}">
                <i class="nav-main-link-icon fa fa-file-signature"></i>
                <span class="nav-main-link-name">My Contracts</span>
            </a>
        </li>
    </ul>
</li>
