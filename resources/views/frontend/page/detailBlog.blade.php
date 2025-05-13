@extends('frontend.app')
@section('content')
    <div class="grid-container">
        <div class="singular-wrap">
            <div class="dt-flex dt-justify-between dt-items-center dt-ml-[91px] dt-mb-6">
                <ul class="dt-text-c808080 dt-text-base dt-leading-5 dt-p-0 dt-list-none">
                    <li class="dt-font-Inter dt-float-left"><a
                            class="dt-text-13px dt-leading-[140%] dt-uppercase dt-text-c565656" title="" href=""
                            data-content-name="article-breadcrumb" data-content-piece="article-breadcrumb-position_1"
                            data-content-target="/du-lich.htm" data-track-content="">{{ $blog->catalogue->name }}</a></li>
                </ul>
            </div>
            <article class="singular-container content-travel">

                <h1 class="title-page detail">{{ $blog->title }}</h1>
                <div class="author-wrap">

                    <div class="author-meta">
                        <div class="author-name">
                        </div><time class="author-time" datetime="">
                            {{ \Carbon\Carbon::parse($blog->posted_at)->format('d/m/Y H:i') }}</time>
                    </div>
                </div>


                <h2 class="singular-sapo">{{ $blog->short_description }}</h2>
                <div class="singular-content">

                    <div id="dta-100000-container" class="dta-unit"
                        style="border-bottom: 0px; width: 0px !important; opacity: 0;" data-partner="adbro"
                        data-filled="false"></div>
                    <p>{!! $blog->content !!}</p>

                    <figure class="image align-center" contenteditable="false"><img title=""
                            src="{{ asset('storage/' . $blog->image) }}" alt="" data-width="1024" data-height="537"
                            data-original="" data-photo-id="3458894" data-track-content=""
                            data-content-name="article-content-image" data-content-piece="article-content-image_3458894"
                            data-content-target="" data-src="" data-srcset="" data-ll-status="loaded"
                            class="entered loaded" srcset="">
                        <figcaption>
                            <p></p>
                        </figcaption>
                    </figure>
                </div>
            </article>

            <aside class="article-related">
                <div class="title-head">Tin liên quan</div>
                @foreach ($relatedBlogs as $item)
                    <article class="article-item" data-content-name="article-related"
                        data-content-piece="article-related-position_1" data-content-target="" data-track-content="">
                        <div class="article-thumb"><a href="{{ route('blog.detail', $item->slug) }}"><img alt=""
                                    data-src="" data-srcset="" height="90"
                                    src="{{ asset('storage/' . $item->image) }}" width="135" data-ll-status="loaded"
                                    class="entered loaded smart-ptt1-img" srcset=""></a>
                        </div>
                        <div class="article-content">
                            <h3 class="article-title"><a class="dt-text-black-mine smart-ptt1-p"
                                    href="{{ route('blog.detail', $item->slug) }}">{{ $item->title }}</a></h3>
                            <div class="article-excerpt"><a
                                    href="{{ route('blog.detail', $item->slug) }}">{{ $item->short_description }}</a> <span
                                    class="article-total-comment dt-text-xs dt-leading-[140%] dt-items-center dt-gap-1 dt-align-middle dt-font-normal dt-hidden hover:dt-text-c0f6c32 dt-ml-1"
                                    data-id="20241211082234872" data-type="1" data-limit-show="10" data-color=""
                                    data-redirect="#comment" data-loaded="loaded"></span></div>
                        </div>
                    </article>
                @endforeach
            </aside>

            {{-- Từ khóa --}}
            <ul class="tags-wrap mt-30">
                <li class="label"><b>Từ khoá:</b></li>
                @foreach ($blog->keywords as $item)
                    <li><a title="núi Thái Sơn" href="" data-content-name="article-tags"
                            data-content-piece="article-tags-position_1" data-content-target=""
                            data-track-content="">{{ $item->name }}</a>
                    </li>
                @endforeach

            </ul>

            {{-- Bình luận --}}
            <div id="comment" data-module="comment" data-objectid="20250509103306115">
                <div class="comment-wrap mt-30">
                    <div class="comment-head flex-jcb">
                        <div class="comment-title flex-jcc "><svg viewBox="0 0 53 45" fill="none"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="53" height="45">
                                <path
                                    d="M25 33a2.667 2.667 0 0 0 2.667 2.667h16L49 41V19.667A2.667 2.667 0 0 0 46.333 17H27.667A2.667 2.667 0 0 0 25 19.667V33Z"
                                    fill="#2361FF" fill-opacity="0.6"></path>
                                <path
                                    d="M35 25a3.333 3.333 0 0 1-3.333 3.333h-20L5 35V8.333A3.333 3.333 0 0 1 8.333 5h23.334A3.333 3.333 0 0 1 35 8.333V25Z"
                                    fill="#1A7900" opacity="0.5"></path>
                            </svg>Bình luận (1)</div>
                        <div class="comment-action flex-jcc"><button type="button" class="login">Đăng
                                nhập</button><button type="button" class="register">Đăng kí</button><span>để gửi bình
                                luận</span></div>
                    </div>
                    <div class="comment-box ">
                        <textarea readonly="" class="textarea " placeholder="Bạn nghĩ gì về tin này?"></textarea>
                        <div class="action">
                            <div class="note ">Ý kiến của bạn sẽ được xét duyệt trước khi đăng. Xin vui lòng gõ tiếng
                                Việt có dấu</div><button type="submit" class="submit flex-jcc"
                                aria-label="Gửi bình luận" name="btnSendComment" disabled="">Gửi bình luận<svg
                                    aria-hidden="true" width="18" height="18" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 22L19 16L13 10" stroke="#F8FAFC" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></button>
                        </div>
                    </div>
                    {{-- <div class="comment-container">
                        <div class="comment--button__select"><button class="comment--button__popular active">Quan tâm
                                nhất</button><button class="comment--button__new ">Mới nhất</button></div>
                        <ul class="comment-list ">
                            <li>
                                <div class="comment-item"><a class="comment-avatar"
                                        href="/doc-gia/binh-luan/8188488569769801018.htm">
                                        <div class="avatar">D</div>
                                    </a>
                                    <div class="comment-content">
                                        <div class="comment-top"><a class="comment-author"
                                                href="/doc-gia/binh-luan/8188488569769801018.htm">doxuantuan</a>
                                            <div class="comment-time">6h trước</div>
                                        </div>
                                        <div class="comment-text">Đi tắt nhưng chưa chắc đã đến sớm đâu.</div>
                                        <ul class="comment-bottom">
                                            <li><button type="button" class="like"><svg width="14" height="14"
                                                        viewBox="0 0 14 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4.879 14.453H2.943a1.29 1.29 0 0 1-1.29-1.29V8.644a1.29 1.29 0 0 1 1.29-1.29h1.936m0 7.098V7.355m0 7.098h7.279a1.292 1.292 0 0 0 1.29-1.097l.89-5.808a1.291 1.291 0 0 0-1.29-1.484H9.396V3.483A1.936 1.936 0 0 0 7.46 1.547L4.879 7.355"
                                                            stroke="#999" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>Thích</button>
                                                <div class="reaction-list"><button class="reaction-item"><i
                                                            class="icon icon-like"></i>
                                                        <div class="reaction-item-name">Thích</div>
                                                    </button><button class="reaction-item"><i class="icon icon-haha"></i>
                                                        <div class="reaction-item-name">Vui</div>
                                                    </button><button class="reaction-item"><i class="icon icon-sad"></i>
                                                        <div class="reaction-item-name">Buồn</div>
                                                    </button><button class="reaction-item"><i class="icon icon-wow"
                                                            id="7"></i>
                                                        <div class="reaction-item-name">Ngạc nhiên</div>
                                                    </button></div>
                                            </li>
                                            <li><button type="button" class="reply">Trả lời</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>

            <div data-module="listing-article-detail" data-excluded-article="20250509103306115" data-title="Du lịch"
                data-category-id="835" data-by-user="0" data-url-cate="/du-lich.htm">
                <div class="lazyload-wrapper ">
                    <div
                        class="dt-flex dt-flex-col dt-font-Inter dt-gap-6 dt-border-t dt-border-[#222222] dt-pt-4  dt-mt-6 ">
                        <a href=""
                            class="dt-font-bold dt-uppercase dt-text-base dt-leading-5 dt-text-[#25282B]">Đang được
                            quan tâm</a>
                        <div class="dt-flex dt-flex-col dt-gap-5 dt-gap-5">
                            @foreach ($highlightBlogs as $item)
                                <article data-track-content="true" data-content-name="article-recommend"
                                    data-content-piece="article-recommend-position_1" data-content-target=""
                                    class="dt-flex  dt-gap-4"><a href="{{ route('blog.detail', $item->slug) }}"
                                        class="dt-aspect-3/2 dt-w-[252px]"><img alt=""
                                            class="dt-w-full dt-h-full" src="{{ asset('storage/' . $item->image) }}"
                                            srcset="" width="252" height="168"></a>
                                    <div class="dt-flex-1 dt-flex dt-flex-col  dt-gap-2"><a
                                            href="{{ route('blog.detail', $item->slug) }}"
                                            class="dt-text-[#222222] dt-font-semibold hover:dt-text-[#222222] dt-text-xl dt-leading-[26px]">{{ $item->title }}</a><a
                                            href="{{ route('blog.detail', $item->slug) }}"
                                            class="dt-text-[#565656] dt-font-Roboto hover:dt-text-[#565656]  dt-text-sm dt-leading-[22px]">{{ $item->short_description }}<span
                                                class="article-total-comment dt-text-xs dt-leading-[140%] dt-items-center dt-gap-1 dt-align-middle dt-font-normal dt-hidden hover:dt-text-c0f6c32 dt-ml-1"
                                                data-id="20250508120008370" data-limit-show="10" data-color=""
                                                data-redirect="" data-type="1" data-loaded="loaded"></span></a></div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bài viết mới --}}
                    <div
                        class="dt-flex dt-flex-col dt-font-Inter dt-gap-6 dt-border-t dt-border-[#222222] dt-pt-4  dt-mt-6 ">
                        <a href="/tin-moi-nhat.htm"
                            class="dt-font-bold dt-uppercase dt-text-base dt-leading-5 dt-text-[#25282B]">Tin mới</a>
                        <div class="dt-flex dt-flex-col dt-gap-5 dt-gap-5">
                            @foreach ($newBlogs as $item)
                                <article data-track-content="true" data-content-name="article-newest"
                                    data-content-piece="article-newest-position_1" data-content-target=""
                                    class="dt-flex  dt-gap-4"><a href="{{ route('blog.detail', $item->slug) }}"
                                        class="dt-aspect-3/2 dt-w-[252px]"><img alt=""
                                            class="dt-w-full dt-h-full" src="{{ asset('storage/' . $item->image) }}"
                                            srcset="" width="252" height="168"></a>
                                    <div class="dt-flex-1 dt-flex dt-flex-col  dt-gap-2"><a
                                            href="{{ route('blog.detail', $item->slug) }}"
                                            class="dt-text-[#222222] dt-font-semibold hover:dt-text-[#222222] dt-text-xl dt-leading-[26px]">{{ $item->title }}</a><a
                                            href="{{ route('blog.detail', $item->slug) }}"
                                            class="dt-text-[#565656] dt-font-Roboto hover:dt-text-[#565656]  dt-text-sm dt-leading-[22px]">{{ $item->short_description }}<span
                                                class="article-total-comment dt-text-xs dt-leading-[140%] dt-items-center dt-gap-1 dt-align-middle dt-font-normal dt-hidden hover:dt-text-c0f6c32 dt-ml-1"
                                                data-id="20250509141403209" data-limit-show="10" data-color=""
                                                data-redirect="" data-type="1" data-loaded="loaded"></span></a></div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    <div class="dt-flex dt-items-center dt-justify-center"><a href="/tin-moi-nhat.htm"
                            class="dt-flex dt-gap-1 dt-items-center dt-justify-center dt-mt-9 dt-rounded-full dt-py-3  dt-font-semibold dt-font-inter dt-px-32 dt-bg-cf4f6fa dt-text-c222 hover:dt-text-c222 dt-text-15px dt-leading-[21px]">Đọc
                            thêm tin mới nhất<svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.125 14.5508L11.875 10.8008L8.125 7.05078" stroke="#A0A4A8"
                                    stroke-width="1.5625" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg></a></div>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <article class="article-lot line">
                <div class="article-head smart-ptt1-p">Đọc nhiều trong {{ $blog->catalogue->name }}</div>
                @foreach ($relatedBlogsHighLight as $item)
                    <article class="article-item" data-content-name="article-popular"
                        data-content-piece="article-popular-position_1"
                        data-content-target=""
                        data-track-content="">
                        <div class="article-thumb"><a
                                href="{{route('blog.detail', $item->slug)}}"><img
                                    alt=""
                                    data-src=""
                                    data-srcset=""
                                    height="200"
                                    src="{{asset('storage/' . $item->image)}}"
                                    width="300" data-ll-status="loaded" class="entered loaded smart-ptt1-img"
                                    srcset=""></a>
                        </div>
                        <h3 class="article-title"><a class="dt-text-black-mine smart-ptt1-h"
                                href="{{route('blog.detail', $item->slug)}}">{{$item->title}}</a> <button
                                class="article-total-comment dt-text-xs dt-leading-[140%] dt-items-center dt-gap-1 dt-align-middle dt-font-normal hover:dt-text-c0f6c32 dt-ml-1 dt-inline-flex"
                                onclick="location.href=`#comment`"
                                data-loaded="loaded">
                                <svg width="16" height="16" viewBox="0 0 17 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.00695 13.7922H6.3674C6.96813 13.7922 7.44872 13.7922 8.16961 14.513C8.64539 15.1474 9.42395 15.1474 9.89973 14.513C10.4188 13.648 11.0532 13.7922 11.774 13.7922C14.6576 13.7922 16.0993 12.3504 16.0993 9.46685V5.86242C16.0993 2.97888 14.6576 1.53711 11.774 1.53711H6.00695C3.12341 1.53711 1.68164 2.97888 1.68164 5.86242V9.46685C1.68164 13.0713 3.12341 13.7922 6.00695 13.7922Z"
                                        fill="#EAF9F1" stroke="#0F6C32" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M5.28613 5.86133H12.495" stroke="#0F6C32" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M5.28613 9.4668H9.61144" stroke="#0F6C32" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                <span class="comment-count dt-font-roboto dt-text-c0f6c32 dt-text-sm">37</span>
                            </button></h3>
                    </article>
                @endforeach

            </article>
        </div>
    </div>
@endsection
