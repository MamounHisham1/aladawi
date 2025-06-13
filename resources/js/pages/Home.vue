<template>
    <AppLayout>
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-emerald-800 to-emerald-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        موقع الشيخ العدوي
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                        موقع علمي يهتم بنشر الفتاوى الشرعية والصوتيات والكتب الإسلامية
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <Link 
                            :href="route('fatwas.index')" 
                            class="bg-white text-emerald-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition"
                        >
                            تصفح الفتاوى
                        </Link>
                        <Link 
                            :href="route('audio.index')" 
                            class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-emerald-800 transition"
                        >
                            استمع للصوتيات
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest Fatwas Section -->
        <section class="py-16 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        أحدث الفتاوى
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        تصفح أحدث الفتاوى والأجوبة الشرعية
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div 
                        v-for="fatwa in latestFatwas" 
                        :key="fatwa.id"
                        class="bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6"
                    >
                        <div class="flex items-start justify-between mb-3">
                            <span class="bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 text-xs px-2 py-1 rounded-full">
                                {{ fatwa.category.name_ar }}
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ formatDate(fatwa.fatwa_date) }}
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 line-clamp-2">
                            {{ fatwa.title_ar }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                            {{ fatwa.excerpt_ar || fatwa.question_ar.substring(0, 150) + '...' }}
                        </p>
                        <Link 
                            :href="route('fatwas.show', fatwa.slug)"
                            class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 font-medium text-sm"
                        >
                            اقرأ المزيد ←
                        </Link>
                    </div>
                </div>
                
                <div class="text-center">
                    <Link 
                        :href="route('fatwas.index')" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 transition"
                    >
                        عرض جميع الفتاوى
                    </Link>
                </div>
            </div>
        </section>

        <!-- Featured Audio Lectures Section -->
        <section class="py-16 bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        الصوتيات المميزة
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        استمع إلى المحاضرات والدروس الصوتية المختارة
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div 
                        v-for="lecture in featuredAudioLectures" 
                        :key="lecture.id"
                        class="bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border-r-4 border-emerald-500"
                    >
                        <div class="flex items-start justify-between mb-3">
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs px-2 py-1 rounded-full">
                                {{ lecture.category.name_ar }}
                            </span>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.617.813L4.793 14H2a1 1 0 01-1-1V7a1 1 0 011-1h2.793l3.59-2.813a1 1 0 011.617.813z" clip-rule="evenodd" />
                                </svg>
                                {{ lecture.duration_minutes ? lecture.duration_minutes + ' دقيقة' : '' }}
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 line-clamp-2">
                            {{ lecture.title_ar }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">
                            {{ lecture.excerpt_ar || lecture.description_ar }}
                        </p>
                        <div class="flex items-center justify-between">
                            <Link 
                                :href="route('audio.show', lecture.slug)"
                                class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 font-medium text-sm"
                            >
                                استمع الآن ←
                            </Link>
                            <span v-if="lecture.audio_series" class="text-xs text-gray-500 dark:text-gray-400">
                                {{ lecture.audio_series.name_ar }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <Link 
                        :href="route('audio.index')" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition"
                    >
                        عرض جميع الصوتيات
                    </Link>
                </div>
            </div>
        </section>

        <!-- Featured Books Section -->
        <section class="py-16 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        الكتب المميزة
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        تحميل الكتب والمؤلفات الإسلامية المختارة
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div 
                        v-for="book in featuredBooks" 
                        :key="book.id"
                        class="bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6"
                    >
                        <div class="flex items-start justify-between mb-3">
                            <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-xs px-2 py-1 rounded-full">
                                {{ book.category.name_ar }}
                            </span>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                </svg>
                                {{ book.pages ? book.pages + ' صفحة' : '' }}
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                            {{ book.title_ar }}
                        </h3>
                        <p v-if="book.author_ar" class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                            المؤلف: {{ book.author_ar }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">
                            {{ book.excerpt_ar || book.description_ar }}
                        </p>
                        <div class="flex items-center justify-between">
                            <Link 
                                :href="route('books.show', book.slug)"
                                class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 font-medium text-sm"
                            >
                                عرض التفاصيل ←
                            </Link>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ book.download_count }} تحميل
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <Link 
                        :href="route('books.index')" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 transition"
                    >
                        عرض جميع الكتب
                    </Link>
                </div>
            </div>
        </section>

        <!-- Latest Articles Section -->
        <section class="py-16 bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        أحدث المقالات
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        اقرأ أحدث المقالات والبحوث الإسلامية
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div 
                        v-for="article in latestArticles" 
                        :key="article.id"
                        class="bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow p-6"
                    >
                        <div class="flex items-start justify-between mb-3">
                            <span class="bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 text-xs px-2 py-1 rounded-full">
                                {{ article.category.name_ar }}
                            </span>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ article.reading_time ? article.reading_time + ' دقيقة قراءة' : '' }}
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 line-clamp-2">
                            {{ article.title_ar }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                            {{ article.excerpt_ar }}
                        </p>
                        <div class="flex items-center justify-between">
                            <Link 
                                :href="route('articles.show', article.slug)"
                                class="text-orange-600 dark:text-orange-400 hover:text-orange-800 dark:hover:text-orange-300 font-medium text-sm"
                            >
                                اقرأ المقال ←
                            </Link>
                            <span v-if="article.published_at" class="text-xs text-gray-500 dark:text-gray-400">
                                {{ formatDate(article.published_at) }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <Link 
                        :href="route('articles.index')" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 transition"
                    >
                        عرض جميع المقالات
                    </Link>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup lang="ts">
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppLayout from '../layouts/AppLayout.vue'

interface Props {
    latestFatwas: Array<any>
    featuredAudioLectures: Array<any>
    featuredBooks: Array<any>
    latestArticles: Array<any>
}

defineProps<Props>()

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('ar-SA', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    })
}
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style> 