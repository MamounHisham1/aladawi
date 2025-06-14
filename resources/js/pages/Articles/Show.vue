<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Calendar, User, Clock, Tag } from 'lucide-vue-next';

interface Article {
    id: number;
    title_ar: string;
    title_en?: string;
    content_ar: string;
    content_en?: string;
    excerpt_ar?: string;
    slug: string;
    published_at: string;
    author_name?: string;
    reading_time?: number;
    is_featured: boolean;
    tags?: string[];
    category: {
        id: number;
        name_ar: string;
        name_en?: string;
    };
}

interface Props {
    article: Article;
    relatedArticles: Article[];
}

const props = defineProps<Props>();

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'المقالات', href: '/articles' },
    { title: props.article.title_ar, href: `/articles/${props.article.slug}` },
];

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('ar-SA', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};
</script>

<template>
    <Head :title="article.title_ar" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <!-- Article Header -->
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <Badge variant="outline">{{ article.category.name_ar }}</Badge>
                        <Badge v-if="article.is_featured" variant="secondary">مميز</Badge>
                    </div>
                    
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">
                        {{ article.title_ar }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 dark:text-gray-400 mb-6">
                        <div v-if="article.author_name" class="flex items-center gap-2">
                            <User class="h-4 w-4" />
                            <span>{{ article.author_name }}</span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <Calendar class="h-4 w-4" />
                            <span>{{ formatDate(article.published_at) }}</span>
                        </div>
                        
                        <div v-if="article.reading_time" class="flex items-center gap-2">
                            <Clock class="h-4 w-4" />
                            <span>{{ article.reading_time }} دقيقة قراءة</span>
                        </div>
                    </div>
                    
                    <p v-if="article.excerpt_ar" class="text-xl text-gray-600 dark:text-gray-400 leading-relaxed">
                        {{ article.excerpt_ar }}
                    </p>
                </div>

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none dark:prose-invert mb-8">
                    <div v-html="article.content_ar" class="leading-relaxed"></div>
                </div>

                <!-- Tags -->
                <div v-if="article.tags && article.tags.length > 0" class="mb-8">
                    <div class="flex items-center gap-2 mb-3">
                        <Tag class="h-4 w-4 text-gray-500" />
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">الكلمات المفتاحية:</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <Badge v-for="tag in article.tags" :key="tag" variant="outline" class="text-xs">
                            {{ tag }}
                        </Badge>
                    </div>
                </div>

                <!-- Related Articles -->
                <div v-if="relatedArticles.length > 0" class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">مقالات ذات صلة</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <Card v-for="relatedArticle in relatedArticles" :key="relatedArticle.id" class="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <Badge variant="outline" class="w-fit mb-2">
                                    {{ relatedArticle.category.name_ar }}
                                </Badge>
                                <CardTitle class="text-lg leading-tight">
                                    <Link :href="`/articles/${relatedArticle.slug}`" class="hover:text-primary">
                                        {{ relatedArticle.title_ar }}
                                    </Link>
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p v-if="relatedArticle.excerpt_ar" class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-3">
                                    {{ relatedArticle.excerpt_ar }}
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ formatDate(relatedArticle.published_at) }}</span>
                                    <span v-if="relatedArticle.reading_time">{{ relatedArticle.reading_time }} دقيقة</span>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <Link 
                        href="/articles" 
                        class="inline-flex items-center text-primary hover:text-primary/80 font-medium"
                    >
                        ← العودة إلى المقالات
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.prose {
    direction: rtl;
    text-align: right;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    font-family: inherit;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style> 