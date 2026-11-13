<?php
require_once __DIR__ . '/header.php';

// Fetch all sections that have video URLs
$stmt = $pdo->query("SELECT s.*, c.title_ur as cat_ur, c.title_en as cat_en, c.icon as cat_icon 
                     FROM legal_sections s 
                     JOIN categories c ON s.category_id = c.id 
                     WHERE s.video_url IS NOT NULL AND length(s.video_url) > 0 
                     ORDER BY s.category_id ASC, s.section_number ASC");
$videos = $stmt->fetchAll();

// Also additional verified legal video guides from the master document
$extra_videos = [
    [
        'id' => 101,
        'category_id' => 1,
        'cat_ur' => 'بینک اکاؤنٹس و مالیاتی اثاثے',
        'cat_en' => 'Bank Accounts & Assets',
        'section_number' => '1.2-B',
        'title_ur' => 'ایف بی آر معلومات پورٹل سے متوفی کے پوشیدہ بینک اثاثے تلاش کرنے کا طریقہ',
        'title_en' => 'How to Trace Deceased Bank Accounts via FBR Maloomat Portal',
        'video_url' => 'https://youtu.be/yWy7nItoMpg?si=pTBzDHA5opFYnK4w',
        'video_label_ur' => 'ایف بی آر معلومات پورٹل ویڈیو گائیڈ',
        'video_label_en' => 'FBR Asset Tracing Video Guide',
        'summary_ur' => 'متوفی کے شناختی کارڈ کے ذریعے FBR ڈیٹا بیس سے نامعلوم اکاؤنٹس اور ویلتھ گوشواروں کی کھوج۔',
        'summary_en' => 'Step-by-step tutorial on tracing active bank accounts and assets using FBR IRIS & Maloomat.'
    ],
    [
        'id' => 102,
        'category_id' => 1,
        'cat_ur' => 'بینک اکاؤنٹس و مالیاتی اثاثے',
        'cat_en' => 'Bank Accounts & Assets',
        'section_number' => '1.2-C',
        'title_ur' => 'اسٹیٹ بینک آف پاکستان (SBP) کا ریگولیٹری سرکلر اور تمام بینکوں سے اکاؤنٹس رپورٹ',
        'title_en' => 'SBP Regulatory Circular for Commercial Bank Account Search',
        'video_url' => 'https://www.facebook.com/share/v/1EYuX61H1F/?mibextid=wwXIfr',
        'video_label_ur' => 'اسٹیٹ بینک سرکلر ویڈیو رہنمائی',
        'video_label_en' => 'SBP Bank Circular Video Guide',
        'summary_ur' => 'سول جج کے حکم پر اسٹیٹ بینک تمام شیڈولڈ بینکوں کو نامعلوم کھاتے تلاش کرنے کی ہدایت کیسے جاری کرتا ہے۔',
        'summary_en' => 'How Senior Civil Judge requisitions SBP to search all commercial banks under CPC Order XI.'
    ]
];

$all_videos = array_merge($videos, $extra_videos);
?>

<div class="container" style="padding: 40px 20px 70px;">
    <!-- Page Header -->
    <div class="section-head">
        <span class="section-tag" style="background: rgba(239, 68, 68, 0.1); color: #dc2626; padding: 6px 18px; border-radius: 20px; font-weight: 700;">
            <i class="fa-brands fa-youtube" style="font-size: 16px;"></i> 
            <?php echo dual_val('تمام مصدقہ ویڈیو گائیڈز', 'All Certified Video Guides'); ?>
        </span>
        <h1 class="section-title" style="margin-top: 14px;">
            <?php echo dual_val('وراثت اور جائیداد کے قانونی طریقہ کار کی ویڈیو رہنمائی', 'Video Guides for Inheritance, Succession & Asset Tracing'); ?>
        </h1>
        <p class="section-desc">
            <?php echo dual_val('نادرا سکسیشن، سول کورٹ دعویٰ، نامعلوم بینک اکاؤنٹس کی تلاش، اراضی ریکارڈ اور خواتین کے حقوق پر مستند ماہرین اور اداروں کی مرحلہ وار ویڈیوز۔', 'Step-by-step video tutorials explaining NADRA succession, court procedures, asset discovery, and land mutation.'); ?>
        </p>
    </div>

    <!-- Live Search & Filter Bar -->
    <div style="max-width: 700px; margin: 0 auto 35px;">
        <div style="position: relative;">
            <input type="text" id="video-search-input" class="form-control" 
                   style="padding: 14px 22px; border-radius: 30px; font-size: 15px; box-shadow: var(--shadow-sm);"
                   placeholder="<?php echo dual_val('ویڈیو کا عنوان، نادرا، بینک، گاڑی، زمین یا موضوع تلاش کریں...', 'Search video guides by topic, NADRA, banks, land partition...'); ?>">
            <i class="fa fa-search" style="position: absolute; right: 20px; top: 16px; color: var(--text-muted); font-size: 16px;"></i>
        </div>
    </div>

    <!-- Video Grid -->
    <div class="video-gallery-grid" id="videos-container">
        <?php foreach ($all_videos as $v): ?>
            <?php
            $yt_id = get_youtube_id($v['video_url']);
            $thumb_url = $yt_id ? "https://img.youtube.com/vi/{$yt_id}/hqdefault.jpg" : 'assets/css/video_placeholder.svg';
            $embed_url = $yt_id ? "https://www.youtube.com/embed/{$yt_id}?autoplay=1" : $v['video_url'];
            $sec_num = $v['section_number'] ?? '';
            $cat_title = $v['cat_ur'] ?? ($v['category_ur'] ?? '');
            ?>
            <div class="video-card" data-title="<?php echo strtolower($v['title_ur'] . ' ' . $v['title_en'] . ' ' . $v['video_label_ur'] . ' ' . $v['video_label_en']); ?>">
                <!-- Video Thumbnail Container -->
                <div class="video-thumb-wrap">
                    <img src="<?php echo safe($thumb_url); ?>" alt="<?php echo safe($v['title_ur']); ?>" class="video-thumb-img" onerror="this.src='https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&w=600&q=80';">
                    <div class="video-play-overlay" onclick="openVideoModal('<?php echo safe($embed_url); ?>', '<?php echo safe(addslashes($v['title_ur'])); ?>')">
                        <div class="play-btn-circle">
                            <i class="fa fa-play"></i>
                        </div>
                    </div>
                    <?php if (!empty($sec_num)): ?>
                        <span class="video-badge-stage">مرحلہ <?php echo safe($sec_num); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Video Info -->
                <div class="video-info-body">
                    <span class="video-category-tag">
                        <i class="fa fa-folder-open"></i> <?php echo dual_val($v['cat_ur'] ?? 'قانونی گائیڈ', $v['cat_en'] ?? 'Legal Guide'); ?>
                    </span>

                    <h3 class="video-card-title">
                        <?php echo dual_val($v['title_ur'], $v['title_en']); ?>
                    </h3>

                    <?php if (!empty($v['summary_ur']) || !empty($v['summary_en'])): ?>
                        <p class="video-card-desc">
                            <?php echo dual_val($v['summary_ur'] ?? '', $v['summary_en'] ?? '', true); ?>
                        </p>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <div class="video-action-row">
                        <button type="button" class="btn-watch-modal" onclick="openVideoModal('<?php echo safe($embed_url); ?>', '<?php echo safe(addslashes($v['title_ur'])); ?>')">
                            <i class="fa fa-play"></i> <?php echo dual_val('ویڈیو دیکھیں', 'Watch Now'); ?>
                        </button>
                        
                        <a href="<?php echo safe($v['video_url']); ?>" target="_blank" rel="noopener" class="btn-yt-external" title="Open directly in YouTube / External">
                            <i class="fa-brands fa-youtube" style="color: #ef4444;"></i>
                        </a>

                        <a href="guide.php#cat-<?php echo safe($v['category_id'] ?? 1); ?>" class="btn-guide-ref" title="Read corresponding legal procedure">
                            <i class="fa fa-book-open"></i> <?php echo dual_val('قانونی تحریر', 'Read Law'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Video Lightbox Modal -->
<div id="videoModal" class="video-modal-backdrop" onclick="closeVideoModal(event)">
    <div class="video-modal-dialog">
        <div class="video-modal-header">
            <h4 id="videoModalTitle" style="color: #ffffff; font-size: 16px; margin: 0; font-weight: 700;"></h4>
            <button type="button" class="video-modal-close" onclick="closeVideoModalForce()">&times;</button>
        </div>
        <div class="video-iframe-wrap">
            <iframe id="videoIframe" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<style>
/* Video Gallery Styles */
.video-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 28px;
}

.video-card {
    background: #ffffff;
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
}

.video-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(239, 68, 68, 0.4);
}

