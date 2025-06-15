<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Search, Calendar, User, Clock } from 'lucide-vue-next';

interface Article {
    id: number;
    title_ar: string;
    title_en?: string;
    excerpt_ar?: string;
    excerpt_en?: string;
    slug: string;
    published_at: string;
    author_name?: string;
    reading_time?: number;
    is_featured: boolean;
    category: {
        id: number;
        name_ar: string;
        name_en?: string;
    };
}

interface Category {
    id: number;
    name_ar: string;
    name_en?: string;
}

interface Props {
    articles: {
        data: Article[];
        links: any[];
        meta: any;
    };
    categories: Category[];
    filters: {
        search?: string;
        category?: string;
        sort?: string;
        order?: string;
    };
}

const props = defineProps<Props>();

const searchQuery = ref(props.filters.search || '');
const selectedCategory = ref(props.filters.category || '');
const sortBy = ref(props.filters.sort || 'published_at');
const sortOrder = ref(props.filters.order || 'desc');

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'المقالات', href: '/articles' },
];

const handleSearch = () => {
    router.get('/articles', {
        search: searchQuery.value,
        category: selectedCategory.value,
        sort: sortBy.value,
        order: sortOrder.value,
    }, {
        preserveState: true,
        replace: true,
    });
};

const handleFilter = () => {
    handleSearch();
};

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('ar-SA', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};
</script>

<template>
    <Head title="المقالات" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">المقالات</h1>
                <p class="text-gray-600 dark:text-gray-400">
                    اكتشف مجموعة متنوعة من المقالات والكتابات الإسلامية
                </p>
            </div>

            <!-- Search and Filters -->
            <div class="mb-8 space-y-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-1 relative">
                        <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" />
                        <Input
                            v-model="searchQuery"
                            placeholder="البحث في المقالات..."
                            class="pl-10"
                            @keyup.enter="handleSearch"
                        />
                    </div>

                    <!-- Category Filter -->
                    <select v-model="selectedCategory" @change="handleFilter">
                        <option value="">جميع التصنيفات</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id.toString()">
                            {{ category.name_ar }}
                        </option>
                    </select>

                    <!-- Sort -->
                    <select v-model="sortBy" @change="handleFilter">
                        <option value="published_at">تاريخ النشر</option>
                        <option value="title_ar">العنوان</option>
                        <option value="reading_time">وقت القراءة</option>
                    </select>

                    <Button @click="handleSearch" class="w-full md:w-auto">
                        بحث
                    </Button>
                </div>
            </div>

            <!-- Articles Grid -->
            <div v-if="articles.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <Card v-for="article in articles.data" :key="article.id" class="hover:shadow-lg transition-shadow">
                    <CardHeader>
                        <div class="flex items-start justify-between mb-2">
                            <Badge v-if="article.is_featured" variant="secondary" class="mb-2">
                                مميز
                            </Badge>
                            <Badge variant="outline">
                                {{ article.category?.name_ar || 'غير محدد' }}
                            </Badge>
                        </div>
                        <CardTitle class="text-lg leading-tight">
                            <Link :href="`/articles/${article.slug}`" class="hover:text-primary">
                                {{ article.title_ar }}
                            </Link>
                        </CardTitle>
                        <CardDescription v-if="article.excerpt_ar" class="line-clamp-3">
                            {{ article.excerpt_ar }}
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center gap-4">
                                <div v-if="article.author_name" class="flex items-center gap-1">
                                    <User class="h-4 w-4" />
                                    <span>{{ article.author_name }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <Calendar class="h-4 w-4" />
                                    <span>{{ formatDate(article.published_at) }}</span>
                                </div>
                            </div>
                            <div v-if="article.reading_time" class="flex items-center gap-1">
                                <Clock class="h-4 w-4" />
                                <span>{{ article.reading_time }} دقيقة</span>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>

            <!-- No Results -->
            <div v-else class="text-center py-12">
                <div class="text-gray-500 dark:text-gray-400">
                    <Search class="h-12 w-12 mx-auto mb-4 opacity-50" />
                    <h3 class="text-lg font-medium mb-2">لا توجد مقالات</h3>
                    <p>لم يتم العثور على مقالات تطابق معايير البحث الخاصة بك.</p>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="articles.links && articles.links.length > 3" class="flex justify-center">
                <nav class="flex items-center gap-2">
                    <Link
                        v-for="link in articles.links"
                        :key="link.label"
                        :href="link.url"
                        :class="[
                            'px-3 py-2 text-sm rounded-md',
                            link.active
                                ? 'bg-primary text-primary-foreground'
                                : 'bg-background border hover:bg-accent',
                            !link.url ? 'opacity-50 cursor-not-allowed' : ''
                        ]"
                    >
                        {{ link.label }}
                    </Link>
                </nav>
            </div>
        </div>
    </AppLayout>
</template> 