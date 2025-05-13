@props(['post'])

@php
    $seoScore = $post->getSeoScore();
    $suggestions = $post->getSeoSuggestions();
@endphp

<div class="seo-score-container">
    <div class="seo-score-header">
        <h3>Điểm SEO: {{ round($seoScore['percentage']) }}/100</h3>
        <div class="progress">
            <div class="progress-bar {{ $seoScore['percentage'] >= 80 ? 'bg-success' : ($seoScore['percentage'] >= 60 ? 'bg-warning' : 'bg-danger') }}" 
                 role="progressbar" 
                 style="width: {{ $seoScore['percentage'] }}%">
            </div>
        </div>
    </div>

    <div class="seo-details mt-3">
        <h4>Chi tiết:</h4>
        <ul class="list-group">
            @foreach($seoScore['details'] as $key => $detail)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ ucfirst($key) }}
                    <span class="badge {{ $detail['is_optimal'] ? 'bg-success' : 'bg-danger' }}">
                        {{ $detail['message'] }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>

    @if(count($suggestions) > 0)
        <div class="seo-suggestions mt-3">
            <h4>Gợi ý cải thiện:</h4>
            <ul class="list-group">
                @foreach($suggestions as $suggestion)
                    <li class="list-group-item text-danger">
                        <i class="fas fa-exclamation-circle"></i> {{ $suggestion }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<style>
.seo-score-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.seo-score-header {
    text-align: center;
    margin-bottom: 20px;
}

.progress {
    height: 20px;
    margin-top: 10px;
}

.seo-details, .seo-suggestions {
    margin-top: 20px;
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.badge {
    font-size: 0.9em;
    padding: 5px 10px;
}
</style> 