.video-thumb-wrap {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* 16:9 Aspect Ratio */
    background: #0c2340;
    overflow: hidden;
    cursor: pointer;
}

.video-thumb-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.video-card:hover .video-thumb-img {
    transform: scale(1.06);
}

.video-play-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(12, 35, 64, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
}

.video-card:hover .video-play-overlay {
    background: rgba(12, 35, 64, 0.15);
}

.play-btn-circle {
    width: 58px;
    height: 58px;
    background: #ef4444;
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.5);
    transition: transform 0.25s ease, background 0.25s ease;
    padding-left: 3px;
}

.video-card:hover .play-btn-circle {
    transform: scale(1.15);
    background: #dc2626;
}

.video-badge-stage {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: rgba(12, 35, 64, 0.85);
    color: var(--gold-light);
    font-size: 11.5px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 4px;
    backdrop-filter: blur(4px);
}
html[dir="ltr"] .video-badge-stage {
    right: auto;
    left: 12px;
}

.video-info-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.video-category-tag {
    display: inline-block;
    font-size: 12px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 8px;
}

.video-card-title {
    font-size: 15.5px;
    font-weight: 800;
    color: var(--navy);
    line-height: 1.5;
    margin-bottom: 10px;
}

.video-card-desc {
    font-size: 13px;
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 16px;
    flex: 1;
}

