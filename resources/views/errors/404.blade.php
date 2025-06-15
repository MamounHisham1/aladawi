<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الصفحة غير موجودة - موقع الشيخ العدوي</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Noto Sans Arabic', sans-serif;
            direction: rtl;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto text-center px-6">
        <div class="mb-8">
            <h1 class="text-9xl font-bold text-gray-300">404</h1>
        </div>
        
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">الصفحة غير موجودة</h2>
            <p class="text-gray-600 leading-relaxed">
                عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها إلى مكان آخر.
            </p>
        </div>
        
        <div class="space-y-4">
            <a href="{{ route('home') }}" 
               class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200">
                العودة للصفحة الرئيسية
            </a>
            
            <div class="text-sm text-gray-500">
                أو يمكنك تصفح:
            </div>
            
            <div class="flex flex-wrap justify-center gap-4 text-sm">
                <a href="{{ route('fatwas.index') }}" class="text-amber-600 hover:text-amber-700 transition-colors">الفتاوى</a>
                <a href="{{ route('audio.index') }}" class="text-amber-600 hover:text-amber-700 transition-colors">الصوتيات</a>
                <a href="{{ route('books.index') }}" class="text-amber-600 hover:text-amber-700 transition-colors">الكتب</a>
                <a href="{{ route('articles.index') }}" class="text-amber-600 hover:text-amber-700 transition-colors">المقالات</a>
            </div>
        </div>
    </div>
</body>
</html> 