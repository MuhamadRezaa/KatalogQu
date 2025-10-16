<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Riho .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...
                            </span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"> </div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"> <a href="index.html"><img class="img-fluid for-light"
                        src="{{ asset('assets/riho-asset/images/logo/logo_dark.png') }}" alt="logo-light"><img
                        class="img-fluid for-dark" src="{{ asset('assets/riho-asset/images/logo/logo.png') }}"
                        alt="logo-dark"></a>
            </div>
            <div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>
        <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
                <li class="onhover-dropdown">
                    <div class="mode"><i class="moon" data-feather="moon"> </i></div>
                </li>
                <li class="profile-nav onhover-dropdown">
                    <div class="media profile-media">
                        @if (Auth::user()->avatar != null)
                            <img class="b-r-10" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt=""
                                width="40px" height="40px">
                        @else
                            <img class="b-r-10" src="{{ asset('assets/images/defaultfoto.png') }}" alt=""
                                width="40px" height="40px">
                        @endif
                        <div class="media-body d-xxl-block d-none box-col-none">
                            <div class="d-flex align-items-center gap-2"> <span>{{ Auth::user()->name }} </span><i
                                    class="middle fa fa-angle-down"> </i></div>
                            <p class="mb-0 font-roboto">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="user-profile.html"><i data-feather="user"></i><span>My Profile</span></a>
                        </li>
                        <li><a href="letter-box.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                        <li> <a href="edit-profile.html"> <i data-feather="settings"></i><span>Settings</span></a>
                        </li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-pill btn-outline-primary btn-sm">
                                    Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>
