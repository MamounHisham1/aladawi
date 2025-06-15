<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class SheikhBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the admin user (assuming first user is admin)
        $adminUser = User::first();
        
        // Get or create categories
        $fiqhCategory = Category::firstOrCreate(['name_ar' => 'الفقه'], [
            'name_en' => 'Fiqh',
            'slug' => 'fiqh',
            'description_ar' => 'كتب الفقه الإسلامي',
            'description_en' => 'Islamic Jurisprudence Books'
        ]);
        
        $hadithCategory = Category::firstOrCreate(['name_ar' => 'الحديث'], [
            'name_en' => 'Hadith',
            'slug' => 'hadith',
            'description_ar' => 'كتب الحديث الشريف',
            'description_en' => 'Hadith Books'
        ]);
        
        $tafsirCategory = Category::firstOrCreate(['name_ar' => 'التفسير'], [
            'name_en' => 'Tafsir',
            'slug' => 'tafsir',
            'description_ar' => 'كتب التفسير',
            'description_en' => 'Quranic Commentary Books'
        ]);
        
        $aqeedahCategory = Category::firstOrCreate(['name_ar' => 'العقيدة'], [
            'name_en' => 'Aqeedah',
            'slug' => 'aqeedah',
            'description_ar' => 'كتب العقيدة',
            'description_en' => 'Islamic Creed Books'
        ]);
        
        $generalCategory = Category::firstOrCreate(['name_ar' => 'عام'], [
            'name_en' => 'General',
            'slug' => 'general',
            'description_ar' => 'كتب عامة',
            'description_en' => 'General Books'
        ]);

        // Books data based on the provided list
        $books = [
            [
                'title_ar' => 'جامع أحكام النساء - أسئلة تطبيقية',
                'slug' => 'jami-ahkam-alnisa-asila-tatbiqiya',
                'description_ar' => 'أسئلة تطبيقية على كتاب جامع أحكام النساء في خمس مجلدات، يحتوي على أسئلة تطبيقية على المسائل المحتواة في الأربع مجلدات الأولى.',
                'excerpt_ar' => 'أسئلة تطبيقية على كتاب جامع أحكام النساء',
                'category_id' => $fiqhCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2023,
                'tags' => json_encode(['المرأة', 'الفقه', 'أسئلة']),
                'download_count' => 1367,
                'is_featured' => true,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'الصحيح المسند من أحاديث الفتن والملاحم وأشراط الساعة',
                'slug' => 'sahih-musnad-ahadith-fitan-malahim',
                'description_ar' => 'مجموعة من الأحاديث الصحيحة المتعلقة بالفتن والملاحم وأشراط الساعة، مع التحقيق والتخريج.',
                'excerpt_ar' => 'أحاديث صحيحة في الفتن والملاحم وأشراط الساعة',
                'category_id' => $hadithCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2017,
                'tags' => json_encode(['الفتن', 'الملاحم', 'أشراط الساعة', 'الحديث']),
                'download_count' => 43202,
                'is_featured' => true,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'قصة أصحاب الجنة',
                'slug' => 'qissat-ashab-aljannah',
                'description_ar' => 'شرح وتفسير لقصة أصحاب الجنة الواردة في القرآن الكريم مع الدروس والعبر المستفادة.',
                'excerpt_ar' => 'شرح قصة أصحاب الجنة من القرآن الكريم',
                'category_id' => $tafsirCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2016,
                'tags' => json_encode(['القرآن', 'القصص', 'التفسير']),
                'download_count' => 7982,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'النور الساري في شرح صحيح البخاري',
                'slug' => 'alnur-alsari-sharh-bukhari',
                'description_ar' => 'شرح مفصل لأحاديث صحيح البخاري مع بيان الفوائد والأحكام المستنبطة.',
                'excerpt_ar' => 'شرح صحيح البخاري',
                'category_id' => $hadithCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2016,
                'tags' => json_encode(['البخاري', 'الحديث', 'الشرح']),
                'download_count' => 18920,
                'is_featured' => true,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'مختصر صحيح تفسير ابن كثير',
                'slug' => 'mukhtasar-sahih-tafsir-ibn-kathir',
                'description_ar' => 'مختصر لتفسير ابن كثير مع التركيز على الأقوال الصحيحة والراجحة في التفسير. مجلدان مدمجان برابط واحد.',
                'excerpt_ar' => 'مختصر تفسير ابن كثير بالأقوال الصحيحة',
                'category_id' => $tafsirCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2015,
                'tags' => json_encode(['تفسير', 'ابن كثير', 'القرآن']),
                'download_count' => 95536,
                'is_featured' => true,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'شفاء القلوب',
                'slug' => 'shifa-alqulub',
                'description_ar' => 'رسالة نافعة تتعلق بالقلوب وما يعتريها من آفات وأمراض وأدواء وعلاجها من كتاب الله وسنة رسوله صلى الله عليه وسلم.',
                'excerpt_ar' => 'علاج أمراض القلوب من الكتاب والسنة',
                'category_id' => $generalCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2014,
                'tags' => json_encode(['القلوب', 'التزكية', 'الأخلاق']),
                'download_count' => 18821,
                'is_featured' => true,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'أخبار الدجال وابن صياد',
                'slug' => 'akhbar-aldajjal-wa-ibn-sayyad',
                'description_ar' => 'جمع وتحقيق للأحاديث الصحيحة المتعلقة بالدجال وابن صياد مع الشرح والتوضيح.',
                'excerpt_ar' => 'أحاديث الدجال وابن صياد',
                'category_id' => $hadithCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2012,
                'tags' => json_encode(['الدجال', 'ابن صياد', 'الفتن']),
                'download_count' => 4192,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'تفسير الربانيين لعموم المؤمنين (تفسير جزء عم)',
                'slug' => 'tafsir-alrabaniyin-juz-amma',
                'description_ar' => 'تفسير مبسط لجزء عم من القرآن الكريم، وهو مختصر من مشروع التسهيل لتأويل التنزيل.',
                'excerpt_ar' => 'تفسير جزء عم مبسط للمؤمنين',
                'category_id' => $tafsirCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2012,
                'tags' => json_encode(['جزء عم', 'التفسير', 'القرآن']),
                'download_count' => 9673,
                'is_featured' => true,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'الترشيد',
                'slug' => 'altrashid',
                'description_ar' => 'كتاب في أحكام الزكاة وآدابها وحكمها وشروطها.',
                'excerpt_ar' => 'أحكام الزكاة في الإسلام',
                'category_id' => $fiqhCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2012,
                'tags' => json_encode(['الزكاة', 'الفقه', 'العبادات']),
                'download_count' => 5578,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'يواقيت الفلاة في مواقيت الصلاة',
                'slug' => 'yawaqit-alfalah-mawaqit-salah',
                'description_ar' => 'بحث مفصل في مواقيت الصلاة وأحكامها الفقهية.',
                'excerpt_ar' => 'أحكام مواقيت الصلاة',
                'category_id' => $fiqhCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2012,
                'tags' => json_encode(['الصلاة', 'المواقيت', 'الفقه']),
                'download_count' => 5398,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'فقه التعامل بين الزوجين وقبسات من بيت النبوة',
                'slug' => 'fiqh-altaamul-bayn-alzawjayn',
                'description_ar' => 'دليل شامل لفقه التعامل بين الزوجين مع أمثلة من بيت النبوة الشريف.',
                'excerpt_ar' => 'آداب وأحكام التعامل بين الزوجين',
                'category_id' => $fiqhCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2012,
                'tags' => json_encode(['الزواج', 'الأسرة', 'الفقه']),
                'download_count' => 37400,
                'is_featured' => true,
                'created_by' => $adminUser->id,
            ],
            [
                'title_ar' => 'أحكام الطلاق في الشريعة الإسلامية',
                'slug' => 'ahkam-altalaq-fi-sharia',
                'description_ar' => 'دراسة فقهية شاملة لأحكام الطلاق في الشريعة الإسلامية.',
                'excerpt_ar' => 'أحكام الطلاق في الإسلام',
                'category_id' => $fiqhCategory->id,
                'author_ar' => 'مصطفى العدوي',
                'publication_year' => 2011,
                'tags' => json_encode(['الطلاق', 'الفقه', 'الأحوال الشخصية']),
                'download_count' => 0, // No count provided in the list
                'created_by' => $adminUser->id,
            ],
        ];

        // Insert books
        foreach ($books as $bookData) {
            Book::create($bookData);
        }

        $this->command->info('Sheikh Al-Adawi books have been seeded successfully!');
    }
}
