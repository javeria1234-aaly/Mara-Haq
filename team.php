<?php
require_once __DIR__ . '/header.php';
?>

<div class="team-page-wrap" style="background: #f8fafc; padding-bottom: 80px;">
    <!-- Hero Section -->
    <div class="team-hero" style="background: linear-gradient(135deg, #0c2340 0%, #0f4c3a 100%); color: #ffffff; padding: 60px 20px 70px; text-align: center; position: relative; overflow: hidden;">
        <div class="container" style="max-width: 900px; position: relative; z-index: 2;">
            <span class="team-tag-pill" data-aos="fade-down" style="background: rgba(197, 155, 39, 0.25); color: #fde047; border: 1.5px solid #c59b27; padding: 6px 20px; border-radius: 30px; font-weight: 800; font-size: 13px; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                <i class="fa fa-users-viewfinder"></i> <?php echo dual_val('پروجیکٹ کی بانی و تخلیق کار ٹیم', 'Meet the Creators & Team Behind Mera Haq'); ?>
            </span>
            <h1 class="team-hero-title" data-aos="fade-up" style="font-size: 34px; font-weight: 900; margin-bottom: 16px; line-height: 1.3;">
                <?php echo dual_val('میرا حق کے بانی اور تخلیق کار', 'The Innovators & Creators of Mera Haq'); ?>
            </h1>
            <p class="team-hero-sub" data-aos="fade-up" data-aos-delay="100" style="font-size: 16px; color: #cbd5e1; line-height: 1.8; max-width: 780px; margin: 0 auto;">
                <?php echo dual_val(
                    'ٹیکنالوجی، قانون اور سوشل امپیکٹ کے باہمی اشتراک سے پاکستان بھر کی خواتین کے شرعی و آئینی وراثتی حقوق کے تحفظ کے لیے تیار کردہ انقلابی ڈیجیٹل پورٹل۔ یہ ہماری باصلاحیت ٹیم کی اجتماعی محنت اور لگن کا ثمر ہے۔',
                    'A specialized LegalTech initiative uniting software engineering, legal expertise, and social innovation to protect and empower women regarding their statutory and Shariah inheritance rights across Pakistan.'
                ); ?>
            </p>
        </div>
        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 30px; background: #f8fafc; clip-path: polygon(0 100%, 100% 100%, 100% 0);"></div>
    </div>

    <div class="container" style="margin-top: -30px; position: relative; z-index: 5;">
        <!-- Team Stats / Recognition Bar -->
        <div class="team-stats-strip" data-aos="fade-up" style="background: #ffffff; border-radius: var(--radius-lg); padding: 22px 30px; box-shadow: 0 10px 30px rgba(12, 35, 64, 0.08); border: 1px solid var(--border-color); margin-bottom: 45px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; text-align: center;">
            <div class="stat-item">
                <div style="font-size: 26px; font-weight: 900; color: #0f4c3a; margin-bottom: 4px;">
                    <i class="fa fa-people-group"></i> 7
                </div>
                <div style="font-size: 13.5px; font-weight: 700; color: #475569;">
                    <?php echo dual_val('مخلص ٹیم ممبرز', 'Dedicated Team Members'); ?>
                </div>
            </div>
            <div class="stat-item" style="border-right: 1px solid #f1f5f9; border-left: 1px solid #f1f5f9;">
                <div style="font-size: 26px; font-weight: 900; color: #c59b27; margin-bottom: 4px;">
                    <i class="fa fa-scale-balanced"></i> 100%
                </div>
                <div style="font-size: 13.5px; font-weight: 700; color: #475569;">
                    <?php echo dual_val('قانونی و شریعہ تصدیق شدہ', 'Legal & Shariah Aligned'); ?>
                </div>
            </div>
            <div class="stat-item">
                <div style="font-size: 26px; font-weight: 900; color: #0c2340; margin-bottom: 4px;">
                    <i class="fa fa-handshake-angle"></i> Mega Project
                </div>
                <div style="font-size: 13.5px; font-weight: 700; color: #475569;">
                    <?php echo dual_val('عوامی خدمت کا مشن', 'Public Impact Initiative'); ?>
                </div>
            </div>
        </div>

        <!-- Section Heading -->
        <div class="section-head" style="text-align: center; margin-bottom: 35px;" data-aos="fade-up">
            <span class="section-tag" style="background: #0f4c3a; color: #ffffff; padding: 5px 18px; border-radius: 20px; font-weight: 800; font-size: 12.5px;">
                <i class="fa fa-star" style="color: #fde047;"></i> <?php echo dual_val('ہماری ٹیم کے اراکین', 'Core Team Roster'); ?>
            </span>
            <h2 class="section-title" style="margin-top: 12px; font-size: 26px;">
                <?php echo dual_val('میرا حق کے بانی و کلیدی شراکت دار', 'Founders & Core Contributors'); ?>
            </h2>
            <p class="section-desc" style="max-width: 650px; margin: 0 auto; color: #64748b; font-size: 14.5px;">
                <?php echo dual_val('ہر رکن نے اپنے مخصوص شعبے—سافٹ ویئر انجینئرنگ، وکالت، اسٹریٹجی، ریسرچ اور کوالٹی—میں کلیدی کردار ادا کر کے اس پلیٹ فارم کو پایۂ تکمیل تک پہنچایا۔', 'Each member contributed distinct expertise—software development, legal advocacy, strategy, research, and quality assurance—to bring this platform to fruition.'); ?>
            </p>
        </div>

        <!-- Team Members Grid -->
        <div class="team-cards-grid">
            <!-- 1. JAVERIA RAFHAN (Software Engineer) -->
            <div class="team-member-card primary-card" data-aos="fade-up" data-aos-delay="50">
                <div class="member-card-badge" style="background: #0f4c3a; color: #ffffff;">
                    <i class="fa fa-code"></i> Lead Engineering
                </div>
                <div class="member-avatar-wrap" style="background: linear-gradient(135deg, #0f4c3a, #15803d);">
                    <span class="avatar-initials">JR</span>
                </div>
                <h3 class="member-name">Javeria Rafhan</h3>
                <div class="member-role" style="color: #0f4c3a;">
                    <i class="fa fa-laptop-code"></i> Software Engineer & Co-Founder
                </div>
                <div class="member-role-ur">جویریہ رفحان (سافٹ ویئر انجینئر و کو-فاؤنڈر)</div>
                <p class="member-desc">
                    <?php echo dual_val(
                        'پورٹل کی مکمل فل اسٹیک ڈیولپمنٹ، جدید آرکیٹیکچر، ہبہ نامہ AI فراڈ اسکینر، او سی آر (OCR) کیمرہ سسٹم، ریسپانسیو ڈیزائن، اور پروڈکشن ڈپلائیمنٹ کی ذمہ دار۔',
                        'Led end-to-end full-stack software development, system architecture, Hiba Nama AI scanner integration, OCR processing, and production deployment.'
                    ); ?>
                </p>
                <div class="member-tags">
                    <span class="skill-tag">Full-Stack Dev</span>
                    <span class="skill-tag">Python & PHP</span>
                    <span class="skill-tag">AI Scanner</span>
                    <span class="skill-tag">Architecture</span>
                </div>
            </div>

            <!-- 2. ADVOCATE ISHRAQ ALI (Lawyer & Legal Backbone) -->
            <div class="team-member-card" data-aos="fade-up" data-aos-delay="100">
                <div class="member-card-badge" style="background: #0c2340; color: #ffffff;">
                    <i class="fa fa-scale-balanced"></i> Legal Backbone
                </div>
                <div class="member-avatar-wrap" style="background: linear-gradient(135deg, #0c2340, #1e3a5f);">
                    <span class="avatar-initials">IA</span>
                </div>
                <h3 class="member-name">Advocate Ishraq Ali</h3>
                <div class="member-role" style="color: #0c2340;">
                    <i class="fa fa-gavel"></i> Practicing Advocate & Legal Advisor
                </div>
                <div class="member-role-ur">ایڈووکیٹ اشراق علی (قانونی مشیر و ایڈووکیٹ)</div>
                <p class="member-desc">
                    <?php echo dual_val(
                        'بطور مستند وکیل، پورے پروجیکٹ کی قانونی ریڑھ کی ہڈی۔ سپریم کورٹ نظائر (2026 SCLR 90)، نادرا قوانین، شریعہ وراثتی طریقہ کار، اور عدالتی پروسیجرز کی مکمل رہنمائی فراہم کی۔',
                        'Practicing legal counsel and procedural architect. Formulated statutory workflows, Supreme Court precedent mappings (2026 SCLR 90), and Shariah compliance logic.'
                    ); ?>
                </p>
                <div class="member-tags">
                    <span class="skill-tag">High Court Advocate</span>
                    <span class="skill-tag">Statutory Law</span>
                    <span class="skill-tag">Inheritance Law</span>
                    <span class="skill-tag">Court Procedures</span>
                </div>
            </div>

            <!-- 3. MOHAMMAD UMAIR RAUF (Team Lead) -->
            <div class="team-member-card" data-aos="fade-up" data-aos-delay="150">
                <div class="member-card-badge" style="background: #c59b27; color: #0c2340;">
                    <i class="fa fa-crown"></i> Team Leadership
                </div>
                <div class="member-avatar-wrap" style="background: linear-gradient(135deg, #c59b27, #92400e);">
                    <span class="avatar-initials">UR</span>
                </div>
                <h3 class="member-name">Mohammad Umair Rauf</h3>
                <div class="member-role" style="color: #b45309;">
                    <i class="fa fa-users-gear"></i> Team Lead & Project Manager
                </div>
                <div class="member-role-ur">محمد عمیر رؤف (ٹیم لیڈ و پروجیکٹ مینیجر)</div>
                <p class="member-desc">
                    <?php echo dual_val(
                        'پروجیکٹ کی عمومی قیادت، اسٹریٹجک پلاننگ، ٹیم کوآرڈینیشن، اور ہر مرحلے پر ٹیم کو منظم رکھ کر بروقت تکمیل کو یقینی بنانے کے رہنما۔',
                        'Steered project management, strategic direction, timeline tracking, and agile team alignment to maintain seamless collaboration from conception to launch.'
                    ); ?>
                </p>
                <div class="member-tags">
                    <span class="skill-tag">Project Management</span>
                    <span class="skill-tag">Team Leadership</span>
                    <span class="skill-tag">Strategic Vision</span>
                </div>
            </div>

            <!-- 4. ANUM (Creative Strategist) -->
            <div class="team-member-card" data-aos="fade-up" data-aos-delay="200">
                <div class="member-card-badge" style="background: #7c3aed; color: #ffffff;">
                    <i class="fa fa-lightbulb"></i> Ideation & Strategy
                </div>
                <div class="member-avatar-wrap" style="background: linear-gradient(135deg, #7c3aed, #a855f7);">
                    <span class="avatar-initials">AN</span>
                </div>
                <h3 class="member-name">Anum</h3>
                <div class="member-role" style="color: #7c3aed;">
                    <i class="fa fa-wand-magic-sparkles"></i> Creative Strategist & Ideation Lead
                </div>
                <div class="member-role-ur">انعم (آئیڈیاز و کریٹیو اسٹریٹجسٹ)</div>
                <p class="member-desc">
                    <?php echo dual_val(
                        'خواتین کے حقیقی مسائل کو سامنے لانے، پورٹل کے بنیادی آئیڈیاز کی تشکیل، انسانی ہمدردی پر مبنی یوزر جرنی اور سوشل امپیکٹ اسٹریٹجی کی روح رواں۔',
                        'Conceptualized the foundational ideas and user-centric approach, focusing on the lived struggles of Pakistani women to craft meaningful features.'
                    ); ?>
                </p>
                <div class="member-tags">
                    <span class="skill-tag">Concept Ideation</span>
                    <span class="skill-tag">User Empathy</span>
                    <span class="skill-tag">Social Impact</span>
                </div>
            </div>

            <!-- 5. MUHAMMAD ZEESHAN (Technical & Operational Support) -->
            <div class="team-member-card" data-aos="fade-up" data-aos-delay="250">
                <div class="member-card-badge" style="background: #0284c7; color: #ffffff;">
                    <i class="fa fa-gears"></i> Technical Support
                </div>
                <div class="member-avatar-wrap" style="background: linear-gradient(135deg, #0284c7, #0369a1);">
                    <span class="avatar-initials">MZ</span>
                </div>
                <h3 class="member-name">Muhammad Zeeshan</h3>
                <div class="member-role" style="color: #0284c7;">
                    <i class="fa fa-screwdriver-wrench"></i> Technical Execution & Operations
                </div>
                <div class="member-role-ur">محمد ذیشان (ٹیکنیکل ایگزیکیوشن و سپورٹ)</div>
                <p class="member-desc">
                    <?php echo dual_val(
                        'ٹیکنیکل مسائل کا حل، سسٹم سپورٹ، ڈیٹا کوآرڈینیشن، اور پروجیکٹ کے عملی مراحل میں تکنیکی معاونت کی مستقل فراہمی۔',
                        'Contributed consistent technical support, operational troubleshooting, data coordination, and development problem-solving.'
                    ); ?>
                </p>
                <div class="member-tags">
                    <span class="skill-tag">Technical Execution</span>
                    <span class="skill-tag">Data Support</span>
                    <span class="skill-tag">Problem Solving</span>
                </div>
            </div>

            <!-- 6. FAREEDA (Legal Research & Content) -->
            <div class="team-member-card" data-aos="fade-up" data-aos-delay="300">
                <div class="member-card-badge" style="background: #d97706; color: #ffffff;">
                    <i class="fa fa-book-open-reader"></i> Legal Research
                </div>
                <div class="member-avatar-wrap" style="background: linear-gradient(135deg, #d97706, #b45309);">
                    <span class="avatar-initials">FR</span>
                </div>
                <h3 class="member-name">Fareeda</h3>
                <div class="member-role" style="color: #d97706;">
                    <i class="fa fa-magnifying-glass-chart"></i> Legal Research & Content Specialist
                </div>
                <div class="member-role-ur">فریدہ (لیگل ریسرچ و مواد کی تیاری)</div>
                <p class="member-desc">
                    <?php echo dual_val(
                        'وراثت اور سکسیشن سے متعلق قانونی دفعات کی گہری ریسرچ، عدالتی فیصلوں کے خلاصے، اور پورٹل کے تعلیمی مواد کی تصدیق و تدوین۔',
                        'Conducted in-depth statutory research, analyzed legal case studies, and structured educational guides and documentation for citizens.'
                    ); ?>
                </p>
                <div class="member-tags">
                    <span class="skill-tag">Legal Research</span>
                    <span class="skill-tag">Case Analysis</span>
                    <span class="skill-tag">Content Curation</span>
                </div>
            </div>

            <!-- 7. LAIBA KHAN (Quality Assurance & Coordination) -->
            <div class="team-member-card" data-aos="fade-up" data-aos-delay="350">
                <div class="member-card-badge" style="background: #16a34a; color: #ffffff;">
                    <i class="fa fa-circle-check"></i> Quality & QA
                </div>
                <div class="member-avatar-wrap" style="background: linear-gradient(135deg, #16a34a, #15803d);">
                    <span class="avatar-initials">LK</span>
                </div>
                <h3 class="member-name">Laiba Khan</h3>
                <div class="member-role" style="color: #16a34a;">
                    <i class="fa fa-clipboard-check"></i> Quality Assurance & Coordination
                </div>
                <div class="member-role-ur">لائبہ خان (کوالٹی ایشورنس و کوآرڈینیشن)</div>
                <p class="member-desc">
                    <?php echo dual_val(
                        'پورٹل کی ٹیسٹنگ، کوالٹی ایشورنس، مختلف ڈیوائسز پر تجربہ کاری، اور ٹیم کوآرڈینیشن میں مسلسل اور باوقار شراکت داری۔',
                        'Spearheaded user experience testing, cross-device QA validation, functional checks, and supportive team coordination.'
                    ); ?>
                </p>
                <div class="member-tags">
                    <span class="skill-tag">Quality Assurance</span>
                    <span class="skill-tag">UX Testing</span>
                    <span class="skill-tag">Team Coordination</span>
                </div>
            </div>
        </div>

        <!-- Mission & Dedication Story Card -->
        <div class="team-mission-box" data-aos="fade-up" style="background: #ffffff; border-radius: var(--radius-lg); border: 2px solid #e2e8f0; padding: 35px 40px; margin-top: 50px; box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fa fa-hand-holding-heart"></i>
                </div>
                <div>
                    <h3 style="font-size: 20px; font-weight: 800; color: var(--navy); margin: 0 0 3px 0;">
                        <?php echo dual_val('ہمارا مشن اور پختہ عزم', 'Our Collective Mission & Promise'); ?>
                    </h3>
                    <div style="font-size: 13.5px; color: #64748b;">
                        <?php echo dual_val('میرا حق — خواتین کے قانونی حقوق کے تحفظ کی آزاد قومی مہم', 'Mera Haq — Dedicated to Defending Inheritance Rights'); ?>
                    </div>
                </div>
            </div>

            <p style="font-size: 15px; line-height: 1.95; color: #334155; margin-bottom: 20px;">
                <?php echo dual_val(
                    'ہماری ٹیم نے یہ پورٹل اس نظریے کے ساتھ تخلیق کیا ہے کہ کوئی بھی بہن، بیٹی، بیوہ یا ماں معلومات کی کمی یا خاندانی فریب کی وجہ سے اپنے جائز و شرعی حق سے محروم نہ ہو۔ ہم نے قانون کی پیچیدہ زبان کو عام فہم ویڈیوز، رہنمائی دستاویزات اور جدید فراڈ ڈیٹیکٹر کے ذریعے ہر شہری کے لیے مفت اور آسان بنا دیا ہے۔',
                    'Our team developed Mera Haq on the foundational principle that no woman—whether a daughter, sister, widow, or mother—should ever be deprived of her rightful Shariah and statutory inheritance due to legal illiteracy or familial manipulation. By uniting cutting-edge technology with rigorous legal advocacy, we have made legal empowerment accessible, intuitive, and completely pro-bono for every citizen.'
                ); ?>
            </p>

            <div style="display: flex; gap: 14px; flex-wrap: wrap; align-items: center; padding-top: 15px; border-top: 1px dashed #e2e8f0;">
                <a href="guide.php" class="btn btn-primary" style="padding: 10px 22px; font-weight: 800;">
                    <i class="fa fa-book-bookmark"></i> <?php echo dual_val('قانونی طریقہ کار دیکھیں', 'Explore Legal Guide'); ?>
                </a>
                <a href="fraud_detector.php" class="btn btn-danger" style="padding: 10px 22px; font-weight: 800;">
                    <i class="fa fa-shield-halved"></i> <?php echo dual_val('ہبہ نامہ فراڈ اسکینر', 'AI Fraud Scanner'); ?>
                </a>
                <a href="help.php" class="btn btn-secondary" style="padding: 10px 22px; font-weight: 800; background: var(--navy); color: #ffffff;">
                    <i class="fa fa-phone-volume"></i> <?php echo dual_val('مفت قانونی ہیلپ لائنز', 'Legal Aid Helplines'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Team Page Styles */
.team-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 26px;
}

