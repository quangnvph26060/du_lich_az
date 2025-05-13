<div class="header-top flex-jcb have-users-onboarding dt-relative">
    <div class="dt-flex dt-gap-7 dt-items-center">
        <h1 class="header-logo flex-jcc">
            <a aria-label="Báo điện tử Dân trí - Tin tức cập nhật liên tục 24/7" href="{{route('home')}}"><img
                    alt="Báo điện tử Dân trí - Tin tức cập nhật liên tục 24/7" class="dt-h-11.5" height="46"
                    src="https://cdnweb.dantri.com.vn/dist/static-logo-v2.1-0-1.9bf6dbdd64e0736085bc.png"
                    width="118" /></a>
        </h1>
    </div>
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Tìm kiếm..." />
        <button onclick="handleSearch()">
            <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                    stroke="#4D4D4D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M21 20.9999L16.65 16.6499" stroke="#4D4D4D" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>
    <div class="header-area flex-jcb">
        <div class="auth-placeholder" data-module="authen-header">
            <button type="button" class="header-account flex-jcc" aria-label="Đăng nhập" name="login">
                <i class="fa-solid fa-user"></i>Đăng nhập
            </button>
        </div>
    </div>
</div>