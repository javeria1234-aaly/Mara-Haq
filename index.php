<?php
require_once __DIR__ . '/header.php';

// Fetch Categories
$cat_stmt = $pdo->query("SELECT * FROM categories ORDER BY sort_order ASC");
$cats = $cat_stmt->fetchAll();

// Fetch Featured NGOs
$ngo_stmt = $pdo->query("SELECT * FROM ngos WHERE is_featured = 1 LIMIT 6");
$featured_ngos = $ngo_stmt->fetchAll();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container hero-content">
        <div class="badge-pill">
            <i class="fa-solid fa-scale-balanced"></i> <?php echo t('hero_badge'); ?>
        </div>
        
        <h1 class="hero-title">
            <?php if ($lang === 'ur'): ?>
                حق وراثت حاصل کرنے کے لیے درکار قانونی طریقہ کار اور ضروری دستاویزات
            <?php elseif ($lang === 'en'): ?>
                Legal Procedures for Requiring Documents to Attain Right of Inheritance
            <?php else: ?>
                <span class="bi-ur">حق وراثت حاصل کرنے کے لیے درکار قانونی طریقہ کار اور ضروری دستاویزات</span>
                <span class="hero-en-title" style="display: block; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 20px; font-weight: 700; color: var(--gold-light); margin-top: 8px; letter-spacing: 0.5px;">
                    LEGAL PROCEDURES FOR REQUIRING DOCUMENTS TO ATTAIN RIGHT OF INHERITANCE
                </span>
            <?php endif; ?>
        </h1>

        <p class="hero-subtitle">
            <?php if ($lang === 'ur'): ?>
                بینک اکاؤنٹس، گاڑیاں، زرعی و شہری اراضی کی قانونی کھوج، نادرا سکسیشن، اور خواتین کے شرعی و آئینی حقوق کا تحفظ
            <?php elseif ($lang === 'en'): ?>
                Comprehensive Guide to Tracing Deceased Bank Accounts, Vehicles, Land Mutation, Succession Certificates & Safeguarding Women's Statutory Inheritance
            <?php else: ?>
                <span class="bi-ur">بینک اکاؤنٹس، گاڑیاں، زرعی و شہری اراضی کی قانونی کھوج، نادرا سکسیشن، اور خواتین کے شرعی و آئینی حقوق کا تحفظ</span>
                <span class="sub-en" style="color: #cbd5e1; font-size: 14.5px; margin-top: 6px;">
                    Tracing Deceased Bank Accounts, Vehicles, Land Mutation, NADRA Succession Certificates & Safeguarding Women's Inheritance
                </span>
            <?php endif; ?>
        </p>

        <div class="hero-actions">
            <a href="guide.php" class="btn btn-primary"><i class="fa fa-book-open"></i> <?php echo t('btn_explore_guide'); ?></a>
            <a href="videos.php" class="btn" style="background: #ef4444; color: #ffffff; border: 1px solid #dc2626;"><i class="fa-brands fa-youtube"></i> <?php echo dual_val('ویڈیو گائیڈز دیکھیں', 'Video Tutorials'); ?></a>
            <a href="help.php" class="btn btn-secondary"><i class="fa fa-hands-holding-child"></i> <?php echo t('btn_ngo_help'); ?></a>
            <a href="fraud_detector.php" class="btn btn-danger"><i class="fa fa-shield-halved"></i> <?php echo t('btn_check_fraud'); ?></a>
        </div>

        <form action="help.php" method="GET" class="hero-search-box">
            <i class="fa fa-search" style="color: var(--text-muted); margin-left: 12px; margin-right: 12px;"></i>
            <input type="text" name="q" placeholder="<?php echo t_plain('search_placeholder'); ?>">
            <button type="submit"><?php echo t('search_btn'); ?></button>
        </form>
    </div>
</section>

