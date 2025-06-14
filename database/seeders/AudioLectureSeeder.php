<?php

namespace Database\Seeders;

use App\Models\AudioLecture;
use App\Models\AudioSeries;
use App\Models\Category;
use Illuminate\Database\Seeder;

class AudioLectureSeeder extends Seeder
{
    public function run(): void
    {
        $audioCategory = Category::where('type', 'audio')->first();
        $generalCategory = Category::where('type', 'general')->first();
        
        $categoryId = $audioCategory ? $audioCategory->id : ($generalCategory ? $generalCategory->id : 1);

        // Create audio series first
        $series1 = AudioSeries::create([
            'name_ar' => 'شرح أسماء الله الحسنى',
            'name_en' => 'Explanation of Allah\'s Beautiful Names',
            'slug' => 'explanation-allah-beautiful-names',
            'description_ar' => 'سلسلة محاضرات في شرح أسماء الله الحسنى ومعانيها وآثارها في حياة المؤمن',
            'description_en' => 'A series of lectures explaining Allah\'s beautiful names, their meanings, and their effects on the believer\'s life',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $series2 = AudioSeries::create([
            'name_ar' => 'فقه العبادات',
            'name_en' => 'Jurisprudence of Worship',
            'slug' => 'jurisprudence-worship-series',
            'description_ar' => 'سلسلة محاضرات في فقه العبادات تشمل الطهارة والصلاة والزكاة والصوم والحج',
            'description_en' => 'A series of lectures on the jurisprudence of worship including purification, prayer, zakat, fasting, and pilgrimage',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $audioLectures = [
            [
                'title_ar' => 'الله الرحمن الرحيم',
                'title_en' => 'Allah Ar-Rahman Ar-Raheem',
                'slug' => 'allah-ar-rahman-ar-raheem',
                'description_ar' => 'شرح اسمي الله الرحمن الرحيم ومعانيهما وآثارهما في حياة المؤمن',
                'description_en' => 'Explanation of Allah\'s names Ar-Rahman and Ar-Raheem, their meanings and effects on the believer\'s life',
                'duration' => 2400,
                'quality' => 'high',
                'is_featured' => true,
                'is_published' => true,
                'category_id' => $categoryId,
                'audio_series_id' => $series1->id,
                'sort_order' => 1,
            ],
            [
                'title_ar' => 'الله الملك القدوس',
                'title_en' => 'Allah Al-Malik Al-Quddus',
                'slug' => 'allah-al-malik-al-quddus',
                'description_ar' => 'شرح اسمي الله الملك القدوس ودلالاتهما على كمال الله وتنزيهه',
                'description_en' => 'Explanation of Allah\'s names Al-Malik and Al-Quddus and their implications for Allah\'s perfection and transcendence',
                'duration' => 2700,
                'quality' => 'high',
                'is_featured' => false,
                'is_published' => true,
                'category_id' => $categoryId,
                'audio_series_id' => $series1->id,
                'sort_order' => 2,
            ],
            [
                'title_ar' => 'أحكام الطهارة',
                'title_en' => 'Rules of Purification',
                'slug' => 'rules-of-purification',
                'description_ar' => 'محاضرة شاملة في أحكام الطهارة والوضوء والغسل والتيمم',
                'description_en' => 'A comprehensive lecture on the rules of purification, ablution, ritual bath, and dry ablution',
                'duration' => 3600,
                'quality' => 'high',
                'is_featured' => true,
                'is_published' => true,
                'category_id' => $categoryId,
                'audio_series_id' => $series2->id,
                'sort_order' => 1,
            ],
            [
                'title_ar' => 'فضل القرآن الكريم',
                'title_en' => 'The Virtue of the Holy Quran',
                'slug' => 'virtue-holy-quran',
                'description_ar' => 'محاضرة في فضل القرآن الكريم وآداب تلاوته وحفظه',
                'description_en' => 'A lecture on the virtue of the Holy Quran and the etiquettes of its recitation and memorization',
                'duration' => 3000,
                'quality' => 'high',
                'is_featured' => false,
                'is_published' => true,
                'category_id' => $categoryId,
                'audio_series_id' => null,
                'sort_order' => 1,
            ],
        ];

        foreach ($audioLectures as $lectureData) {
            AudioLecture::create($lectureData);
        }
    }
}
