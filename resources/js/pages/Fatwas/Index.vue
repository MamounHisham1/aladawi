<template>
    <AppLayout>
        <!-- Page Header -->
        <div class="bg-emerald-800 text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold">الفتاوى الشرعية</h1>
                <p class="mt-2 text-emerald-200">تصفح الفتاوى والأجوبة الشرعية المختلفة</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Search and Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
                <form @submit.prevent="search" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search Input -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                البحث في الفتاوى
                            </label>
                            <input
                                v-model="form.search"
                                type="text"
                                placeholder="ابحث في عنوان الفتوى أو النص..."
                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            />
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                التصنيف
                            </label>
                            <select
                                v-model="form.category"
                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            >
                                <option value="">جميع التصنيفات</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name_ar }}
                                </option>
                            </select>
                        </div>

                        <!-- Sort Options -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                ترتيب حسب
                            </label>
                            <select
                                v-model="form.sort"
                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            >
                                <option value="created_at">الأحدث</option>
                                <option value="fatwa_date">تاريخ الفتوى</option>
                                <option value="title_ar">العنوان</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <button
                            type="submit"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-md transition"
                        >
                            بحث
                        </button>
                        <button
                            type="button"
                            @click="clearFilters"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200"
                        >
                            مسح الفلاتر
                        </button>
                    </div>
                </form>
            </div>

            <!-- Results -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div 
                    v-for="fatwa in fatwas.data" 
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
                    <div class="flex items-center justify-between">
                        <Link 
                            :href="route('fatwas.show', fatwa.slug)"
                            class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 font-medium text-sm"
                        >
                            اقرأ الفتوى ←
                        </Link>
                        <span v-if="fatwa.questioner_name" class="text-xs text-gray-500 dark:text-gray-400">
                            السائل: {{ fatwa.questioner_name }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav v-if="fatwas.links.length > 3" class="flex justify-center">
                <div class="flex space-x-1 rtl:space-x-reverse">
                    <Link
                        v-for="link in fatwas.links"
                        :key="link.label"
                        :href="link.url"
                        :class="[
                            'px-3 py-2 text-sm rounded-md',
                            link.active
                                ? 'bg-emerald-600 text-white'
                                : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600'
                        ]"
                        v-html="link.label"
                    />
                </div>
            </nav>

            <!-- No Results -->
            <div v-if="fatwas.data.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">لا توجد نتائج</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    لم يتم العثور على فتاوى تطابق معايير البحث الخاصة بك.
                </p>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import AppLayout from '../../layouts/AppLayout.vue'

interface Props {
    fatwas: {
        data: Array<any>
        links: Array<any>
    }
    categories: Array<any>
    filters: {
        search?: string
        category?: string
        sort?: string
        order?: string
    }
}

const props = defineProps<Props>()

const form = reactive({
    search: props.filters.search || '',
    category: props.filters.category || '',
    sort: props.filters.sort || 'created_at',
    order: props.filters.order || 'desc'
})

const search = () => {
    router.get(route('fatwas.index'), form, {
        preserveState: true,
        preserveScroll: true
    })
}

const clearFilters = () => {
    form.search = ''
    form.category = ''
    form.sort = 'created_at'
    form.order = 'desc'
    search()
}

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