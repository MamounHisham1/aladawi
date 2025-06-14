<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const breadcrumbs = [
    { title: 'الرئيسية', href: '/' },
    { title: 'اتصل بنا', href: '/contact' },
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
    <Head title="اتصل بنا" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl font-bold mb-8 text-center">اتصل بنا</h1>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-semibold mb-6">أرسل رسالة</h2>
                        
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <Label for="name">الاسم *</Label>
                                <Input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    required
                                    :class="{ 'border-red-500': form.errors.name }"
                                />
                                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            
                            <div>
                                <Label for="email">البريد الإلكتروني *</Label>
                                <Input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    required
                                    :class="{ 'border-red-500': form.errors.email }"
                                />
                                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.email }}
                                </div>
                            </div>
                            
                            <div>
                                <Label for="phone">رقم الهاتف</Label>
                                <Input
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    :class="{ 'border-red-500': form.errors.phone }"
                                />
                                <div v-if="form.errors.phone" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.phone }}
                                </div>
                            </div>
                            
                            <div>
                                <Label for="subject">الموضوع *</Label>
                                <Input
                                    id="subject"
                                    v-model="form.subject"
                                    type="text"
                                    required
                                    :class="{ 'border-red-500': form.errors.subject }"
                                />
                                <div v-if="form.errors.subject" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.subject }}
                                </div>
                            </div>
                            
                            <div>
                                <Label for="message">الرسالة *</Label>
                                <textarea
                                    id="message"
                                    v-model="form.message"
                                    rows="6"
                                    required
                                    :class="{ 'border-red-500': form.errors.message }"
                                />
                                <div v-if="form.errors.message" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.message }}
                                </div>
                            </div>
                            
                            <Button 
                                type="submit" 
                                :disabled="form.processing"
                                class="w-full"
                            >
                                {{ form.processing ? 'جاري الإرسال...' : 'إرسال الرسالة' }}
                            </Button>
                        </form>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
                            <h2 class="text-2xl font-semibold mb-6">معلومات التواصل</h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">العنوان</h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        المملكة العربية السعودية
                                    </p>
                                </div>
                                
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">البريد الإلكتروني</h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        info@aladawi.com
                                    </p>
                                </div>
                                
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">الهاتف</h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        +966 XX XXX XXXX
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
                            <h2 class="text-2xl font-semibold mb-6">أوقات العمل</h2>
                            
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>السبت - الخميس</span>
                                    <span>8:00 ص - 5:00 م</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>الجمعة</span>
                                    <span>مغلق</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

