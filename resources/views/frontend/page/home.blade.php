@extends('frontend.app')
@section('content')
    <div class="grid highlight">
        <div class="article-wrap">
            <article class="article grid">
                @foreach ($highlightBlogs as $item)
                    <article class="article-item" data-content-name="category-highlights"
                        data-content-piece="category-highlights-position_1"
                        data-content-target="/du-lich/tu-y-chat-cay-500-nam-tuoi-khong-xin-phep-nha-hang-doi-mat-khoan-phat-nang-20250420064457019.htm"
                        data-track-content="">
                        <div class="article-thumb">
                            <a href="{{ route('blog.detail', $item->slug) }}"><img src="{{ asset('storage/' . $item->image) }}" height="344"
                                    src="/assets/img/Hình-ảnh-dịch-vụ-chặt-cây-xanh-AP.jpg" width="516" /></a>
                        </div>
                        <div class="article-content">
                            <h3 class="article-title">
                                <a class="dt-text-black-mine" href="{{ route('blog.detail', $item->slug) }}">{{ $item->title }}</a>
                            </h3>
                            <div class="article-excerpt">
                                <a href="{{ route('blog.detail', $item->slug) }}">{{ $item->short_description }}</a>
                                <span
                                    class="article-total-comment dt-text-xs dt-leading-[140%] dt-items-center dt-gap-1 dt-align-middle dt-font-normal dt-hidden hover:dt-text-c0f6c32 dt-ml-1"
                                    data-id="20250420064457019" data-type="1" data-limit-show="10" data-color=""
                                    data-redirect="/du-lich/tu-y-chat-cay-500-nam-tuoi-khong-xin-phep-nha-hang-doi-mat-khoan-phat-nang-20250420064457019.htm#comment"
                                    data-loaded="loaded"></span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </article>

            <article class="article column">
                @foreach ($latesBlogs as $item)
                    <article class="article-item" data-content-name="category-highlights"
                        data-content-piece="category-highlights-position_4"
                        data-content-target="/du-lich/ha-noi-nghi-van-khach-uong-sua-chua-phat-hien-chan-gian-chu-quan-noi-gi-20250421222141269.htm"
                        data-track-content="">
                        <div class="article-thumb">
                            <a href="{{ route('blog.detail', $item->slug) }}"><img
                                    alt="{{ $item->title }}"
                                    height="124" src="{{ asset('storage/' . $item->image) }}" width="186" /></a>
                        </div>
                        <h3 class="article-title">
                            <a class="dt-text-black-mine" href="{{ route('blog.detail', $item->slug) }}">{{ $item->title }}</a>
                            <span
                                class="article-total-comment dt-text-xs dt-leading-[140%] dt-items-center dt-gap-1 dt-align-middle dt-font-normal dt-hidden hover:dt-text-c0f6c32 dt-ml-1"
                                data-id="20250421222141269" data-type="1" data-limit-show="10" data-color=""
                                data-redirect="/du-lich/ha-noi-nghi-van-khach-uong-sua-chua-phat-hien-chan-gian-chu-quan-noi-gi-20250421222141269.htm#comment"
                                data-loaded="loaded"></span>
                        </h3>
                        <div class="article-excerpt-none">
                            <a href="{{ route('blog.detail', $item->slug) }}">{{ $item->short_description }}</a>
                            <span
                                class="article-total-comment dt-text-xs dt-leading-[140%] dt-items-center dt-gap-1 dt-align-middle dt-font-normal dt-hidden hover:dt-text-c0f6c32 dt-ml-1"
                                data-id="20250420064457019" data-type="1" data-limit-show="10" data-color=""
                                data-redirect="/du-lich/tu-y-chat-cay-500-nam-tuoi-khong-xin-phep-nha-hang-doi-mat-khoan-phat-nang-20250420064457019.htm#comment"
                                data-loaded="loaded"></span>
                        </div>
                    </article>
                @endforeach
            </article>

        </div>
    </div>

    <div class="grid list" id="bai-viet">
        <div class="main">
            <div class="article list">
                @foreach ($listBlogs as $item)
                    <article class="article-item" data-content-name="category-timeline_page_1"
                        data-content-piece="category-timeline_page_1-position_1" data-content-target="#"
                        data-track-content="">
                        <div class="article-thumb">
                            <a href="{{ route('blog.detail', $item->slug) }}"><img
                                    alt="{{ $item->title }}"
                                    src="{{ asset('storage/' . $item->image) }}" height="168" width="252" /></a>
                        </div>
                        <div class="article-content">
                            <h3 class="article-title">
                                <a class="dt-text-black-mine" href="{{ route('blog.detail', $item->slug) }}">{{ $item->title }}</a>
                            </h3>
                            <div class="article-excerpt">
                                <a href="{{ route('blog.detail', $item->slug) }}">{{ $item->short_description }}</a>
                                <span
                                    class="article-total-comment dt-text-xs dt-leading-[140%] dt-items-center dt-gap-1 dt-align-middle dt-font-normal dt-hidden hover:dt-text-c0f6c32 dt-ml-1"
                                    data-id="20250421090452936" data-type="1" data-limit-show="10" data-color=""
                                    data-redirect="/du-lich/gan-200-giang-vien-nganh-du-lich-tim-huong-di-moi-cho-du-lich-trai-nghiem-20250421090452936.htm#comment"
                                    data-loaded="loaded"></span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="lazyload-wrapper">
                <div class="lazyload dt-mt-6 dt-flex dt-flex-col dt-gap-6">
                    <div
                        class="dt-w-full dt-h-10 dt-flex dt-items-center dt-justify-center dt-gap-1 dt-text-sm dt-text-green-jewel dt-font-inter dt-font-semibold dt-bg-[#EAF9F1] dt-rounded-full">
                        Đọc thêm<svg class="dt-relative dt-top-px" aria-hidden="true" width="22" height="22"
                            viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 13L16 19L22 13" stroke="#1A7900" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="pagination-date">
                <div class="pagination">
                    @if ($listBlogs->hasPages())
                        {{-- Previous Page Link --}}
                        @if ($listBlogs->onFirstPage())
                            <span class="page-item disabled" title="Trang trước">❮</span>
                        @else
                            <a class="page-item" href="{{ $listBlogs->previousPageUrl() }}" rel="nofollow"
                                title="Trang trước">❮</a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($listBlogs->getUrlRange(1, $listBlogs->lastPage()) as $page => $url)
                            @if ($page == $listBlogs->currentPage())
                                <a class="page-item active" href="{{ $url }}"
                                    rel="nofollow">{{ $page }}</a>
                            @else
                                <a class="page-item" href="{{ $url }}" rel="nofollow">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($listBlogs->hasMorePages())
                            <a class="page-item next" href="{{ $listBlogs->nextPageUrl() }}" rel="nofollow"
                                title="Trang tiếp">❯</a>
                        @else
                            <span class="page-item next disabled" title="Trang tiếp">❯</span>
                        @endif
                    @endif
                </div>
                <div data-module="category-page-date-range" data-from="" data-to="">
                    <div class="lazyload-wrapper">
                        <div class="dt-relative">
                            <div class="dt-w-fit dt-flex dt-items-center dt-gap-3 dt-cursor-pointer">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.63566 22.125C3.11099 22.125 1.875 20.889 1.875 19.3643V9.24999H22.1356V19.3643C22.1356 20.889 20.8996 22.125 19.375 22.125H4.63566ZM24.0106 19.3643C24.0106 21.9245 21.9352 24 19.375 24H4.63566C2.07544 24 0 21.9245 0 19.3643V6.47944C0 3.91925 2.07544 1.84373 4.63566 1.84373H5.53125V0.9375C5.53125 0.419733 5.95098 1.90735e-06 6.46875 1.90735e-06C6.98652 1.90735e-06 7.40625 0.419733 7.40625 0.9375V1.84373H16.6044V0.9375C16.6044 0.419733 17.0241 1.90735e-06 17.5419 1.90735e-06C18.0597 1.90735e-06 18.4794 0.419733 18.4794 0.9375V1.84373H19.375C21.9352 1.84373 24.0106 3.91925 24.0106 6.47944V19.3643ZM22.1356 7.37499H1.875V6.47944C1.875 4.95475 3.111 3.71874 4.63566 3.71874H5.53125V5.54686C5.53125 6.06463 5.95098 6.48436 6.46875 6.48436C6.98652 6.48436 7.40625 6.06463 7.40625 5.54686V3.71874H16.6044V5.54686C16.6044 6.06463 17.0241 6.48436 17.5419 6.48436C18.0597 6.48436 18.4794 6.06463 18.4794 5.54686V3.71874H19.375C20.8996 3.71874 22.1356 4.95475 22.1356 6.47944V7.37499ZM4.60936 18.4688C4.60936 18.9865 5.02909 19.4063 5.54686 19.4063H7.39059C7.90836 19.4063 8.32809 18.9865 8.32809 18.4688C8.32809 17.951 7.90836 17.5312 7.39059 17.5312H5.54686C5.02909 17.5312 4.60936 17.951 4.60936 18.4688ZM10.1406 18.4688C10.1406 18.9865 10.5603 19.4063 11.0781 19.4063H12.9218C13.4396 19.4063 13.8593 18.9865 13.8593 18.4688C13.8593 17.951 13.4396 17.5312 12.9218 17.5312H11.0781C10.5603 17.5312 10.1406 17.951 10.1406 18.4688ZM15.6825 18.4688C15.6825 18.9865 16.1023 19.4063 16.62 19.4063H18.4638C18.9815 19.4063 19.4013 18.9865 19.4013 18.4688C19.4013 17.951 18.9815 17.5312 18.4638 17.5312H16.62C16.1023 17.5312 15.6825 17.951 15.6825 18.4688ZM4.60936 12.9375C4.60936 13.4553 5.02909 13.875 5.54686 13.875H7.39059C7.90836 13.875 8.32809 13.4553 8.32809 12.9375C8.32809 12.4197 7.90836 12 7.39059 12H5.54686C5.02909 12 4.60936 12.4197 4.60936 12.9375ZM10.1406 12.9375C10.1406 13.4553 10.5603 13.875 11.0781 13.875H12.9218C13.4396 13.875 13.8593 13.4553 13.8593 12.9375C13.8593 12.4197 13.4396 12 12.9218 12H11.0781C10.5603 12 10.1406 12.4197 10.1406 12.9375ZM15.6825 12.9375C15.6825 13.4553 16.1023 13.875 16.62 13.875H18.4638C18.9815 13.875 19.4013 13.4553 19.4013 12.9375C19.4013 12.4197 18.9815 12 18.4638 12H16.62C16.1023 12 15.6825 12.4197 15.6825 12.9375Z"
                                        fill="#0F6C32"></path>
                                </svg><span class="dt-font-roboto dt-text-c565656 dt-text-lg">Xem tin theo
                                    ngày</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid row">
        <div class="article-col" data-cate-id="837">
            <h2 class="title">
                <a href="#">Khám phá<svg class="next" width="24" height="25" viewBox="0 0 24 25"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.93 6.17188L15 12.2419L8.93 18.3119" stroke="#565656" stroke-width="1.5"
                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
            </h2>
            <article class="article-wrap">
                @if(isset($catalogueBlogs['Du lịch']))
                    @foreach ($catalogueBlogs['Du lịch'] as $item)
                        <article class="article-item" data-content-name="category-children"
                            data-content-piece="category-children-position_2_1"
                            data-content-target=""
                            data-track-content="">
                            <div class="article-thumb">
                                <a href="#"><img alt="{{ $item->title }}" src="{{ asset('storage/' . $item->image) }}"
                                        height="176" width="264" /></a>
                            </div>
                            <h3 class="article-title">
                                <a class="dt-text-black-mine" href="#">{{ $item->title }}</a>
                            </h3>
                            <div class="article-excerpt-mobile">
                                <a href="#">{{ $item->short_description }}</a>
                            </div>
                        </article>
                    @endforeach
                @endif
                <a class="read-more dt-mt-6 dt-h-[44px] dt-flex dt-items-center dt-justify-center dt-gap-1 dt-text-sm dt-text-green-jewel dt-font-inter dt-font-semibold dt-bg-[#EAF9F1] dt-rounded-full"
                    rel="nofollow" href="#">Đọc tất cả bài viết Khám phá
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.125 14.5234L11.875 10.7734L8.125 7.02344" stroke="#A0A4A8" stroke-width="1.5625"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
            </article>
        </div>

        <div class="article-col" data-cate-id="839">
            <h2 class="title">
                <a href="#">Món ngon - Điểm đẹp<svg class="next" width="24" height="25"
                        viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.93 6.17188L15 12.2419L8.93 18.3119" stroke="#565656" stroke-width="1.5"
                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
            </h2>
            <article class="article-wrap">
                @if(isset($catalogueBlogs['Thể thao']))
                    @foreach ($catalogueBlogs['Thể thao'] as $item)
                        <article class="article-item" data-content-name="category-children"
                            data-content-piece="category-children-position_3_1"
                            data-content-target="/du-lich/ha-noi-nghi-van-khach-uong-sua-chua-phat-hien-chan-gian-chu-quan-noi-gi-20250421222141269.htm"
                            data-track-content="">
                            <div class="article-thumb">
                                <a href="#"><img alt="{{ $item->title }}" src="{{ asset('storage/' . $item->image) }}"
                                        height="176" width="264" /></a>
                            </div>
                            <h3 class="article-title">
                                <a class="dt-text-black-mine" href="#">{{ $item->title }}</a>
                            </h3>
                            <div class="article-excerpt-mobile">
                                <a href="#">{{ $item->short_description }}</a>
                            </div>
                        </article>
                    @endforeach
                @endif
                <a class="read-more dt-mt-6 dt-h-[44px] dt-flex dt-items-center dt-justify-center dt-gap-1 dt-text-sm dt-text-green-jewel dt-font-inter dt-font-semibold dt-bg-[#EAF9F1] dt-rounded-full"
                    rel="nofollow" href="#">Đọc tất cả bài viết Món ngon - Điểm đẹp
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.125 14.5234L11.875 10.7734L8.125 7.02344" stroke="#A0A4A8" stroke-width="1.5625"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
            </article>
        </div>
        <div class="article-col" data-cate-id="841">
            <h2 class="title">
                <a href="#">Tour hay - Khuyến mại<svg class="next" width="24" height="25"
                        viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.93 6.17188L15 12.2419L8.93 18.3119" stroke="#565656" stroke-width="1.5"
                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
            </h2>
            <article class="article-wrap">
                @if(isset($catalogueBlogs['Pháp luật']))
                    @foreach ($catalogueBlogs['Pháp luật'] as $item)
                        <article class="article-item" data-content-name="category-children"
                            data-content-piece="category-children-position_4_1"
                            data-content-target="/du-lich/chay-ve-tau-thong-nhat-phuc-vu-dai-le-304-80000-ve-da-ban-het-sach-20250419104812234.htm"
                            data-track-content="">
                            <div class="article-thumb">
                                <a href="#"><img alt="{{ $item->title }}" src="{{ asset('storage/' . $item->image) }}"
                                        height="176" width="264" /></a>
                            </div>
                            <h3 class="article-title">
                                <a class="dt-text-black-mine" href="#">{{ $item->title }}</a>
                            </h3>
                            <div class="article-excerpt-mobile">
                                <a href="#">{{ $item->short_description }}</a>
                            </div>
                        </article>
                    @endforeach
                @endif
                <a class="read-more dt-mt-6 dt-h-[44px] dt-flex dt-items-center dt-justify-center dt-gap-1 dt-text-sm dt-text-green-jewel dt-font-inter dt-font-semibold dt-bg-[#EAF9F1] dt-rounded-full"
                    rel="nofollow" href="#">Đọc tất cả bài viết Tour hay - Khuyến mãi
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.125 14.5234L11.875 10.7734L8.125 7.02344" stroke="#A0A4A8" stroke-width="1.5625"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
            </article>
        </div>
        <div class="article-col" data-cate-id="842">
            <h2 class="title">
                <a href="#">Video - Ảnh<svg class="next" width="24" height="25" viewBox="0 0 24 25"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.93 6.17188L15 12.2419L8.93 18.3119" stroke="#565656" stroke-width="1.5"
                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
            </h2>
            <article class="article-wrap">
                @if(isset($catalogueBlogs['Đời sống']))
                    @foreach ($catalogueBlogs['Đời sống'] as $item)
                        <article class="article-item" data-content-name="category-children"
                            data-content-piece="category-children-position_5_1"
                            data-content-target="/du-lich/o-lai-thu-do-gioi-tre-chon-cam-trai-hoa-cung-thien-nhien-dip-quoc-khanh-20240902183057008.htm"
                            data-track-content="">
                            <div class="article-thumb">
                                <a href="#"><img alt="{{ $item->title }}" src="{{ asset('storage/' . $item->image) }}"
                                        height="176" width="264" /></a>
                            </div>
                            <h3 class="article-title">
                                <a class="dt-text-black-mine" href="#">{{ $item->title }}</a>
                            </h3>
                            <div class="article-excerpt-mobile">
                                <a href="#">{{ $item->short_description }}</a>
                            </div>
                        </article>
                    @endforeach
                @endif
                <a class="read-more dt-mt-6 dt-h-[44px] dt-flex dt-items-center dt-justify-center dt-gap-1 dt-text-sm dt-text-green-jewel dt-font-inter dt-font-semibold dt-bg-[#EAF9F1] dt-rounded-full"
                    rel="nofollow" href="#">Đọc tất cả bài viết Video - Ảnh
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.125 14.5234L11.875 10.7734L8.125 7.02344" stroke="#A0A4A8" stroke-width="1.5625"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
            </article>
        </div>
    </div>
@endsection
