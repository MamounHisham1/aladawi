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
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">الكتب</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="book in books.data" :key="book.id" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-3">
                        <Link :href="`/books/${book.slug}`" class="hover:text-primary">
                            {{ book.title_ar }}
                        </Link>
                    </h2>
                    <p v-if="book.description_ar" class="text-gray-600 dark:text-gray-400 mb-4">
                        {{ book.description_ar }}
                    </p>
                    <div class="text-sm text-gray-500">
                        <span>{{ book.category?.name_ar || 'غير محدد' }}</span>
                    </div>
                </div>
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