.video-action-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid var(--border-color);
}

.btn-watch-modal {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #ffffff;
    font-weight: 700;
    font-size: 13.5px;
    padding: 9px 14px;
    border-radius: var(--radius-sm);
    border: none;
    cursor: pointer;
    transition: var(--transition);
}

.btn-watch-modal:hover {
    background: #b91c1c;
    box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
}

.btn-yt-external, .btn-guide-ref {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    background: #f1f5f9;
    color: var(--navy);
    font-weight: 600;
    font-size: 12px;
    padding: 9px 12px;
    border-radius: var(--radius-sm);
    text-decoration: none;
    border: 1px solid var(--border-color);
    transition: var(--transition);
}

.btn-yt-external:hover, .btn-guide-ref:hover {
    background: #e2e8f0;
    color: var(--primary);
}

/* Modal Backdrop */
.video-modal-backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(8, 22, 40, 0.85);
    z-index: 2000;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(5px);
}

.video-modal-dialog {
    background: #0c2340;
    width: 100%;
    max-width: 850px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.video-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    background: #081628;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.video-modal-close {
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 26px;
    cursor: pointer;
    line-height: 1;
}

.video-iframe-wrap {
    position: relative;
    padding-top: 56.25%;
    width: 100%;
}

.video-iframe-wrap iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

@media (max-width: 600px) {
    .video-gallery-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function openVideoModal(url, title) {
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoIframe');
    const titleElem = document.getElementById('videoModalTitle');
    
    titleElem.innerText = title;
    iframe.src = url;
    modal.style.display = 'flex';
}

function closeVideoModal(e) {
    if (e.target.id === 'videoModal') {
        closeVideoModalForce();
    }
}

function closeVideoModalForce() {
    const modal = document.getElementById('videoModal');
    const iframe = document.getElementById('videoIframe');
    iframe.src = '';
    modal.style.display = 'none';
}

// Live Search Filter for Videos
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('video-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.video-card');
            
            cards.forEach(card => {
                const text = card.getAttribute('data-title') || '';
                if (text.includes(query)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});
</script>

<?php require_once __DIR__ . '/footer.php'; ?>
