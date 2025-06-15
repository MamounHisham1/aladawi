<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'تواصل مع فريق الموقع', href: '/contact' },
];

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});

const submit = () => {
    form.post('/contact', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="تواصل مع فريق الموقع" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <!-- Page Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold mb-8 text-center rtl-text">تواصل مع فريق الموقع</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 rtl-text">
                        للتواصل مع مطوري الموقع لتحسينات أو الإبلاغ عن مشاكل تقنية
                    </p>
                </div>

                <!-- Important Notice -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6 mb-8">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mt-1 ml-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <div class="rtl-content">
                            <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-2 rtl-text">
                                تنويه مهم
                            </h3>
                            <p class="text-blue-700 dark:text-blue-300 leading-relaxed">
                                هذا النموذج مخصص للتواصل مع فريق تطوير الموقع وليس مع فضيلة الشيخ مصطفى العدوي مباشرة. 
                                يرجى استخدام هذا النموذج للإبلاغ عن مشاكل تقنية، اقتراح تحسينات، أو طلب إضافة محتوى جديد.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-semibold mb-6 rtl-text">أرسل رسالة للفريق التقني للفريق التقني</h2>
                        
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <Label for="name" class="rtl-text">الاسم *</Label>
                                <Input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    required
                                    :class="{ 'border-red-500': form.errors.name }"
                                    class="rtl-text"
                                />
                                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1 rtl-text">
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            
                            <div>
                                <Label for="email" class="rtl-text">البريد الإلكتروني *</Label>
                                <Input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    :class="{ 'border-red-500': form.errors.email }"
                                />
                                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1 rtl-text">
                                    {{ form.errors.email }}
                                </div>
                            </div>
                            
                            <div>
                                <Label for="phone" class="rtl-text">رقم الهاتف</Label>
                                <Input
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    :class="{ 'border-red-500': form.errors.phone }"
                                />
                                <div v-if="form.errors.phone" class="text-red-500 text-sm mt-1 rtl-text">
                                    {{ form.errors.phone }}
                                </div>
                            </div>
                            
                            <div>
                                <Label for="subject" class="rtl-text">نوع المشكلة أو الطلب *</Label>
                                <select
                                    id="subject"
                                    v-model="form.subject"
                                    required
                                    :class="{ 'border-red-500': form.errors.subject }"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 rtl-text"
                                >
                                    <option value="">اختر نوع المشكلة أو الطلب</option>
                                    <option value="bug">الإبلاغ عن مشكلة تقنية</option>
                                    <option value="enhancement">اقتراح تحسين</option>
                                    <option value="content">طلب إضافة محتوى</option>
                                    <option value="broken-link">رابط معطل</option>
                                    <option value="other">أخرى</option>
                                </select>
                                <div v-if="form.errors.subject" class="text-red-500 text-sm mt-1 rtl-text">
                                    {{ form.errors.subject }}
                                </div>
                            </div>
                            
                            <div>
                                <Label for="message" class="rtl-text">تفاصيل المشكلة أو الطلب *</Label>
                                <textarea
                                    id="message"
                                    v-model="form.message"
                                    rows="6"
                                    required
                                    :class="{ 'border-red-500': form.errors.message }"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 rtl-text"
                                    placeholder="يرجى وصف المشكلة أو الطلب بالتفصيل..."
                                />
                                <div v-if="form.errors.message" class="text-red-500 text-sm mt-1 rtl-text">
                                    {{ form.errors.message }}
                                </div>
                            </div>
                            
                            <Button 
                                type="submit" 
                                :disabled="form.processing"
                                class="w-full rtl-text"
                            >
                                {{ form.processing ? 'جاري الإرسال...' : 'إرسال للفريق التقني' }}
                            </Button>
                        </form>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
                            <h2 class="text-2xl font-semibold mb-6 rtl-text">معلومات الفريق التقني</h2>
                            
                            <div class="space-y-4 rtl-content">
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white mb-2 rtl-text">البريد الإلكتروني</h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        support@aladawi.com
                                    </p>
                                </div>
                                
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white mb-2 rtl-text">وقت الاستجابة</h3>
                                    <p class="text-gray-600 dark:text-gray-400 rtl-text">
                                        عادة خلال 24-48 ساعة
                                    </p>
                                </div>
                                
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white mb-2 rtl-text">أولوية الاستجابة</h3>
                                    <ul class="text-gray-600 dark:text-gray-400 space-y-1 rtl-text">
                                        <li>1. المشاكل التقنية العاجلة</li>
                                        <li>2. الروابط المعطلة</li>
                                        <li>3. طلبات التحسين</li>
                                        <li>4. طلبات المحتوى الجديد</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-emerald-800 dark:text-emerald-200 mb-3 rtl-text">
                                شكراً لمساعدتكم
                            </h3>
                            <p class="text-emerald-700 dark:text-emerald-300 rtl-text leading-relaxed">
                                نقدر تواصلكم معنا لتحسين الموقع. ملاحظاتكم واقتراحاتكم تساعدنا في تقديم خدمة أفضل لنشر علم الشيخ مصطفى العدوي.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

