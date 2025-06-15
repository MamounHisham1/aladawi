<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Fatwa;
use Illuminate\Database\Seeder;

class FatwaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fatwaCategory = Category::where('type', 'fatwa')->first();
        $generalCategory = Category::where('type', 'general')->first();

        $categoryId = $fatwaCategory ? $fatwaCategory->id : ($generalCategory ? $generalCategory->id : 1);

        $fatwas = [
            [
                'title_ar' => 'حكم الصلاة في الطائرة',
                'title_en' => 'Ruling on Prayer in an Airplane',
                'slug' => 'prayer-in-airplane-ruling',
                'question_ar' => 'ما حكم الصلاة في الطائرة أثناء السفر؟ وكيف يتم تحديد القبلة؟',
                'question_en' => 'What is the ruling on prayer in an airplane during travel? And how is the qibla determined?',
                'answer_ar' => '<p>الحمد لله والصلاة والسلام على رسول الله وبعد:</p>

<p>يجوز للمسافر أن يصلي في الطائرة إذا خاف فوات الوقت، وذلك لقول الله تعالى: "فإن خفتم فرجالاً أو ركباناً".</p>

<h3>شروط الصلاة في الطائرة:</h3>
<ul>
<li>أن يخاف فوات وقت الصلاة</li>
<li>أن يتوضأ قبل الصعود إلى الطائرة إن أمكن</li>
<li>أن يستقبل القبلة عند تكبيرة الإحرام إن أمكن</li>
<li>أن يصلي قائماً إن أمكن، وإلا فجالساً</li>
</ul>

<h3>تحديد القبلة:</h3>
<p>يمكن تحديد القبلة من خلال:</p>
<ul>
<li>البوصلة الموجودة في الطائرة</li>
<li>تطبيقات الهاتف المحمول</li>
<li>سؤال طاقم الطائرة</li>
<li>الاجتهاد إذا لم يتمكن من التأكد</li>
</ul>

<p>والله أعلم.</p>',
                'answer_en' => '<p>Praise be to Allah, and peace and blessings be upon the Messenger of Allah. To proceed:</p>

<p>It is permissible for a traveler to pray in an airplane if he fears missing the prayer time, based on Allah\'s saying: "But if you fear [an enemy, then pray] on foot or riding."</p>

<h3>Conditions for Prayer in an Airplane:</h3>
<ul>
<li>Fearing that the prayer time will pass</li>
<li>Performing ablution before boarding the plane if possible</li>
<li>Facing the qibla during the opening takbir if possible</li>
<li>Praying standing if possible, otherwise sitting</li>
</ul>

<h3>Determining the Qibla:</h3>
<p>The qibla can be determined through:</p>
<ul>
<li>The compass in the airplane</li>
<li>Mobile phone applications</li>
<li>Asking the flight crew</li>
<li>Personal judgment if unable to confirm</li>
</ul>

<p>And Allah knows best.</p>',
                'questioner_name' => 'أحمد محمد',
                'questioner_location' => 'الرياض، السعودية',
                'fatwa_date' => now()->subDays(10),
                'is_featured' => true,
                'is_published' => true,

                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'زكاة الذهب المدخر للزينة',
                'title_en' => 'Zakat on Gold Saved for Adornment',
                'slug' => 'zakat-gold-adornment',
                'question_ar' => 'هل تجب الزكاة في الذهب المدخر للزينة والاستعمال الشخصي؟',
                'question_en' => 'Is zakat due on gold saved for adornment and personal use?',
                'answer_ar' => '<p>بسم الله الرحمن الرحيم</p>

<p>اختلف العلماء في هذه المسألة على قولين:</p>

<h3>القول الأول:</h3>
<p>لا تجب الزكاة في الذهب المعد للزينة والاستعمال الشخصي، وهذا مذهب الحنفية والمالكية.</p>

<h3>الأدلة:</h3>
<ul>
<li>أن النبي صلى الله عليه وسلم رأى في يد امرأة سوارين من ذهب فلم يأمرها بزكاتهما</li>
<li>أن المعد للاستعمال الشخصي ليس مالاً نامياً</li>
</ul>

<h3>القول الثاني:</h3>
<p>تجب الزكاة في الذهب مطلقاً سواء كان للزينة أو للتجارة، وهذا مذهب الشافعية والحنابلة.</p>

<h3>الأدلة:</h3>
<ul>
<li>عموم الأحاديث الواردة في زكاة الذهب والفضة</li>
<li>أن الذهب يبقى ذهباً سواء استعمل أو لم يستعمل</li>
</ul>

<h3>الراجح:</h3>
<p>الأحوط والأولى إخراج زكاة الذهب المدخر للزينة إذا بلغ النصاب وحال عليه الحول، خروجاً من الخلاف وبراءة للذمة.</p>

<p>والله أعلم.</p>',
                'answer_en' => '<p>In the name of Allah, the Most Gracious, the Most Merciful</p>

<p>Scholars have differed on this issue into two opinions:</p>

<h3>First Opinion:</h3>
<p>Zakat is not due on gold prepared for adornment and personal use. This is the position of the Hanafi and Maliki schools.</p>

<h3>Evidence:</h3>
<ul>
<li>The Prophet (peace be upon him) saw a woman wearing two gold bracelets and did not order her to pay zakat on them</li>
<li>What is prepared for personal use is not growing wealth</li>
</ul>

<h3>Second Opinion:</h3>
<p>Zakat is due on gold absolutely, whether for adornment or trade. This is the position of the Shafi\'i and Hanbali schools.</p>

<h3>Evidence:</h3>
<ul>
<li>The general hadiths regarding zakat on gold and silver</li>
<li>Gold remains gold whether used or not</li>
</ul>

<h3>The Preferred Opinion:</h3>
<p>It is more cautious and preferable to pay zakat on gold saved for adornment if it reaches the nisab and a full year passes over it, to avoid the difference of opinion and clear one\'s responsibility.</p>

<p>And Allah knows best.</p>',
                'questioner_name' => 'فاطمة أحمد',
                'questioner_location' => 'جدة، السعودية',
                'fatwa_date' => now()->subDays(15),
                'is_featured' => false,
                'is_published' => true,

                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'حكم صيام المريض',
                'title_en' => 'Ruling on Fasting for the Sick',
                'slug' => 'fasting-ruling-sick-person',
                'question_ar' => 'ما حكم الصيام للمريض الذي يتناول الأدوية؟ وهل يجب عليه القضاء؟',
                'question_en' => 'What is the ruling on fasting for a sick person who takes medication? Is he required to make up the missed days?',
                'answer_ar' => '<p>الحمد لله رب العالمين، والصلاة والسلام على أشرف المرسلين.</p>

<p>المريض له أحوال مختلفة في الصيام:</p>

<h3>الحالة الأولى: المرض الذي لا يؤثر على الصيام</h3>
<p>إذا كان المرض خفيفاً لا يتأثر بالصيام ولا يزيد بسببه، فيجب عليه الصيام.</p>

<h3>الحالة الثانية: المرض الذي يتأثر بالصيام</h3>
<p>إذا كان الصيام يضر بالمريض أو يؤخر شفاءه، فيجوز له الفطر بل يستحب، لقول الله تعالى: "ومن كان مريضاً أو على سفر فعدة من أيام أخر".</p>

<h3>تناول الأدوية:</h3>
<ul>
<li>الأدوية التي تؤخذ عن طريق الفم تفطر</li>
<li>الحقن العضلية والوريدية للعلاج تفطر على الراجح</li>
<li>القطرات في العين والأذن لا تفطر على الصحيح</li>
<li>البخاخات للربو محل خلاف، والأحوط تجنبها</li>
</ul>

<h3>القضاء:</h3>
<p>من أفطر لعذر شرعي وجب عليه القضاء عند زوال العذر، لقوله تعالى: "فعدة من أيام أخر".</p>

<p>والله أعلم.</p>',
                'answer_en' => '<p>Praise be to Allah, Lord of the worlds, and peace and blessings be upon the most noble of messengers.</p>

<p>The sick person has different situations regarding fasting:</p>

<h3>First Situation: Illness that does not affect fasting</h3>
<p>If the illness is mild and is not affected by fasting nor increased because of it, then fasting is obligatory.</p>

<h3>Second Situation: Illness that is affected by fasting</h3>
<p>If fasting harms the sick person or delays his recovery, then it is permissible for him to break the fast, rather it is recommended, based on Allah\'s saying: "And whoever is ill or on a journey - then an equal number of other days."</p>

<h3>Taking Medication:</h3>
<ul>
<li>Medications taken orally break the fast</li>
<li>Intramuscular and intravenous injections for treatment break the fast according to the preferred opinion</li>
<li>Eye and ear drops do not break the fast according to the correct view</li>
<li>Asthma inhalers are a matter of disagreement; it is more cautious to avoid them</li>
</ul>

<h3>Making Up Missed Days:</h3>
<p>Whoever breaks the fast for a legitimate excuse must make up the missed days when the excuse is removed, based on Allah\'s saying: "then an equal number of other days."</p>

<p>And Allah knows best.</p>',
                'questioner_name' => 'عبدالله سالم',
                'questioner_location' => 'الدمام، السعودية',
                'fatwa_date' => now()->subDays(20),
                'is_featured' => true,
                'is_published' => true,

                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'حكم العمل في البنوك التقليدية',
                'title_en' => 'Ruling on Working in Conventional Banks',
                'slug' => 'working-conventional-banks-ruling',
                'question_ar' => 'ما حكم العمل في البنوك التقليدية التي تتعامل بالربا؟',
                'question_en' => 'What is the ruling on working in conventional banks that deal with interest?',
                'answer_ar' => '<p>بسم الله الرحمن الرحيم</p>

<p>العمل في البنوك التقليدية له تفصيل:</p>

<h3>الأعمال المحرمة:</h3>
<ul>
<li>كتابة عقود الربا وتوثيقها</li>
<li>حساب الفوائد الربوية</li>
<li>الترويج للقروض الربوية</li>
<li>إدارة أقسام الاستثمار الربوي</li>
</ul>

<h3>الأعمال المباحة:</h3>
<ul>
<li>أعمال الحراسة والنظافة</li>
<li>أعمال الصيانة والتقنية</li>
<li>الأعمال الإدارية البعيدة عن الربا</li>
<li>خدمة العملاء في الأمور المباحة</li>
</ul>

<h3>الضوابط:</h3>
<ol>
<li>ألا يباشر الأعمال المحرمة بنفسه</li>
<li>أن يبحث عن عمل بديل في مؤسسة مباحة</li>
<li>إذا لم يجد بديلاً واضطر للعمل، فليتق الله ما استطاع</li>
<li>أن يتصدق من راتبه إذا كان مختلطاً بالحرام</li>
</ol>

<h3>النصيحة:</h3>
<p>الأولى للمسلم أن يبحث عن عمل في مؤسسة مالية إسلامية أو في مجال آخر مباح، فإن لم يجد واضطر فليتق الله ما استطاع.</p>

<p>والله أعلم.</p>',
                'answer_en' => '<p>In the name of Allah, the Most Gracious, the Most Merciful</p>

<p>Working in conventional banks has details:</p>

<h3>Prohibited Work:</h3>
<ul>
<li>Writing and documenting interest contracts</li>
<li>Calculating interest</li>
<li>Promoting interest-based loans</li>
<li>Managing interest-based investment departments</li>
</ul>

<h3>Permissible Work:</h3>
<ul>
<li>Security and cleaning work</li>
<li>Maintenance and technical work</li>
<li>Administrative work distant from interest</li>
<li>Customer service in permissible matters</li>
</ul>

<h3>Guidelines:</h3>
<ol>
<li>Not to directly engage in prohibited activities</li>
<li>To search for alternative work in a permissible institution</li>
<li>If no alternative is found and one is compelled to work, then fear Allah as much as possible</li>
<li>To give charity from the salary if it is mixed with the forbidden</li>
</ol>

<h3>Advice:</h3>
<p>It is preferable for a Muslim to seek work in an Islamic financial institution or in another permissible field. If he cannot find one and is compelled, then let him fear Allah as much as he can.</p>

<p>And Allah knows best.</p>',
                'questioner_name' => 'محمد العتيبي',
                'questioner_location' => 'الرياض، السعودية',
                'fatwa_date' => now()->subDays(25),
                'is_featured' => false,
                'is_published' => true,

                'category_id' => $categoryId,
            ],
            [
                'title_ar' => 'حكم صلاة الجمعة للمسافر',
                'title_en' => 'Ruling on Friday Prayer for Travelers',
                'slug' => 'friday-prayer-travelers-ruling',
                'question_ar' => 'هل تجب صلاة الجمعة على المسافر؟ وما حكم من فاتته الجمعة؟',
                'question_en' => 'Is Friday prayer obligatory for travelers? What is the ruling for one who misses Friday prayer?',
                'answer_ar' => '<p>الحمد لله والصلاة والسلام على رسول الله وبعد:</p>

<h3>حكم صلاة الجمعة للمسافر:</h3>
<p>لا تجب صلاة الجمعة على المسافر، لكن إن حضرها وصلاها أجزأته عن صلاة الظهر.</p>

<h3>الأدلة:</h3>
<ul>
<li>أن النبي صلى الله عليه وسلم كان يسافر فلا يصلي الجمعة</li>
<li>أن الجمعة من خصائص الإقامة والاستقرار</li>
<li>أن المسافر له رخص شرعية منها عدم وجوب الجمعة</li>
</ul>

<h3>شروط سقوط الجمعة عن المسافر:</h3>
<ol>
<li>أن يكون في سفر شرعي (أكثر من 80 كم تقريباً)</li>
<li>أن يكون خارج بلده</li>
<li>ألا ينوي الإقامة أكثر من أربعة أيام</li>
</ol>

<h3>من فاتته الجمعة:</h3>
<p>من فاتته صلاة الجمعة لعذر شرعي (كالمرض أو السفر) يصلي الظهر أربع ركعات. ومن فاتته بلا عذر فعليه التوبة وصلاة الظهر.</p>

<h3>المسافر في بلد الإقامة:</h3>
<p>إذا كان المسافر في بلد يقيم فيه وأقام الجمعة، فالأولى له حضورها إن تيسر له ذلك.</p>

<p>والله أعلم.</p>',
                'answer_en' => '<p>Praise be to Allah, and peace and blessings be upon the Messenger of Allah. To proceed:</p>

<h3>Ruling on Friday Prayer for Travelers:</h3>
<p>Friday prayer is not obligatory for travelers, but if he attends and prays it, it suffices him instead of Dhuhr prayer.</p>

<h3>Evidence:</h3>
<ul>
<li>The Prophet (peace be upon him) used to travel and did not pray Friday prayer</li>
<li>Friday prayer is specific to residence and settlement</li>
<li>Travelers have legal concessions, including the non-obligation of Friday prayer</li>
</ul>

<h3>Conditions for Friday Prayer to be Waived for Travelers:</h3>
<ol>
<li>Being on a legitimate journey (approximately more than 80 km)</li>
<li>Being outside one\'s hometown</li>
<li>Not intending to stay more than four days</li>
</ol>

<h3>For Those Who Miss Friday Prayer:</h3>
<p>Whoever misses Friday prayer for a legitimate excuse (such as illness or travel) should pray Dhuhr four rak\'ahs. Whoever misses it without excuse should repent and pray Dhuhr.</p>

<h3>Traveler in a City of Residence:</h3>
<p>If a traveler is in a city where he resides and Friday prayer is established, it is preferable for him to attend if it is easy for him.</p>

<p>And Allah knows best.</p>',
                'questioner_name' => 'خالد الأحمد',
                'questioner_location' => 'مكة المكرمة، السعودية',
                'fatwa_date' => now()->subDays(30),
                'is_featured' => true,
                'is_published' => true,

                'category_id' => $categoryId,
            ],
        ];

        foreach ($fatwas as $fatwaData) {
            Fatwa::create($fatwaData);
        }
    }
}
