<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PdfController extends Controller
{
    private $gsPath = 'C:\\Program Files\\gs\\gs10.03.1\\bin\\gswin64c.exe';

    public function index()
    {
        return view('compress-pdf');
    }

    public function compress(Request $request)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:51200',
            'compression_level' => 'required|in:low,medium,high',
        ]);

        $file = $request->file('pdf');
        $originalSize = $file->getSize();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // Create temp directories with unique names
        $inputPath = storage_path('app/temp/pdf_input_' . Str::random(10) . '.pdf');
        $outputPath = storage_path('app/temp/pdf_output_' . Str::random(10) . '.pdf');

        // Ensure temp directory exists
        if (!is_dir(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        // Move uploaded file to temp
        $file->move(storage_path('app/temp'), basename($inputPath));

        // Map compression level to Ghostscript settings
        $gsSettings = match ($request->input('compression_level')) {
            'high' => [
                'preset' => '/screen',
                'resolution' => 72,
            ],
            'medium' => [
                'preset' => '/ebook',
                'resolution' => 150,
            ],
            'low' => [
                'preset' => '/printer',
                'resolution' => 300,
            ],
        };

        // Build Ghostscript command
        $cmd = sprintf(
            '"%s" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=%s -dColorImageResolution=%d -dGrayImageResolution=%d -dMonoImageResolution=%d -dNOPAUSE -dQUIET -dBATCH -sOutputFile="%s" "%s"',
            $this->gsPath,
            $gsSettings['preset'],
            $gsSettings['resolution'],
            $gsSettings['resolution'],
            $gsSettings['resolution'],
            $outputPath,
            $inputPath
        );

        // Execute Ghostscript
        $output = [];
        $returnVar = 0;
        exec($cmd, $output, $returnVar);

        // Check if output file was created
        if (!file_exists($outputPath) || filesize($outputPath) === 0) {
            // Clean up temp files
            @unlink($inputPath);
            return back()->with('error', 'Failed to compress the PDF file. The file may be corrupted or password protected.');
        }

        $compressedSize = filesize($outputPath);
        $savings = $originalSize - $compressedSize;
        $savingsPercent = $originalSize > 0 ? round(($savings / $originalSize) * 100, 1) : 0;

        // If compressed is larger, use original
        if ($compressedSize >= $originalSize) {
            $compressedSize = $originalSize;
            $savings = 0;
            $savingsPercent = 0;
            $message = 'The PDF could not be compressed further. The original file was kept.';
            copy($inputPath, $outputPath);
        } else {
            $message = 'PDF compressed successfully!';
        }

        // Store info in session for the download
        session()->flash('compressed_file', basename($outputPath));
        session()->flash('original_size', $this->formatBytes($originalSize));
        session()->flash('compressed_size', $this->formatBytes($compressedSize));
        session()->flash('savings_percent', $savingsPercent);
        session()->flash('original_name', $originalName);
        session()->flash('message', $message);

        // Clean up input temp file
        @unlink($inputPath);

        return redirect()->route('tools.compress-pdf.index')->with([
            'success' => $message,
            'original_size' => $this->formatBytes($originalSize),
            'compressed_size' => $this->formatBytes($compressedSize),
            'savings_percent' => $savingsPercent,
            'original_name' => $originalName,
        ]);
    }

    public function download(Request $request)
    {
        $file = basename($request->query('file', ''));
        $originalName = $request->query('name', 'compressed');
        $path = storage_path('app/temp/' . $file);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        return response()->download($path, $originalName . '_compressed.pdf')->deleteFileAfterSend(true);
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
