<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    fatwa: any;
    relatedFatwas: any[];
}>();

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'الفتاوى', href: '/fatwas' },
    { title: props.fatwa.question_ar, href: `/fatwas/${props.fatwa.slug}` },
];

const getYouTubeEmbedUrl = (url: string) => {
    if (!url) return '';
    
    // Extract video ID from various YouTube URL formats
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);
    
    if (match && match[2].length === 11) {
        return `https://www.youtube.com/embed/${match[2]}`;
    }
    
    return url;
};
</script>

<template>
    <Head :title="fatwa.question_ar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl font-bold mb-6">{{ fatwa.title_ar }}</h1>
                
                <div class="mb-6 text-gray-600 dark:text-gray-400">
                    <span>{{ fatwa.category?.name_ar || 'غير محدد' }}</span>>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-4">السؤال:</h2>
                    <div class="prose prose-lg max-w-none dark:prose-invert" v-html="fatwa.question_ar"></div>
                </div>
                
                <div class="bg-white dark:bg-gray-900 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-4">الجواب:</h2>
                    <div class="prose prose-lg max-w-none dark:prose-invert" v-html="fatwa.answer_ar"></div>
                </div>
                
                <!-- YouTube Video Section -->
                <div v-if="fatwa.youtube_link" class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-4 flex items-center">
                        <svg class="w-6 h-6 text-red-600 ml-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                        فيديو الفتوى
                    </h2>
                    <div class="aspect-video">
                        <iframe 
                            :src="getYouTubeEmbedUrl(fatwa.youtube_link)"
                            class="w-full h-full rounded-lg"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                    </div>
                    <div class="mt-4">
                        <a 
                            :href="fatwa.youtube_link" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="inline-flex items-center text-red-600 hover:text-red-800 font-medium"
                        >
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            مشاهدة على اليوتيوب
                        </a>
                    </div>
                </div>
                
                <div v-if="relatedFatwas.length > 0" class="mt-12">
                    <h2 class="text-2xl font-bold mb-6">فتاوى ذات صلة</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div v-for="related in relatedFatwas" :key="related.id" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                            <h3 class="font-semibold mb-2">
                                <Link :href="`/fatwas/${related.slug}`" class="hover:text-primary">
                                    {{ related.question_ar }}
                                </Link>
                            </h3>
                            <div class="text-sm text-gray-500">
                                {{ related.category?.name_ar || 'غير محدد' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