<!-- Landmark Supreme Court Precedent Banner -->
<div class="container" style="margin-top: 35px; margin-bottom: 20px;" data-aos="fade-up">
    <div class="precedent-banner" data-tilt data-tilt-max="4">
        <div class="precedent-icon">
            <i class="fa-solid fa-gavel"></i>
        </div>
        <div class="precedent-content">
            <span class="precedent-badge">
                <?php echo $lang === 'en' ? 'Supreme Court Landmark Precedent (2026 SCLR 90)' : ($lang === 'ur' ? 'سپریم کورٹ آف پاکستان اہم قانونی نظیر (2026 SCLR 90)' : 'سپریم کورٹ آف پاکستان اہم فیصلہ / Supreme Court Landmark Precedent (2026 SCLR 90)'); ?>
            </span>
            <h3>
                <?php echo dual_val($translations['ur']['sc_precedent'], $translations['en']['sc_precedent']); ?>
            </h3>
            <div style="margin-top: 6px; font-size: 14px; line-height: 1.8;">
                <?php echo dual_val($translations['ur']['sc_precedent_text'], $translations['en']['sc_precedent_text'], true); ?>
            </div>
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-top: 14px;">
                <a href="https://pakistankanoon.com/sclr2026.php/2026-SCLR-90" target="_blank" rel="noopener" class="btn btn-primary btn-sm">
                    <i class="fa fa-external-link-alt"></i> <?php echo $lang === 'en' ? 'Read 2026 SCLR 90 Judgment' : ($lang === 'ur' ? 'فیصلے کا اصل متن پڑھیں (2026 SCLR 90)' : 'فیصلے کا اصل متن (2026 SCLR 90 Judgment)'); ?>
                </a>
                <a href="fraud_detector.php" class="btn btn-secondary btn-sm">
                    <i class="fa fa-shield"></i> <?php echo $lang === 'en' ? 'Check Tanazul Risk' : ($lang === 'ur' ? 'دستبرداری کا خطرہ چیک کریں' : 'دستبرداری رسک چیک / Fraud Risk Tool'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Interactive Live Stats Counter Bar -->
<div class="container" style="margin-top: 25px; margin-bottom: 25px;">
    <div style="background: linear-gradient(135deg, #0c2340 0%, #0f4c3c 100%); border-radius: var(--radius-lg); padding: 25px 30px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; box-shadow: var(--shadow-md); border: 2px solid var(--gold); text-align: center;" data-aos="fade-up">
        <div>
            <div style="font-size: 36px; font-weight: 800; color: var(--gold-light);" class="stat-number-animated" data-target="25" data-suffix="+">0</div>
            <div style="font-size: 13.5px; color: #ffffff; font-weight: 600; margin-top: 4px;"><?php echo dual_val('مستند این جی اوز و ادارے', 'Verified Legal NGOs'); ?></div>
        </div>
        <div>
            <div style="font-size: 36px; font-weight: 800; color: #ffffff;" class="stat-number-animated" data-target="5" data-suffix=" مراحل">0</div>
            <div style="font-size: 13.5px; color: #ffffff; font-weight: 600; margin-top: 4px;"><?php echo dual_val('لازمی قانونی مراحل', 'Statutory Stages'); ?></div>
        </div>
        <div>
            <div style="font-size: 36px; font-weight: 800; color: var(--gold-light);" class="stat-number-animated" data-target="100" data-suffix="%">0</div>
            <div style="font-size: 13.5px; color: #ffffff; font-weight: 600; margin-top: 4px;"><?php echo dual_val('مفت قانونی رہنمائی', 'Free Public Aid'); ?></div>
        </div>
        <div>
            <div style="font-size: 36px; font-weight: 800; color: #ffffff;" class="stat-number-animated" data-target="12" data-suffix="+ اضلاع">0</div>
            <div style="font-size: 13.5px; color: #ffffff; font-weight: 600; margin-top: 4px;"><?php echo dual_val('شہر بہ شہر رسائی', 'Cities & Districts'); ?></div>
        </div>
    </div>
</div>

<!-- Major Categories Section -->
<section class="categories-section">
    <div class="container">
        <div class="section-head" data-aos="fade-up">
            <span class="section-tag"><?php echo t('sec_categories'); ?></span>
            <h2 class="section-title">
                <?php echo $lang === 'en' ? '5 Core Inheritance Legal Stages' : ($lang === 'ur' ? 'وراثت کے 5 بنیادی قانونی مراحل' : 'وراثت کے 5 بنیادی قانونی مراحل / 5 Core Legal Stages'); ?>
            </h2>
            <p class="section-desc">
                <?php echo $lang === 'en' ? 'Procedures for bank accounts, vehicles, land partition, and women\'s statutory rights.' : ($lang === 'ur' ? 'بینک اکاؤنٹس، گاڑیاں، زرعی و شہری زمین اور حقوقِ نسواں کے قانونی ضابطے' : 'بینک اکاؤنٹس، گاڑیاں، زرعی و شہری زمین، نادرا اور حقوقِ نسواں کے قانونی ضابطے &middot; Bank accounts, vehicles, land partition and legal rights.'); ?>
            </p>
        </div>

        <div class="categories-grid">
            <?php $delay = 50; foreach ($cats as $cat): ?>
                <div class="category-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>" data-tilt data-tilt-max="6">
                    <div>
                        <div class="category-icon-wrap">
                            <i class="fa-solid fa-<?php echo $cat['icon']; ?>"></i>
                        </div>
                        <h3>
                            <?php echo dual_val($cat['title_ur'], $cat['title_en']); ?>
                        </h3>
                        <div style="margin-top: 8px;">
                            <?php echo dual_val($cat['description_ur'], $cat['description_en'], true); ?>
                        </div>
                    </div>
                    <a href="guide.php#cat-<?php echo $cat['id']; ?>" class="card-link-action">
                        <?php echo t('view_details'); ?> <i class="fa-solid <?php echo is_rtl() ? 'fa-arrow-left' : 'fa-arrow-right'; ?>"></i>
                    </a>
                </div>
            <?php $delay += 75; endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Free Legal Aid NGOs Bar -->
<section style="background: #ffffff; padding: 50px 0; border-top: 1px solid var(--border-color);">
    <div class="container">
        <div class="section-head">
            <span class="section-tag" style="color: var(--danger);"><i class="fa fa-phone-volume"></i> 1 Screen Help</span>
            <h2 class="section-title">
                <?php echo $lang === 'en' ? 'City-by-City Free Legal Aid & NGOs Directory' : ($lang === 'ur' ? 'شہر بہ شہر مفت قانونی امداد اور این جی اوز' : 'شہر بہ شہر این جی اوز اور قانونی امداد / City-by-City Legal Aid'); ?>
            </h2>
            <p class="section-desc">
                <?php echo $lang === 'en' ? 'Verified organizations assisting citizens in inheritance defense, land rights, and succession.' : ($lang === 'ur' ? 'لاہور، کراچی، اسلام آباد، پشاور، کوئٹہ، ملتان، فیصل آباد اور دیگر شہروں کے مستند ادارے' : 'لاہور، کراچی، اسلام آباد، پشاور، کوئٹہ، ملتان، فیصل آباد سمیت 12+ شہروں کے مستند ادارے &middot; Verified NGOs across 12+ cities.'); ?>
            </p>
        </div>

        <div class="ngos-grid">
            <?php $ngo_delay = 50; foreach ($featured_ngos as $f_ngo): ?>
                <div class="ngo-card featured" data-aos="fade-up" data-aos-delay="<?php echo $ngo_delay; ?>" data-tilt data-tilt-max="4">
                    <div>
                        <div class="ngo-card-header">
                            <div class="ngo-badges">
                                <span class="city-badge"><i class="fa fa-map-marker-alt"></i> <?php echo dual_val($f_ngo['city_ur'], $f_ngo['city_en']); ?></span>
                                <span class="category-badge"><?php echo dual_val($f_ngo['category_ur'], $f_ngo['category_en']); ?></span>
                            </div>
                        </div>
                        <h3 class="ngo-title">
                            <?php echo dual_val($f_ngo['name_ur'], $f_ngo['name_en']); ?>
                        </h3>
                        <div class="ngo-services">
                            <?php echo dual_val($f_ngo['services_ur'], $f_ngo['services_en'], true); ?>
                        </div>
                        
                        <div class="ngo-contact-list">
                            <?php if (!empty($f_ngo['helpline'])): ?>
                                <div class="contact-item">
                                    <i class="fa fa-phone-volume" style="color: var(--danger);"></i>
                                    <strong><?php echo $lang === 'en' ? 'Helpline:' : ($lang === 'ur' ? 'ہیلپ لائن:' : 'ہیلپ لائن / Helpline:'); ?></strong>
                                    <a href="tel:<?php echo safe($f_ngo['helpline']); ?>" style="color: var(--danger); font-weight: 800;"><?php echo safe($f_ngo['helpline']); ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($f_ngo['phone'])): ?>
                                <div class="contact-item">
                                    <i class="fa fa-phone" style="color: var(--primary);"></i>
                                    <strong><?php echo $lang === 'en' ? 'Phone:' : ($lang === 'ur' ? 'فون:' : 'فون / Phone:'); ?></strong>
                                    <a href="tel:<?php echo safe($f_ngo['phone']); ?>"><?php echo safe($f_ngo['phone']); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="ngo-action-bar">
                        <a href="tel:<?php echo safe(!empty($f_ngo['helpline']) ? $f_ngo['helpline'] : $f_ngo['phone']); ?>" class="btn-call">
                            <i class="fa fa-phone-alt"></i> <?php echo t('call_now'); ?>
                        </a>
                        <?php if (!empty($f_ngo['whatsapp'])): ?>
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $f_ngo['whatsapp']); ?>" target="_blank" rel="noopener" class="btn-whatsapp">
                                <i class="fab fa-whatsapp"></i> <?php echo t('whatsapp'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php $ngo_delay += 75; endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="help.php" class="btn btn-primary" style="padding: 12px 30px;">
                <i class="fa fa-list-check"></i> <?php echo $lang === 'en' ? 'View Full Nationwide NGO Directory (25+ Organizations)' : ($lang === 'ur' ? 'تمام شہروں کی مکمل این جی اوز لسٹ دیکھیں (25+ ادارے)' : 'تمام شہروں کی 1 سکرین ہیلپ لسٹ دیکھیں (25+ NGOs Directory)'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Featured Video Guides Showcase -->
<section style="background: #0c2340; padding: 60px 0; color: #ffffff; border-top: 4px solid #ef4444;">
    <div class="container">
        <div class="section-head" style="margin-bottom: 35px;">
            <span class="section-tag" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.4); padding: 5px 16px; border-radius: 20px;">
                <i class="fa-brands fa-youtube"></i> <?php echo dual_val('ویڈیو رہنمائی سیکشن', 'Video Guides Showcase'); ?>
            </span>
            <h2 class="section-title" style="color: #ffffff; margin-top: 10px;">
                <?php echo dual_val('وراثت اور جائیداد کی مرحلہ وار ویڈیو گائیڈز', 'Step-by-Step Legal Video Tutorials'); ?>
            </h2>
            <p class="section-desc" style="color: #f8fafc; font-size: 15px; font-weight: 500;">
                <?php echo dual_val('نادرا سکسیشن، نامعلوم بینک اکاؤنٹس کی تلاش، اور زمین کی تقسیم پر مستند ویڈیو رہنمائی۔', 'Certified procedural videos covering succession, asset discovery and land partition.'); ?>
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
            <div style="background: #11284a; border-radius: var(--radius-md); overflow: hidden; border: 1.5px solid rgba(255,255,255,0.2); box-shadow: var(--shadow-md);">
                <div style="position: relative; padding-top: 56.25%;">
                    <img src="https://img.youtube.com/vi/2WQ7bNK3Rdo/hqdefault.jpg" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                    <a href="https://youtu.be/2WQ7bNK3Rdo?si=i4O2m7msjvQdFoeH" target="_blank" rel="noopener" style="position: absolute; inset:0; background: rgba(0,0,0,0.3); display: flex; align-items:center; justify-content:center;">
                        <span style="width: 50px; height: 50px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px;"><i class="fa fa-play"></i></span>
                    </a>
                </div>
                <div style="padding: 16px;">
                    <h4 style="font-size: 15px; margin-bottom: 6px; color: #ffffff; font-weight: 700; line-height: 1.4;"><?php echo dual_val('نادرا سکسیشن سرٹیفکیٹ کا طریقہ کار', 'NADRA Succession Certificate Procedure'); ?></h4>
                    <span style="font-size: 13px; color: #fde047; font-weight: 700;"><i class="fa fa-folder"></i> نادرا قوانین</span>
                </div>
            </div>

            <div style="background: #11284a; border-radius: var(--radius-md); overflow: hidden; border: 1.5px solid rgba(255,255,255,0.2); box-shadow: var(--shadow-md);">
                <div style="position: relative; padding-top: 56.25%;">
                    <img src="https://img.youtube.com/vi/dWfm0UCg7ck/hqdefault.jpg" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                    <a href="https://youtu.be/dWfm0UCg7ck?si=kgsMULIYQFQnrwzo" target="_blank" rel="noopener" style="position: absolute; inset:0; background: rgba(0,0,0,0.3); display: flex; align-items:center; justify-content:center;">
                        <span style="width: 50px; height: 50px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px;"><i class="fa fa-play"></i></span>
                    </a>
                </div>
                <div style="padding: 16px;">
                    <h4 style="font-size: 15px; margin-bottom: 6px; color: #ffffff; font-weight: 700; line-height: 1.4;"><?php echo dual_val('عدالت کے ذریعے سکسیشن و بینک اکاؤنٹس کی تلاش', 'Civil Court Succession & Bank Search'); ?></h4>
                    <span style="font-size: 13px; color: #fde047; font-weight: 700;"><i class="fa fa-folder"></i> سول کورٹ پروسیجر</span>
                </div>
            </div>

            <div style="background: #11284a; border-radius: var(--radius-md); overflow: hidden; border: 1.5px solid rgba(255,255,255,0.2); box-shadow: var(--shadow-md);">
                <div style="position: relative; padding-top: 56.25%;">
                    <img src="https://img.youtube.com/vi/VEu7IaOcc-A/hqdefault.jpg" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                    <a href="https://youtu.be/VEu7IaOcc-A?si=Ut8EDipp8vjY6PIs" target="_blank" rel="noopener" style="position: absolute; inset:0; background: rgba(0,0,0,0.3); display: flex; align-items:center; justify-content:center;">
                        <span style="width: 50px; height: 50px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px;"><i class="fa fa-play"></i></span>
                    </a>
                </div>
                <div style="padding: 16px;">
                    <h4 style="font-size: 15px; margin-bottom: 6px; color: #ffffff; font-weight: 700; line-height: 1.4;"><?php echo dual_val('پنجاب اراضی ریکارڈ (PLRA) وراثتی انتقال', 'PLRA Land Mutation Procedure'); ?></h4>
                    <span style="font-size: 13px; color: #fde047; font-weight: 700;"><i class="fa fa-folder"></i> اراضی ریکارڈ سنٹر</span>
                </div>
            </div>

            <div style="background: #11284a; border-radius: var(--radius-md); overflow: hidden; border: 1.5px solid rgba(255,255,255,0.2); box-shadow: var(--shadow-md);">
                <div style="position: relative; padding-top: 56.25%;">
                    <img src="https://img.youtube.com/vi/hxsvi0Unryk/hqdefault.jpg" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                    <a href="https://youtu.be/hxsvi0Unryk?si=H-EVBr4wo1IeADxY" target="_blank" rel="noopener" style="position: absolute; inset:0; background: rgba(0,0,0,0.3); display: flex; align-items:center; justify-content:center;">
                        <span style="width: 50px; height: 50px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px;"><i class="fa fa-play"></i></span>
                    </a>
                </div>
                <div style="padding: 16px;">
                    <h4 style="font-size: 15px; margin-bottom: 6px; color: #ffffff; font-weight: 700; line-height: 1.4;"><?php echo dual_val('زرعی زمین کی تقسیم کا قانونی طریقہ کار', 'Agricultural Land Partition Law'); ?></h4>
                    <span style="font-size: 13px; color: #fde047; font-weight: 700;"><i class="fa fa-folder"></i> تقسیم اراضی</span>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="videos.php" class="btn" style="background: #ef4444; color: #ffffff; padding: 12px 28px; font-weight: 700; border-radius: 30px; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);">
                <i class="fa-brands fa-youtube"></i> <?php echo dual_val('تمام 8+ ویڈیو گائیڈز دیکھیں (All Video Guides)', 'View All 8+ Video Guides'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Official Digital Portals Section -->
<section class="portals-section">
    <div class="container">
        <div class="section-head" style="margin-bottom: 25px;">
            <span class="section-tag"><?php echo t('quick_portals'); ?></span>
            <h3 class="section-title" style="font-size: 20px;">
                <?php echo $lang === 'en' ? 'Verified Government Digital Gateways' : ($lang === 'ur' ? 'حکومتی پورٹلز کے آفیشل لنکس' : 'حکومتی پورٹلز کے آفیشل لنکس / Government Digital Portals'); ?>
            </h3>
        </div>

        <div class="portals-grid" data-aos="fade-up">
            <a href="https://www.nadra.gov.pk/identityDocument/certificates/succession?tab=succession" target="_blank" rel="noopener" class="portal-box" data-tilt data-tilt-max="8">
                <i class="fa fa-id-card" style="font-size: 26px; color: var(--primary); margin-bottom: 8px;"></i>
                <h4>نادرا سکسیشن پورٹل</h4>
                <span>NADRA Succession Unit Portal</span>
            </a>

            <a href="https://fbr.gov.pk/malomaat-web-portal-for-the-third-party-and-fbr-data-about-the-existing-and-unregistered-potential-t/173824" target="_blank" rel="noopener" class="portal-box" data-tilt data-tilt-max="8">
                <i class="fa fa-file-invoice-dollar" style="font-size: 26px; color: var(--navy); margin-bottom: 8px;"></i>
                <h4>ایف بی آر معلومات پورٹل</h4>
                <span>FBR Asset Tracing Portal</span>
            </a>

            <a href="https://www.sbp.org.pk/our-subsidiaries/sbp-bsc/list-of-unclaimed-deposits" target="_blank" rel="noopener" class="portal-box" data-tilt data-tilt-max="8">
                <i class="fa fa-vault" style="font-size: 26px; color: var(--gold-dark); margin-bottom: 8px;"></i>
                <h4>اسٹیٹ بینک ان کلیمڈ فنڈز</h4>
                <span>SBP Unclaimed Deposits</span>
            </a>

            <a href="https://mtmis.excise.punjab.gov.pk/" target="_blank" rel="noopener" class="portal-box" data-tilt data-tilt-max="8">
                <i class="fa fa-car" style="font-size: 26px; color: var(--primary); margin-bottom: 8px;"></i>
                <h4>پنجاب ایم ٹی ایم آئی ایس</h4>
                <span>Vehicle Verification (MTMIS)</span>
            </a>

            <a href="https://www.punjab-zameen.gov.pk/" target="_blank" rel="noopener" class="portal-box" data-tilt data-tilt-max="8">
                <i class="fa fa-landmark" style="font-size: 26px; color: var(--navy); margin-bottom: 8px;"></i>
                <h4>پنجاب اراضی ریکارڈ (PLRA)</h4>
                <span>Land Mutation & Partition</span>
            </a>

            <a href="https://sindhrevenue.gos.pk/" target="_blank" rel="noopener" class="portal-box" data-tilt data-tilt-max="8">
                <i class="fa fa-city" style="font-size: 26px; color: var(--gold-dark); margin-bottom: 8px;"></i>
                <h4>سندھ ریونیو بورڈ</h4>
                <span>Sindh DC Valuation Portal</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>
