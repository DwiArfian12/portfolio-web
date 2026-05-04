<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>Dwi Arfian's Portfolio</title>
    <meta name="keywords" content="" />
    <meta name="description" content="Dwi Arfian's Portfolio" />
    <meta name="author" content="Dwi Arfian" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/Logo Dwi Arfian.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/Logo Dwi Arfian.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prettyPhoto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <style>
        .toast-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 15px 25px;
            border-radius: 5px;
            color: #fff;
            font-weight: 500;
            display: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .toast-message.success { background: #28a745; }
        .toast-message.error { background: #dc3545; }
        .navbar .dropdown-menu {
            margin-top: 10px;
            border-radius: 8px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 8px;
        }
        .navbar .dropdown-item {
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .navbar .dropdown-item:hover {
            background: linear-gradient(135deg, #6c63ff, #4834d4);
            color: #fff;
        }
        .navbar .nav-link.dropdown-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top" class="politics_version">
    <div id="preloader">
        <div id="main-ld">
            <div id="loader"></div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <img class="img-fluid" src="{{ $profile && $profile->logo_image ? asset($profile->logo_image) : asset('images/tes.webp') }}" width="230px" alt="" />
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About Me</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Skills</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#blog">Projects</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact Me</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="toolsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tools</a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="toolsDropdown">
                            <a class="dropdown-item" href="{{ route('tools.convert-text.index') }}">Convert Text</a>
                            <a class="dropdown-item" href="{{ route('tools.compress-pdf.index') }}">Compress PDF</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="main-banner parallaxie" style="background: url('{{ $profile && $profile->hero_image ? asset($profile->hero_image) : asset('images/hero.webp') }}')">
        <div class="heading">
            <h1>{{ $profile->title ?? "Hello, I'm Dwi Arfian" }}</h1>
            <p>{!! $profile->subtitle ?? '"A college student majoring in Informatics Engineering Education <br>at <a href=\"https://www.uny.ac.id/\" style=\"color: #fff\">Yogyakarta State University.</a>"' !!}</p>
            <h3 class="cd-headline clip is-full-width">
                <span>I'm good at:&nbsp;</span>
                <span class="cd-words-wrapper">
                    <b class="is-visible">Web Development</b>
                    <b>Web Design</b>
                    <b>UI & Graphic Design</b>
                    <b>Video Editing</b>
                    <b>Office Work</b>
                    <b>Etc.</b>
                </span>
            </h3>
        </div>
    </section>

    <svg id="clouds" class="hidden-xs" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 85 100" preserveAspectRatio="none">
        <path d="M-5 100 Q 0 20 5 100 Z M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100 M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100 M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100 M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100 M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z"></path>
    </svg>

    <!-- About Section -->
    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="message-box pr-5">
                        <h2>About Me.</h2>
                        <p class="text-justify">
                            {!! $profile->about_text ?? 'I am a college student majoring in informatics engineering education at Yogyakarta State University. Have created several systems for companies, schools, university, and competitions. Having good leadership, time management and communication skills. Having fullstack website development skills.' !!}
                        </p>
                        <p class="text-justify">
                            Another summary of me is in my CV. You can download it by pressing the button below.
                        </p>
                        <a href="{{ $profile && $profile->cv_file ? asset('storage/'.$profile->cv_file) : asset('files/CV Dwi Arfian New Sept 2025.pdf') }}" class="sim-btn btn-hover-new" data-text="Press Me!" target="_blank">
                            <span>Download My CV</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-box-pro wow fadeIn">
                        <img src="{{ $profile && $profile->profile_image ? asset($profile->profile_image) : asset('images/me.webp') }}" alt="About Me" class="img-fluid img-rounded" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills Section -->
    <div id="services" class="section lb">
        <div class="container">
            <div class="section-title text-left">
                <h3>Skills</h3>
                <p>{{ $profile->skills_headline ?? 'Here are some skills I have.' }}</p>
            </div>
            <div class="row">
                @forelse($skills as $skill)
                <div class="col-md-4">
                    <div class="services-inner-box">
                        <div class="ser-icon"><i class="{{ $skill->icon_class }}"></i></div>
                        <h2>{{ $skill->title }}</h2>
                        <p class="text-justify">{{ $skill->description }}</p>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No skills added yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div id="portfolio" class="section wb">
        <div class="container">
            <div class="section-title text-left">
                <h3>Gallery</h3>
                <p>There are some photos of me.</p>
            </div>
            <div class="gallery-menu row">
                <div class="col-md-12">
                    <div class="button-group filter-button-group text-left">
                        <button class="active" data-filter="*">All</button>
                        <button data-filter=".gal_a">Certificates</button>
                        <button data-filter=".gal_b">Achievements</button>
                        <button data-filter=".gal_c">Awards</button>
                    </div>
                </div>
            </div>
            <div class="gallery-list row">
                @forelse($galleries as $gallery)
                <div class="col-md-4 col-sm-6 gallery-grid {{ $gallery->category }}">
                    <div class="gallery-single fix">
                        <img src="{{ asset('storage/'.$gallery->image_path) }}" class="img-fluid" alt="{{ $gallery->title ?? 'Gallery Image' }}" />
                        <div class="img-overlay">
                            <a href="{{ asset('storage/'.$gallery->image_path) }}" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius">
                                <i class="fa fa-picture-o"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No gallery images yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <div id="blog" class="section lb">
        <div class="container">
            <div class="section-title text-left">
                <h3>Projects</h3>
                <p>There are some of my projects, <a href="https://github.com/DwiArfian12"><u>visit my Github </u></a>to see the others.</p>
            </div>
            <div class="row">
                @forelse($projects as $project)
                <div class="col-md-4 col-sm-6 col-lg-4">
                    <div class="post-box">
                        <div class="post-thumb">
                            <img src="{{ asset('storage/'.$project->image_path) }}" class="img-fluid" alt="{{ $project->title }}" />
                            @if($project->year)
                            <div class="date"><span>{{ $project->year }}</span></div>
                            @endif
                        </div>
                        <div class="post-info">
                            <h4>{{ $project->title }}</h4>
                            <p>
                                {{ $project->description }}
                                @if($project->url)
                                <a href="{{ $project->url }}" target="_blank"><u>Click here to visit this website!</u></a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No projects added yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="section db">
        <div class="container">
            <div class="section-title text-left">
                <h3>Contact Me</h3>
                <p>Send me your message below.</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form id="contactForm" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Your Name" required data-validation-required-message="Please enter your name." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Your Email" required data-validation-required-message="Please enter your email address." />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" name="message" placeholder="Your Message" required data-validation-required-message="Please enter a message."></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <!-- Captcha -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="captcha" style="font-weight: 600; color: #666;">
                                            <span id="captchaQuestion">{{ $captcha['question'] ?? '' }}</span>
                                            <button type="button" id="refreshCaptcha" style="background: none; border: none; color: #6c63ff; cursor: pointer; font-size: 14px; margin-left: 8px;">
                                                <i class="fa fa-refresh"></i> Refresh
                                            </button>
                                        </label>
                                        <input class="form-control" id="captcha" name="captcha" placeholder="Your Answer" required />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button id="sendMessageButton" class="sim-btn btn-hover-new" data-text="Send Message" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-left">
                    <p class="footer-links">
                        @if($profile && $profile->instagram)<a href="{{ $profile->instagram }}">Instagram</a>@endif
                        @if($profile && $profile->facebook)<a href="{{ $profile->facebook }}">Facebook</a>@endif
                        @if($profile && $profile->twitter)<a href="{{ $profile->twitter }}">X</a>@endif
                        @if($profile && $profile->youtube)<a href="{{ $profile->youtube }}">YouTube</a>@endif
                        @if($profile && $profile->github)<a href="{{ $profile->github }}">Github</a>@endif
                    </p>
                    <p class="footer-company-name">All Rights Reserved. <a href="#">Dwi Arfian</a> &copy; 2026</p>
                </div>
            </div>
        </div>
    </div>

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- Toast message -->
    <div id="toastMessage" class="toast-message"></div>

    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/jquery.mobile.customized.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/parallaxie.js') }}"></script>
    <script src="{{ asset('js/headline.js') }}"></script>
    <script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/jquery.vide.js') }}"></script>
    <script>
        // Contact form submission via AJAX
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            const submitBtn = document.getElementById('sendMessageButton');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Sending...';

            fetch('{{ route("contact.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => {
                if (!response.ok && response.status === 422) {
                    return response.json().then(data => {
                        // Refresh captcha on error
                        if (data.refresh_captcha) {
                            refreshCaptchaQuestion();
                        }
                        showToast(data.message || 'Captcha verification failed.', 'error');
                    });
                }
                return response.json().then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        form.reset();
                        refreshCaptchaQuestion();
                    } else {
                        showToast('Failed to send message. Please try again.', 'error');
                    }
                });
            })
            .catch(error => {
                showToast('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Send Message';
            });
        });

        // Refresh captcha via AJAX
        function refreshCaptchaQuestion() {
            fetch('{{ route("captcha.refresh") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('captchaQuestion').textContent = data.question;
                document.getElementById('captcha').value = '';
            })
            .catch(error => {
                console.error('Failed to refresh captcha:', error);
            });
        }

        // Refresh captcha on button click
        document.getElementById('refreshCaptcha').addEventListener('click', function(e) {
            e.preventDefault();
            refreshCaptchaQuestion();
        });

        function showToast(message, type) {
            const toast = document.getElementById('toastMessage');
            toast.textContent = message;
            toast.className = 'toast-message ' + type;
            toast.style.display = 'block';
            setTimeout(() => {
                toast.style.display = 'none';
            }, 4000);
        }
    </script>
</body>
</html>
