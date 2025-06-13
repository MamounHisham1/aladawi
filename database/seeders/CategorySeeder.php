<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // General categories
            [
                'name_ar' => 'العقيدة',
                'name_en' => 'Creed',
                'slug' => 'creed',
                'description_ar' => 'مسائل العقيدة والتوحيد',
                'description_en' => 'Matters of creed and monotheism',
                'type' => 'general',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الفقه',
                'name_en' => 'Jurisprudence',
                'slug' => 'jurisprudence',
                'description_ar' => 'الأحكام الفقهية والمسائل الشرعية',
                'description_en' => 'Islamic jurisprudence and legal matters',
                'type' => 'general',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الطهارة',
                'name_en' => 'Purification',
                'slug' => 'purification',
                'description_ar' => 'أحكام الطهارة والوضوء والغسل',
                'description_en' => 'Rules of purification, ablution and bathing',
                'type' => 'fatwa',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الصلاة',
                'name_en' => 'Prayer',
                'slug' => 'prayer',
                'description_ar' => 'أحكام الصلاة والزكاة',
                'description_en' => 'Rules of prayer and zakat',
                'type' => 'fatwa',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الصيام',
                'name_en' => 'Fasting',
                'slug' => 'fasting',
                'description_ar' => 'أحكام الصيام والاعتكاف',
                'description_en' => 'Rules of fasting and spiritual retreat',
                'type' => 'fatwa',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الحج والعمرة',
                'name_en' => 'Hajj and Umrah',
                'slug' => 'hajj-umrah',
                'description_ar' => 'أحكام الحج والعمرة',
                'description_en' => 'Rules of Hajj and Umrah',
                'type' => 'fatwa',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name_ar' => 'المعاملات',
                'name_en' => 'Transactions',
                'slug' => 'transactions',
                'description_ar' => 'المعاملات المالية والتجارية',
                'description_en' => 'Financial and commercial transactions',
                'type' => 'fatwa',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الأحوال الشخصية',
                'name_en' => 'Personal Status',
                'slug' => 'personal-status',
                'description_ar' => 'النكاح والطلاق والأحوال الشخصية',
                'description_en' => 'Marriage, divorce and personal status',
                'type' => 'fatwa',
                'sort_order' => 8,
                'is_active' => true,
            ],
            // Audio categories
            [
                'name_ar' => 'دروس علمية',
                'name_en' => 'Educational Lessons',
                'slug' => 'educational-lessons',
                'description_ar' => 'الدروس العلمية والمحاضرات',
                'description_en' => 'Educational lessons and lectures',
                'type' => 'audio',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name_ar' => 'خطب الجمعة',
                'name_en' => 'Friday Sermons',
                'slug' => 'friday-sermons',
                'description_ar' => 'خطب الجمعة والعيدين',
                'description_en' => 'Friday and Eid sermons',
                'type' => 'audio',
                'sort_order' => 10,
                'is_active' => true,
            ],
            // Book categories
            [
                'name_ar' => 'كتب العقيدة',
                'name_en' => 'Creed Books',
                'slug' => 'creed-books',
                'description_ar' => 'كتب في العقيدة والتوحيد',
                'description_en' => 'Books on creed and monotheism',
                'type' => 'book',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name_ar' => 'كتب الفقه',
                'name_en' => 'Jurisprudence Books',
                'slug' => 'jurisprudence-books',
                'description_ar' => 'كتب الفقه والأحكام',
                'description_en' => 'Books on jurisprudence and rulings',
                'type' => 'book',
                'sort_order' => 12,
                'is_active' => true,
            ],
            // Article categories
            [
                'name_ar' => 'مقالات إسلامية',
                'name_en' => 'Islamic Articles',
                'slug' => 'islamic-articles',
                'description_ar' => 'مقالات ومواضيع إسلامية متنوعة',
                'description_en' => 'Various Islamic articles and topics',
                'type' => 'article',
                'sort_order' => 13,
                'is_active' => true,
            ],
            [
                'name_ar' => 'بحوث علمية',
                'name_en' => 'Academic Research',
                'slug' => 'academic-research',
                'description_ar' => 'البحوث والدراسات العلمية',
                'description_en' => 'Academic research and studies',
                'type' => 'article',
                'sort_order' => 14,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
