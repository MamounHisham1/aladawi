<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articleCategory = Category::where('type', 'article')->first();
        $generalCategory = Category::where('type', 'general')->first();

        $categoryId = $articleCategory ? $articleCategory->id : ($generalCategory ? $generalCategory->id : 1);

        $articles = [
            [
                'title_ar' => 'أهمية الصلاة في الإسلام',
                'title_en' => 'The Importance of Prayer in Islam',
                'slug' => 'importance-of-prayer-in-islam',
                'excerpt_ar' => 'الصلاة هي الركن الثاني من أركان الإسلام وهي أول ما يحاسب عليه العبد يوم القيامة',
                'excerpt_en' => 'Prayer is the second pillar of Islam and the first thing a person will be held accountable for on the Day of Judgment',
                'content_ar' => '<p>الصلاة في الإسلام هي الركن الثاني من أركان الإسلام الخمسة، وهي فريضة على كل مسلم بالغ عاقل. قال الله تعالى: "وأقيموا الصلاة وآتوا الزكاة واركعوا مع الراكعين".</p>

<h2>فضل الصلاة</h2>
<p>للصلاة فضائل عظيمة في الإسلام، منها:</p>
<ul>
<li>أنها صلة بين العبد وربه</li>
<li>أنها تنهى عن الفحشاء والمنكر</li>
<li>أنها راحة للقلب وطمأنينة للنفس</li>
<li>أنها سبب لمغفرة الذنوب</li>
</ul>

<h2>أوقات الصلاة</h2>
<p>فرض الله على المسلمين خمس صلوات في اليوم والليلة:</p>
<ol>
<li>صلاة الفجر: من طلوع الفجر إلى طلوع الشمس</li>
<li>صلاة الظهر: من زوال الشمس إلى أن يصير ظل كل شيء مثله</li>
<li>صلاة العصر: من انتهاء وقت الظهر إلى غروب الشمس</li>
<li>صلاة المغرب: من غروب الشمس إلى مغيب الشفق الأحمر</li>
<li>صلاة العشاء: من مغيب الشفق الأحمر إلى منتصف الليل</li>
</ol>

<p>وقد قال رسول الله صلى الله عليه وسلم: "أول ما يحاسب به العبد يوم القيامة من عمله صلاته، فإن صلحت فقد أفلح وأنجح، وإن فسدت فقد خاب وخسر".</p>',
                'content_en' => '<p>Prayer in Islam is the second pillar of the five pillars of Islam, and it is an obligation upon every adult, sane Muslim. Allah says: "And establish prayer and give zakah and bow with those who bow."</p>

<h2>The Virtue of Prayer</h2>
<p>Prayer has great virtues in Islam, including:</p>
<ul>
<li>It is a connection between the servant and his Lord</li>
<li>It forbids indecency and wrongdoing</li>
<li>It brings rest to the heart and tranquility to the soul</li>
<li>It is a cause for the forgiveness of sins</li>
</ul>

<h2>Prayer Times</h2>
<p>Allah has ordained five prayers upon Muslims throughout the day and night:</p>
<ol>
<li>Fajr prayer: From dawn until sunrise</li>
<li>Dhuhr prayer: From when the sun passes its zenith until the shadow of everything equals its length</li>
<li>Asr prayer: From the end of Dhuhr time until sunset</li>
<li>Maghrib prayer: From sunset until the red twilight disappears</li>
<li>Isha prayer: From the disappearance of red twilight until midnight</li>
</ol>

<p>The Prophet (peace be upon him) said: "The first thing for which a person will be held accountable on the Day of Judgment is his prayer. If it is sound, he will have succeeded and prospered, but if it is corrupt, he will have failed and lost."</p>',
                'author_name' => 'الشيخ العدوي',
                'reading_time' => 8,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'آداب تلاوة القرآن الكريم',
                'title_en' => 'Etiquettes of Reciting the Holy Quran',
                'slug' => 'etiquettes-of-quran-recitation',
                'excerpt_ar' => 'للقرآن الكريم آداب وأحكام في التلاوة يجب على المسلم مراعاتها عند قراءة كتاب الله',
                'excerpt_en' => 'The Holy Quran has etiquettes and rules for recitation that Muslims must observe when reading the Book of Allah',
                'content_ar' => '<p>القرآن الكريم هو كلام الله المنزل على رسوله محمد صلى الله عليه وسلم، وله آداب وأحكام في التلاوة يجب مراعاتها.</p>

<h2>آداب ما قبل التلاوة</h2>
<ul>
<li>الوضوء: يستحب أن يكون القارئ على وضوء</li>
<li>اختيار المكان المناسب: يفضل مكان هادئ ونظيف</li>
<li>الاستعاذة: قول "أعوذ بالله من الشيطان الرجيم"</li>
<li>البسملة: قول "بسم الله الرحمن الرحيم"</li>
</ul>

<h2>آداب أثناء التلاوة</h2>
<ul>
<li>الخشوع والتدبر في معاني الآيات</li>
<li>الترتيل وعدم الإسراع في القراءة</li>
<li>تحسين الصوت دون مبالغة</li>
<li>الوقف عند آيات الوعيد والوعد</li>
</ul>

<h2>فضل تلاوة القرآن</h2>
<p>قال رسول الله صلى الله عليه وسلم: "من قرأ حرفاً من كتاب الله فله به حسنة، والحسنة بعشر أمثالها، لا أقول الم حرف، ولكن ألف حرف ولام حرف وميم حرف".</p>

<p>وقال أيضاً: "اقرؤوا القرآن فإنه يأتي يوم القيامة شفيعاً لأصحابه".</p>',
                'content_en' => '<p>The Holy Quran is the word of Allah revealed to His Messenger Muhammad (peace be upon him), and it has etiquettes and rules for recitation that must be observed.</p>

<h2>Etiquettes Before Recitation</h2>
<ul>
<li>Ablution: It is recommended that the reader be in a state of ablution</li>
<li>Choosing the appropriate place: A quiet and clean place is preferred</li>
<li>Seeking refuge: Saying "I seek refuge in Allah from Satan the accursed"</li>
<li>Basmalah: Saying "In the name of Allah, the Most Gracious, the Most Merciful"</li>
</ul>

<h2>Etiquettes During Recitation</h2>
<ul>
<li>Humility and contemplation of the meanings of the verses</li>
<li>Measured recitation without rushing</li>
<li>Beautifying the voice without exaggeration</li>
<li>Pausing at verses of warning and promise</li>
</ul>

<h2>The Virtue of Reciting the Quran</h2>
<p>The Prophet (peace be upon him) said: "Whoever reads a letter from the Book of Allah will have a reward, and the reward is multiplied by ten. I do not say that Alif-Lam-Mim is one letter, but Alif is a letter, Lam is a letter, and Mim is a letter."</p>

<p>He also said: "Read the Quran, for it will come on the Day of Judgment as an intercessor for its companions."</p>',
                'author_name' => 'الشيخ العدوي',
                'reading_time' => 6,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'الزكاة وأحكامها في الإسلام',
                'title_en' => 'Zakat and Its Rules in Islam',
                'slug' => 'zakat-and-its-rules-in-islam',
                'excerpt_ar' => 'الزكاة هي الركن الثالث من أركان الإسلام وهي حق المال الذي فرضه الله على الأغنياء للفقراء',
                'excerpt_en' => 'Zakat is the third pillar of Islam and is the right of wealth that Allah has ordained upon the rich for the poor',
                'content_ar' => '<p>الزكاة لغة: النماء والطهارة والبركة. وشرعاً: حق واجب في مال مخصوص لطائفة مخصوصة في وقت مخصوص.</p>

<h2>حكم الزكاة</h2>
<p>الزكاة فريضة من فرائض الإسلام، وهي الركن الثالث من أركان الإسلام الخمسة. قال الله تعالى: "وأقيموا الصلاة وآتوا الزكاة".</p>

<h2>شروط وجوب الزكاة</h2>
<ul>
<li>الإسلام</li>
<li>الحرية</li>
<li>ملك النصاب</li>
<li>حولان الحول (مرور سنة كاملة)</li>
<li>عدم وجود دين يستغرق النصاب</li>
</ul>

<h2>أنواع الأموال التي تجب فيها الزكاة</h2>
<ol>
<li>زكاة النقدين (الذهب والفضة)</li>
<li>زكاة عروض التجارة</li>
<li>زكاة الزروع والثمار</li>
<li>زكاة بهيمة الأنعام</li>
<li>زكاة المعادن والركاز</li>
</ol>

<h2>مصارف الزكاة</h2>
<p>حدد الله تعالى مصارف الزكاة في قوله: "إنما الصدقات للفقراء والمساكين والعاملين عليها والمؤلفة قلوبهم وفي الرقاب والغارمين وفي سبيل الله وابن السبيل فريضة من الله والله عليم حكيم".</p>

<h2>فوائد الزكاة</h2>
<ul>
<li>تطهير النفس من البخل والشح</li>
<li>تحقيق التكافل الاجتماعي</li>
<li>تقليل الفوارق بين طبقات المجتمع</li>
<li>بركة في المال</li>
</ul>',
                'content_en' => '<p>Zakat linguistically means: growth, purification, and blessing. Legally: an obligatory right in specific wealth for specific people at a specific time.</p>

<h2>The Ruling on Zakat</h2>
<p>Zakat is an obligation of Islam and is the third pillar of the five pillars of Islam. Allah says: "And establish prayer and give zakat."</p>

<h2>Conditions for the Obligation of Zakat</h2>
<ul>
<li>Islam</li>
<li>Freedom</li>
<li>Ownership of nisab (minimum threshold)</li>
<li>Completion of a full year</li>
<li>Absence of debt that consumes the nisab</li>
</ul>

<h2>Types of Wealth Subject to Zakat</h2>
<ol>
<li>Zakat on gold and silver</li>
<li>Zakat on trade goods</li>
<li>Zakat on crops and fruits</li>
<li>Zakat on livestock</li>
<li>Zakat on minerals and treasures</li>
</ol>

<h2>Recipients of Zakat</h2>
<p>Allah has specified the recipients of zakat in His saying: "Zakah expenditures are only for the poor and for the needy and for those employed to collect [zakah] and for bringing hearts together [for Islam] and for freeing captives [or slaves] and for those in debt and for the cause of Allah and for the [stranded] traveler - an obligation [imposed] by Allah. And Allah is Knowing and Wise."</p>

<h2>Benefits of Zakat</h2>
<ul>
<li>Purifying the soul from miserliness and greed</li>
<li>Achieving social solidarity</li>
<li>Reducing gaps between social classes</li>
<li>Blessing in wealth</li>
</ul>',
                'author_name' => 'الشيخ العدوي',
                'reading_time' => 10,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'أخلاق المسلم في التعامل مع الآخرين',
                'title_en' => 'Muslim Ethics in Dealing with Others',
                'slug' => 'muslim-ethics-dealing-with-others',
                'excerpt_ar' => 'الإسلام دين الأخلاق الحميدة، وقد حث على حسن التعامل مع جميع الناس بالحكمة والموعظة الحسنة',
                'excerpt_en' => 'Islam is a religion of noble character, and it encourages good treatment of all people with wisdom and good advice',
                'content_ar' => '<p>الأخلاق في الإسلام لها مكانة عظيمة، فقد قال رسول الله صلى الله عليه وسلم: "إنما بعثت لأتمم مكارم الأخلاق".</p>

<h2>أسس الأخلاق الإسلامية</h2>
<ul>
<li>الصدق في القول والعمل</li>
<li>الأمانة في جميع المعاملات</li>
<li>العدل مع جميع الناس</li>
<li>الرحمة والرأفة</li>
<li>التواضع وعدم الكبر</li>
</ul>

<h2>آداب التعامل مع الوالدين</h2>
<p>قال الله تعالى: "وقضى ربك ألا تعبدوا إلا إياه وبالوالدين إحساناً".</p>
<ul>
<li>البر والطاعة في المعروف</li>
<li>خفض الجناح لهما</li>
<li>الدعاء لهما بالرحمة</li>
<li>عدم التأفف من أوامرهما</li>
</ul>

<h2>آداب التعامل مع الجيران</h2>
<p>قال رسول الله صلى الله عليه وسلم: "ما زال جبريل يوصيني بالجار حتى ظننت أنه سيورثه".</p>
<ul>
<li>كف الأذى عنهم</li>
<li>تقديم المساعدة عند الحاجة</li>
<li>تبادل الهدايا والزيارات</li>
<li>الصبر على أذاهم</li>
</ul>

<h2>آداب التعامل في البيع والشراء</h2>
<ul>
<li>الصدق في الوصف</li>
<li>عدم الغش أو الخداع</li>
<li>الوفاء بالعقود والمواعيد</li>
<li>التسامح في المطالبة</li>
</ul>

<p>قال رسول الله صلى الله عليه وسلم: "التاجر الصدوق الأمين مع النبيين والصديقين والشهداء".</p>',
                'content_en' => '<p>Ethics in Islam hold a great position, as the Prophet (peace be upon him) said: "I was sent only to perfect noble character."</p>

<h2>Foundations of Islamic Ethics</h2>
<ul>
<li>Truthfulness in word and deed</li>
<li>Trustworthiness in all dealings</li>
<li>Justice with all people</li>
<li>Mercy and compassion</li>
<li>Humility and avoiding arrogance</li>
</ul>

<h2>Etiquettes of Dealing with Parents</h2>
<p>Allah says: "And your Lord has decreed that you not worship except Him, and to parents, good treatment."</p>
<ul>
<li>Righteousness and obedience in what is good</li>
<li>Lowering the wing of humility before them</li>
<li>Praying for them with mercy</li>
<li>Not showing annoyance at their commands</li>
</ul>

<h2>Etiquettes of Dealing with Neighbors</h2>
<p>The Prophet (peace be upon him) said: "Gabriel kept advising me about the neighbor until I thought he would make him an heir."</p>
<ul>
<li>Refraining from harming them</li>
<li>Offering help when needed</li>
<li>Exchanging gifts and visits</li>
<li>Being patient with their harm</li>
</ul>

<h2>Etiquettes of Dealing in Buying and Selling</h2>
<ul>
<li>Honesty in description</li>
<li>Avoiding fraud or deception</li>
<li>Fulfilling contracts and appointments</li>
<li>Being lenient in demands</li>
</ul>

<p>The Prophet (peace be upon him) said: "The honest, trustworthy merchant will be with the prophets, the truthful, and the martyrs."</p>',
                'author_name' => 'الشيخ العدوي',
                'reading_time' => 7,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'فضل العلم وطلبه في الإسلام',
                'title_en' => 'The Virtue of Knowledge and Seeking It in Islam',
                'slug' => 'virtue-of-knowledge-seeking-in-islam',
                'excerpt_ar' => 'العلم في الإسلام له مكانة عظيمة، وقد حث الإسلام على طلب العلم من المهد إلى اللحد',
                'excerpt_en' => 'Knowledge in Islam has a great position, and Islam has encouraged seeking knowledge from the cradle to the grave',
                'content_ar' => '<p>العلم في الإسلام له مكانة رفيعة ومنزلة عالية، فهو أساس الحضارة والتقدم، وسبيل الهداية والرشاد.</p>

<h2>فضل العلم في القرآن والسنة</h2>
<p>قال الله تعالى: "وقل رب زدني علماً"، وقال أيضاً: "يرفع الله الذين آمنوا منكم والذين أوتوا العلم درجات".</p>

<p>وقال رسول الله صلى الله عليه وسلم: "طلب العلم فريضة على كل مسلم".</p>

<h2>أنواع العلم</h2>
<ol>
<li><strong>العلم الشرعي:</strong> وهو علم الكتاب والسنة وما يتعلق بأمور الدين</li>
<li><strong>العلم الدنيوي:</strong> وهو العلوم التي تنفع الناس في دنياهم كالطب والهندسة</li>
</ol>

<h2>آداب طالب العلم</h2>
<ul>
<li>إخلاص النية لله تعالى</li>
<li>التواضع وعدم الكبر</li>
<li>احترام المعلم وتوقيره</li>
<li>الصبر على طلب العلم</li>
<li>العمل بما تعلم</li>
<li>نشر العلم وتعليمه للآخرين</li>
</ul>

<h2>فضل المعلم في الإسلام</h2>
<p>قال رسول الله صلى الله عليه وسلم: "إن الله وملائكته وأهل السماوات والأرض حتى النملة في جحرها وحتى الحوت ليصلون على معلم الناس الخير".</p>

<h2>ثمرات العلم</h2>
<ul>
<li>الخشية من الله تعالى</li>
<li>التمييز بين الحق والباطل</li>
<li>رفعة الدرجات في الدنيا والآخرة</li>
<li>نفع الناس والمجتمع</li>
<li>الأجر المستمر بعد الموت</li>
</ul>

<p>قال رسول الله صلى الله عليه وسلم: "إذا مات الإنسان انقطع عنه عمله إلا من ثلاثة: إلا من صدقة جارية، أو علم ينتفع به، أو ولد صالح يدعو له".</p>',
                'content_en' => '<p>Knowledge in Islam has a high status and elevated position, as it is the foundation of civilization and progress, and the path to guidance and righteousness.</p>

<h2>The Virtue of Knowledge in the Quran and Sunnah</h2>
<p>Allah says: "And say, My Lord, increase me in knowledge," and also: "Allah will raise those who have believed among you and those who were given knowledge, by degrees."</p>

<p>The Prophet (peace be upon him) said: "Seeking knowledge is an obligation upon every Muslim."</p>

<h2>Types of Knowledge</h2>
<ol>
<li><strong>Religious Knowledge:</strong> Knowledge of the Book and Sunnah and matters related to religion</li>
<li><strong>Worldly Knowledge:</strong> Sciences that benefit people in their worldly life such as medicine and engineering</li>
</ol>

<h2>Etiquettes of the Student of Knowledge</h2>
<ul>
<li>Sincerity of intention for Allah</li>
<li>Humility and avoiding arrogance</li>
<li>Respecting and honoring the teacher</li>
<li>Patience in seeking knowledge</li>
<li>Acting upon what is learned</li>
<li>Spreading knowledge and teaching it to others</li>
</ul>

<h2>The Virtue of the Teacher in Islam</h2>
<p>The Prophet (peace be upon him) said: "Indeed, Allah, His angels, the inhabitants of the heavens and the earth, even the ant in its hole and the fish, pray for the one who teaches people good."</p>

<h2>Fruits of Knowledge</h2>
<ul>
<li>Fear of Allah</li>
<li>Distinguishing between truth and falsehood</li>
<li>Elevation of ranks in this world and the next</li>
<li>Benefiting people and society</li>
<li>Continuous reward after death</li>
</ul>

<p>The Prophet (peace be upon him) said: "When a person dies, his deeds come to an end except for three: ongoing charity, knowledge from which people benefit, or a righteous child who prays for him."</p>',
                'author_name' => 'الشيخ العدوي',
                'reading_time' => 9,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(25),
                'category_id' => $categoryId,
            ],
        ];

        foreach ($articles as $articleData) {
            Article::create($articleData);
        }
    }
}
