<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    books: any;
    categories: any;
    filters: any;
}>();

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'الكتب', href: '/books' },
];
</script>

<template>
    <Head title="الكتب" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Page Header -->
        <div class="bg-emerald-800 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold mb-4 rtl-text">مكتبة الكتب</h1>
                    <p class="text-xl text-emerald-200 rtl-text">مجموعة من الكتب والمؤلفات الإسلامية</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Books Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div 
                    v-for="book in books.data" 
                    :key="book.id" 
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden"
                >
                    <!-- Book Cover Placeholder -->
                    <div class="h-48 bg-gradient-to-br from-emerald-600 to-emerald-800 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/80" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 715.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                        </svg>
                    </div>
                    
                    <!-- Book Content -->
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-3 rtl-text leading-tight">
                            <Link 
                                :href="`/books/${book.slug}`" 
                                class="hover:text-emerald-600 transition-colors duration-200"
                            >
                                {{ book.title_ar }}
                            </Link>
                        </h2>
                        
                        <!-- Book Meta Information -->
                        <div class="space-y-2 mb-4">
                            <div v-if="book.author_ar" class="flex items-center text-sm text-gray-600 dark:text-gray-400 rtl-content">
                                <svg class="w-4 h-4 ml-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ book.author_ar }}</span>
                            </div>
                            
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 rtl-content">
                                <svg class="w-4 h-4 ml-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 712 10V5a3 3 0 713-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ book.category?.name_ar || 'غير محدد' }}</span>
                            </div>
                            
                            <div v-if="book.publication_year" class="flex items-center text-sm text-gray-600 dark:text-gray-400 rtl-content">
                                <svg class="w-4 h-4 ml-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ book.publication_year }}</span>
                            </div>
                            
                            <div v-if="book.download_count > 0" class="flex items-center text-sm text-emerald-600 dark:text-emerald-400 rtl-content">
                                <svg class="w-4 h-4 ml-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ book.download_count.toLocaleString('ar-SA') }} تحميل</span>
                            </div>
                        </div>
                        
                        <!-- Book Description -->
                        <p v-if="book.excerpt_ar" class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3 rtl-content leading-relaxed">
                            {{ book.excerpt_ar }}
                        </p>
                        
                        <!-- Read More Button -->
                        <div class="flex justify-between items-center">
                            <Link 
                                :href="`/books/${book.slug}`" 
                                class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-md hover:bg-emerald-700 transition-colors duration-200 rtl-text"
                            >
                                اقرأ المزيد
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </Link>
                            
                            <div v-if="book.is_featured" class="flex items-center text-yellow-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Empty State -->
            <div v-if="!books.data || books.data.length === 0" class="text-center py-16">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 715.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2 rtl-text">لا توجد كتب</h3>
                <p class="text-gray-500 dark:text-gray-400 rtl-text">لم يتم العثور على أي كتب في الوقت الحالي.</p>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

