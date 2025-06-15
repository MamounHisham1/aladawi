<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    book: any;
}>();

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'الكتب', href: '/books' },
    { title: props.book.title_ar, href: `/books/${props.book.slug}` },
];
</script>

<template>
    <Head :title="book.title_ar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-1">
                        <div v-if="book.cover_image" class="mb-6">
                            <img :src="book.cover_image" :alt="book.title_ar" class="w-full rounded-lg shadow-lg">
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <h1 class="text-4xl font-bold mb-4">{{ book.title_ar }}</h1>
                        
                        <div class="mb-6 space-y-2">
                            <div v-if="book.author_name" class="text-gray-600 dark:text-gray-400">
                                <strong>المؤلف:</strong> {{ book.author_name }}
                            </div>
                            <div class="text-gray-600 dark:text-gray-400">
                                <strong>التصنيف:</strong> {{ book.category?.name_ar || 'غير محدد' }}
                            </div>
                            <div v-if="book.published_at" class="text-gray-600 dark:text-gray-400">
                                <strong>تاريخ النشر:</strong> {{ new Date(book.published_at).toLocaleDateString('ar-SA') }}
                            </div>
                        </div>
                        
                        <div v-if="book.description_ar" class="prose prose-lg max-w-none dark:prose-invert mb-8">
                            <div v-html="book.description_ar"></div>
                        </div>
                        
                        <div v-if="book.media && book.media.length > 0" class="space-y-4">
                            <h3 class="text-xl font-semibold">تحميل الكتاب</h3>
                            <div class="flex flex-wrap gap-3">
                                <Link 
                                    v-for="media in book.media" 
                                    :key="media.id"
                                    :href="`/books/${book.slug}/download/${media.id}`"
                                    class="bg-primary text-primary-foreground px-6 py-3 rounded-md hover:bg-primary/90 flex items-center gap-2"
                                >
                                    <span>تحميل ({{ media.mime_type.split('/')[1].toUpperCase() }})</span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

