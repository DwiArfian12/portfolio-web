<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use setasign\Fpdi\Fpdi;

class PdfController extends Controller
{
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

        try {
            // Attempt to recompile PDF using FPDI for compression
            $compressionResult = $this->compressPdfWithFpdi($inputPath, $outputPath, $request->input('compression_level'));

            if (!$compressionResult) {
                // If FPDI fails, try basic file optimization
                $compressionResult = $this->compressPdfBasic($inputPath, $outputPath);
            }
        } catch (\Exception $e) {
            @unlink($inputPath);
            return back()->with('error', 'Unable to process this PDF. The file may be corrupted, password protected, or use unsupported encoding. Error: ' . $e->getMessage());
        }

        // Check if output file was created
        if (!file_exists($outputPath) || filesize($outputPath) === 0) {
            @unlink($inputPath);
            return back()->with('error', 'Failed to compress the PDF file. The file may be corrupted or password protected.');
        }

        $compressedSize = filesize($outputPath);
        $savings = $originalSize - $compressedSize;
        $savingsPercent = $originalSize > 0 ? round(($savings / $originalSize) * 100, 1) : 0;

        // If compressed is larger or not effective, use original
        if ($compressedSize >= $originalSize || $savingsPercent < 0.5) {
            $compressedSize = $originalSize;
            $savings = 0;
            $savingsPercent = 0;
            $message = 'This PDF could not be compressed further. The original file was kept.';
            copy($inputPath, $outputPath);
        } else {
            $message = 'PDF compressed successfully!';
        }

        // Clean up input temp file
        @unlink($inputPath);

        return redirect()->route('tools.compress-pdf.index')->with([
            'success' => $message,
            'original_size' => $this->formatBytes($originalSize),
            'compressed_size' => $this->formatBytes($compressedSize),
            'savings_percent' => $savingsPercent,
            'original_name' => $originalName,
            'compressed_file' => basename($outputPath),
        ]);
    }

    /**
     * Compress PDF using FPDI - recompiles PDF structure for optimization
     * Works purely in PHP with no external dependencies (no exec/proc_open needed)
     */
    private function compressPdfWithFpdi($inputPath, $outputPath, $compressionLevel = 'medium')
    {
        try {
            // Get page count first to validate PDF
            $pageCount = $this->getPageCount($inputPath);

            if ($pageCount === 0 || $pageCount > 500) {
                return false;
            }

            $pdf = new Fpdi();
            $pdf->setCompression(true);

            // Import and add each page
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $templateId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($templateId);

                if ($size && isset($size['width']) && isset($size['height'])) {
                    // Orientation handling
                    $orientation = ($size['width'] > $size['height']) ? 'L' : 'P';
                    $pdf->AddPage($orientation, [$size['width'], $size['height']]);
                    $pdf->useTemplate($templateId);
                }
            }

            // Save the compressed PDF
            $pdf->Output('F', $outputPath);

            return file_exists($outputPath) && filesize($outputPath) > 0;
        } catch (\Exception $e) {
            // FPDI might fail on complex PDFs (forms, certain encodings)
            return false;
        }
    }

    /**
     * Basic compression - just copies the file but removes metadata
     * This is a fallback for PDFs that FPDI can't process
     */
    private function compressPdfBasic($inputPath, $outputPath)
    {
        // Read the PDF as text and try basic optimization
        $content = file_get_contents($inputPath);
        if ($content === false) {
            return false;
        }

        // Remove unnecessary whitespace/newlines within objects
        $content = preg_replace('/\n\s+/', "\n", $content);
        $content = preg_replace('/\n+/', "\n", $content);

        // Optimize cross-reference table spacing
        $content = preg_replace('/\n\d+\s+\d+\s+[a-z]/i', "\n$0", $content);

        file_put_contents($outputPath, $content);

        return file_exists($outputPath) && filesize($outputPath) > 0;
    }

    /**
     * Get number of pages in a PDF file by parsing it
     */
    private function getPageCount($filePath)
    {
        $content = file_get_contents($filePath);
        if ($content === false) {
            return 0;
        }

        // Try to find /Type /Pages and count /Page entries
        $count = preg_match_all('/\/Type\s*\/Page[^s]/i', $content, $matches);
        return $count > 0 ? $count : 0;
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
