<?php
require_once __DIR__ . '/header.php';

// Fetch all categories and sections
$cats = $pdo->query("SELECT * FROM categories ORDER BY sort_order ASC")->fetchAll();
$sections = $pdo->query("SELECT * FROM legal_sections ORDER BY category_id ASC, section_number ASC")->fetchAll();

// Group sections by category
$grouped_sections = [];
foreach ($sections as $s) {
    $grouped_sections[$s['category_id']][] = $s;
}
?>

<div class="guide-container">
    <div class="container">
        <!-- Section Header -->
        <div class="section-head">
            <span class="section-tag"><i class="fa fa-scale-balanced"></i> پاکستان لا کمپیڈیم &middot; Pakistan Legal Compendium</span>
            <h1 class="section-title">
                <?php echo $lang === 'en' ? 'Legal Procedures for Requiring Documents to Attain Right of Inheritance' : ($lang === 'ur' ? 'حق وراثت حاصل کرنے کے لیے قانونی طریقہ کار اور ضروری دستاویزات' : 'حق وراثت حاصل کرنے کے لیے قانونی طریقہ کار اور ضروری دستاویزات / Legal Procedures for Inheritance Documents'); ?>
            </h1>
            <p class="section-desc">
                <?php echo $lang === 'en' ? 'Certified operational guide for succession certificates, bank account tracing, land mutation, and legal rights.' : ($lang === 'ur' ? 'نادرا، ایف بی آر، اسٹیٹ بینک اور اراضی ریکارڈ سینٹر سے متعلق تمام قانونی مراحل کی مستند رہنمائی' : 'نادرا، ایف بی آر، اسٹیٹ بینک، اراضی ریکارڈ اور سول کورٹ سے متعلق تمام قانونی مراحل &middot; Operational Guide for Succession, Banking & Land Mutation'); ?>
            </p>

            <!-- Document Download Bar -->
            <div style="display: flex; justify-content: center; gap: 10px; margin-top: 20px; flex-wrap: wrap;">
                <a href="Legal_Procedures_Inheritance_Bilingual.pdf" download class="btn btn-primary btn-sm" style="background: linear-gradient(135deg, var(--gold), var(--gold-dark)); color: #ffffff;">
                    <i class="fa fa-file-pdf"></i> <?php echo dual_val('بائی لنگول پی ڈی ایف ڈاؤنلوڈ (اردو + English)', 'Download Bilingual PDF (Urdu + English)'); ?>
                </a>
                <a href="Legal_Procedures_Inheritance_Bilingual.docx" download class="btn btn-secondary btn-sm" style="color: var(--navy); background: #ffffff; border-color: var(--border-color);">
                    <i class="fa fa-file-word"></i> <?php echo dual_val('بائی لنگول ورڈ فائل (.docx)', 'Download Bilingual Word (.docx)'); ?>
                </a>
                <a href="Legal_Procedures_Inheritance_Urdu.pdf" download class="btn btn-primary btn-sm">
                    <i class="fa fa-file-pdf"></i> <?php echo dual_val('صرف اردو پی ڈی ایف', 'Urdu-only PDF'); ?>
                </a>
            </div>
        </div>

        <!-- In-page Live Search -->
        <div style="max-width: 600px; margin: 0 auto 25px;">
            <input type="text" id="portal-search-input" class="form-control" style="padding: 12px 18px; border-radius: 30px; box-shadow: var(--shadow-sm);"
                   placeholder="<?php echo $lang === 'en' ? 'Search legal sections, trial steps, NADRA, CPC, court...' : ($lang === 'ur' ? 'عدالتی کارروائی، قانون، سیکشن، نادرا، یا سول کورٹ سرچ کریں...' : 'عدالتی کارروائی، سیکشن، نادرا یا کورٹ تلاش کریں / Search Sections, CPC, Court...'); ?>">
        </div>

        <!-- Category Navigation Quick-Pills -->
        <div class="guide-category-pills">
            <button type="button" class="guide-pill-btn active" onclick="filterCategoryPill('all', this)">
                <i class="fa fa-list"></i> <?php echo dual_val('تمام قانونی گائیڈز (All)', 'All Guides'); ?>
            </button>
            <a href="#cat-6" class="guide-pill-btn featured" onclick="filterCategoryPill('cat-6', this)">
                <i class="fa fa-gavel"></i> <?php echo dual_val('🏛️ وراثتی مکان میں عدالتی کارروائی (۸ مراحل) [نیا روڈ میپ]', '🏛️ Residential Trial Roadmap (8 Steps) [NEW]'); ?>
            </a>
            <?php foreach ($cats as $c): ?>
                <?php if ($c['id'] != 6): ?>
                    <a href="#cat-<?php echo $c['id']; ?>" class="guide-pill-btn" onclick="filterCategoryPill('cat-<?php echo $c['id']; ?>', this)">
                        <i class="fa-solid fa-<?php echo $c['icon']; ?>"></i> <?php echo dual_val($c['title_ur'], $c['title_en']); ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Guide Sections Display -->
        <div class="guide-content-area">
            <?php foreach ($cats as $cat): ?>
                <?php
                $cat_sections = isset($grouped_sections[$cat['id']]) ? $grouped_sections[$cat['id']] : [];
                ?>
                <section class="guide-section-block" id="cat-<?php echo $cat['id']; ?>" data-aos="fade-up">
                    <div class="guide-section-header">
                        <h2>
                            <i class="fa-solid fa-<?php echo $cat['icon']; ?>" style="color: var(--primary); margin-left: 8px; margin-right: 8px;"></i>
                            <?php echo dual_val($cat['title_ur'], $cat['title_en']); ?>
                        </h2>
                        <span class="category-badge">
                            <?php echo count($cat_sections); ?> <?php echo $lang === 'en' ? 'Articles' : ($lang === 'ur' ? 'مراحل' : 'مراحل / Articles'); ?>
                        </span>
                    </div>

                    <?php if ($cat['id'] == 6): ?>
                        <!-- INTERACTIVE TRIAL PROCEEDINGS STEPPER CARD -->
                        <div class="trial-roadmap-card">
                            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
                                <span style="background: var(--gold); color: var(--navy); font-size: 11.5px; font-weight: 800; padding: 4px 12px; border-radius: 12px; letter-spacing: 0.5px;">
                                    <i class="fa fa-scale-balanced"></i> CODE OF CIVIL PROCEDURE (CPC) 1908 & SPECIFIC RELIEF ACT 1877
                                </span>
                                <span style="font-size: 12.5px; color: #a7f3d0; font-weight: 700;">
                                    <i class="fa fa-clock"></i> رہائشی مکان میں حقِ وراثت کا مرحلہ وار عدالتی روڈ میپ
                                </span>
                            </div>

                            <p style="font-size: 14px; line-height: 1.85; color: #e2e8f0; margin-bottom: 16px;">
                                <?php echo dual_val(
                                    '<strong>بنیادی قانونی خاکہ:</strong> پاکستان میں جب کسی خاتون کو وراثتی مکان (رہائشی/شہری غیر منقولہ جائیداد) میں اپنا شرعی و قانونی حقِ وراثت حاصل کرنا ہو، تو قانونی چارہ جوئی عام طور پر <strong>Code of Civil Procedure, 1908 (CPC)</strong> اور <strong>Specific Relief Act, 1877</strong> کے تحت دیوانی مقدمے کے ذریعے عمل میں لائی جاتی ہے۔ اس کے ساتھ ساتھ متعلقہ فورمز پر متوازی فوجداری کارروائی یا محتسب (Ombudsperson) سے بھی رجوع کیا جا سکتا ہے۔',
                                    '<strong>Basic Legal Framework:</strong> When a woman in Pakistan seeks to attain her Shariah and statutory inheritance share in a residential inherited house (urban immovable property), legal proceedings are instituted via a Civil Suit under the <strong>Code of Civil Procedure, 1908 (CPC)</strong> and <strong>Specific Relief Act, 1877</strong>. Concurrently, fast-track parallel criminal remedies or recourse to the Ombudsperson can also be invoked.'
                                ); ?>
                            </p>

                            <!-- 8 Steps Clickable Stepper Grid -->
                            <div class="trial-stepper">
                                <?php foreach ($cat_sections as $idx => $s): ?>
                                    <a href="#article-<?php echo $s['id']; ?>" class="trial-step-item" <?php echo $s['section_number'] === 'فوری دادرسی' ? 'style="border-color: #f87171; background: rgba(239, 68, 68, 0.18);"' : ''; ?>>
                                        <span class="trial-step-badge" <?php echo $s['section_number'] === 'فوری دادرسی' ? 'style="color: #fca5a5;"' : ''; ?>>
                                            <?php echo safe($s['section_number']); ?>
                                        </span>
                                        <span class="trial-step-title" <?php echo $s['section_number'] === 'فوری دادرسی' ? 'style="color: #fee2e2;"' : ''; ?>>
                                            <?php echo dual_val($s['title_ur'], $s['title_en']); ?>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="guide-body">
                        <?php foreach ($cat_sections as $sec): ?>
                            <article class="guide-article" id="article-<?php echo $sec['id']; ?>">
                                <h3>
                                    <span style="color: var(--gold-dark); font-weight: 800;"><?php echo safe($sec['section_number']); ?></span>
                                    <?php echo dual_val($sec['title_ur'], $sec['title_en']); ?>
                                </h3>

                                <?php if (!empty($sec['subtitle_ur']) || !empty($sec['subtitle_en'])): ?>
                                    <p style="font-size: 13.5px; font-weight: 600; color: var(--navy); margin-bottom: 12px;">
                                        <?php echo dual_val($sec['subtitle_ur'], $sec['subtitle_en']); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($lang === 'both'): ?>
                                    <div class="dual-guide-content" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; background: #f8fafc; padding: 18px; border-radius: var(--radius-md); border: 1px solid var(--border-color); margin-bottom: 15px;">
                                        <div class="guide-lang-ur" style="direction: rtl; text-align: right; border-left: 1px solid var(--border-color); padding-left: 15px;">
                                            <span style="display: inline-block; font-size: 11px; font-weight: 700; background: var(--primary); color: #ffffff; padding: 2px 8px; border-radius: 4px; margin-bottom: 8px;">اردو متن</span>
                                            <div style="font-family: 'Noto Nastaliq Urdu', serif; font-size: 13px; line-height: 2; color: #1e293b;">
                                                <?php echo nl2br(safe($sec['content_ur'])); ?>
                                            </div>
                                        </div>
                                        <div class="guide-lang-en" style="direction: ltr; text-align: left; padding-right: 5px;">
                                            <span style="display: inline-block; font-size: 11px; font-weight: 700; background: var(--navy); color: #ffffff; padding: 2px 8px; border-radius: 4px; margin-bottom: 8px;">English Text</span>
                                            <div style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; line-height: 1.6; color: #334155;">
                                                <?php echo nl2br(safe($sec['content_en'])); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($lang === 'ur'): ?>
                                    <div class="article-content" style="font-family: 'Noto Nastaliq Urdu', serif; line-height: 2.1;"><?php echo nl2br(safe($sec['content_ur'])); ?></div>
                                <?php else: ?>
                                    <div class="article-content" style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 1.7;"><?php echo nl2br(safe($sec['content_en'])); ?></div>
                                <?php endif; ?>

                                <?php if (!empty($sec['video_url'])): ?>
                                    <?php
                                    $yt_id = get_youtube_id($sec['video_url']);
                                    $thumb = $yt_id ? "https://img.youtube.com/vi/{$yt_id}/mqdefault.jpg" : '';
                                    ?>
                                    <div class="article-video-callout">
                                        <?php if ($thumb): ?>
                                            <div class="video-callout-thumb">
                                                <img src="<?php echo safe($thumb); ?>" alt="Video Tutorial">
                                                <span class="mini-play-icon"><i class="fa fa-play"></i></span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="video-callout-text">
                                            <span class="video-callout-badge">
                                                <i class="fa-brands fa-youtube"></i> <?php echo dual_val('عملی ویڈیو گائیڈ', 'Video Tutorial Available'); ?>
                                            </span>
                                            <h4 style="margin: 3px 0 0; font-size: 14.5px; color: var(--navy);">
                                                <?php echo dual_val($sec['video_label_ur'], $sec['video_label_en']); ?>
                                            </h4>
                                        </div>
                                        <a href="<?php echo safe($sec['video_url']); ?>" target="_blank" rel="noopener" class="btn-callout-watch">
                                            <i class="fa fa-play"></i> <?php echo dual_val('ویڈیو دیکھیں', 'Watch Video'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="article-meta-bar">
                                    <?php if (!empty($sec['legal_basis_ur']) || !empty($sec['legal_basis_en'])): ?>
                                        <div class="legal-citation">
                                            <i class="fa fa-gavel" style="color: var(--gold-dark);"></i>
                                            <span>
                                                <strong><?php echo $lang === 'en' ? 'Statutory Basis:' : ($lang === 'ur' ? 'قانونی بنیاد:' : 'قانونی بنیاد / Statutory Basis:'); ?></strong> 
                                                <?php echo dual_val($sec['legal_basis_ur'], $sec['legal_basis_en']); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="meta-links">
                                        <?php if (!empty($sec['official_url'])): ?>
                                            <a href="<?php echo safe($sec['official_url']); ?>" target="_blank" rel="noopener" class="btn-link-action">
                                                <i class="fa fa-external-link-alt" style="color: var(--primary);"></i>
                                                <?php echo dual_val($sec['official_link_label_ur'], $sec['official_link_label_en']); ?>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($sec['video_url'])): ?>
                                            <a href="<?php echo safe($sec['video_url']); ?>" target="_blank" rel="noopener" class="btn-link-action">
                                                <i class="fa-brands fa-youtube" style="color: #ef4444;"></i>
                                                <?php echo dual_val($sec['video_label_ur'], $sec['video_label_en']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
function filterCategoryPill(targetId, btn) {
    document.querySelectorAll('.guide-pill-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');

    const blocks = document.querySelectorAll('.guide-section-block');
    if (targetId === 'all') {
        blocks.forEach(sec => sec.style.display = 'block');
    } else {
        blocks.forEach(sec => {
            if (sec.id === targetId) {
                sec.style.display = 'block';
                sec.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                sec.style.display = 'none';
            }
        });
    }
}
</script>

<?php require_once __DIR__ . '/footer.php'; ?>
