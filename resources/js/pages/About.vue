<template>
    <AppLayout>
        <!-- Page Header -->
        <div class="bg-emerald-800 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold mb-4 rtl-text">عن الشخص</h1>
                    <p class="text-xl text-emerald-200 rtl-text">ترجمة فضيلة الشيخ أبى عبد الله مصطفى بن العدوي</p>
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
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 rtl-text">
                        فضيلة الشيخ أبى عبد الله مصطفى بن العدوي
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 rtl-text">
                        عالم وداعية إسلامي معاصر
                    </p>
                </div>

                <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300 leading-relaxed rtl-content">
                    <div class="space-y-6">
                        <p class="text-lg leading-relaxed">
                            ولد فى قرية "منية سمنود" التابعة لمحافظة الدقهلية عام 1954م، ودرس فى كلية الهندسة قسم الميكانيكا فى عام 1977م.
                        </p>

                        <p class="text-lg leading-relaxed">
                            حفظ كتاب الله عز وجل، رحل إلى الشيخ مقبل بن هادي الوادعي رحمه الله تعالى في اليمن، وحضر دروسه من عام 1400هـ إلى عام 1404هـ تقريباً، وحصل علماً كثيراً مع الشيخ مقبل رحمه الله رحمة واسعة.
                        </p>

                        <p class="text-lg leading-relaxed">
                            رجع إلى مصر، وأنشأ مسجداً صغيراً وبدأ فيه التدريس، بدأ دروسه فى البخارى ومسلم وفى التفسير والفقه، رحل إليه عدد كبير من الطلبة من داخل مصر وخارجها، وبدأ فى إنشاء مسجد كبير ومكتبة كبيرة، بعد ازدياد عدد الطلاب.
                        </p>

                        <p class="text-lg leading-relaxed">
                            له عدد من الدروس الأسبوعية في مختلف محافظات مصر.
                        </p>

                        <p class="text-lg leading-relaxed">
                            كتب فى عدة اتجاهات منها (فقه - حديث - مصطلح حديث - التفسير).
                        </p>
                    </div>
                </div>
            </div>

            <!-- Major Works Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-12">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 rtl-text">مشاريع التفسير</h3>
                <div class="space-y-4 rtl-content">
                    <p class="text-lg leading-relaxed">
                        له مشروع كبير في التفسير على صورة سؤال وجواب واسم هذا المشروع: <strong>(التسهيل لتأويل التنزيل)</strong> وقد صدر منه حوالى أربعة عشر مجلدا منها (الفاتحة - البقرة - آل عمران – النساء – المائدة - يوسف - النور – القصص – الحجرات – جزء قد سمع - جزء تبارك - جزء عم ).
                    </p>
                    
                    <p class="text-lg leading-relaxed">
                        ولهذا العمل مختصر فى ثلاث مجلدات صدر منه جزء يحتوى تفسير جزء عم واسمه <strong>(تفسير الربانيين لعموم المؤمنيين)</strong>.
                    </p>
                    
                    <p class="text-lg leading-relaxed">
                        ثم لهذا التفسير المختصر اختصارا آخر اسمه <strong>(تسهيل التسهيل)</strong> وهو تفسير للقرآن فى جزء واحد.
                    </p>
                    
                    <p class="text-lg leading-relaxed">
                        ثم مشروع آخر رابع يحتوى معانى المفردات مع الثوابت من تفسيرات الرسول صلى الله عليه وسلم لبعض الآيات مع أسباب النـزول.
                    </p>
                </div>
            </div>

            <!-- Fiqh Works Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-12">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 rtl-text">مؤلفات الفقه</h3>
                <div class="space-y-4 rtl-content">
                    <p class="text-lg leading-relaxed">
                        وأما بالنسبة للفقه فله كتاب <strong>"الجامع لأحكام النساء"</strong> فى خمس مجلدات أربعة مجلدات للشرح والخامس أسئلة تطبيقية على الأربع مجلدات فى المسائل المحتواة، وله كتاب آخر فى الفقه بصفة عامة وهو كتاب اسمه <strong>(الجامع العام فى الفقه والأحكام)</strong>.
                    </p>
                </div>
            </div>

            <!-- Other Works Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-12">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 rtl-text">المؤلفات الأخرى</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 rtl-text">الكتب الكبيرة:</h4>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300 rtl-content">
                            <li>• الصحيح المسند من أحاديث الفتن والملاحم وأشراط الساعة</li>
                            <li>• الصحيح المسند من أذكار اليوم والليلة</li>
                            <li>• الصحيح المسند من فضائل الصحابة</li>
                            <li>• الصحيح المسند من الأحاديث القدسية</li>
                            <li>• فقه التعامل مع الوالدين</li>
                            <li>• فقه التعامل بين الزوجين</li>
                            <li>• فقه تربية الأبناء</li>
                            <li>• فقه الأخلاق والمعاملات مع المؤمنين</li>
                            <li>• أسئلة وأجوبة فى علم مصطلح الحديث مع شرح علل الحديث</li>
                            <li>• مفاتيح الفقه فى الدين</li>
                            <li>• شفاء القلوب</li>
                            <li>• فقه الدعاء</li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 rtl-text">المختصرات الصغيرة:</h4>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300 rtl-content">
                            <li>• القبس المختار من صحيح الأذكار</li>
                            <li>• روضة المحبين من فضائل صحابة النبى الأمين</li>
                            <li>• فضائل القرآن وآداب حملته</li>
                            <li>• معجزات النبى</li>
                            <li>• ولاتقربوا الزنا</li>
                            <li>• ذم البخل</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Verifications Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-12">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 rtl-text">التحقيقات</h3>
                <div class="rtl-content">
                    <p class="text-lg leading-relaxed mb-4">
                        وله عدد من التحقيقات منها:
                    </p>
                    <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                        <li>• المنتخب لعبد ابن حميد</li>
                        <li>• الفرقان بين أولياء الرحمن وأولياء الشيطان</li>
                        <li>• الوابل الصيب من الكلم الطيب</li>
                        <li>• تحقيق شرح الطحاوية</li>
                    </ul>
                </div>
            </div>

            <!-- Current Status -->
            <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-8 text-center">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 rtl-text">
                    الوضع الحالي
                </h3>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-6 rtl-content leading-relaxed">
                    ولا زال الشيخ مشمرًا في الدعوة إلى الله ونشر العلم والتأليف، نسأل الله عز وجل أن يبارك في علمه وعمله.
                </p>
                <Link 
                    :href="route('contact.index')" 
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 transition rtl-text"
                >
                    تواصل مع الشيخ
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import AppLayout from '../layouts/AppLayout.vue'
</script> 