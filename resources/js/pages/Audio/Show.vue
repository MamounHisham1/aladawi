<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    audioLecture: any;
    relatedLectures: any[];
}>();

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'المحاضرات الصوتية', href: '/audio' },
    { title: props.audioLecture.title_ar, href: `/audio/${props.audioLecture.slug}` },
];
</script>

<template>
    <Head :title="audioLecture.title_ar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl font-bold mb-6">{{ audioLecture.title_ar }}</h1>
                
                <div class="mb-6 space-y-2">
                    <div class="text-gray-600 dark:text-gray-400">
                        <strong>التصنيف:</strong> {{ audioLecture.category?.name_ar || 'غير محدد' }}
                    </div>
                    <div v-if="audioLecture.audio_series" class="text-gray-600 dark:text-gray-400">
                        <strong>السلسلة:</strong> {{ audioLecture.audio_series.title_ar }}
                    </div>
                    <div v-if="audioLecture.duration" class="text-gray-600 dark:text-gray-400">
                        <strong>المدة:</strong> {{ Math.floor(audioLecture.duration / 60) }} دقيقة
                    </div>
                    <div v-if="audioLecture.published_at" class="text-gray-600 dark:text-gray-400">
                        <strong>تاريخ النشر:</strong> {{ new Date(audioLecture.published_at).toLocaleDateString('ar-SA') }}
                    </div>
                </div>
                
                <div v-if="audioLecture.description_ar" class="prose prose-lg max-w-none dark:prose-invert mb-8">
                    <div v-html="audioLecture.description_ar"></div>
                </div>
                
                <div v-if="audioLecture.audio_file" class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">استماع للمحاضرة</h3>
                    <audio controls class="w-full">
                        <source :src="audioLecture.audio_file" type="audio/mpeg">
                        متصفحك لا يدعم تشغيل الملفات الصوتية.
                    </audio>
                </div>
                
                <div v-if="relatedLectures.length > 0" class="mt-12">
                    <h2 class="text-2xl font-bold mb-6">محاضرات ذات صلة</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div v-for="related in relatedLectures" :key="related.id" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                            <h3 class="font-semibold mb-2">
                                <Link :href="`/audio/${related.slug}`" class="hover:text-primary">
                                    {{ related.title_ar }}
                                </Link>
                            </h3>
                            <p v-if="related.description_ar" class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                {{ related.description_ar }}
                            </p>
                            <div class="text-xs text-gray-500">
                                <span v-if="related.duration">{{ Math.floor(related.duration / 60) }} دقيقة</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

