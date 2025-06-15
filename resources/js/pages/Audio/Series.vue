<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    series: any;
}>();

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'المحاضرات الصوتية', href: '/audio' },
    { title: 'السلاسل', href: '/audio/series' },
];
</script>

<template>
    <Head title="سلاسل المحاضرات الصوتية" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">سلاسل المحاضرات الصوتية</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="serie in series.data" :key="serie.id" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-3">{{ serie.title_ar }}</h2>
                    
                    <p v-if="serie.description_ar" class="text-gray-600 dark:text-gray-400 mb-4">
                        {{ serie.description_ar }}
                    </p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span>{{ serie.audio_lectures_count || 0 }} محاضرة</span>
                        <span v-if="serie.created_at">{{ new Date(serie.created_at).toLocaleDateString('ar-SA') }}</span>
                    </div>
                    
                    <Link :href="`/audio?series=${serie.id}`" class="bg-primary text-primary-foreground px-4 py-2 rounded-md text-sm hover:bg-primary/90">
                        عرض المحاضرات
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template> 