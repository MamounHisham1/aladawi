<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookCategory = Category::where('type', 'book')->first();
        $generalCategory = Category::where('type', 'general')->first();
        
        $categoryId = $bookCategory ? $bookCategory->id : ($generalCategory ? $generalCategory->id : 1);

        $books = [
            [
                'title_ar' => 'أصول الفقه الإسلامي',
                'title_en' => 'Principles of Islamic Jurisprudence',
                'slug' => 'principles-of-islamic-jurisprudence',
                'description_ar' => 'كتاب شامل في أصول الفقه الإسلامي يتناول القواعد والمبادئ الأساسية لاستنباط الأحكام الشرعية من مصادرها الأصلية. يشمل الكتاب دراسة مفصلة للقرآن الكريم والسنة النبوية والإجماع والقياس وغيرها من مصادر التشريع الإسلامي.',
                'description_en' => 'A comprehensive book on the principles of Islamic jurisprudence covering the basic rules and principles for deriving Islamic rulings from their original sources. The book includes a detailed study of the Holy Quran, Prophetic Sunnah, consensus, analogy, and other sources of Islamic legislation.',
                'author_ar' => 'الشيخ العدوي',
                'author_en' => 'Sheikh Al-Adawi',
                'isbn' => '978-1-234567-89-0',
                'pages' => 450,
                'language' => 'ar',
                'publication_year' => 2023,
                'publisher_ar' => 'دار النشر الإسلامية',
                'publisher_en' => 'Islamic Publishing House',
                'is_featured' => true,
                'is_published' => true,
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'السيرة النبوية المختصرة',
                'title_en' => 'Concise Biography of the Prophet',
                'slug' => 'concise-biography-of-prophet',
                'description_ar' => 'سيرة مختصرة وشاملة لحياة النبي محمد صلى الله عليه وسلم، تتناول مولده ونشأته ودعوته وهجرته وغزواته ووفاته. الكتاب مكتوب بأسلوب سهل ومبسط يناسب جميع الأعمار.',
                'description_en' => 'A concise and comprehensive biography of the life of Prophet Muhammad (peace be upon him), covering his birth, upbringing, mission, migration, battles, and death. The book is written in an easy and simplified style suitable for all ages.',
                'author_ar' => 'الشيخ العدوي',
                'author_en' => 'Sheikh Al-Adawi',
                'isbn' => '978-1-234567-90-6',
                'pages' => 320,
                'language' => 'ar',
                'publication_year' => 2022,
                'publisher_ar' => 'دار النشر الإسلامية',
                'publisher_en' => 'Islamic Publishing House',
                'is_featured' => false,
                'is_published' => true,
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'فقه العبادات',
                'title_en' => 'Jurisprudence of Worship',
                'slug' => 'jurisprudence-of-worship',
                'description_ar' => 'دراسة فقهية شاملة لأحكام العبادات في الإسلام، تشمل الطهارة والصلاة والزكاة والصوم والحج. يتناول الكتاب الأدلة الشرعية والآراء الفقهية المختلفة مع الترجيح والتوضيح.',
                'description_en' => 'A comprehensive jurisprudential study of the rulings of worship in Islam, including purification, prayer, zakat, fasting, and pilgrimage. The book covers legal evidence and different jurisprudential opinions with preference and clarification.',
                'author_ar' => 'الشيخ العدوي',
                'author_en' => 'Sheikh Al-Adawi',
                'isbn' => '978-1-234567-91-3',
                'pages' => 520,
                'language' => 'ar',
                'publication_year' => 2023,
                'publisher_ar' => 'دار النشر الإسلامية',
                'publisher_en' => 'Islamic Publishing House',
                'is_featured' => true,
                'is_published' => true,
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'التفسير الميسر للقرآن الكريم',
                'title_en' => 'Simplified Interpretation of the Holy Quran',
                'slug' => 'simplified-quran-interpretation',
                'description_ar' => 'تفسير مبسط للقرآن الكريم يهدف إلى تقريب معاني الآيات للقارئ العادي. يتميز بالوضوح والبساطة مع الحفاظ على دقة المعنى والالتزام بأقوال المفسرين المعتبرين.',
                'description_en' => 'A simplified interpretation of the Holy Quran aimed at bringing the meanings of verses closer to the ordinary reader. It is characterized by clarity and simplicity while maintaining accuracy of meaning and adherence to the sayings of respected interpreters.',
                'author_ar' => 'الشيخ العدوي',
                'author_en' => 'Sheikh Al-Adawi',
                'isbn' => '978-1-234567-92-0',
                'pages' => 680,
                'language' => 'ar',
                'publication_year' => 2024,
                'publisher_ar' => 'دار النشر الإسلامية',
                'publisher_en' => 'Islamic Publishing House',
                'is_featured' => true,
                'is_published' => true,
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'الأخلاق الإسلامية',
                'title_en' => 'Islamic Ethics',
                'slug' => 'islamic-ethics',
                'description_ar' => 'دراسة شاملة للأخلاق الإسلامية وتطبيقاتها في الحياة العملية. يتناول الكتاب أخلاق المسلم مع ربه ومع نفسه ومع الآخرين، مع التركيز على النماذج العملية من السيرة النبوية.',
                'description_en' => 'A comprehensive study of Islamic ethics and their applications in practical life. The book covers Muslim ethics with God, with oneself, and with others, focusing on practical examples from the Prophetic biography.',
                'author_ar' => 'الشيخ العدوي',
                'author_en' => 'Sheikh Al-Adawi',
                'isbn' => '978-1-234567-93-7',
                'pages' => 380,
                'language' => 'ar',
                'publication_year' => 2023,
                'publisher_ar' => 'دار النشر الإسلامية',
                'publisher_en' => 'Islamic Publishing House',
                'is_featured' => false,
                'is_published' => true,
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'فقه المعاملات المالية',
                'title_en' => 'Jurisprudence of Financial Transactions',
                'slug' => 'jurisprudence-financial-transactions',
                'description_ar' => 'دراسة فقهية معاصرة للمعاملات المالية في الإسلام، تشمل البيع والشراء والإجارة والشركات والمصارف الإسلامية. يتناول الكتاب التطبيقات المعاصرة والحلول الشرعية للمسائل المالية الحديثة.',
                'description_en' => 'A contemporary jurisprudential study of financial transactions in Islam, including buying and selling, leasing, partnerships, and Islamic banks. The book covers contemporary applications and legal solutions to modern financial issues.',
                'author_ar' => 'الشيخ العدوي',
                'author_en' => 'Sheikh Al-Adawi',
                'isbn' => '978-1-234567-94-4',
                'pages' => 420,
                'language' => 'ar',
                'publication_year' => 2024,
                'publisher_ar' => 'دار النشر الإسلامية',
                'publisher_en' => 'Islamic Publishing House',
                'is_featured' => false,
                'is_published' => true,
                'category_id' => $categoryId,
            ],
        ];

        foreach ($books as $bookData) {
            Book::create($bookData);
        }
    }
}
