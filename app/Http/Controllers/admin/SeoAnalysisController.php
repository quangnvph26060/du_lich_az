<?php
namespace App\Http\Controllers;

use App\RankmathSEOForLaravel\Rules\KeywordInTitleRule;
use App\RankmathSEOForLaravel\Services\SeoAnalyzer;
use Illuminate\Http\Request;

class SeoAnalysisController extends Controller
{
    public function analyze(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'focus_keyword' => 'required',
        ]);

        $rules = [
            new KeywordInTitleRule(),
            
        ];

        $analyzer = new SeoAnalyzer($rules);

        $result = $analyzer->analyze(
            $request->input('title'),
            $request->input('content'),
            $request->input('focus_keyword')
        );

        return response()->json($result);
    }
}