.team-member-card {
    background: #ffffff;
    border-radius: var(--radius-lg);
    border: 1.5px solid #e2e8f0;
    padding: 30px 24px;
    box-shadow: 0 4px 15px rgba(12, 35, 64, 0.04);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    overflow: hidden;
}

.team-member-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(12, 35, 64, 0.1);
    border-color: #cbd5e1;
}

.team-member-card.primary-card {
    border-color: #0f4c3a;
    box-shadow: 0 6px 20px rgba(15, 76, 58, 0.08);
}

.member-card-badge {
    position: absolute;
    top: 14px;
    right: 14px;
    font-size: 11px;
    font-weight: 800;
    padding: 3px 10px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
html[dir="rtl"] .member-card-badge {
    right: auto;
    left: 14px;
}

.member-avatar-wrap {
    width: 84px;
    height: 84px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    margin-bottom: 18px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    border: 3px solid #ffffff;
}

.avatar-initials {
    font-size: 28px;
    font-weight: 900;
    letter-spacing: 1px;
}

.member-name {
    font-size: 20px;
    font-weight: 900;
    color: var(--navy);
    margin: 0 0 4px 0;
}

.member-role {
    font-size: 13.5px;
    font-weight: 800;
    margin-bottom: 2px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.member-role-ur {
    font-size: 12.5px;
    color: #64748b;
    font-weight: 700;
    margin-bottom: 14px;
}

.member-desc {
    font-size: 13.5px;
    line-height: 1.75;
    color: #475569;
    margin-bottom: 18px;
    flex: 1;
}

.member-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    justify-content: center;
    margin-top: auto;
}

.skill-tag {
    background: #f1f5f9;
    color: #334155;
    font-size: 11.5px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

@media (max-width: 600px) {
    .team-hero-title {
        font-size: 26px !important;
    }
    .team-cards-grid {
        grid-template-columns: 1fr;
    }
    .team-mission-box {
        padding: 24px 20px !important;
    }
}
</style>

<?php require_once __DIR__ . '/footer.php'; ?>
