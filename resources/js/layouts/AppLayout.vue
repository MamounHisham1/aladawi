<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'

const mobileMenuOpen = ref(false)
const isDarkMode = ref(false)

const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value
    localStorage.setItem('darkMode', isDarkMode.value.toString())
    
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
}

onMounted(() => {
    const savedDarkMode = localStorage.getItem('darkMode')
    if (savedDarkMode) {
        isDarkMode.value = savedDarkMode === 'true'
    } else {
        isDarkMode.value = window.matchMedia('(prefers-color-scheme: dark)').matches
    }
    
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark')
    }
})
</script>

<template>
    <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors" :dir="$page.props.locale === 'ar' ? 'rtl' : 'ltr'">
        <!-- Header -->
        <header class="bg-emerald-800 dark:bg-emerald-900 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <Link href="/" class="text-white text-xl font-bold">
                            الشيخ العدوي
                        </Link>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-8 rtl:space-x-reverse">
                        <Link 
                            :href="route('home')" 
                            class="text-white hover:text-emerald-200 px-3 py-2 rounded-md text-sm font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('home') }"
                        >
                            الرئيسية
                        </Link>
                        <Link 
                            :href="route('fatwas.index')" 
                            class="text-white hover:text-emerald-200 px-3 py-2 rounded-md text-sm font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('fatwas.*') }"
                        >
                            الفتاوى
                        </Link>
                        <Link 
                            :href="route('audio.index')" 
                            class="text-white hover:text-emerald-200 px-3 py-2 rounded-md text-sm font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('audio.*') }"
                        >
                            الصوتيات
                        </Link>
                        <Link 
                            :href="route('books.index')" 
                            class="text-white hover:text-emerald-200 px-3 py-2 rounded-md text-sm font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('books.*') }"
                        >
                            الكتب
                        </Link>
                        <Link 
                            :href="route('articles.index')" 
                            class="text-white hover:text-emerald-200 px-3 py-2 rounded-md text-sm font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('articles.*') }"
                        >
                            المقالات
                        </Link>
                        <Link 
                            :href="route('about')" 
                            class="text-white hover:text-emerald-200 px-3 py-2 rounded-md text-sm font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('about') }"
                        >
                            عن الشيخ
                        </Link>
                        <Link 
                            :href="route('contact.index')" 
                            class="text-white hover:text-emerald-200 px-3 py-2 rounded-md text-sm font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('contact.*') }"
                        >
                            اتصل بنا
                        </Link>
                    </nav>

                    <!-- Dark Mode Toggle -->
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        <button 
                            @click="toggleDarkMode"
                            class="text-white hover:text-emerald-200 p-2 rounded-md"
                        >
                            <svg v-if="!isDarkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg v-else class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707" />
                            </svg>
                        </button>

                        <!-- Mobile menu button -->
                        <button 
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="md:hidden text-white hover:text-emerald-200 p-2 rounded-md"
                        >
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div v-show="mobileMenuOpen" class="md:hidden pb-4">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <Link 
                            :href="route('home')" 
                            class="text-white hover:text-emerald-200 block px-3 py-2 rounded-md text-base font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('home') }"
                        >
                            الرئيسية
                        </Link>
                        <Link 
                            :href="route('fatwas.index')" 
                            class="text-white hover:text-emerald-200 block px-3 py-2 rounded-md text-base font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('fatwas.*') }"
                        >
                            الفتاوى
                        </Link>
                        <Link 
                            :href="route('audio.index')" 
                            class="text-white hover:text-emerald-200 block px-3 py-2 rounded-md text-base font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('audio.*') }"
                        >
                            الصوتيات
                        </Link>
                        <Link 
                            :href="route('books.index')" 
                            class="text-white hover:text-emerald-200 block px-3 py-2 rounded-md text-base font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('books.*') }"
                        >
                            الكتب
                        </Link>
                        <Link 
                            :href="route('articles.index')" 
                            class="text-white hover:text-emerald-200 block px-3 py-2 rounded-md text-base font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('articles.*') }"
                        >
                            المقالات
                        </Link>
                        <Link 
                            :href="route('about')" 
                            class="text-white hover:text-emerald-200 block px-3 py-2 rounded-md text-base font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('about') }"
                        >
                            عن الشيخ
                        </Link>
                        <Link 
                            :href="route('contact.index')" 
                            class="text-white hover:text-emerald-200 block px-3 py-2 rounded-md text-base font-medium transition-colors"
                            :class="{ 'bg-emerald-700': route().current('contact.*') }"
                        >
                            اتصل بنا
                        </Link>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 dark:bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">موقع الشيخ العدوي</h3>
                        <p class="text-gray-300">
                            موقع علمي يهتم بنشر الفتاوى والصوتيات والكتب الإسلامية
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">روابط سريعة</h3>
                        <ul class="space-y-2">
                            <li><Link :href="route('fatwas.index')" class="text-gray-300 hover:text-white">الفتاوى</Link></li>
                            <li><Link :href="route('audio.index')" class="text-gray-300 hover:text-white">الصوتيات</Link></li>
                            <li><Link :href="route('books.index')" class="text-gray-300 hover:text-white">الكتب</Link></li>
                            <li><Link :href="route('articles.index')" class="text-gray-300 hover:text-white">المقالات</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">تواصل معنا</h3>
                        <p class="text-gray-300 mb-2">
                            <Link :href="route('contact.index')" class="hover:text-white">إرسال رسالة</Link>
                        </p>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                    <p class="text-gray-300">
                        © {{ new Date().getFullYear() }} موقع الشيخ العدوي. جميع الحقوق محفوظة.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>
