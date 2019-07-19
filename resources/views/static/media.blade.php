@extends('layout.master')

@section('page-content')

@push('header-scripts')
<style>
    .month-slider .media-active { background-color: #f27d27; color: #ffffff !important;}
    .month-slider .media-active p { color: #ffffff !important;}
    .media_year {display: none}
    .media-timeline {cursor: pointer;}
    .bg_media{background-image: url(img/media/media_bg.png);  background-repeat: no-repeat; background-position: left center; vertical-align:top; height:86px; text-align:center;}
</style>
@endpush

{!! $content !!}

{{-- <div class="media-page">
    <!-- banner -->
    <figure class="inner-banner">
        <img src="/img/inner-banner.jpg" alt="banner">
        <figcaption>
            <div class="container">
                <h1>On Top Of The <br> World</h1>
                <p>Look who's talking about Healthians</p>
            </div>
        </figcaption>
    </figure>
    <!-- time-slider -->
    <section class="month-slider">
        <div class="container">
            <div id="time-slider" class="owl-carousel">
                <div class="media-timeline media-active">
                    <p>2018</p>
                </div>
                <div class="media-timeline">
                    <p>2017</p>
                </div>
                <div class="media-timeline">
                    <p>2016</p>
                </div>
                <div class="media-timeline">
                    <p>2015</p>
                </div>
            </div>
        </div>
    </section>
    <!-- meet us -->
    <section class="meet-us">
        <div class="container">
            <!-- Media 2018 -->
            <div id="year_2018" class="media_year">

                <!--Media 2018-->
                <div class="container">
                    <h2>September 2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="img/media/thestatesman.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Internet: A boon or a bane?</h4>
                                <p>For most of us internet has become the way of living. A single day without internet seems impossible. We have unknowingly but willingly become slaves to the modern day technology.</p>
                                <a target="_blank" href="http://epaper.thestatesman.com/1802145/Voices/6th-September-2018#page/2/1" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="img/media/theeconomics-times.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Say 'no' to hair woes!</h4>
                                <p>As people are getting busy with their hectic work schedule - with little to no time left for self-care and pampering - hair fall is increasingly becoming a common problem. The problem arises due to extreme levels of stress</p>
                                <a target="_blank" href="https://timesofindia.indiatimes.com/life-style/beauty/say-no-to-hair-woes/articleshow/65770255.cms?utm_campaign=andapp&utm_medium=referral&utm_source=whatsapp.com&from=mdr" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/thehindu-businessline.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Diagnostic firm Healthians raises ₹20 cr</h4>
                                <p>Diagnostic and wellness start-up Healthians on Monday said it has raised $3 million (nearly ₹20 crore) in Series A round of funding led by Japanese early-stage investor Beenext. Digital Garage and Beenos also took part in the round.</p>
                                <a target="_blank" href="https://www.thehindubusinessline.com/companies/diagnostic-firm-healthians-raises-20-cr/article9262530.ece" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/et-healhtworld.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Business to customer healthcare model reduced cost by 40%: Healthians’ CEO</h4>
                                <p>Launched in February 2015, online diagnostic startup Healthians is now targeting much higher growth with current revenue run rate of over 40 crore in FY 18-19. Yuvraj Singh-backed company claims to have witnessed fourfold growth in 2016 and had a similar growth in 2017 with 258% surge in revenues along with operational and marketing level profitability.</p>
                                <a target="_blank" href="https://health.economictimes.indiatimes.com/news/health-it/business-to-customer-healthcare-model-reduced-cost-by-40-healthians-ceo/65810788" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/et-rise.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Healthians to invest $5 million in marketing</h4>
                                <p>Doorstep health test provider Healthians is looking to invest $5 million in a bid to expand its user base and add upto 1 million users. The investment will be made towards marketing the firm for which Healthians has roped in its investor, cricketer Yuvraj Singh to feature in the advertising campaign.</p>
                                <a target="_blank" href="https://economictimes.indiatimes.com/small-biz/startups/newsbuzz/healthians-to-invest-5-million-in-marketing/articleshow/65885941.cms?from=mdr" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>
                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/sentinelassam.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>A Heart that Protects All, Needs Care</h4>
                                <p>A woman, a “care giver”, whose health is often neglected by her or by others, is always on the edge of health disorders. She tends to forget about looking after herself, while taking care of others. Consequently, she becomes more susceptible to several health hazards. </p>
                                <a target="_blank" href="https://www.sentinelassam.com/news/a-heart-that-protects-all-needs-care/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>August 2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/amarujala.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>डॉक्टर की सलाह, सही जांच और जागरूकता से संभव है घातक बीमारी की रोकथाम</h4>
                                <p>पिछले कुछ सालों में डेंगू और चिकनगुनिया की देहशत बहुत बढ़ गयी हैं। दोनों ही बीमारियों के एक जैसे लक्षण होने की वजह से अक्सर बीमारी की सही पहचान करना मुश्किल हो जाता हैं। बुखार और कमजोरी सबसे आम लक्षण हैं। </p>
                                <a target="_blank" href="https://www.amarujala.com/delhi-ncr/how-to-safe-for-chikungunya-symptoms-diagnosis-and-treatment" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/aajtak-indiatoday.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>पाचन से जुड़ीं ये समस्याएं कर सकती हैं परेशान, बरतें सावधानी</h4>
                                <p>गर्मी में पेट से जुड़ी कई परेशानियां सामने आती हैं. जैसे-जैसे मौसम गर्म होता है, हमारी लाइफस्टाइल और खानपान की आदतें बदलने लगती हैं. मौसम के बढ़े हुए तापमान से न केवल हमें पसीना ज्यादा होता है, बल्कि इससे हमारी प्रतिरक्षा शक्ति भी कमजोर होती है.</p>
                                <a target="_blank" href="https://aajtak.intoday.in/story/stomach-relataed-problems-may-be-dangerous-tpra-1-1020959.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Sugar-free, calorie free: Artificial sweeteners may not help with weight loss</h4>
                                <p>If you feel artificial sweeteners are a perfect substitute to sugar, you might want to think again. Marketed as ‘sugar-free’ or ‘diet option’, artificial sweeteners - commonly found in a variety of food and beverages, including soft drinks, chewing gum, jellies - give a person the same pleasure as sugar but reduce the calories.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/sugar-free-calorie-free-artificial-sweeteners-may-not-help-with-weight-loss/story-KDrFmPQ6V2FTFpO9uAMQFM.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/menshealth.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>5 Health Benefits Of Fish Oil</h4>
                                <p>The World Health Organization (WHO) recommends eating 1–2 portions of fish per week. This is because the omega-3 fatty acids in fish provide multiple health benefits and are believed to help in the prevention of many cardiovascular, skin and psychological disorders.</p>
                                <a target="_blank" href="https://www.menshealthindia.com/article/5-health-benefits-fish-oil" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/thehealthsite.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Chikungunya Vs Dengue: Understanding the difference between the two</h4>
                                <p>Dengue and Chikungunya. Moreover, with no vaccine or medicine to prevent them and reports of hospitals packed with patients, the only key to prevention is awareness. Here Dr Dhrity Vats, Healthians, explains the difference between the two.</p>
                                <a target="_blank" href="https://www.thehealthsite.com/news/chikungunya-vs-dengue-understanding-the-difference-between-the-two-d0818/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/mailtoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Insomnia</h4>
                                <p>Millennials are turning into night owls as they catch up with their dose of web series & obsessively ise social media. Here are the way to beat insomnia no matter </p>
                                <a target="_blank" href="http://epaper.mailtoday.in/m5/1783701/Mail-Today/Mail-Today,-Monday,-August,-20,-2018#page/20/1" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>July 2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/popxo.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>इन 5 डाइट टिप्स से रखें लीवर स्वस्थ</h4>
                                <p>शरीर के हर अंग की तरह लीवर (liver) का भी अपना महत्व होता है। शरीर के अंदर जाने वाली हर चीज़ को लीवर गार्ड करता है। वहीं से तय होता है कि वह चीज़ व्यक्ति के लायक है या नहीं पर अपनी ड्यूटी निभाते- निभाते कभी- कभी लीवर भी थक जाता है। वर्ल्ड हेपेटाइटिस डे के मौके पर हेल्दियंस की वेलनेस कंसल्टेंट डॉ. पूजा चौधरी से जानिए खाने की 5 ऐसी चीज़ों के बारे में, जिनसे लीवर स्वस्थ रह सके। थकान, कमजोरी, सिर दर्द, बदन दर्द व दूसरी स्वास्थ्य समस्याओं से बचने के लिए खानपान को बदल कर इन चीज़ों को डाइट में शामिल करें। </p>
                                <a target="_blank" href="https://hindi.popxo.com/2018/07/5-food-items-to-keep-liver-clean-and-healthy-in-hindi/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Hitting the gym is not enough. These 5 things are also necessary to keep fit</h4>
                                <p>While it's a good idea to stop being lazy and start working out, there are certain rules you need to follow to ensure you only reap the benefits of your hopefully regular fitness regime. Being careless about seemingly small and simple things can deteriorate your health instead of helping you achieve your fitness goal. Experts in the city compile a list of things you should do and some you shouldn't while opting to work out.</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/hitting-the-gym-is-not-enough-these-5-things-are-also-necessary-to-keep-fit-1275482-2018-07-02" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>
                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Health benefits of cocoa, here are 8 reasons why it is good for skin care, cancer and more</h4>
                                <p>Cocoa, the brown coloured powder is truly a miracle of nature, feel experts who also say that it is full of abundant goodness and health benefits and is one of the best medicinal foods available to man Meenu Beri, MD (path) HOD Hematology, Cytopathology and Clinical Pathology, Lifeline Laboratory and Palak Mathur, Dietician, Healthians at home diagnostic service provider, list the various benefits of cocoa.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/health/8-cocoa-benefits-for-skin-care-constipation-cancer-and-more/story-ANg5pBZPlmLVkBQIQwkXxN.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Surviving monsoon: Here's all you need to know</h4>
                                <p>While you might rejoice and try to soak up the rain this monsoon, keep in mind the toll it can take on your health. The weather conditions are conducive for the growth of many microorganisms, besides the stomach bug and plethora of serious ailments you could get due to poor hygiene, eating out and being careless.</p>
                                <a target="_blank" href="https://www.indiatoday.in/mail-today/story/surviving-the-monsoon-here-s-all-you-need-to-know-1293099-2018-07-23" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/bindugopalrao.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Debunking food myths</h4>
                                <p>While there is more and more talk of food and nutrition, food myths abound. Here is the truth from experts in the field. There is a huge buzz surrounding the word nutrition today. Alongside, theories abound as to what make good food habits and what don’t. In addition, there is research that often contradicts itself, with one research saying carbs are bad and another one saying carbs are essential. The result is a whole lot of people confused about what constitutes a good diet.</p>
                                <a target="_blank" href="http://www.bindugopalrao.com/debunking-food-myths/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/zeenews.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>वर्ल्ड हेपेटाइटिस डे : इन लक्षणों से की जा सकती है सही समय पर हेपेटाइटिस की पहचान</h4>
                                <p> हेपेटाइटिस के बारे में जानकारी बचाव का कारगर तरीका हो सकता है. हेपेटाइटिस को लेकर जागरूकता की कमी बड़ी समस्या है. ज्यादातर लोग डॉक्टर के पास तभी जाते हैं, जब लक्षण उभरने लगते हैं. अक्सर ऐसा तब होता है, जब लिवर पर वायरस का प्रभाव पड़ चुका होता है. ऐसे में लक्षणों की जानकारी और जागरूकता जान बचा सकती है. घर बैठे स्वास्थ्य जांच की सुविधा देने वाली फर्म हेल्थियंस के मेडिकल अफसर डॉ. दीपक पराशर का कहना है कि इस संक्रमण से निपटने का सबसे कारगर तरीका इसे पहचानना है. इसके लक्षणों को समझकर सही समय पर इसकी जांच किसी की जान बचा सकती है</p>
                                <a target="_blank" href="http://zeenews.india.com/hindi/health/world-hepatitis-day-thease-causes-can-be-diagnosed-hepatitis-at-the-right-time/424768" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>June 2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/business-standard.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Busting the hookah myth</h4>
                                <p>The hookah has been associated with leisurely activities for centuries. A really famous old tradition has become a huge rage nowadays and youngsters flock to hookah joints like hibernating birds without understanding the repercussions of this habit.</p>
                                <a target="_blank" href="https://www.business-standard.com/article/news-ians/busting-the-hookah-myths-118060200370_1.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/telanganatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Busting the hookah myth</h4>
                                <p>Hookah smokers can be at risk of the same health problems as cigarette smokers. The toxic substances, chemicals and poisonous gases increase the risk of several health problems.</p>
                                <a target="_blank" href="https://telanganatoday.com/busting-hookah-myths" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/sentinelassam.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Women are More Vunerable to Climate Crisis Effects</h4>
                                <p>The fact that “climate change is for real, and is here” is ubiquitous yet it is sidelined for the reasons less known to human conscience except the ignorance of the causes and impacts; and the phase of denial. The denial can be in the form of</p>
                                <a target="_blank" href="https://www.sentinelassam.com/news/women-are-more-vunerable-to-climate-crisis-effects/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>International Yoga Day: Try these 3 simple poses for stronger bones</h4>
                                <p>Yoga, since time immemorial, has been healing people. The whole world is in awe of yoga and the significant benefits that it offers. People from all the nook and crannies of the world flock to yoga classes and professionals to seek the benefits. It is not just a mere set of exercise but an entire school of physical, mental and spiritual awakening.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/international-yoga-day-try-these-3-simple-poses-for-stronger-bones/story-saRdyqmHovOQcZsYnaj9CN.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/aajtak.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>रक्तदान खुद की सेहत के लिए भी होता है फायदेमंद</h4>
                                <p>कई लोग रक्तदान करने से हिचकिचाते हैं, मगर विशेषज्ञ का कहना है कि रक्तदान करने से दिल की सेहत में सुधार, वजन नियंत्रण और बेहतर सेहत जैसे कई लाभ मिलते हैं. रक्तदान रक्तदाता के शरीर और मन दोनों पर बहुत अच्छा प्रभाव डालता है. कई लोग रक्तदान करने से हिचकिचाते हैं, मगर विशेषज्ञ का कहना है कि रक्तदान करने से दिल की सेहत में सुधार, वजन नियंत्रण और बेहतर सेहत जैसे कई लाभ मिलते हैं. रक्तदान रक्तदाता के शरीर और मन दोनों पर बहुत अच्छा प्रभाव डालता है.</p>
                                <a target="_blank" href="https://aajtak.intoday.in/story/myth-about-blood-donation-and-their-truth-tpra-1-1012491.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/ndtv.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>कभी सुना है सफेद चाय के बारे में! जानें इसके फायदे...</h4>
                                <p>चाय सर्दी के मौसम में आपके दिन को ज्यादा सक्रिय बनाती है. 3000 से अधिक किस्मों के साथ एक कप चाय दुनिया भर में पानी के बाद सबसे अधिक पिया जाने वाला पेय है. भारतीय चाय के प्रति अपने लगाव के लिए जाने जाते हैं, और सर्दियों में यह कई लोगों के लिए एक आदत बन जाती है. चाय के कई लाभ हैं. 'हेल्थियंस' की वरिष्ठ पोषण विशेषज्ञ व स्वास्थ्य सलाहकार डॉक्टर सौम्या सताक्षी ने चाय के ये लाभ बताए हैं: </p>
                                <a target="_blank" href="https://food.ndtv.com/hindi/white-tea-benefits-1856974" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>May 2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="D">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/deccan-chronicle.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Losing weight too fast puts your health at risk</h4>
                                <p>Did you know losing too much weight too fast can be harmful for your health? Losing weight is not always a euphoria moment, sometimes it can be bad for health.</p>
                                <a target="_blank" href="https://www.deccanchronicle.com/lifestyle/health-and-wellbeing/220518/losing-weight-too-fast-puts-your-health-at-risk.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/entrepreneur.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>How to be Social for Entrepreneurs Who are Introverts </h4>
                                <p>Are you an entrepreneur who is shy by nature, enjoys being in a quiet place and talk less when surrounded by people? If yes, then this article is a must-read for you. Building networks is easy for those entrepreneurs who are extroverts, but it gets little difficult for introverts to interact with people whom they have never met.</p>
                                <a target="_blank" href="https://www.entrepreneur.com/article/313879" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/newindian-express.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>What to eat to stay full during Ramzan </h4>
                                <p>For those observing Ramzan fasting, it will help to start a day with a heavy and nutritious meal so that the body feels satiated for the remaining day, suggest experts.</p>
                                <a target="_blank" href="http://www.newindian-express.com/lifestyle/health/2018/may/25/what-to-eat-to-stay-full-during-ramzan-1819318.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/millenniumpost.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Dietary dos and don'ts for Ramzan</h4>
                                <p>The holy month of Ramzan brings with it the message of brotherhood, finding beauty in the little things, being thankful for what we have and praying for those who are less fortunate. The month-long celebration includes an elaborate routine of rigorous fasting from dusk to dawn. It is a path to spiritual and physical cleansing and fasting.</p>
                                <a target="_blank" href="http://www.millenniumpost.in/features/dietary-dos-and-donts-for-ramzan-301241" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/telanganatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Embark on crash dieting wisely</h4>
                                <p>A slow and steady weight loss plan is always a good idea, but losing weight too fast means putting your health at a risk which can lead to severe issues. So, be wise about undertaking excessive exercising or going for a crash diet.</p>
                                <a target="_blank" href="https://telanganatoday.com/embark-on-crash-dieting-wisely" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/tribuneindia.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Why it’s bad to lose weight too fast</h4>
                                <p>Losing weight is not always a euphoria moment, sometimes it can be bad for health. The market is flooded with options to lose weight - crash diets, supplements, pills etc. - all promising a rapid weight transformation. “A lot of us get tempted with the lucrative promises of quick weight loss</p>
                                <a target="_blank" href="https://www.tribuneindia.com/news/life-style/why-it-s-bad-to-lose-weight-too-fast/593230.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>April 2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="D">
                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/thehindu.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>8 strategies to eat right on a work trip</h4>
                                <p>No matter how devoted you are to healthful eating, chances are that travel, especially of the work kind, throws you off. “Travelling on work means living without a routine. You wake up earlier than usual and tend to eat the wrong foods at haphazard times.</p>
                                <a target="_blank" href="https://www.thehindu.com/todays-paper/tp-features/tp-metroplus/8-strategies-to-eat-right-on-a-work-trip/article23462363.ece" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Here's how you can protect yourself from allergies this spring</h4>
                                <p>Come spring and everyone can be seen coughing and wheezing, popping pills and doing whatever possible to avoid an allergic reaction. But the increase in temperature and moisture conditions at the beginning of spring causes microbes to multiply and disperse through the air, causing allergies..</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/here-s-how-you-can-protect-yourself-from-allergies-this-spring-1207941-2018-04-09" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/mailtoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Keep spring fever at bay</h4>
                                <p>Doctors in the city spill the beans on how can survive the annual allergy fest this spring, and how not to confuse with sunusitis</p>
                                <a target="_blank" href="http://epaper.mailtoday.in/1611922/Mail-Today/Mail-Today-Issue-09.04.2018#page/21/2" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/deccan-chronicle.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Here's how too much caffeine can harm your health</h4>
                                <p>Whether dependency or addiction, the reality is that for many stopping caffeine consumption is really very difficult as most of us follow the ritual of having a steaming cup of tea or coffee in the morning. Caffeine is believed to boost mood, metabolism and mental and physical performance. But is this a caffeine myth or caffeine fact?</p>
                                <a target="_blank" href="https://www.deccanchronicle.com/lifestyle/health-and-wellbeing/210418/heres-how-too-much-caffeine-can-harm-your-health.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Can mangoes make you fat? Every good, bad and tasty side of king of fruits</h4>
                                <p>Do mangoes help in weight loss? Is it healthy to have the fruit in summers? While delicious, mangoes have long been reviled as being high on sugar and calories, and some dieticians say they make you fat. How true is the claim? Read on to know the pros and cons of mangoes.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/can-mangoes-make-you-fat-every-good-bad-and-tasty-side-of-king-of-fruits/story-2Xw9jDDsjpRzpL0RUk2UkM.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>March 2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="D">
                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/tribuneindia.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Don't let your stomach suffer this summer</h4>
                                <p>With summer comes various issues of the stomach. Not only do the high temperatures make us sweat more, it also reduces our immunity so make sure you eat eating properly this season.</p>
                                <a target="_blank" href="https://www.tribuneindia.com/news/health/don-t-let-your-stomach-suffer-this-summer/562899.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Water retention: Symptoms, causes, treatment</h4>
                                <p>We all know that approximately 70 per cent of the human body comprises of water, present both inside and outside of the cells. Our organs, muscles and even bones have high water content. Water is the essence of our existence but sometimes our body holds on to too much of it. Such excessive fluid build-up in the body leads to water retention.</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/water-retention-weight-gain-loss-cause-cure-symptoms-1196220-2018-03-23" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Parents, this is how you can deal with your kids' exam stress</h4>
                                <p>Dealing with exam stress is not difficult. Right preparation for the exams is the primary step, being confident about is another and being positive about the outcome is the most important factor. Many children and parents face exam stress because of the fear of performance and of the results..</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/exam-stress-board-exams-examinations-mental-pressure-diet-tips-tricks-1188120-2018-03-13" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustan-times.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Don’t let the heat get to you. Here are 7 tips to avoid common summer illnesses</h4>
                                <p>With the onset of summer comes various issues of the stomach. Not only does the high temperature make us sweat more, it also reduces our immunity. Kirti Chadha, Head of Global Reference laboratories, Metropolis Healthcare, says: “Summer brings a majority of digestion-related illnesses. Considering the rise in temperature every year, it is important to manage our food habits to avoid stomach illnesses.” Chadha suggests a few tips to keep your stomach healthy:</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/don-t-let-the-heat-get-to-you-here-are-7-tips-to-avoid-common-summer-illnesses/story-VjcCBUrgElOGx1HEbMqIoK.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/economictimes.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Diagnostic start-ups have created a new market of Health test at home services : Deepak Sahni</h4>
                                <p>Shahid Akhter, editor, ETHealthworld spoke to Deepak Sahni, Founder & CEO Healthians to discuss the emerging role of Start-ups in healthcare and how they are playing an instrumental role in building the non-existent preventive healthcare sector in India. Edited excerpts: Your views on unorganised & standalone players which form a substantial part of this fragmented market especially in Tier II & Tier III cities. </p>
                                <a target="_blank" href="https://health.economictimes.indiatimes.com/news/diagnostics/diagnostic-start-ups-have-created-a-new-market-of-health-test-at-home-services-deepak-sahni/63525347" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>February 2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="D">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Salt, sugar and stress: Important facts you should know about these 3 sins</h4>
                                <p>Do you often give in to the temptations of your taste buds? Indulging in that extra slice of cake, another piece of sweet, sprinkling extra salt over your food can seem completely harmless at that time but can eventually lead to various health issues.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/salt-sugar-and-stress-important-facts-you-should-know-about-these-3-sins/story-8fdD7ogaLXWQFV6fpO5pbI.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/biovoicenews.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“We were the pioneers for online diagnostics in the country</h4>
                                <p>Your everyday foods can have the weirdest reactions on the body. Saumya Satakshi, Senior Wellness Consultant at Healthians, an online diagnostic centre that offers at home services, will help us in understanding these 5 foods and their health impact in detail.</p>
                                <a target="_blank" href="https://www.biovoicenews.com/pioneers-online-diagnostics-country/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/thehealthsite.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Beware of these weird reactions from your everyday foods”</h4>
                                <p>Founded in February 2015, the Healthians.com based out of Delhi-NCR is fast emerging as one of North India’s largest online health diagnostic services provider. The brand is presently targeting patients in the 25 to 55 age bracket, living a sedentary lifestyle. In an exclusive interaction with the BioVoice News, Mr Deepak Sahni, Founder and CEO of Healthians.com shared his views on the company’s operations, challenges, opportunities and much more</p>
                                <a target="_blank" href="https://www.thehealthsite.com/fitness/diet/beware-of-these-weird-reactions-from-your-everyday-foods-f0218/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Organic colours to healthy diet: How to play it safe on Holi</h4>
                                <p>While it's the most colourful festival of all, Holi also comes with its baggage - sticking out at work due to your stained skin days after everyone is back to looking their normal selves, getting bombarded by balloons before a meeting or a gujiya overdose.</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/organic-colours-to-healthy-diet-how-to-play-it-safe-on-holi-1177687-2018-02-26" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Organic colours to healthy diet: How to play it safe on Holi</h4>
                                <p>While it's the most colourful festival of all, Holi also comes with its baggage - sticking out at work due to your stained skin days after everyone is back to looking their normal selves, getting bombarded by balloons before a meeting or a gujiya overdose.</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/organic-colours-to-healthy-diet-how-to-play-it-safe-on-holi-1177687-2018-02-26" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/popxo.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>होली के त्योहार पर कुछ इस तरह रखें सेहत का खास ख्याल</h4>
                                <p>रंगों के त्योहार होली की तैयारियां शुरू हो चुकी हैं। हम उम्मीद करते हैं कि इको फ्रेंडली सेलिब्रेशन के ज़माने में आप भी अपनी सेहत का खास ख्याल रखते होंगे। मौज-मस्ती के इस त्योहार को कुशल-मंगल बनाने के लिए ज़रूरी है कि इस दिन हंसी-खुशी सबके साथ मिला-जुला जाए।</p>
                                <a target="_blank" href="https://hindi.popxo.com/2018/02/play-safe-holi-with-organic-colors/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/ndtv.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Happy Holi 2018: केमिकल रंगों से होते हैं ये नुकसान, इन TIPS से पहचानें रंग असली है या नकली</h4>
                                <p>रंगों के खूबसूरत त्योहार होली का मजा दोगुना करने के लिए आपको कुछ खास टिप्स बता रहे हैं, जिन्हें फॉलो कर आपकी ये होली सुरक्षित होली बन सकती है. क्योंकि कई बार होली खेलने के दौरान एलर्जी, जलन, बालों का खराब होना जैसी दिक्कतों का सामना करना पड़ता है. इसी कारण हेल्थियंस की वरिष्ठ लाइफस्टाइल मैनेजमेंट कन्सल्टेंट डॉ. स्नेहल सिंह होली के जश्न से जुड़े कुछ स्वास्थ्य संबंधी जोखिम और उनसे बचने के तरीके बता रहे हैं</p>
                                <a target="_blank" href="https://khabar.ndtv.com/news/lifestyle/holi-2018-organic-colors-skin-hair-care-tips-1817553" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/deccanchronicle.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Monitoring blood sugar conditions regularly could improve diabetics' health</h4>
                                <p>"Regular monitoring has a huge psychological impact that motivates a person to take action," said Dr Walia Murshida Huda, Head of Wellness Team at Healthians. "Tracking acts like a reminder. It alerts and prompts a person to do more for their health. Lifestyle changes and dietary control can effectively reverse diabetes," Huda said.</p>
                                <a target="_blank" href="https://www.deccanchronicle.com/lifestyle/health-and-wellbeing/270218/monitoring-blood-sugar-conditions-regularly-could-improve-diabetics-h.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/livehindustan.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>मिलेनियम सिटी में 33 फीसदी मरीज डायबिटिज से पीड़ित</h4>
                                <p>मिलेनियम सिटी के लोगों के स्वास्थ्य स्तर में तेजी से गिरावट आ रही है। इसके कारण शहर की बड़ी आबादी मधुमेह की चपेट में आ रही है। आंकड़ों के मुताबिक शहर के 33 फीसदी लोग मधुमेह से पीड़ित हैं। जबकि 16 फीसदी लोगों प्री-डायबिटिक की चपेट में हैं। स्वास्थ्य विभाग के सहयोग से हेल्थीयंस ने लोगों की स्वास्थ्य जांच की है। शहर के 90 हजार लोगों के एचबीए1सी और ग्लूकोज टॉलरेंस टेस्ट किए गए</p>
                                <a target="_blank" href="https://www.livehindustan.com/ncr/gurgaon/story-33-percent-of-patients-in-millennium-city-suffer-from-diabetes-1828921.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/livehindustan.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>होली के रंग त्यौहार को न कर दें बदरंग</h4>
                                <p>होली के रंग और खान पान का ढंग त्यौहार को बदरंग न कर दें। होली की मस्ती के बीच रंगों व खान-पान का विशेष ध्यान रखें। रंगों में इस्तेमाल होने वाले केमीकल त्वाचा को नुकसान पहुंचा सकते हैं। इसके अलावा श्वांस संबंधी और आंखों की बीमारी का कारण बन सकते हैं। डॉक्टरों के मुताबिक होली के रंग अक्सर केमिकल से बनाए जाते हैं। और इनसे कुछ लोगों को ऐलर्जिक रिएक्शन हो सकते हैं।</p>
                                <a target="_blank" href="https://www.livehindustan.com/ncr/gurgaon/story-do-not-let-the-colors-of-holi-be-celebrated-1828746.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/livehindustan.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>बोर्ड एक्जाम्स की टेंशन? बच्चों को ऐसे करें तैयार</h4>
                                <p>परीक्षा की तैयारी के समय डर कैसे कम किया जा सकता है यह जानना जरूरी है। हिन्दुस्तान से बातचीत में परीक्षा के तनाव को कम करने के ट्रिक्स बता रही हैं डॉ. स्नेहल सिंह (वरिष्ठ लाइफस्टाइल मैनेजमेंट कन्सल्टेंट, हेल्थियंस)।</p>
                                <a target="_blank" href="https://www.livehindustan.com/career/story-tips-remove-examinations-tension-1824652.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/deccanchronicle.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Monitoring blood sugar conditions regularly could improve diabetics' health</h4>
                                <p>"Regular monitoring has a huge psychological impact that motivates a person to take action," said Dr Walia Murshida Huda, Head of Wellness Team at Healthians. "Tracking acts like a reminder. It alerts and prompts a person to do more for their health. Lifestyle changes and dietary control can effectively reverse diabetes," Huda said.</p>
                                <a target="_blank" href="https://www.deccanchronicle.com/lifestyle/health-and-wellbeing/270218/monitoring-blood-sugar-conditions-regularly-could-improve-diabetics-h.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>January  2018</h2>
                    <img class="center-block underline-img" src="/img/underline.png" alt="D">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/economictimes.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Medical expenses burning a hole in your pocket? Here's why correct diagnosis is important </h4>
                                <p>When it comes to medical care, no one wants to compromise. Everyone wants to avail the best possible facilities as per their capacity. But in an era where medical expenses and complications are mounting with each passing day and news of malpractices by even the best names in the industry have become an almost daily affair, the customer should be aware of the various possibilities of malpractices in the diagnostic process also</p>
                                <a target="_blank" href="https://economictimes.indiatimes.com/magazines/panache/medical-expenses-burning-a-hole-in-your-pocket-heres-why-correct-diagnosis-is-important/articleshow/62352094.cms" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/tribuneindia.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Must-take fitness resolutions 
                                </h4>
                                <p>A few basic lifestyle changes can bring a long-lasting desired difference for a healthier and happier you, suggest experts. Saumya Satakshi, senior Wellness Consultant, Healthians, shared the following tips: </p>
                                <a target="_blank" href="https://www.tribuneindia.com/news/life-style/must-take-fitness-resolutions/530566.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Remedies to common ailments that you can make using ingredients in the kitchen</h4>
                                <p>It's that time of the year when everyone is falling prey to the flu. While the working individual dilly-dallies when it comes to going to the doctor, choosing to follow advice from the internet instead, experts in the city list out some homeremedies that actually work. And some myths that you shouldn't try out. </p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/home-remedies-common-ailments-cures-make-using-ingredients-kitchen-lifest-1151252-2018-01-22" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/business-standard.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Are you being diagnosed correctly?</h4>
                                <p>When it comes to medical care, no one wants to compromise. Everyone wants to avail the best possible facilities as per their capacity. But in an era where medical expenses and complications are mounting with each passing day and news of malpractices by even the best names in the industry have become an almost daily affair, the customer should be aware of the various possibilities of malpractices in the diagnostic process also. After all, correct diagnosis is the first step towards correct treatment.</p>
                                <a target="_blank" href="https://www.business-standard.com/article/news-ani/are-you-being-diagnosed-correctly-118010300170_1.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Take these 6 easy fitness resolutions to make 2018 your healthiest year</h4>
                                <p>A few basic lifestyle changes can bring a long-lasting desired difference for a healthier and happier you, suggest experts. Saumya Satakshi, Senior Wellness Consultant, Healthians, shared the following tips:</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/take-these-6-easy-fitness-resolutions-to-make-2018-your-healthiest-year/story-BrxOLR4nvJP5cU0Q1UtrIN.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                </div>
                <!--Media 2018 Ends-->

            </div>

            <!-- Media 2017 -->
            <div id="year_2017" class="media_year">

                <div class="container">
                    <h2>December 2017</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="Icon">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/economics-times.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Can't do without your morning cup? Here are the health benefits of drinking tea</h4>
                                <p>Waking up on a chilly morning to a hot cup of tea is definitely the best way to start your day and why not after all it has many health benefits too. Dhrity Vats, Senior Wellness Consultant at online diagnostic center Healthians lists down some of the health befits of different varieties of tea</p>
                                <a target="_blank" href="https://economictimes.indiatimes.com/magazines/panache/cant-do-without-your-morning-cup-here-are-the-health-benefits-of-drinking-tea/articleshow/62096577.cms" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/business-standard.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Be friends with tea for health benefits</h4>
                                <p>Waking up on a chilly morning to a hot cup of tea is definitely the best way to start your day and why not after all it has many health benefits too. Dhrity Vats, Senior Wellness Consultant at online diagnostic center Healthians lists down some of the health befits of different varieties of tea</p>
                                <a href="https://www.business-standard.com/article/news-ians/be-friends-with-tea-for-health-benefits-117121600445_1.html" target="_blank" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indian-express.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Be friends with tea for health benefits</h4>
                                <p>Tea helps in treating serious diseases like cancer, heart disease, stroke, and high blood pressure but can also affect the human body in several ways, causing insomnia, nervousness, and irregularities in heart rate. Waking up on a chilly morning to a hot cup of tea is definitely the best way to start your day</p>
                                <a target="_blank" href="https://indian-express.com/article/lifestyle/health/be-friends-with-tea-for-health-benefits-4985685/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/the-statesman.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Be friends with tea for health benefits</h4>
                                <p>Waking up on a chilly morning to a hot cup of tea is definitely the best way to start your day and why not after all it has many health benefits too. Dhrity Vats, Senior Wellness Consultant at online diagnostic center Healthians lists down some of the health befits of different varieties of tea</p>
                                <a target="_blank" href="https://www.thestatesman.com/lifestyle/friends-tea-health-benefits-1502546260.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/bw-disrupt.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>What to Expect in 2018 in HealthTech?</h4>
                                <p>Healthcare as an industry focuses on improvement and innovation. Hospitals, medical practioners, diagnostics, pharmacy and insurance are all centred on improving the health quotient of individuals, their services and customer satisfaction. Innovation in health systems across all verticals with the use of technology.</p>
                                <a target="_blank" href="http://bw-disrupt.businessworld.in/article/What-to-Expect-in-2018-in-HealthTech-/23-12-2017-135522/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/asian-age.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Managing the balancing act</h4>
                                <p>With women getting back on track with their careers soon after they give birth, we ask them and life coaches about how to juggle the demands of motherhood and careers at the same time. Tennis star Serena Williams’ pregnancy has been much talked about, first when she won the Australian Open while still pregnant.</p>
                                <a target="_blank" href="http://www.asianage.com/life/more-features/261217/managing-the-balancing-act.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/popxo.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>सर्दियों में रखें अपनी हैल्थ का खास ख्याल</h4>
                                <p>सर्दियों में अकसर लोग हैल्थ के प्रति लापरवाह हो जाते हैं। यह सच है कि ठंड में रजाई-कंबल से बाहर निकलने की इच्छा किसी की भी नहीं करती है पर उससे बड़ा सच यह है कि अकसर इस मौसम में ही लोग जोड़ों में दर्द आदि समस्याओं से पीड़ित होते हैं। लाइफस्टाइल में थोड़ा बदलाव कर हर समस्या से बचा जा सकता है। हैल्दियंस की सीनियर वेलनेस कंसल्टेंट डॉ. धृति वत्स बता रही हैं कुछ ऐसे टिप्स, जिनसे आप इस मौसम में सेहतमंद और खुश रह सकते हैं।</p>
                                <a target="_blank" href="https://hindi.popxo.com/2017/12/tips-to-keep-yourself-healthy-in-winter/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>November 2017</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/bw-disrupt.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Yuvraj Singh Backed Healthians Launches Its Services in Lucknow & Kanpur</h4>
                                <p>Currently based out of Delhi-NCR, the company has an extensive growth plan to expand to the other major cities including Mumbai, Bengaluru, and create a marked presence in North & West India and other identified Tier II cities by end of the current financial year.</p>
                                <a target="_blank" href="http://bw-disrupt.businessworld.in/article/Yuvraj-Singh-Backed-Healthians-Launches-Its-Services-in-Lucknow-Kanpur/21-11-2017-132280/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/biztech-post.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Healthians launches its services in Lucknow and Kanpur</h4>
                                <p>Expedient Healthcare Marketing Pvt. Ltd, which runs online diagnostics and wellness startup Healthians.com has recently launched its services in Lucknow and Kanpur. Headquartered in Gurugram and backed with an experience of serving over 5,00,000 families in Delhi NCR in last 2 years, the company is now spreading its reach to Tier 2 cities</p>
                                <a target="_blank" href="https://www.biztechpost.com/healthians-launches-its-services-in-lucknow-and-kanpur/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustan-times.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Can you be a ‘healthy obese’? Do kids outgrow baby fat? 10 myths about obesity busted</h4>
                                <p>Many of your notions about weight-related problems may be inaccurate. For example, some people claim to be obese but healthy. However, research shows that so-called ‘metabolically healthy’ obese people are still at higher risk of cardiovascular disease events such as heart failure or stroke than normal weight people.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/can-you-be-a-healthy-obese-do-kids-outgrow-baby-fat-10-myths-about-obesity-busted/story-OabKR9AD4AuEXCiDy8BQKO.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/theeconomics-times.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>If you think you are 'healthy obese', you may be wrong</h4>
                                <p>Have you heard of healthy obese? Wondering if there are healthy obese people too? Research shows that so-called 'metabolically healthy' obese people are still at higher risk of cardiovascular disease events such as heart failure or stroke than normal weight people.</p>
                                <a target="_blank" href="https://economictimes.indiatimes.com/magazines/panache/if-you-think-you-are-healthy-obese-you-may-be-wrong/articleshow/61821497.cms" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/deccan-chronicle.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Metabolically healthy obese people at higher risk of heart disease</h4>
                                <p>Have you heard of healthy obese? Wondering if there are healthy obese people too? Research shows that so-called 'metabolically healthy' obese people are still at higher risk of cardiovascular disease events such as heart failure or stroke than normal weight people.</p>
                                <a target="_blank" href="https://www.deccanchronicle.com/lifestyle/health-and-wellbeing/271117/metabolically-healthy-obese-people-at-higher-risk-of-heart-disease.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/yahoo.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>`Healthy obese` may be just a myth</h4>
                                <p>Have you heard of healthy obese? Wondering if there are healthy obese people too? Research shows that so-called 'metabolically healthy' obese people are still at higher risk of cardiovascular disease events such as heart failure or stroke than normal weight people.</p>
                                <a target="_blank" href="https://in.news.yahoo.com/healthy-obese-may-just-myth-225723200.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/outlook.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>`Healthy obese` may be just a myth</h4>
                                <p>Have you heard of healthy obese? Wondering if there are healthy obese people too? Research shows that so-called 'metabolically healthy' obese people are still at higher risk of cardiovascular disease events such as heart failure or stroke than normal weight people.</p>
                                <a target="_blank" href="https://www.outlookindia.com/newsscroll/healthy-obese-may-be-just-a-myth/1196917" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/asian-age.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>`Healthy obese` may be just a myth</h4>
                                <p>Have you heard of healthy obese? Wondering if there are healthy obese people too? Research shows that so-called 'metabolically healthy' obese people are still at higher risk of cardiovascular disease events such as heart failure or stroke than normal weight people.</p>
                                <a target="_blank" href="http://www.asianage.com/life/health/271117/healthy-obese-may-be-just-a-myth.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/theeconomics-times.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Here's how you can fight air pollution</h4>
                                <p>Delhi's air pollution level has hit a new high this winter, leaving its people grasping for breath. The smog that blankets the city is a result of high air pollution combined with no-wind cold weather conditions. "With little or no signs of improvement, we, on an individual level, have to find ways to beat it," says Dr. Walia Murshida Huda, (Senior Medical Officer, Healthians, MBBS, MBA (H.C.A), FICM Walia.</p>
                                <a target="_blank" href="https://economictimes.indiatimes.com/magazines/panache/heres-how-you-can-fight-air-pollution/articleshow/61701827.cms" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/outlook.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Here's how you can fight air pollution</h4>
                                <p>Delhi's air pollution level has hit a new high this winter, leaving its people grasping for breath. The smog that blankets the city is a result of high air pollution combined with no-wind cold weather conditions. "With little or no signs of improvement, we, on an individual level, have to find ways to beat it," says Dr. Walia Murshida Huda, (Senior Medical Officer, Healthians, MBBS, MBA (H.C.A), FICM Walia.</p>
                                <a target="_blank" href="https://www.outlookindia.com/newsscroll/heres-how-you-can-fight-air-pollution/1190684" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/yahoo.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Here's how you can fight air pollution</h4>
                                <p>Delhi's air pollution level has hit a new high this winter, leaving its people grasping for breath. The smog that blankets the city is a result of high air pollution combined with no-wind cold weather conditions. "With little or no signs of improvement, we, on an individual level, have to find ways to beat it," says Dr. Walia Murshida Huda, (Senior Medical Officer, Healthians, MBBS, MBA (H.C.A), FICM Walia.</p>
                                <a target="_blank" href="https://in.news.yahoo.com/heres-fight-air-pollution-112751724.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Diabetes Day: Keep your sugar levels under control with regular exercise</h4>
                                <p>Among all the ways you can keep your diabetes in check, working out is one of the best. There is a strong link between exercise and sugar levels in diabetes. Basic lifestyle changes and regular exercise can help you manage diabetes. Ranging from sugar control to weight management, staying active offers great benefits.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/world-diabetes-day-keep-your-sugar-levels-under-control-by-regular-exercise/story-fLLjETuRECJ3gq81BGtoeP.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/business-standard.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Fighting with diabetes? Staying active is what you need</h4>
                                <p>Among all the ways you can keep your diabetes in check, working out is one of the best. There is a strong link between exercise and sugar levels in diabetes. Basic lifestyle changes and regular exercise can help you manage diabetes. Ranging from sugar control to weight management, staying active offers great benefits.</p>
                                <a target="_blank" href="https://www.business-standard.com/article/news-ani/fighting-with-diabetes-staying-active-is-what-you-need-117111400253_1.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/abp-live.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Fighting with diabetes? Staying active is what you need</h4>
                                <p>World diabetes day is celebrated each year on November 14. There is a strong link between exercise and sugar levels in diabetes. Basic lifestyle changes and regular exercise can help you manage diabetes. Ranging from sugar control to weight management, staying active offers great benefits.</p>
                                <a target="_blank" href="https://www.abplive.in/world-news/fighting-with-diabetes-staying-active-is-what-you-need-603689?ani" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/outlookindia.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Fighting with diabetes? Staying active is what you need</h4>
                                <p>World diabetes day is celebrated each year on November 14. There is a strong link between exercise and sugar levels in diabetes. Basic lifestyle changes and regular exercise can help you manage diabetes. Ranging from sugar control to weight management, staying active offers great benefits.</p>
                                <a target="_blank" href="https://www.outlookindia.com/newsscroll/fighting-with-diabetes-staying-active-is-what-you-need/1187802" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>October 2017</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/free-press-journal.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>International Coffee Day: The dark secrets of coffee revealed</h4>
                                <p>Don’t we all just love that dark, strong coffee right after getting up in the morning? Since time unknown coffee has been our favourite beverage while we catch up with old friends or go for a date. Coffee has been a part of our daily routine.</p>
                                <a target="_blank" href="http://www.freepressjournal.in/featured-blog/international-coffee-day-the-dark-secrets-of-coffee-revealed/1146013" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/india-today.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Eggs don't cause high cholesterol: Cracking 8 common myths about eggs</h4>
                                <p>"Research has proven that, as opposed to the previous beliefs, eggs are actually good for health. Researchers have looked at the diets of people, and they have suggested that consuming eggs every day is not associated with cholesterol problems or heart disease.</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/eggs-health-myths-busted-facts-nutrition-cholesterol-protein-salmonella-lifest-1063901-2017-10-13" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/ndtv.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Egg Day: 5 Common Egg Myths Busted</h4>
                                <p>Happy World Egg Day! World Egg Day was established at the IEC Vienna 1996 conference when it was decided to celebrate World Egg Day on the second Friday in October each year. The day is dedicated to help raise awareness of the many health benefits of eggs, you know what will rescue you out of the crisis- Eggs, of course! Scrambled, boiled, half fried or poached if you have eggs</p>
                                <a target="_blank" href="https://www.ndtv.com/food/world-egg-day-5-common-egg-myths-busted-1762372" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indian-express.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Cracking egg myths</h4>
                                <p>Eggs can help in protecting our eyes with age-related blindness because of the various kinds of nutrients they are loaded with. Both white and brown have the same nutritional values and are healthy. Winter is set to knock on doors soon so its time to get your dose of eggs on a regular basis. Go for it without holding yourself back.</p>
                                <a target="_blank" href="https://indian-express.com/article/lifestyle/health/cracking-egg-myths-4887158/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/free-press-journal.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>How medical technology is opening new possibilities</h4>
                                <p>Technology for the layman means anything which improves quality of product offering, or saves time, or reduces cost, compared to the current standards. Healthcare, right from the time of quack medicines, raw roots and witchcraft spells, has had an aura of mystique around it. It has not been easy to apply mathematical parameters to this field, but with technology</p>
                                <a target="_blank" href="https://www.freepressjournal.in/ucretail/how-medical-technology-is-opening-new-possibilities/1155090" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/business-standard.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Stroke Day: Effects and causes</h4>
                                <p>World Stroke Day is observed on the October 29, each year. Stroke, the most commonly heard reason of mortality in India after road accidents, is a condition where the brain does not receive enough oxygen or nutrients, causing brain cells to die. Researches show that India will report almost 1.6 million cases of stroke annually</p>
                                <a target="_blank" href="http://www.business-standard.com/article/news-ani/world-stroke-day-effects-and-causes-117102800445_1.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/outlook.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Stroke Day: Effects and causes</h4>
                                <p>World Stroke Day is observed on the October 29, each year. Stroke, the most commonly heard reason of mortality in India after road accidents, is a condition where the brain does not receive enough oxygen or nutrients, causing brain cells to die. Researches show that India will report almost 1.6 million cases of stroke annually by 2020 out of which one third would be disabled.</p>
                                <a target="_blank" href="https://www.outlookindia.com/newsscroll/world-stroke-day-effects-and-causes/1176412" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/yahoo.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Stroke Day: Effects and causes</h4>
                                <p>World Stroke Day is observed on the October 29, each year. Stroke, the most commonly heard reason of mortality in India after road accidents, is a condition where the brain does not receive enough oxygen or nutrients, causing brain cells to die. Researches show that India will report almost 1.6 million cases of stroke annually by 2020 out of which one third would be disabled.</p>
                                <a target="_blank" href="https://in.news.yahoo.com/world-stroke-day-effects-causes-102611958.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/yahoo.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>#WorldStrokeDay2017: Recognise these signs of stroke and act quickly</h4>
                                <p>World Stroke Day is observed on the October 29, each year. Stroke, the most commonly heard reason of mortality in India after road accidents, is a condition where the brain does not receive enough oxygen or nutrients, causing brain cells to die.</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/health/story/world-stroke-day-brain-stroke-confusion-trouble-speaking-headache-nausea-vomiting-balance-problems-lifest-1071269-2017-10-29" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Stroke Day: All you need to know about warning signs, causes, treatment</h4>
                                <p>Stroke is the most commonly heard reason of mortality in India after road accidents. It is a condition where the brain does not receive enough oxygen or nutrients, causing brain cells to die. Researches show that India will report almost 1.6 million cases of stroke annually by 2020 out of which one third would be disabled.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/world-stroke-day-everything-you-need-to-know-about-warning-signs-causes-treatment/story-ld1PttjgKwZl4PEdRUiajL.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/deccanchronicle.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Stroke Day: Ways to prevent a stroke</h4>
                                <p>World Stroke Day is observed on the October 29, each year. Stroke, the most commonly heard reason of mortality in India after road accidents, is a condition where the brain does not receive enough oxygen or nutrients, causing brain cells to die.</p>
                                <a target="_blank" href="https://www.deccanchronicle.com/lifestyle/health-and-wellbeing/291017/world-stroke-day-ways-to-prevent-a-stroke.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>September 2017</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Bad breath to body odour, here's how you can tackle awkward ailments</h4>
                                <p>Bad breath, body odour, unwanted hair growth and 'moobs' are some of the few health problems many suffer from, but people usually don't get looked or like to talk about, because of the embarrassment that comes with them. The one deal-breaker for many is if their date has bad breath.</p>
                                <a target="_blank" href="https://www.indiatoday.in/lifestyle/wellness/story/bad-breath-body-odour-embarassing-diseases-tips-cause-hygiene-wellness-lifest-1037450-2017-09-04" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indian-express.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Surprising reasons why you are not losing weight</h4>
                                <p>Many people complain that they are eating less but not losing weight. A few others say they are exercising but not losing weight on scales and if you are one of them then you need to take a closer look at it and find the reasons. Walia Murshida Huda, Senior Wellness Consultant at Healthians and Angeli Misra, co-founder of Lifeline Laboratory, shared possible reasons why you are not losing weight.</p>
                                <a target="_blank" href="https://indian-express.com/article/lifestyle/surprising-reasons-why-you-are-not-losing-weight-4834504/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/business-standard.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Surprising reasons why you are not losing weight</h4>
                                <p>Many people complain that they are eating less but not losing weight. A few others say they are exercising but not losing weight on scales and if you are one of them then you need to take a closer look at it and find the reasons. Walia Murshida Huda, Senior Wellness Consultant at Healthians and Angeli Misra, co-founder of Lifeline Laboratory, shared possible reasons why you are not losing weight.</p>
                                <a target="_blank" href="https://www.business-standard.com/article/news-ians/surprising-reasons-why-you-are-not-losing-weight-117090701003_1.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/hindustantimes.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Heart Day: Make these simple changes in your eating habits to avoid high cholesterol</h4>
                                <p>“A healthy heart means a healthy life, yet most of us ignore our heart health. With two million heart attack cases in India in a year; it kills one Indian every 33 seconds. Though this is undeniably alarming, luckily, there are preventive measures to keep your heart healthy,” says Dr Bhaskar, senior consultant, cardiologist, Healthians.</p>
                                <a target="_blank" href="https://www.hindustantimes.com/fitness/world-heart-day-make-these-simple-changes-in-your-eating-habits-to-avoid-high-cholesterol/story-xvK8npcU6hCd6Hf7bfvpHK.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/asian-age.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Eating habits can help us avoid high cholesterol issues</h4>
                                <p>"A healthy heart means a healthy life, yet most of us ignore our heart health. With two million heart attack cases in India in a year; it kills one Indian every 33 seconds. Though this is undeniably alarming, luckily, there are preventive measures to keep your heart healthy", says Dr. Bhaskar, Senior Consultant, Cardiologist, Healthians.</p>
                                <a target="_blank" href="http://www.asianage.com/life/health/290917/eating-habits-can-help-us-avoid-high-cholesterol-issues.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/outlook.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Eating habits can help us avoid high cholesterol issues</h4>
                                <p>"A healthy heart means a healthy life, yet most of us ignore our heart health. With two million heart attack cases in India in a year; it kills one Indian every 33 seconds. Though this is undeniably alarming, luckily, there are preventive measures to keep your heart healthy", says Dr. Bhaskar, Senior Consultant, Cardiologist, Healthians.</p>
                                <a target="_blank" href="https://www.outlookindia.com/newsscroll/eating-habits-can-help-us-avoid-high-cholesterol-issues/1156864" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/abplive.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Eating habits can help us avoid high cholesterol issues</h4>
                                <p>"A healthy heart means a healthy life, yet most of us ignore our heart health. With two million heart attack cases in India in a year; it kills one Indian every 33 seconds. Though this is undeniably alarming, luckily, there are preventive measures to keep your heart healthy", says Dr. Bhaskar, Senior Consultant, Cardiologist, Healthians.</p>
                                <a target="_blank" href="https://www.abplive.in/world-news/eating-habits-can-help-us-avoid-high-cholesterol-issues-586218?ani" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/deccanchronicle.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>World Heart Day: High cholesterol issues leading cause of heart attacks in India</h4>
                                <p>"A healthy heart means a healthy life, yet most of us ignore our heart health. With two million heart attack cases in India in a year; it kills one Indian every 33 seconds. Though this is undeniably alarming, luckily, there are preventive measures to keep your heart healthy", says Dr. Bhaskar, Senior Consultant, Cardiologist, Healthians.</p>
                                <a target="_blank" href="https://www.deccanchronicle.com/lifestyle/health-and-wellbeing/290917/world-heart-day-high-cholesterol-issues-leading-cause-of-heart-attacks-in-india.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>August 2017</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indiatoday.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Smartphone app can predict disease risk based on health inputs</h4>
                                <p>A new smartphone app, developed by a Gurgaon-based start-up, can provide smart reports that may predict the users risk of diseases and expose hidden disorders based on their symptoms and lifestyle inputs. The app, called Healthians, allows users to log their basic body vitals like blood pressure, weight and sugar levels as well as maintain a depository of all their test reports for future reference.</p>
                                <a target="_blank" href="https://www.indiatoday.in/pti-feed/story/smartphone-app-can-predict-disease-risk-based-on-health-inputs-1011917-2017-08-08" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/indian-express.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Smartphone app can predict disease risk based on health inputs</h4>
                                <p>A new smartphone app, developed by a Gurgaon-based start-up, can provide smart reports that may predict the users risk of diseases and expose hidden disorders based on their symptoms and lifestyle inputs. The app, called Healthians, allows users to log their basic body vitals like blood pressure, weight and sugar levels as well as maintain a depository of all their test reports for future reference.</p>
                                <a target="_blank" href="https://indian-express.com/article/technology/tech-news-technology/smartphone-app-can-predict-disease-risk-based-on-health-inputs-4787644/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/dd-news.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Smartphone app can predict disease risk based on health inputs</h4>
                                <p>The app, called Healthians, allows users to log their basic body vitals like blood pressure, weight and sugar levels as well as maintain a depository of all their test reports for future reference. The app then analyses the data for abnormal parameters, and recommends the future course of required action</p>
                                <a target="_blank" href="http://www.ddnews.gov.in/sci-tech/smartphone-app-predicts-disease-risk-you-based-your-inputs" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/zeenews.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Smartphone app can predict disease risk based on health inputs</h4>
                                <p>A new smartphone app, developed by a Gurgaon-based start-up, can provide 'smart reports' that may predict the user's risk of diseases and expose hidden disorders based on their symptoms and lifestyle inputs. The app, called Healthians, allows users to log their basic body vitals like blood pressure, weight and sugar levels as well as maintain a depository of all their test reports for future reference.</p>
                                <a target="_blank" href="http://zeenews.india.com/health/smartphone-app-can-predict-disease-risk-based-on-health-inputs-2031273" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/livehindustan.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>यह स्मार्टफोन ऐप लगाएगा बीमारी का पता, एक क्लिक पर मिलेगी स्वास्थ्य जानकारी</h4>
                                <p>गुड़गांव की एक स्टार्टअप कंपनी ने एक ऐसा स्मार्टफोन ऐप बनाया है जो 'स्मार्ट रिपोर्ट' मुहैया कराएगा। यह ऐप उपयोगकर्ता में बीमारियों के खतरे का अनुमान लगा सकता है और उनके लक्षणों और जीवनशैली की सूचनाओं के आधार पर छिपी हुई विकृतियों के बारे में बता सकता है।</p>
                                <a target="_blank" href="https://www.livehindustan.com/gadgets/story-this-mobile-app-will-detect-disease-in-one-click-1263448.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/amarujala.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>स्वास्थ्य सूचनाओं के आधार पर स्मार्टफोन ऐप बताएगा बीमारी</h4>
                                <p>गुरूग्राम की एक स्टार्ट अप कंपनी ने एक ऐसा स्मार्टफोन ऐप बनाया है जो ‘स्मार्ट रिपोर्ट’ मुहैया कराएगा । यह ऐप उपयोगकर्ता में बीमारियों के खतरे का अनुमान लगा सकता है और उनके लक्षणों और जीवनशैली की सूचनाओं के आधार पर छिपी हुई बिमारियों के बारे में बता सकता है। हेल्दियन्स नाम का यह ऐप उपयोगकर्ता को उनके शरीर की मूल सूचनाओं जैसे रक्त चाप, वजन और शर्करा के स्तर का पता लगा सकता है। साथ ही यह भविष्य के लिए अपने सभी जांच परिणामों को संग्रहित भी कर सकता है।</p>
                                <a target="_blank" href="https://www.amarujala.com/technology/tech-diary/smartphone-app-will-detect-disease-based-on-health-information" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/punjabkesari.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>स्वास्थ्य सूचनाओं के आधार पर स्मार्टफोन ऐप लगाएगा बीमारी का पता</h4>
                                <p>गुडगांव की एक स्टार्ट अप कंपनी ने एक ऐसा स्मार्टफोन ऐप बनाया है जो स्मार्ट रिपोर्ट मुहैया कराएगा। दरअसल, इस एप्प का नाम हेल्दियन्स है और यह ऐप उपयोगकर्ता को उनके शरीर की मूल सूचनाओं जैसे रक्त चाप, वजन और शर्करा के स्तर का पता लगा सकता है। साथ ही यह भविष्य के लिए अपने सभी जांच परिणामों को संग्रहित भी कर सकता है।</p>
                                <a target="_blank" href="https://gadget.punjabkesari.in/gadgets/news/based-on-health-information--smartphone-app-will-detect-disease-problem-658399" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>July 2017</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/t2online.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“5 good foods that are not good for you at all”</h4>
                                <p>Your diet is as important as your gym hours to keep fit. And the market is flooded with a variety of “good foods” mostly recommended for muscle growth and healthy, balanced diet. But, are you aware that a few of these good foods are actually secret sugar bombs. "If you are watching your weight, have diabetes or simply wish to have a healthy diet, beware of these secret sugar bombs.</p>
                                <a target="_blank" href="http://t2online.com/lifestyle/5-good-foods-that-are-not-good-for-you-at-all/cid/13363" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/reuters.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>As India's new tax kicks in, concerns about core inflation rise</h4>
                                <p>Indians have started paying more for items ranging from movie tickets to cholesterol tests, thanks to the new goods and services tax, and that raises the prospect the central bank will grow more cautious about cutting interest rates deeply. Increases in charges for services, if sustained, threaten to push up core inflation, which excludes food and energy prices.</p>
                                <a target="_blank" href="https://www.reuters.com/article/us-india-inflation-core/as-indias-new-tax-kicks-in-concerns-about-core-inflation-rise-idUSKBN19W0J5?il=0" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/livemint.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>As GST kicks in, concerns about core inflation rise</h4>
                                <p>Indians have started paying more for items ranging from movie tickets to cholesterol tests, thanks to the new goods and services tax (GST), and that raises the prospect the central bank will grow more cautious about cutting interest rates deeply. Increases in charges for services, if sustained, threaten to push up core inflation, which excludes food and energy prices. Nomura estimates the annual core rate could rise as much as 60 basis points.</p>
                                <a target="_blank" href="https://www.livemint.com/Politics/wnZ9taUpa0a3l2o323UI7K/As-GST-kicks-in-concerns-about-core-inflation-rise.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/deccanchronicle.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>As GST kicks in, concerns about core inflation rise</h4>
                                <p>Indians have started paying more for items ranging from movie tickets to cholesterol tests, thanks to the new goods and services tax, and that raises the prospect the central bank will grow more cautious about cutting interest rates deeply. Increases in charges for services, if sustained, threaten to push up core inflation, which excludes food and energy prices.</p>
                                <a target="_blank" href="https://www.deccanchronicle.com/business/economy/110717/as-gst-kicks-in-concerns-about-core-inflation-rise.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/ndtvprofit.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>After GST Kicks In, Core Inflation Seen Rising</h4>
                                <p>Consumers in the country have started paying more for items ranging from movie tickets to cholesterol tests, thanks to GST or goods and services tax, and that raises the prospect the Reserve Bank of India will grow more cautious about cutting interest rates deeply. Increases in charges for services, if sustained, threaten to push up core inflation, which excludes food and energy prices.</p>
                                <a target="_blank" href="https://www.ndtv.com/business/after-gst-kicks-in-core-inflation-seen-rising-1723273" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/yourstory.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Delhi-based Healthians is trying to solidify its presence in the online diagnostics market</h4>
                                <p>Healthians, which claims to get more than 35,000 bookings per month, wants to add over 200 labs and over 3,000 phlebotomists across 30 cities by the end of 2019. With two successful exits in healthcare information technology and medical tourism, a third endeavour in the same space did not seem out of place to 33-year-old Deepak Sahni</p>
                                <a target="_blank" href="https://yourstory.com/2017/07/delhi-based-healthians-trying-solidify-presence-online-diagnostics-market/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/freepressjournal.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Deepak Sahni, co-founder and CEO of Healthians, on potential of home-based pathology testing</h4>
                                <p>The idea of home-based pathology testing crystallised in April 2014, after my 12-year exposure (direct and indirect) to healthcare services. In 2006-08 in my personal capacity, I had represented India in the USA, pitching the country as an ideal medical tourism destination. An association was created, and I helped individual hospitals set up</p>
                                <a target="_blank" href="http://www.freepressjournal.in/interviews/deepak-sahni-co-founder-and-ceo-of-healthians-on-potential-of-home-based-pathology-testing/1105242" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!--Media 2017-->

            <!-- Media 2016 -->
            <div id="year_2016" class="media_year">

                <div class="container">
                    <h2>October 2016</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/business-standard.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Diagnostic start-up Healthians.com raises $3 mn from investors”</h4>
                                <p>Healthians.com, a diagnostic and wellness start-up has raised $3 million (around Rs 20 crore) in Series A Round of funding led by BEENEXT along with Digital Garage, BEENOS and others. The company had raised its seed round last year in July from YouWecan ventures. Healthians.com runs on a technology-led asset-light model. The operational model involves working in close partnership with lab owners .</p>
                                <a target="_blank" href="http://www.business-standard.com/article/companies/diagnostic-start-up-healthians-com-raises-3-mn-from-investors-116102400135_1.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/economics-times.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“YouWeCan Ventures-backed Healthians raises Rs.20 crore in fresh funding”</h4>
                                <p>Expedient Healthcare, which owns and operates home service health test platform Healthians, has raised about Rs 20 crore in a new round of funding led by Japanese early-stage investor Beenext. The company, which operates in the NCR, will use the funds to expand operations to Mumbai, Bengaluru and Hyderabad, according to Deepak Sahni, chief executive of Healthians. Beenos and Digital Garage have also entered the startup's investor cap table, he said.</p>
                                <a target="_blank" href="http://tech.economictimes.indiatimes.com/news/startups/yuvraj-singh-backed-healthians-raises-rs-20-crore-in-fresh-funding/55023196" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/thehindu.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Diagnostic firm Healthians raises Rs.20 crore”</h4>
                                <p>Diagnostic and wellness start-up Healthians on Monday said it has raised $3 million (nearly Rs.20 crore) in Series A round of funding led by Japanese early-stage investor Beenext. Digital Garage and Beenos also took part in the round. The company plans to create India’s first and largest umbrella brand for a high-quality, end-to-end diagnostic service with doorstep convenience at low cost.</p>
                                <a target="_blank" href="https://www.thehindubusinessline.com/companies/diagnostic-firm-healthians-raises-20-cr/article9262530.ece" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/vccircle.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Japan’s Beenext leads Series A round in healthcare marketplace Healthians.com”</h4>
                                <p>Expedient Healthcare Marketing Pvt. Ltd, which runs online diagnostics and wellness startup Healthians.com, said on Monday it has raised $3 million (Rs.20 crore) in a Series A round led by venture capital fund Beenext. Japanese Internet Company Digital Garage and Japanese e-commerce and investment firm Beenos, among others, also participated in this funding round, Healthians said in a statement.</p>
                                <a target="_blank" href="http://www.vccircle.com/news/technology/2016/10/24/japan-s-beenext-leads-series-round-healthcare-marketplace-healthianscom" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/yourstory.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Diagnostics startup Healthians raises Series A funding of $3 million in round led by BEENEXT”</h4>
                                <p>Healthians, the Delhi-based diagnostics and wellness healthcare marketplace, has raised Series A funding in a round led by BEENEXT, along with Digital Garage, BEENOS and others. This is the venture’s second round of funding, having raised a seed round in July last year from YouWeCan Ventures. The funds will be used for expanding to other cities, building technology to automate lab operations and creating products to monitor and manage customers’ health using data.</p>
                                <a target="_blank" href="https://yourstory.com/2016/10/healthians-series-a-funding/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- Media 2016 -->

            <!-- Media 2015 -->
            <div id="year_2015" class="media_year">
                <div class="container">
                    <h2>August 2015</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/cnbc.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Healthians.com featured on CNBC Awaaz</h4>
                                <p>CNBC Awaaz popular show Awaaz Entrepreneur aired a special episode on Healthians.com story on 8th August 2015.</p>
                                <a target="_blank" href="https://www.youtube.com/watch?v=lkRTyiKiGf4" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/Bloomberg.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Bloomberg TV India talks to Yuvraj & Healthians.com</h4>
                                <p>Bloomberg e-Inc talks to Yuvraj and Healthians.com in an exclusive show by Abha Bakaya</p>
                                <a target="_blank" href="https://www.youtube.com/watch?v=oIKXEUskNoA" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/zeebusiness.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Yuvraj Singh speaks about Healthians.com & other ventures.</h4>
                                <p>Yuvraj Singh - Investor and Brand Ambassador for Healthians.com speaks about the business in his Interview with Zee Business.</p>
                                <a target="_blank" href="https://www.youtube.com/watch?v=2cTGRStBvZs" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <h2>June 2015</h2>
                    <img class="center-block underline-img" src="/img/media/underline.png" alt="">

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/business-standard.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Yuvraj Singh invests in online healthcare marketplace Healthians.com”</h4>
                                <p>Cricketer Yuvraj Singh's investment fund YouWeCan Ventures has acquired a stake in online healthcare marketplace Healthians.com. Healthians.com helps users discover affordable healthcare, using quality and price transparency. It aggregates diagnostic labs, crowd sourced sample collectors and nearby doctors, as well as makes patients’ medical records available online.</p>
                                <a target="_blank" href="https://www.business-standard.com/article/companies/yuvraj-singh-invests-in-online-healthcare-marketplace-healthians-com-115062300843_1.html" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/economictimes.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Healthians.com raises funding from Yuvraj Singh's You We Can Ventures”</h4>
                                <p>Online healthcare marketplace Healthians.com has raised funding from cricketer Yuvraj Singh's investment fund YouWeCan Ventures. The Gurgaon-based startup, founded by Deepak Sahni, aggregates diagnostic labs, crowd sourced sample collectors, doctors and also makes patients' medical records available online. "Having gone through life threatening medical condition</p>
                                <a target="_blank" href="https://tech.economictimes.indiatimes.com/news/startups/healthians-funding-yuvraj-singh-youwecan-ventures/47781365" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/thehindu.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Yuvraj Singh turns investor, bets big on start-ups”</h4>
                                <p>Cricketer Yuvraj Singh, who was instrumental in India’s 2011 World Cup win, is on an investment spree. This week, his venture capital fund, YouWeCan Ventures, has acquired stake in two start-ups - Healthians.com and EduKart. These start ups are focused on healthcare and education. Healthians.com, an online healthcare marketplace, helps users discover affordable healthcare and provides transparency about price and quality.</p>
                                <a target="_blank" href="https://www.thehindu.com/business/cricketer-yuvraj-singh-turns-investor-bets-big-on-startups/article7350867.ece" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/vccircle.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Online marketplace for preventive health check-up Healthians raises funding from YouWeCan”</h4>
                                <p>Expedient Healthcare Marketing Pvt Ltd, which runs online healthcare website Healthians.com, has raised an undisclosed amount from You We Can Ventures, an early-stage venture fund floated by cricketer Yuvraj Singh, the company said in a release.</p>
                                <a target="_blank" href="https://www.vccircle.com/online-marketplace-preventive-health-check-healthians-raises-funding" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/yourstory.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>“Yuvi led YouWeCan ventures makes investment in healthcare marketplace Healthians”</h4>
                                <p>Continuing his investment spree Yuvraj Singh has invested undisclosed amount in healthcare marketplace Healthians. Healthians helps users discover affordable healthcare, using quality and price transparency. The company aggregates diagnostic labs, crowd sourced sample collectors and nearby doctors.</p>
                                <a target="_blank" href="http://yourstory.com/2015/06/yuvraj-singh-youwecan-ventures-healthians/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                    <div class="class-margin">
                        <div class="lft-member">
                            <div class="bg_media">
                                <img src="/img/media/bw-disrupt.png" alt="Images">
                            </div>
                        </div>
                        <div class="rgt-mem">
                            <div class="member-content">
                                <h4>Healthians is a Pre – Series A Startup Trying to Promote Preventive Healthcare</h4>
                                <p>Healthians.com is a diagnostic and wellness company enabling customers to book a test from an app, web or over the phone. The startup also offers the expertise of Healthians wellness expert on what test to take. Diagnostics and preventive healthcare is a tough business to break into because nobody believes people will pay for tests if they are not sick.</p>
                                <a target="_blank" href="http://bw-disrupt.businessworld.in/article/Healthians-is-a-Pre-Series-A-Startup-Trying-to-Promote-Preventive-Healthcare/05-09-2016-105231/" class="know-more">+ Full Coverage</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--Media 2015-->

        </div>
    </section>
</div> --}}

@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#year_2018").show();
            
            $(".media-timeline").click(function() {
                $(".media-timeline").each(function(i){
                    $(this).removeClass("media-active");
                });
                $(".media_year").hide();

                $(this).addClass("media-active");
                var clickedYear = $(this).children().text();
                $("#year_"+clickedYear).show();
            });
        });
    </script>
@endpush