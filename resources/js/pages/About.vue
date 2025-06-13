<template>
    <AppLayout>
        <!-- Page Header -->
        <div class="bg-emerald-800 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold mb-4">عن الشيخ العدوي</h1>
                    <p class="text-xl text-emerald-200">نبذة عن حياة الشيخ ومسيرته العلمية</p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Biography Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-12">
                <div class="text-center mb-8">
                    <div class="w-32 h-32 mx-auto mb-6 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        الشيخ الدكتور / محمد العدوي
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        عالم وداعية إسلامي معاصر
                    </p>
                </div>

                <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">النشأة والتعليم</h3>
                    <p class="mb-6">
                        وُلد الشيخ العدوي ونشأ في بيئة علمية محافظة، حيث حفظ القرآن الكريم في سن مبكرة وتلقى تعليمه الأولي في الكتاتيب، 
                        ثم التحق بالأزهر الشريف حيث تخرج من كلية أصول الدين وحصل على الدكتوراه في العقيدة والفلسفة.
                    </p>

                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">المسيرة العلمية</h3>
                    <p class="mb-6">
                        عمل الشيخ العدوي أستاذاً في عدة جامعات إسلامية، وله إسهامات علمية كبيرة في مجال العقيدة والدعوة الإسلامية. 
                        كما شارك في العديد من المؤتمرات العلمية المحلية والدولية وألف العديد من الكتب والمؤلفات في مختلف العلوم الشرعية.
                    </p>

                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">الأنشطة الدعوية</h3>
                    <p class="mb-6">
                        يُعرف الشيخ العدوي بأسلوبه المتميز في الدعوة والتعليم، حيث يجمع بين العمق العلمي والوضوح في العرض. 
                        له برامج إذاعية وتلفزيونية متنوعة، ويشارك بانتظام في المحاضرات والندوات الدينية في مختلف البلدان العربية والإسلامية.
                    </p>
                </div>
            </div>

            <!-- Achievements Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 text-emerald-600 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                        </svg>
                        المؤلفات والكتب
                    </h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>• أصول العقيدة الإسلامية</li>
                        <li>• منهج الدعوة في القرآن والسنة</li>
                        <li>• شرح أسماء الله الحسنى</li>
                        <li>• فقه المعاملات المعاصرة</li>
                        <li>• الرد على الشبهات العصرية</li>
                    </ul>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 text-emerald-600 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        الجوائز والتكريمات
                    </h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li>• جائزة الملك فيصل للعلوم الإسلامية</li>
                        <li>• وسام التميز الأكاديمي</li>
                        <li>• شهادة تقدير من رابطة العالم الإسلامي</li>
                        <li>• درع الإنجاز في الدعوة الإسلامية</li>
                        <li>• عضوية المجامع الفقهية الدولية</li>
                    </ul>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-8 text-center">
                    المسيرة الزمنية
                </h3>
                <div class="space-y-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-24 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                            1970م
                        </div>
                        <div class="flex-grow text-gray-700 dark:text-gray-300">
                            <h4 class="font-semibold mb-1">بداية المسيرة التعليمية</h4>
                            <p>التحق بالأزهر الشريف لدراسة العلوم الشرعية</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-24 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                            1975م
                        </div>
                        <div class="flex-grow text-gray-700 dark:text-gray-300">
                            <h4 class="font-semibold mb-1">التخرج والماجستير</h4>
                            <p>حصل على درجة الماجستير في أصول الدين</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-24 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                            1980م
                        </div>
                        <div class="flex-grow text-gray-700 dark:text-gray-300">
                            <h4 class="font-semibold mb-1">الدكتوراه</h4>
                            <p>حصل على درجة الدكتوراه في العقيدة والفلسفة بتقدير ممتاز</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-24 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                            1985م
                        </div>
                        <div class="flex-grow text-gray-700 dark:text-gray-300">
                            <h4 class="font-semibold mb-1">بداية التدريس الجامعي</h4>
                            <p>انضم إلى هيئة التدريس بكلية أصول الدين</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-24 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                            1995م
                        </div>
                        <div class="flex-grow text-gray-700 dark:text-gray-300">
                            <h4 class="font-semibold mb-1">الأستاذية</h4>
                            <p>حصل على درجة الأستاذية وتولى رئاسة قسم العقيدة</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-24 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                            2000م
                        </div>
                        <div class="flex-grow text-gray-700 dark:text-gray-300">
                            <h4 class="font-semibold mb-1">الانطلاق الإعلامي</h4>
                            <p>بدأ المشاركة في البرامج الإذاعية والتلفزيونية</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-24 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                            2010م
                        </div>
                        <div class="flex-grow text-gray-700 dark:text-gray-300">
                            <h4 class="font-semibold mb-1">إطلاق الموقع الإلكتروني</h4>
                            <p>تدشين موقع al-adawi.net لنشر العلم والفتاوى</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-6 mt-12 text-center">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    تواصل مع الشيخ
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    يمكنكم التواصل مع الشيخ العدوي من خلال الطرق التالية:
                </p>
                <Link 
                    :href="route('contact.index')" 
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 transition"
                >
                    إرسال سؤال أو استفسار
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import AppLayout from '../layouts/AppLayout.vue'
</script> 