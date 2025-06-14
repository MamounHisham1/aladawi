<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    audioLectures: any;
    audioSeries: any;
    categories: any;
    filters: any;
}>();

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'المحاضرات الصوتية', href: '/audio' },
];
</script>

<template>
    <Head title="المحاضرات الصوتية" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">المحاضرات الصوتية</h1>
            
            <div class="mb-8">
                <Link href="/audio/series" class="bg-primary text-primary-foreground px-6 py-3 rounded-md hover:bg-primary/90">
                    عرض السلاسل
                </Link>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="lecture in audioLectures.data" :key="lecture.id" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-3">
                        <Link :href="`/audio/${lecture.slug}`" class="hover:text-primary">
                            {{ lecture.title_ar }}
                        </Link>
                    </h2>
                    
                    <p v-if="lecture.description_ar" class="text-gray-600 dark:text-gray-400 mb-4">
                        {{ lecture.description_ar }}
                    </p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span>{{ lecture.category.name_ar }}</span>
                        <span v-if="lecture.duration">{{ Math.floor(lecture.duration / 60) }} دقيقة</span>
                    </div>
                    
                    <div v-if="lecture.audio_series" class="text-sm text-primary mb-4">
                        السلسلة: {{ lecture.audio_series.title_ar }}
                    </div>
                    
                    <Link :href="`/audio/${lecture.slug}`" class="bg-primary text-primary-foreground px-4 py-2 rounded-md text-sm hover:bg-primary/90">
                        استماع
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

