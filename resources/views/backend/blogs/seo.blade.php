 <!-- SEO Card -->
 {{-- @dd($seoData) --}}
 <div class="card mb-3" id="seo-card">

     <div class="card-body">
         <div class="d-flex justify-content-between align-items-center mb-2">
             <h5 class="mb-0">Tối ưu hóa tìm kiếm</h5>
             {{-- <a href="#" id="edit-seo-btn">Edit SEO meta</a> --}}
         </div>
         <div id="seo-desc">
             <span>Setup meta title & description to make your site easy to discovered on search
                 engines such as
                 Google</span>
         </div>
         <div id="seo-form">
             <hr>
             <!-- Phần hiển thị điểm SEO -->
             <div class="mb-3">
                 <h5 class="mb-0">SEO cơ bản
                     @php
                         $score = $seoData['seoScoreValue'] ?? 0;
                     @endphp
                     <span
                         class="badge 
                                            {{ $score >= 80 ? 'bg-success' : ($score >= 70 ? 'bg-warning text-dark' : 'bg-danger') }} ms-2">
                         {{ $score >= 80 ? 'Tất cả điều tốt' : ($score >= 70 ? 'Cần cải thiện nhẹ' : 'Cần tối ưu') }}
                     </span>
                 </h5>

                 <ul class="list-unstyled mb-0 mt-2" id="seoAnalysis">
                     @if (isset($seoData['analysis']) && count($seoData['analysis']))
                         @foreach ($seoData['analysis'] as $item)
                             <li class="d-flex align-items-center mb-2">
                                 @php
                                     switch ($item['status']) {
                                         case 'success':
                                             $icon = 'fa-check-circle';
                                             $colorClass = 'text-success'; // xanh lá
                                             break;
                                         case 'warning':
                                             $icon = 'fa-exclamation-circle';
                                             $colorClass = 'text-warning'; // vàng
                                             break;
                                         case 'danger':
                                             $icon = 'fa-times-circle';
                                             $colorClass = 'text-danger'; // đỏ
                                             break;
                                         default:
                                             $icon = 'fa-info-circle';
                                             $colorClass = 'text-muted'; // xám
                                     }
                                 @endphp
                                 <i class="fa {{ $icon }} {{ $colorClass }} me-2 fs-5"></i>
                                 <span class="text-dark">{{ $item['message'] }}</span>
                             </li>
                         @endforeach
                     @endif
                 </ul>
             </div>
         </div>
     </div>
 </div>

 {{-- Hiển thị lỗi --}}
 <div class="card mb-3" id="seo-card-error">
     <div class="card-body">
         <div class="d-flex justify-content-between align-items-center mb-2">
             <h5 class="mb-0">Cẩn cải thiện</h5>

             {{-- <a href="#" id="edit-seo-btn-error">Edit SEO meta</a> --}}
         </div>
         <div id="seo-desc-error"></div>
         <div id="seo-form-error">
             <hr>
             <!-- Phần hiển thị lỗi SEO -->
             <div class="mb-3">
                 <h5 class="mb-0">Bổ sung</h5>
                 <ul class="list-unstyled mb-0 mt-2" id="seoSuggestions">
                     @if (isset($seoData['suggestions']) && count($seoData['suggestions']))
                         @foreach ($seoData['suggestions'] as $item)
                             <li class="d-flex align-items-center mb-2">
                                 @php
                                     switch ($item['status']) {
                                         case 'success':
                                             $icon = 'fa-check-circle';
                                             $colorClass = 'text-success'; // xanh lá
                                             break;
                                         case 'warning':
                                             $icon = 'fa-exclamation-circle';
                                             $colorClass = 'text-warning'; // vàng
                                             break;
                                         case 'danger':
                                             $icon = 'fa-times-circle';
                                             $colorClass = 'text-danger'; // đỏ
                                             break;
                                         default:
                                             $icon = 'fa-info-circle';
                                             $colorClass = 'text-muted'; // xám
                                     }
                                 @endphp
                                 <i class="fa {{ $icon }} {{ $colorClass }} me-2 fs-5"></i>
                                 <span class="text-dark">{{ $item['message'] }}</span>
                             </li>
                         @endforeach
                     @endif
                 </ul>
             </div>
         </div>
     </div>
 </div>
