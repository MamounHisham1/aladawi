<!DOCTYPE html>
<html lang="ar" dir="rtl" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="index, follow">
        <meta name="author" content="الشيخ العدوي">
        <meta name="language" content="Arabic">
        
        <!-- SEO Meta Tags -->
        <meta name="description" content="موقع الشيخ العدوي الرسمي - تصفح الفتاوى الشرعية، الصوتيات الإسلامية، الكتب والمقالات الدينية. مصدر موثوق للمعرفة الإسلامية والفتاوى الشرعية.">
        <meta name="keywords" content="الشيخ العدوي، فتاوى إسلامية، صوتيات إسلامية، كتب إسلامية، مقالات دينية، فقه إسلامي، أحكام شرعية، دروس دينية">
        
        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="{{ config('app.name') }}">
        <meta property="og:description" content="موقع الشيخ العدوي الرسمي - مصدر موثوق للفتاوى الشرعية والصوتيات الإسلامية">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:image" content="{{ config('app.url') }}/images/og-image.jpg">
        <meta property="og:locale" content="ar_SA">
        <meta property="og:site_name" content="موقع الشيخ العدوي">
        
        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ config('app.name') }}">
        <meta name="twitter:description" content="موقع الشيخ العدوي الرسمي - مصدر موثوق للفتاوى الشرعية والصوتيات الإسلامية">
        <meta name="twitter:image" content="{{ config('app.url') }}/images/twitter-card.jpg">
        
        <!-- Canonical URL -->
        <link rel="canonical" href="{{ config('app.url') }}">
        
        <!-- Structured Data -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "موقع الشيخ العدوي",
            "alternateName": "الشيخ العدوي",
            "url": "{{ config('app.url') }}",
            "description": "موقع الشيخ العدوي الرسمي - مصدر موثوق للفتاوى الشرعية والصوتيات الإسلامية",
            "inLanguage": "ar",
            "author": {
                "@type": "Person",
                "name": "الشيخ العدوي"
            },
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ config('app.url') }}/search?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
        </script>

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name') }}</title>

        <!-- Favicons and Icons -->
        <link rel="icon" href="/favicon.ico" sizes="32x32">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#059669">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#059669">

        <!-- Preconnect to external domains -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <!-- Arabic Font -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @routes
        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased rtl-content">
        @inertia
    </body>
</html>
