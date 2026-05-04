<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Compress PDF - Dwi Arfian's Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .card-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .card-header h1 svg {
            width: 36px;
            height: 36px;
            stroke: #6c63ff;
            fill: none;
            stroke-width: 2;
        }

        .card-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* File Upload */
        .file-upload {
            position: relative;
            width: 100%;
        }

        .file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .file-upload .upload-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 20px;
            background: rgba(255, 255, 255, 0.06);
            border: 2px dashed rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .file-upload input[type="file"]:hover + .upload-area {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .file-upload input[type="file"]:hover + .upload-area.dragover,
        .file-upload .upload-area.dragover {
            background: rgba(108, 99, 255, 0.15);
            border-color: #6c63ff;
        }

        .file-upload .upload-area svg {
            width: 48px;
            height: 48px;
            stroke: rgba(255, 255, 255, 0.4);
            fill: none;
            stroke-width: 1.5;
            margin-bottom: 12px;
        }

        .file-upload .upload-area .upload-text {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
        }

        .file-upload .upload-area .upload-text strong {
            color: #6c63ff;
        }

        .file-upload .upload-area .upload-hint {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.8rem;
            margin-top: 6px;
        }

        .file-info {
            display: none;
            margin-top: 16px;
            padding: 16px 20px;
            background: rgba(108, 99, 255, 0.1);
            border: 1px solid rgba(108, 99, 255, 0.3);
            border-radius: 12px;
            color: #fff;
        }

        .file-info.visible {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .file-info .file-details {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .file-info .file-details svg {
            width: 28px;
            height: 28px;
            stroke: #6c63ff;
            fill: none;
        }

        .file-info .file-details .file-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .file-info .file-details .file-size {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
        }

        .file-info .remove-file {
            background: rgba(255, 71, 87, 0.2);
            border: 1px solid rgba(255, 71, 87, 0.3);
            border-radius: 8px;
            padding: 6px 12px;
            color: #ff4757;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-info .remove-file:hover {
            background: rgba(255, 71, 87, 0.3);
        }

        /* Compression Levels */
        .compression-levels {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .compression-option {
            position: relative;
        }

        .compression-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .compression-option .option-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 14px;
            background: rgba(255, 255, 255, 0.06);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
            text-align: center;
        }

        .compression-option input[type="radio"]:checked + .option-label {
            background: rgba(108, 99, 255, 0.2);
            border-color: #6c63ff;
            box-shadow: 0 0 20px rgba(108, 99, 255, 0.2);
        }

        .compression-option input[type="radio"]:hover + .option-label {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .compression-option .option-label .level-icon {
            font-size: 1.5rem;
            margin-bottom: 6px;
        }

        .compression-option .option-label .level-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 2px;
        }

        .compression-option .option-label .level-desc {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Submit Button */
        .btn-compress {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, #6c63ff, #4834d4);
            border: none;
            border-radius: 14px;
            color: #fff;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-compress:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(108, 99, 255, 0.4);
        }

        .btn-compress:active {
            transform: translateY(0);
        }

        .btn-compress:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-compress svg {
            width: 20px;
            height: 20px;
        }

        /* Result Section */
        .result-section {
            margin-top: 28px;
            padding-top: 28px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: none;
        }

        .result-section.visible {
            display: block;
        }

        .result-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 20px;
            text-align: center;
        }

        .stat-card .stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
        }

        .stat-card .stat-label {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 4px;
        }

        .stat-card.savings .stat-value {
            color: #2ed573;
        }

        .btn-download {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, #2ed573, #26a65b);
            border: none;
            border-radius: 14px;
            color: #fff;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(46, 213, 115, 0.4);
            color: #fff;
            text-decoration: none;
        }

        .btn-download svg {
            width: 20px;
            height: 20px;
        }

        .error-message {
            margin-top: 16px;
            padding: 14px 20px;
            background: rgba(255, 71, 87, 0.15);
            border: 1px solid rgba(255, 71, 87, 0.3);
            border-radius: 12px;
            color: #ff4757;
            font-size: 0.9rem;
            display: none;
        }

        .error-message.visible {
            display: block;
        }

        .back-link {
            position: fixed;
            top: 30px;
            left: 30px;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(-4px);
        }

        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .spinner.visible {
            display: inline-block;
        }

        .btn-text.hidden {
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 600px) {
            .card {
                padding: 24px 20px;
                border-radius: 16px;
            }

            .card-header h1 {
                font-size: 1.5rem;
            }

            .compression-levels {
                grid-template-columns: 1fr;
            }

            .result-stats {
                grid-template-columns: 1fr;
            }

            .back-link {
                top: 16px;
                left: 16px;
                padding: 8px 14px;
                font-size: 0.8rem;
            }

            .file-upload .upload-area {
                padding: 32px 16px;
            }
        }
    </style>
</head>
<body>

    <a href="{{ route('home') }}" class="back-link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Back to Home
    </a>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="12" y1="18" x2="12" y2="12"/>
                        <line x1="9" y1="15" x2="15" y2="15"/>
                    </svg>
                    Compress PDF
                </h1>
                <p>Reduce PDF file size while keeping quality</p>
            </div>

            @if(session('error'))
            <div class="error-message visible">{{ session('error') }}</div>
            @endif

            <form id="compressForm" method="POST" action="{{ route('tools.compress-pdf.compress') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Upload PDF</label>
                    <div class="file-upload">
                        <input type="file" name="pdf" id="pdfInput" accept=".pdf" onchange="handleFileSelect(event)" />
                        <div class="upload-area" id="uploadArea">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                            <div class="upload-text">Drag & drop your PDF here or <strong>browse</strong></div>
                            <div class="upload-hint">Maximum file size: 50 MB</div>
                        </div>
                    </div>

                    <div class="file-info {{ session('original_size') ? 'visible' : '' }}" id="fileInfo">
                        <div class="file-details">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                            <div>
                                <div class="file-name" id="fileName">{{ session('original_name', 'No file selected') }}</div>
                                <div class="file-size" id="fileSize">{{ session('original_size', '') }}</div>
                            </div>
                        </div>
                        <button type="button" class="remove-file" onclick="removeFile()">Remove</button>
                    </div>
                    @error('pdf')
                    <div class="error-message visible">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Compression Level</label>
                    <div class="compression-levels">
                        <div class="compression-option">
                            <input type="radio" name="compression_level" value="low" id="level_low" {{ old('compression_level', 'medium') === 'low' ? 'checked' : '' }}>
                            <label class="option-label" for="level_low">
                                <div class="level-icon">📄</div>
                                <div class="level-name">Low</div>
                                <div class="level-desc">Maximum quality, minimal compression</div>
                            </label>
                        </div>
                        <div class="compression-option">
                            <input type="radio" name="compression_level" value="medium" id="level_medium" {{ old('compression_level', 'medium') === 'medium' ? 'checked' : '' }}>
                            <label class="option-label" for="level_medium">
                                <div class="level-icon">📃</div>
                                <div class="level-name">Medium</div>
                                <div class="level-desc">Good balance of quality & size</div>
                            </label>
                        </div>
                        <div class="compression-option">
                            <input type="radio" name="compression_level" value="high" id="level_high" {{ old('compression_level', 'medium') === 'high' ? 'checked' : '' }}>
                            <label class="option-label" for="level_high">
                                <div class="level-icon">🗜️</div>
                                <div class="level-name">High</div>
                                <div class="level-desc">Maximum compression, lower quality</div>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-compress" id="compressBtn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="4 14 10 14 10 20"/>
                        <polyline points="20 10 14 10 14 4"/>
                        <line x1="14" y1="10" x2="21" y2="3"/>
                        <line x1="3" y1="21" x2="10" y2="14"/>
                    </svg>
                    <span class="btn-text">Compress PDF</span>
                    <div class="spinner" id="spinner"></div>
                </button>
            </form>

            @if(session('success'))
            <div class="result-section visible" id="resultSection">
                <div class="result-stats">
                    <div class="stat-card">
                        <div class="stat-value">{{ session('original_size') }}</div>
                        <div class="stat-label">Original Size</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ session('compressed_size') }}</div>
                        <div class="stat-label">Compressed Size</div>
                    </div>
                    <div class="stat-card savings">
                        <div class="stat-value">{{ session('savings_percent') }}%</div>
                        <div class="stat-label">Saved</div>
                    </div>
                </div>

                <a href="{{ route('tools.compress-pdf.download', ['file' => session('compressed_file'), 'name' => session('original_name')]) }}" class="btn-download" id="downloadBtn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Download Compressed PDF
                </a>
            </div>
            @endif
        </div>
    </div>

    <script>
        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file type
            if (file.type !== 'application/pdf') {
                showError('Please select a valid PDF file.');
                return;
            }

            // Validate file size (50MB)
            if (file.size > 50 * 1024 * 1024) {
                showError('File size exceeds 50 MB limit.');
                return;
            }

            document.getElementById('fileName').textContent = file.name;
            document.getElementById('fileSize').textContent = formatBytes(file.size);
            document.getElementById('fileInfo').classList.add('visible');

            // Remove error
            document.querySelector('.error-message')?.classList.remove('visible');
        }

        function removeFile() {
            const input = document.getElementById('pdfInput');
            input.value = '';
            document.getElementById('fileInfo').classList.remove('visible');
        }

        function formatBytes(bytes) {
            if (bytes === 0) return '0 B';
            const units = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));
            return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + units[i];
        }

        function showError(message) {
            const errorDiv = document.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.classList.add('visible');
            }
            removeFile();
        }

        // Drag and drop support
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('pdfInput');

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, e => {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, e => {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
            });
        });

        uploadArea.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files;
                handleFileSelect({ target: { files: [files[0]] } });
            }
        });

        // Form loading state
        document.getElementById('compressForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('compressBtn');
            const btnText = btn.querySelector('.btn-text');
            const spinner = document.getElementById('spinner');

            btn.disabled = true;
            btnText.textContent = 'Compressing...';
            spinner.classList.add('visible');
        });

        // Auto-download when result appears
        @if(session('success'))
        setTimeout(() => {
            document.getElementById('resultSection').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 200);
        @endif
    </script>
</body>
</html>
