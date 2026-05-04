<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index()
    {
        return view('convert-text');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'case_type' => 'required|in:sc,lc,uc,cc,ac,tc,ic',
        ]);

        $text = $request->input('text');
        $caseType = $request->input('case_type');
        $converted = match ($caseType) {
            'sc' => $this->sentenceCase($text),
            'lc' => $this->lowerCase($text),
            'uc' => $this->upperCase($text),
            'cc' => $this->capitalizedCase($text),
            'ac' => $this->alternatingCase($text),
            'tc' => $this->titleCase($text),
            'ic' => $this->inverseCase($text),
            default => $text,
        };

        if ($request->wantsJson()) {
            return response()->json([
                'original' => $text,
                'converted' => $converted,
                'case_type' => $caseType,
            ]);
        }

        return redirect()->route('convert-text.index')->withInput()->with([
            'result' => $converted,
            'original' => $text,
            'case_type' => $caseType,
        ]);
    }

    private function sentenceCase($text)
    {
        $text = strtolower($text);
        return ucfirst($text);
    }

    private function lowerCase($text)
    {
        return strtolower($text);
    }

    private function upperCase($text)
    {
        return strtoupper($text);
    }

    private function capitalizedCase($text)
    {
        return ucwords(strtolower($text));
    }

    private function alternatingCase($text)
    {
        $result = '';
        $i = 0;
        for ($j = 0; $j < strlen($text); $j++) {
            $char = $text[$j];
            if (ctype_alpha($char)) {
                $result .= ($i % 2 === 0) ? strtolower($char) : strtoupper($char);
                $i++;
            } else {
                $result .= $char;
            }
        }
        return $result;
    }

    private function titleCase($text)
    {
        $smallWords = ['a', 'an', 'the', 'and', 'but', 'or', 'for', 'nor', 'on', 'at', 'to', 'by', 'with', 'in', 'of', 'is', 'as'];
        $words = explode(' ', strtolower($text));
        $result = [];

        foreach ($words as $index => $word) {
            if ($index === 0 || !in_array($word, $smallWords)) {
                $result[] = ucfirst($word);
            } else {
                $result[] = $word;
            }
        }

        return implode(' ', $result);
    }

    private function inverseCase($text)
    {
        $result = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (ctype_upper($char)) {
                $result .= strtolower($char);
            } elseif (ctype_lower($char)) {
                $result .= strtoupper($char);
            } else {
                $result .= $char;
            }
        }
        return $result;
    }
}
