<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Convert Text - Dwi Arfian's Portfolio</title>
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
            max-width: 900px;
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

        textarea {
            width: 100%;
            min-height: 160px;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            color: #fff;
            font-size: 1rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            resize: vertical;
            transition: all 0.3s ease;
        }

        textarea:focus {
            outline: none;
            border-color: #6c63ff;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.15);
        }

        textarea::placeholder {
            color: rgba(255, 255, 255, 0.35);
        }

        textarea.result-area {
            background: rgba(108, 99, 255, 0.1);
            border-color: rgba(108, 99, 255, 0.3);
            min-height: 150px;
        }

        .case-options {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 12px;
            margin-bottom: 28px;
        }

        .case-option {
            position: relative;
        }

        .case-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .case-option .option-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px 14px;
            background: rgba(255, 255, 255, 0.06);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
            text-align: center;
            min-height: 80px;
        }

        .case-option input[type="radio"]:checked + .option-label {
            background: rgba(108, 99, 255, 0.2);
            border-color: #6c63ff;
            box-shadow: 0 0 20px rgba(108, 99, 255, 0.2);
        }

        .case-option input[type="radio"]:hover + .option-label {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .case-option .option-label .abbr {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .case-option .option-label .desc {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .case-option .option-label .preview {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.35);
            margin-top: 4px;
            font-style: italic;
        }

        .input-output {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .char-count {
            text-align: right;
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.8rem;
            margin-top: 6px;
        }

        .result-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .result-header h3 {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .copy-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 8px 16px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .copy-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .copy-btn.copied {
            background: rgba(46, 213, 115, 0.3);
            border-color: #2ed573;
            color: #2ed573;
        }

        .toast {
            position: fixed;
            top: 30px;
            right: 30px;
            background: #2ed573;
            color: #fff;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 10px 30px rgba(46, 213, 115, 0.3);
            transform: translateX(120%);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 1000;
        }

        .toast.show {
            transform: translateX(0);
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

        .swap-btn {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: rgba(108, 99, 255, 0.8);
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
        }

        .swap-btn:hover {
            background: #6c63ff;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .swap-btn svg {
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            width: 20px;
            height: 20px;
        }

        .input-wrapper {
            position: relative;
        }

        @media (max-width: 768px) {
            .input-output {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 24px 20px;
                border-radius: 16px;
            }

            .card-header h1 {
                font-size: 1.5rem;
            }

            .case-options {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .case-option .option-label {
                padding: 12px 10px;
                min-height: 70px;
            }

            .back-link {
                top: 16px;
                left: 16px;
                padding: 8px 14px;
                font-size: 0.8rem;
            }

            .swap-btn {
                position: relative;
                left: auto;
                top: auto;
                transform: none;
                margin: 8px auto;
            }

            .swap-btn:hover {
                transform: scale(1.1);
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
                <h1>Convert Text</h1>
                <p>Select a case type and watch your text transform in real-time</p>
            </div>

            <div class="form-group">
                <label>Choose case type</label>
                <div class="case-options">
                    <div class="case-option">
                        <input type="radio" name="case_type" value="sc" id="case_sc" checked>
                        <label class="option-label" for="case_sc">
                            <span class="abbr">Sc</span>
                            <span class="desc">Sentence Case</span>
                            <span class="preview">The quick brown fox</span>
                        </label>
                    </div>
                    <div class="case-option">
                        <input type="radio" name="case_type" value="lc" id="case_lc">
                        <label class="option-label" for="case_lc">
                            <span class="abbr">lc</span>
                            <span class="desc">lower case</span>
                            <span class="preview">the quick brown fox</span>
                        </label>
                    </div>
                    <div class="case-option">
                        <input type="radio" name="case_type" value="uc" id="case_uc">
                        <label class="option-label" for="case_uc">
                            <span class="abbr">UC</span>
                            <span class="desc">UPPER CASE</span>
                            <span class="preview">THE QUICK BROWN FOX</span>
                        </label>
                    </div>
                    <div class="case-option">
                        <input type="radio" name="case_type" value="cc" id="case_cc">
                        <label class="option-label" for="case_cc">
                            <span class="abbr">Cc</span>
                            <span class="desc">Capitalized Case</span>
                            <span class="preview">The Quick Brown Fox</span>
                        </label>
                    </div>
                    <div class="case-option">
                        <input type="radio" name="case_type" value="ac" id="case_ac">
                        <label class="option-label" for="case_ac">
                            <span class="abbr">aC</span>
                            <span class="desc">aLtErNaTiNg cAsE</span>
                            <span class="preview">tHe QuIcK bRoWn FoX</span>
                        </label>
                    </div>
                    <div class="case-option">
                        <input type="radio" name="case_type" value="tc" id="case_tc">
                        <label class="option-label" for="case_tc">
                            <span class="abbr">Tc</span>
                            <span class="desc">Title Case</span>
                            <span class="preview">The Quick Brown Fox</span>
                        </label>
                    </div>
                    <div class="case-option">
                        <input type="radio" name="case_type" value="ic" id="case_ic">
                        <label class="option-label" for="case_ic">
                            <span class="abbr">iC</span>
                            <span class="desc">InVeRsE CaSe</span>
                            <span class="preview">tHE qUICK bROWN fOX</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="input-output">
                <div>
                    <div class="result-header">
                        <h3>Input</h3>
                        <span class="char-count"><span id="inputCount">0</span> characters</span>
                    </div>
                    <textarea id="inputText" placeholder="Type or paste your text here..." oninput="convertText()"></textarea>
                </div>

                <div class="input-wrapper">
                    <button class="swap-btn" onclick="swapInputOutput()" title="Swap input and output">
                        <svg viewBox="0 0 24 24">
                            <path d="M7 16l-4-4 4-4"/>
                            <path d="M17 8l4 4-4 4"/>
                            <path d="M3 12h18"/>
                        </svg>
                    </button>

                    <div>
                        <div class="result-header">
                            <h3>Output</h3>
                            <button class="copy-btn" id="copyBtn" onclick="copyResult()">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                    <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"></path>
                                </svg>
                                Copy
                            </button>
                        </div>
                        <textarea id="outputText" class="result-area" readonly placeholder="Converted text will appear here..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        // ===================== CONVERSION FUNCTIONS =====================

        function toSentenceCase(text) {
            if (!text) return '';
            text = text.toLowerCase();
            return text.charAt(0).toUpperCase() + text.slice(1);
        }

        function toLowerCase(text) {
            return text.toLowerCase();
        }

        function toUpperCase(text) {
            return text.toUpperCase();
        }

        function toCapitalizedCase(text) {
            return text.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
        }

        function toAlternatingCase(text) {
            let result = '';
            let i = 0;
            for (let j = 0; j < text.length; j++) {
                const char = text[j];
                if (/[a-zA-Z]/.test(char)) {
                    result += i % 2 === 0 ? char.toLowerCase() : char.toUpperCase();
                    i++;
                } else {
                    result += char;
                }
            }
            return result;
        }

        function toTitleCase(text) {
            const smallWords = ['a', 'an', 'the', 'and', 'but', 'or', 'for', 'nor', 'on', 'at', 'to', 'by', 'with', 'in', 'of', 'is', 'as'];
            const words = text.toLowerCase().split(' ');
            return words.map((word, index) => {
                if (index === 0 || !smallWords.includes(word)) {
                    return word.charAt(0).toUpperCase() + word.slice(1);
                }
                return word;
            }).join(' ');
        }

        function toInverseCase(text) {
            let result = '';
            for (let i = 0; i < text.length; i++) {
                const char = text[i];
                if (char === char.toUpperCase()) {
                    result += char.toLowerCase();
                } else {
                    result += char.toUpperCase();
                }
            }
            return result;
        }

        function convertText() {
            const input = document.getElementById('inputText').value;
            const selectedCase = document.querySelector('input[name="case_type"]:checked');
            if (!selectedCase) return;

            let output;
            switch (selectedCase.value) {
                case 'sc': output = toSentenceCase(input); break;
                case 'lc': output = toLowerCase(input); break;
                case 'uc': output = toUpperCase(input); break;
                case 'cc': output = toCapitalizedCase(input); break;
                case 'ac': output = toAlternatingCase(input); break;
                case 'tc': output = toTitleCase(input); break;
                case 'ic': output = toInverseCase(input); break;
                default: output = input;
            }

            document.getElementById('outputText').value = output;
            document.getElementById('inputCount').textContent = input.length;
        }

        // ===================== EVENT LISTENERS =====================

        // Real-time conversion on radio change
        document.querySelectorAll('input[name="case_type"]').forEach(radio => {
            radio.addEventListener('change', convertText);
        });

        // ===================== SWAP INPUT/OUTPUT =====================

        function swapInputOutput() {
            const input = document.getElementById('inputText');
            const output = document.getElementById('outputText');
            const temp = input.value;
            input.value = output.value;
            output.value = '';
            convertText();
        }

        // ===================== COPY TO CLIPBOARD =====================

        function copyResult() {
            const text = document.getElementById('outputText').value;
            if (!text) return;

            navigator.clipboard.writeText(text).then(() => {
                const copyBtn = document.getElementById('copyBtn');
                copyBtn.innerHTML = `
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Copied!
                `;
                copyBtn.classList.add('copied');
                showToast('Copied to clipboard!');

                setTimeout(() => {
                    copyBtn.innerHTML = `
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"></path>
                        </svg>
                        Copy
                    `;
                    copyBtn.classList.remove('copied');
                }, 2000);
            }).catch(() => {
                showToast('Failed to copy text');
            });
        }

        // ===================== TOAST =====================

        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    </script>
</body>
</html>
