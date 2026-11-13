<?php
require_once __DIR__ . '/header.php';

// Filter parameters
$selected_city = isset($_GET['city']) ? trim($_GET['city']) : 'all';
$selected_province = isset($_GET['province']) ? trim($_GET['province']) : 'all';
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

// Build Query
$sql = "SELECT * FROM ngos WHERE 1=1";
$params = [];

if ($selected_city !== 'all' && !empty($selected_city)) {
    $sql .= " AND (city_en LIKE ? OR city_ur LIKE ?)";
    $params[] = "%$selected_city%";
    $params[] = "%$selected_city%";
}

if (!empty($search_query)) {
    $sql .= " AND (name_en LIKE ? OR name_ur LIKE ? OR city_en LIKE ? OR city_ur LIKE ? OR helpline LIKE ? OR phone LIKE ?)";
    $p = "%$search_query%";
    $params = array_merge($params, [$p, $p, $p, $p, $p, $p]);
}

$sql .= " ORDER BY is_featured DESC, id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$ngos_list = $stmt->fetchAll();

// Province Classification Helper
function get_province_key($prov_ur, $prov_en = '') {
    $str = mb_strtolower($prov_ur . ' ' . $prov_en);
    if (strpos($str, 'kashmir') !== false || strpos($str, 'کشمیر') !== false || strpos($str, 'gilgit') !== false || strpos($str, 'گلگت') !== false || strpos($str, 'ajk') !== false) {
        return 'ajk_gb';
    }
    if (strpos($str, 'federal') !== false || strpos($str, 'وفاق') !== false || strpos($str, 'اسلام آباد') !== false) {
        return 'federal';
    }
    if (strpos($str, 'punjab') !== false || strpos($str, 'پنجاب') !== false) {
        return 'punjab';
    }
    if (strpos($str, 'sindh') !== false || strpos($str, 'سندھ') !== false) {
        return 'sindh';
    }
    if (strpos($str, 'khyber') !== false || strpos($str, 'پختونخوا') !== false || strpos($str, 'kp') !== false) {
        return 'kp';
    }
    if (strpos($str, 'balochistan') !== false || strpos($str, 'بلوچستان') !== false) {
        return 'balochistan';
    }
    return 'federal';
}

$provinces_meta = [
    'federal' => [
        'key' => 'federal',
        'title_ur' => 'وفاقی دارالحکومت (اسلام آباد)',
        'title_en' => 'Federal Capital (Islamabad & National Helplines)',
        'icon' => 'fa-landmark',
        'color' => '#0f4c3a',
        'desc_ur' => 'قومی ہیلپ لائنز، وزارتِ انسانی حقوق اور وفاقی محتسب برائے جائیداد (FOSPAH)'
    ],
    'punjab' => [
        'key' => 'punjab',
        'title_ur' => 'صوبہ پنجاب (Punjab)',
        'title_en' => 'Punjab Province',
        'icon' => 'fa-building-columns',
        'color' => '#15803d',
        'desc_ur' => 'لاہور، راولپنڈی، ملتان، فیصل آباد اور گوجرانوالہ کے سرکاری و مفت قانونی مراکز'
    ],
    'sindh' => [
        'key' => 'sindh',
        'title_ur' => 'صوبہ سندھ (Sindh)',
        'title_en' => 'Sindh Province',
        'icon' => 'fa-water',
        'color' => '#0284c7',
        'desc_ur' => 'کراچی، حیدرآباد، سکھر اور لیگل ایڈ سوسائٹی کے تصدیق شدہ لیگل ہیلپ ڈیسک'
    ],
    'kp' => [
        'key' => 'kp',
        'title_ur' => 'صوبہ خیبر پختونخوا (KP)',
        'title_en' => 'Khyber Pakhtunkhwa',
        'icon' => 'fa-mountain',
        'color' => '#d97706',
        'desc_ur' => 'پشاور، ایبٹ آباد / ہزارہ اور ملحقہ اضلاع کے وراثتی قانونی معاونتی مراکز'
    ],
    'balochistan' => [
        'key' => 'balochistan',
        'title_ur' => 'صوبہ بلوچستان (Balochistan)',
        'title_en' => 'Balochistan Province',
        'icon' => 'fa-shield-halved',
        'color' => '#dc2626',
        'desc_ur' => 'کوئٹہ اور بلوچستان ویمن ڈیسک و مفت قانونی نمائندگی کے مراکز'
    ],
    'ajk_gb' => [
        'key' => 'ajk_gb',
        'title_ur' => 'آزاد جموں و کشمیر اور گلگت بلتستان',
        'title_en' => 'AJK & Gilgit-Baltistan',
        'icon' => 'fa-mountain-sun',
        'color' => '#7c3aed',
        'desc_ur' => 'مظفر آباد اور گلگت بلتستان کے خصوصی قانونی معاونت و وراثت سہولت کاری ڈیسک'
    ],
];

// Partition NGOs into provincial buckets
$ngos_by_province = [
    'federal' => [],
    'punjab' => [],
    'sindh' => [],
    'kp' => [],
    'balochistan' => [],
    'ajk_gb' => []
];

foreach ($ngos_list as $ngo) {
    $pkey = get_province_key($ngo['province_ur'], $ngo['province_en']);
    if (isset($ngos_by_province[$pkey])) {
        $ngos_by_province[$pkey][] = $ngo;
    } else {
        $ngos_by_province['federal'][] = $ngo;
    }
}

$featured_cities = [
    ['all', 'تمام شہر', 'All Cities'],
    ['lahore', 'لاہور', 'Lahore'],
    ['karachi', 'کراچی', 'Karachi'],
    ['islamabad', 'اسلام آباد', 'Islamabad'],
    ['rawalpindi', 'راولپنڈی', 'Rawalpindi'],
    ['peshawar', 'پشاور', 'Peshawar'],
    ['quetta', 'کوئٹہ', 'Quetta'],
    ['multan', 'ملتان', 'Multan'],
    ['faisalabad', 'فیصل آباد', 'Faisalabad'],
    ['hyderabad', 'حیدرآباد', 'Hyderabad'],
    ['sukkur', 'سکھر', 'Sukkur'],
    ['gujranwala', 'گوجرانوالہ', 'Gujranwala'],
    ['abbottabad', 'ایبٹ آباد', 'Abbottabad'],
    ['muzaffarabad', 'مظفر آباد', 'Muzaffarabad'],
    ['gilgit', 'گلگت', 'Gilgit']
];
?>

<div class="help-page-wrap" style="background: #f8fafc; padding-bottom: 70px;">
    <div class="container">
        <!-- Simplified Header -->
        <div class="section-head" style="margin-bottom: 25px; text-align: center;">
            <span class="section-tag" style="background: #0f4c3a; color: #ffffff; padding: 6px 20px; border-radius: 20px; font-weight: 800; font-size: 13px;">
                <i class="fa fa-phone-volume"></i> <?php echo dual_val('صوبہ وار قومی قانونی ہیلپ لائنز و رابطہ نمبرز', 'Province-wise Legal Helplines & Contacts'); ?>
            </span>
            <h1 class="section-title" style="margin-top: 12px; font-size: 26px;">
                <?php echo dual_val('شہریوں کے لیے مفت قانونی امداد اور صوبائی ہیلپ لائنز', 'Free Citizen Legal Aid & Provincial Helplines'); ?>
            </h1>
            <p class="section-desc" style="max-width: 780px; margin: 0 auto; color: #475569; font-size: 15px;">
                <?php echo dual_val('وراثت سے محرومی، جائیداد پر غیر قانونی قبضے یا قانونی رہنمائی کے لیے اپنے صوبے اور قریبی شہر کے ادارے سے فوری رابطہ کریں۔ تمام 27 ادارے اور نمبرز تصدیق شدہ ہیں۔', 'Direct contact numbers and hotlines for inheritance defense and legal protection across all provinces of Pakistan.'); ?>
            </p>
        </div>

        <!-- 1. TOP SPEED-DIAL EMERGENCY HOTLINES (4 BIG CARDS) -->
        <div class="speed-dial-grid" data-aos="fade-up">
            <div class="speed-dial-card hotline-1099" data-tilt data-tilt-max="6">
                <div class="speed-dial-icon"><i class="fa fa-scale-balanced"></i></div>
                <div class="speed-dial-body">
                    <span class="speed-badge"><?php echo dual_val('مفت قانونی امداد و وکیل', 'Free Legal Aid & Lawyer'); ?></span>
                    <h3>وزارتِ انسانی حقوق</h3>
                    <div class="speed-number">1099</div>
                    <p>پورے پاکستان میں مفت قانونی مشورہ</p>
                </div>
                <a href="tel:1099" class="btn-speed-call">
                    <i class="fa fa-phone-alt"></i> کال ملائیں (Call 1099)
                </a>
            </div>

            <div class="speed-dial-card hotline-1043" data-tilt data-tilt-max="6">
                <div class="speed-dial-icon"><i class="fa fa-female"></i></div>
                <div class="speed-dial-body">
                    <span class="speed-badge"><?php echo dual_val('خواتین حقوق و وراثت', 'Women Rights Helpline'); ?></span>
                    <h3>پنجاب ویمن پروٹیکشن</h3>
                    <div class="speed-number">1043</div>
                    <p>خواتین کو وراثت و تحفظ کی فراہمی</p>
                </div>
                <a href="tel:1043" class="btn-speed-call">
                    <i class="fa fa-phone-alt"></i> کال ملائیں (Call 1043)
                </a>
            </div>

            <div class="speed-dial-card hotline-1098" data-tilt data-tilt-max="6">
                <div class="speed-dial-icon"><i class="fa fa-hand-holding-heart"></i></div>
                <div class="speed-dial-body">
                    <span class="speed-badge"><?php echo dual_val('سندھ و کراچی ریجن', 'Sindh Legal Aid Helpline'); ?></span>
                    <h3>لیگل ایڈ سوسائٹی</h3>
                    <div class="speed-number">1098</div>
                    <p>مفت وکالت اور قانونی رہنمائی</p>
                </div>
                <a href="tel:1098" class="btn-speed-call">
                    <i class="fa fa-phone-alt"></i> کال ملائیں (Call 1098)
                </a>
            </div>

            <div class="speed-dial-card hotline-1055" data-tilt data-tilt-max="6">
                <div class="speed-dial-icon"><i class="fa fa-building-shield"></i></div>
                <div class="speed-dial-body">
                    <span class="speed-badge"><?php echo dual_val('وفاقی محتسب جائیداد', 'Women Property Ombudsman'); ?></span>
                    <h3>فوسپاہ (FOSPAH)</h3>
                    <div class="speed-number">1055</div>
                    <p>جائیداد سے بے دخلی روکنے کا ادارہ</p>
                </div>
                <a href="tel:1055" class="btn-speed-call">
                    <i class="fa fa-phone-alt"></i> کال ملائیں (Call 1055)
                </a>
            </div>
        </div>

        <!-- 2. STREAMLINED SEARCH & PROVINCE/CITY FILTER CONTROLS -->
        <div class="simplified-filter-box">
            <div class="filter-top-bar">
                <!-- Search Box -->
                <div class="search-input-wrap">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" id="portal-search-input" value="<?php echo safe($search_query); ?>" 
                           class="clean-search-input" 
                           placeholder="<?php echo dual_val('ادارے کا نام، فون نمبر، یا شہر تلاش کریں...', 'Search organization, phone number, or city...'); ?>">
                </div>

                <!-- Dropdown for Quick City Selection -->
                <div class="city-select-wrap">
                    <i class="fa fa-map-marker-alt select-icon"></i>
                    <select id="city-dropdown-select" class="clean-city-select">
                        <option value="all"><?php echo dual_val('تمام شہر (پاکستان بھر میں)', 'All Cities (Nationwide)'); ?></option>
                        <option value="lahore">لاہور (Lahore)</option>
                        <option value="karachi">کراچی (Karachi)</option>
                        <option value="islamabad">اسلام آباد (Islamabad)</option>
                        <option value="rawalpindi">راولپنڈی (Rawalpindi)</option>
                        <option value="peshawar">پشاور (Peshawar)</option>
                        <option value="quetta">کوئٹہ (Quetta)</option>
                        <option value="multan">ملتان (Multan)</option>
                        <option value="faisalabad">فیصل آباد (Faisalabad)</option>
                        <option value="hyderabad">حیدرآباد (Hyderabad)</option>
                        <option value="sukkur">سکھر (Sukkur)</option>
                        <option value="gujranwala">گوجرانوالہ (Gujranwala)</option>
                        <option value="abbottabad">ایبٹ آباد (Abbottabad)</option>
                        <option value="muzaffarabad">مظفر آباد (Muzaffarabad)</option>
                        <option value="gilgit">گلگت (Gilgit)</option>
                    </select>
                </div>

                <!-- View Switcher (List vs Cards) -->
                <div class="view-toggle-wrap">
                    <button type="button" class="view-btn active" id="btn-view-cards" onclick="switchView('cards')">
                        <i class="fa fa-th-large"></i> <?php echo dual_val('کارڈز ویو', 'Cards'); ?>
                    </button>
                    <button type="button" class="view-btn" id="btn-view-list" onclick="switchView('list')">
                        <i class="fa fa-list"></i> <?php echo dual_val('فوری فون لسٹ', 'Quick List'); ?>
                    </button>
                </div>
            </div>

            <!-- PROVINCE QUICK TABS / PILLS (PRIMARY NAVIGATION) -->
            <div class="province-quick-pills">
                <span style="font-weight: 800; font-size: 13.5px; color: var(--navy); display: flex; align-items: center; gap: 6px;">
                    <i class="fa fa-map-location-dot" style="color: var(--primary);"></i> <?php echo dual_val('صوبائی تقسیم:', 'By Province:'); ?>
                </span>
                <button type="button" class="province-pill active" data-province="all">
                    <i class="fa fa-globe-asia"></i> <?php echo dual_val('تمام صوبے', 'All Provinces'); ?>
                    <span class="count-badge"><?php echo count($ngos_list); ?></span>
                </button>
                <?php foreach (['federal', 'punjab', 'sindh', 'kp', 'balochistan', 'ajk_gb'] as $pk): 
                    $pm = $provinces_meta[$pk];
                    $pcount = count($ngos_by_province[$pk]);
                ?>
                <button type="button" class="province-pill" data-province="<?php echo $pk; ?>">
                    <i class="fa <?php echo $pm['icon']; ?>"></i> <?php echo dual_val($pm['title_ur'], $pm['title_en']); ?>
                    <span class="count-badge"><?php echo $pcount; ?></span>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Quick City Shortcut Buttons -->
            <div class="city-quick-pills">
                <span style="font-weight: 700; font-size: 13px; color: var(--navy); display: flex; align-items: center; gap: 4px;">
                    <i class="fa fa-city" style="color: var(--primary);"></i> <?php echo dual_val('شہر:', 'City:'); ?>
                </span>
                <?php foreach ($featured_cities as $fc): ?>
                    <?php
                    $city_slug = $fc[0];
                    $c_label = $fc[1];
                    $is_active = ($selected_city === $city_slug || ($city_slug === 'all' && empty($selected_city))) ? 'active' : '';
                    ?>
                    <button type="button" class="city-pill <?php echo $is_active; ?>" data-city="<?php echo $city_slug; ?>">
                        <?php echo $c_label; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Result Status Counter -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; font-size: 14px; color: #475569; flex-wrap: wrap; gap: 10px;">
            <div>
                <?php echo dual_val('دستیاب ادارے و ہیلپ لائنز:', 'Available Organizations:'); ?>
                <strong id="ngo-counter" style="color: var(--primary); font-size: 20px; margin: 0 4px;"><?php echo count($ngos_list); ?></strong>
                <span id="active-filter-label" style="font-size: 12.5px; color: #64748b; font-weight: 600;">(تمام صوبے و پاکستان)</span>
            </div>
            <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #15803d; font-weight: 700; background: #ecfdf5; padding: 5px 12px; border-radius: 20px; border: 1px solid #bbf7d0;">
                <i class="fa fa-circle-check"></i> <?php echo dual_val('تمام 27 نمبرز کی صوبہ وار سرکاری و آزاد تصدیق شدہ ہے', 'All 27 Numbers Formally Verified by Province'); ?>
            </div>
        </div>

        <!-- 3. VIEW MODE A: PROVINCE-WISE GROUPED HIGH-IMPACT CARDS -->
        <div id="ngos-cards-container">
            <?php foreach (['federal', 'punjab', 'sindh', 'kp', 'balochistan', 'ajk_gb'] as $pk): 
                $pm = $provinces_meta[$pk];
                $prov_ngos = $ngos_by_province[$pk];
                if (empty($prov_ngos)) continue;
            ?>
            <div class="province-group-section" data-province="<?php echo $pk; ?>" id="prov-card-group-<?php echo $pk; ?>">
                <!-- Province Section Header -->
                <div class="province-section-header">
                    <div class="prov-header-left">
                        <div class="prov-icon-wrap" style="background: <?php echo $pm['color']; ?>;">
                            <i class="fa <?php echo $pm['icon']; ?>"></i>
                        </div>
                        <div>
                            <h2 class="prov-title"><?php echo dual_val($pm['title_ur'], $pm['title_en']); ?></h2>
                            <div class="prov-subtitle"><?php echo $pm['desc_ur']; ?></div>
                        </div>
                    </div>
                    <div class="prov-badge" style="background: #f1f5f9; color: var(--navy); border: 1px solid #e2e8f0;">
                        <i class="fa fa-shield-halved" style="color: <?php echo $pm['color']; ?>;"></i>
                        <span class="prov-card-counter" style="font-weight: 900; font-size: 14px; color: <?php echo $pm['color']; ?>;"><?php echo count($prov_ngos); ?></span>
                        <?php echo dual_val('تصدیق شدہ ادارے', 'Verified Centers'); ?>
                    </div>
                </div>

                <!-- Cards Grid for this Province -->
                <div class="simple-ngo-grid">
                    <?php foreach ($prov_ngos as $ngo): ?>
                        <?php
                        $main_phone = !empty($ngo['helpline']) ? $ngo['helpline'] : $ngo['phone'];
                        $city_text = $ngo['city_ur'];
                        $cat_text = $ngo['category_ur'];
                        $city_search = strtolower($ngo['city_en'] . ' ' . $ngo['city_ur']);
                        ?>
                        <div class="simple-ngo-card" data-province="<?php echo $pk; ?>" data-city="<?php echo safe($city_search); ?>" data-name="<?php echo strtolower(safe($ngo['name_ur'] . ' ' . $ngo['name_en'] . ' ' . $main_phone)); ?>">
                            <!-- Card Top Header -->
                            <div class="s-card-head">
                                <div class="s-card-badges">
                                    <span class="s-badge-city"><i class="fa fa-map-marker-alt"></i> <?php echo safe($city_text); ?></span>
                                    <span class="s-badge-cat"><?php echo safe($cat_text); ?></span>
                                </div>
                                <?php if ($ngo['is_featured']): ?>
                                    <span class="s-badge-verified">
                                        <i class="fa fa-star"></i> قومی ترجیح
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Organization Title -->
                            <h3 class="s-card-title">
                                <?php echo dual_val($ngo['name_ur'], $ngo['name_en']); ?>
                            </h3>

                            <!-- BIG HERO PHONE BOX (SUPER EASY TO READ) -->
                            <div class="hero-phone-box">
                                <div class="phone-label">
                                    <i class="fa fa-phone-volume"></i> 
                                    <?php echo !empty($ngo['helpline']) ? 'براہِ راست ہیلپ لائن (Direct Helpline)' : 'رابطہ نمبر (Contact Number)'; ?>
                                </div>
                                <a href="tel:<?php echo safe($main_phone); ?>" class="phone-number-display">
                                    <?php echo safe($main_phone); ?>
                                </a>
                                <?php if (!empty($ngo['phone']) && !empty($ngo['helpline'])): ?>
                                    <div class="sub-phone-item">
                                        دفتر فون: <a href="tel:<?php echo safe($ngo['phone']); ?>"><?php echo safe($ngo['phone']); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Instant Big Action Buttons -->
                            <div class="s-action-buttons">
                                <a href="tel:<?php echo safe($main_phone); ?>" class="btn-direct-call">
                                    <i class="fa fa-phone-alt"></i> کال ملائیں (Call)
                                </a>

                                <?php if (!empty($ngo['whatsapp'])): ?>
                                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $ngo['whatsapp']); ?>" target="_blank" rel="noopener" class="btn-direct-whatsapp">
                                        <i class="fab fa-whatsapp"></i> واٹس ایپ (WhatsApp)
                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- Collapsible Quick Info -->
                            <?php if (!empty($ngo['address_ur']) || !empty($ngo['services_ur'])): ?>
                                <details class="s-details-toggle">
                                    <summary><i class="fa fa-info-circle"></i> دفتر کا پتہ اور خدمات دیکھیں</summary>
                                    <div class="s-details-content">
                                        <?php if (!empty($ngo['services_ur'])): ?>
                                            <p><strong>خدمات:</strong> <?php echo safe($ngo['services_ur']); ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($ngo['address_ur'])): ?>
                                            <p><strong>پتہ:</strong> <?php echo safe($ngo['address_ur']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </details>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Empty State for Cards -->
            <div id="no-ngos-found-cards" style="display: none; text-align: center; padding: 60px 20px; background: #ffffff; border-radius: var(--radius-lg); border: 1.5px dashed #cbd5e1; margin-top: 20px;">
                <i class="fa fa-search" style="font-size: 42px; color: #94a3b8; margin-bottom: 15px;"></i>
                <h3 style="color: var(--navy); font-size: 20px; margin-bottom: 8px;">کوئی ادارہ یا ہیلپ لائن نہیں ملی</h3>
                <p style="color: #64748b; font-size: 14.5px; max-width: 500px; margin: 0 auto 15px;">منتخب کردہ فلٹر کے مطابق کوئی نتیجہ نہیں ملا۔ براہِ کرم کسی دوسرے صوبے یا شہر کا انتخاب کریں۔</p>
                <button type="button" onclick="resetAllFilters()" style="background: var(--primary); color: #fff; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 800; cursor: pointer; transition: background 0.2s;">
                    <i class="fa fa-rotate-left"></i> تمام فلٹرز ختم کریں (Reset All)
                </button>
            </div>
        </div>

        <!-- 4. VIEW MODE B: PROVINCE-WISE COMPACT DIRECTORY TABLE -->
        <div class="directory-table-wrap" id="ngos-list-container" style="display: none;">
            <table class="clean-directory-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">ادارے کا نام (Organization)</th>
                        <th style="width: 20%;">شہر / صوبہ (City)</th>
                        <th style="width: 25%;">ہیلپ لائن / فون (Phone)</th>
                        <th style="width: 20%; text-align: center;">فوری رابطہ (Actions)</th>
                    </tr>
                </thead>
                <tbody id="directory-table-body">
                    <?php foreach (['federal', 'punjab', 'sindh', 'kp', 'balochistan', 'ajk_gb'] as $pk): 
                        $pm = $provinces_meta[$pk];
                        $prov_ngos = $ngos_by_province[$pk];
                        if (empty($prov_ngos)) continue;
                    ?>
                    <tr class="province-table-header" data-province="<?php echo $pk; ?>">
                        <td colspan="4" style="background: #f8fafc; padding: 12px 18px; border-right: 5px solid <?php echo $pm['color']; ?>;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-weight: 800; font-size: 15px; color: var(--navy); display: flex; align-items: center; gap: 8px;">
                                    <i class="fa <?php echo $pm['icon']; ?>" style="color: <?php echo $pm['color']; ?>;"></i> 
                                    <?php echo dual_val($pm['title_ur'], $pm['title_en']); ?>
                                </span>
                                <span style="font-size: 12px; color: #64748b; font-weight: 700; background: #ffffff; padding: 3px 12px; border-radius: 12px; border: 1px solid #e2e8f0;">
                                    <?php echo count($prov_ngos); ?> تصدیق شدہ ادارے
                                </span>
                            </div>
                        </td>
                    </tr>
                    <?php foreach ($prov_ngos as $ngo): ?>
                        <?php
                        $main_phone = !empty($ngo['helpline']) ? $ngo['helpline'] : $ngo['phone'];
                        $city_search = strtolower($ngo['city_en'] . ' ' . $ngo['city_ur']);
                        ?>
                        <tr class="dir-table-row" data-province="<?php echo $pk; ?>" data-city="<?php echo safe($city_search); ?>" data-name="<?php echo strtolower(safe($ngo['name_ur'] . ' ' . $ngo['name_en'] . ' ' . $main_phone)); ?>">
                            <td>
                                <strong style="color: var(--navy); font-size: 15px;"><?php echo safe($ngo['name_ur']); ?></strong>
                                <span class="table-sub-en"><?php echo safe($ngo['name_en']); ?></span>
                            </td>
                            <td>
                                <span class="table-city-pill"><i class="fa fa-location-dot"></i> <?php echo safe($ngo['city_ur']); ?></span>
                            </td>
                            <td>
                                <a href="tel:<?php echo safe($main_phone); ?>" class="table-phone-link">
                                    <i class="fa fa-phone-alt"></i> <?php echo safe($main_phone); ?>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center;">
                                    <a href="tel:<?php echo safe($main_phone); ?>" class="btn-table-call" title="Call Now">
                                        <i class="fa fa-phone"></i> کال
                                    </a>
                                    <?php if (!empty($ngo['whatsapp'])): ?>
                                        <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $ngo['whatsapp']); ?>" target="_blank" rel="noopener" class="btn-table-wa" title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Empty State for Table -->
            <div id="no-ngos-found-table" style="display: none; text-align: center; padding: 40px 20px;">
                <p style="color: #64748b; font-size: 14.5px; margin: 0;">کوئی ادارہ نہیں ملا۔ براہ کرم سرچ فلٹر تبدیل کریں۔</p>
            </div>
        </div>
    </div>
</div>

<style>
/* ==============================================================
   SIMPLIFIED & USER-FRIENDLY HELPLINE SCREEN STYLES
   ============================================================== */

/* Speed Dial Grid (Top 4 Hotlines) */
.speed-dial-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 18px;
    margin-bottom: 30px;
}

.speed-dial-card {
    background: #ffffff;
    border-radius: var(--radius-md);
    padding: 20px;
    border: 2px solid #e2e8f0;
    box-shadow: 0 4px 12px rgba(12, 35, 64, 0.05);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.25s ease;
    position: relative;
    overflow: hidden;
}

.speed-dial-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(12, 35, 64, 0.12);
}

.hotline-1099 { border-top: 5px solid #0f4c3a; }
.hotline-1043 { border-top: 5px solid #dc2626; }
.hotline-1098 { border-top: 5px solid #0284c7; }
.hotline-1055 { border-top: 5px solid #c59b27; }

.speed-dial-icon {
    font-size: 28px;
    margin-bottom: 10px;
}
.hotline-1099 .speed-dial-icon { color: #0f4c3a; }
.hotline-1043 .speed-dial-icon { color: #dc2626; }
.hotline-1098 .speed-dial-icon { color: #0284c7; }
.hotline-1055 .speed-dial-icon { color: #c59b27; }

.speed-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    background: #f1f5f9;
    color: var(--navy);
    padding: 2px 8px;
    border-radius: 4px;
    margin-bottom: 6px;
}

.speed-dial-body h3 {
    font-size: 17px;
    font-weight: 800;
    color: var(--navy);
    margin-bottom: 4px;
}

.speed-number {
    font-size: 32px;
    font-weight: 900;
    color: #0f4c3a;
    line-height: 1.1;
    margin: 8px 0;
    letter-spacing: 1px;
}
.hotline-1043 .speed-number { color: #dc2626; }
.hotline-1098 .speed-number { color: #0284c7; }
.hotline-1055 .speed-number { color: #c59b27; }

.speed-dial-body p {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 14px;
}

.btn-speed-call {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #15803d;
    color: #ffffff !important;
    text-decoration: none;
    font-size: 15px;
    font-weight: 800;
    padding: 12px;
    border-radius: 8px;
    transition: background 0.2s ease;
}
.btn-speed-call:hover {
    background: #166534;
}

/* Simplified Filter Box */
.simplified-filter-box {
    background: #ffffff;
    border-radius: var(--radius-lg);
    padding: 20px 24px;
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    margin-bottom: 25px;
}

.filter-top-bar {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.search-input-wrap {
    flex: 2;
    min-width: 260px;
    position: relative;
}

.clean-search-input {
    width: 100%;
    padding: 12px 18px 12px 42px;
    border-radius: 8px;
    border: 1.5px solid #cbd5e1;
    font-size: 15px;
    transition: border-color 0.2s;
    background: #f8fafc;
}
html[dir="rtl"] .clean-search-input {
    padding: 12px 42px 12px 18px;
}

.clean-search-input:focus {
    border-color: var(--primary);
    background: #ffffff;
    outline: none;
}

.search-icon {
    position: absolute;
    top: 15px;
    color: #94a3b8;
    font-size: 16px;
}
html[dir="rtl"] .search-icon { right: 16px; }
html[dir="ltr"] .search-icon { left: 16px; }

.city-select-wrap {
    flex: 1.2;
    min-width: 200px;
    position: relative;
}

.clean-city-select {
    width: 100%;
    padding: 12px 16px 12px 38px;
    border-radius: 8px;
    border: 1.5px solid #cbd5e1;
    font-size: 14.5px;
    font-weight: 600;
    color: var(--navy);
    background: #f8fafc;
    cursor: pointer;
}
html[dir="rtl"] .clean-city-select {
    padding: 12px 38px 12px 16px;
}

.select-icon {
    position: absolute;
    top: 15px;
    color: var(--primary);
    font-size: 15px;
}
html[dir="rtl"] .select-icon { right: 14px; }
html[dir="ltr"] .select-icon { left: 14px; }

.view-toggle-wrap {
    display: flex;
    background: #f1f5f9;
    border-radius: 8px;
    padding: 3px;
    gap: 3px;
}

.view-btn {
    border: none;
    background: transparent;
    color: #64748b;
    font-weight: 700;
    font-size: 13px;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}

.view-btn.active {
    background: #ffffff;
    color: var(--navy);
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
}

/* Province Quick Pills */
.province-quick-pills {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    align-items: center;
    margin-top: 14px;
    padding-top: 14px;
    border-top: 1px dashed var(--border-color);
}

.province-pill {
    background: #ffffff;
    border: 1.5px solid var(--border-color);
    color: var(--navy);
    padding: 7px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    user-select: none;
}

.province-pill .count-badge {
    background: #e2e8f0;
    color: var(--navy);
    font-size: 11px;
    font-weight: 800;
    padding: 1px 7px;
    border-radius: 10px;
    transition: all 0.2s ease;
}

.province-pill:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
}

.province-pill.active {
    background: var(--primary);
    color: #ffffff;
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(15, 76, 60, 0.25);
}

.province-pill.active .count-badge {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
}

/* City Shortcut Pills */
.city-quick-pills {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #f1f5f9;
}

.city-quick-pills .city-pill {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #334155;
    cursor: pointer;
    transition: all 0.2s;
}

.city-quick-pills .city-pill:hover {
    background: #e2e8f0;
    border-color: #cbd5e1;
}

.city-quick-pills .city-pill.active {
    background: var(--primary);
    color: #ffffff;
    border-color: var(--primary);
}

/* Province Group Sections in Directory */
.province-group-section {
    margin-bottom: 38px;
}

.province-section-header {
    background: #ffffff;
    border-radius: var(--radius-md);
    padding: 14px 20px;
    margin-bottom: 18px;
    border: 1px solid var(--border-color);
    border-right: 5px solid var(--primary);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

[dir="ltr"] .province-section-header {
    border-right: 1px solid var(--border-color);
    border-left: 5px solid var(--primary);
}

.prov-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.prov-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.prov-title {
    font-size: 18px;
    font-weight: 800;
    color: var(--navy);
    margin: 0 0 3px 0;
    line-height: 1.3;
}

.prov-subtitle {
    font-size: 12.5px;
    color: #64748b;
    font-weight: 600;
}

.prov-badge {
    font-size: 12px;
    font-weight: 800;
    padding: 5px 14px;
    border-radius: 15px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* Simple NGO Card */
.simple-ngo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 22px;
}

.simple-ngo-card {
    background: #ffffff;
    border-radius: var(--radius-lg);
    border: 1.5px solid #e2e8f0;
    padding: 22px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s;
}

.simple-ngo-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(12, 35, 64, 0.08);
    border-color: #cbd5e1;
}

.s-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.s-card-badges {
    display: flex;
    gap: 6px;
}

.s-badge-city {
    background: #f1f5f9;
    color: var(--navy);
    font-weight: 700;
    font-size: 12px;
    padding: 3px 10px;
    border-radius: 6px;
}

.s-badge-cat {
    background: #ecfdf5;
    color: #065f46;
    font-weight: 700;
    font-size: 11.5px;
    padding: 3px 8px;
    border-radius: 6px;
}

.s-badge-verified {
    background: #fffbeb;
    color: #92400e;
    font-weight: 800;
    font-size: 11.5px;
    padding: 3px 8px;
    border-radius: 6px;
    border: 1px solid #fde68a;
}

.s-card-title {
    font-size: 17px;
    font-weight: 800;
    color: var(--navy);
    line-height: 1.4;
    margin-bottom: 15px;
}

/* Big Hero Phone Box */
.hero-phone-box {
    background: #f8fafc;
    border: 1.5px dashed #cbd5e1;
    border-radius: 10px;
    padding: 14px;
    text-align: center;
    margin-bottom: 16px;
}

.phone-label {
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 4px;
}

.phone-number-display {
    font-size: 24px;
    font-weight: 900;
    color: var(--navy);
    text-decoration: none;
    letter-spacing: 0.5px;
    display: inline-block;
}
.phone-number-display:hover {
    color: #15803d;
}

.sub-phone-item {
    font-size: 12px;
    color: #64748b;
    margin-top: 4px;
}
.sub-phone-item a {
    color: var(--primary);
    font-weight: 700;
    text-decoration: none;
}

/* Instant Action Buttons */
.s-action-buttons {
    display: flex;
    gap: 10px;
    margin-bottom: 12px;
}

.btn-direct-call {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: #16a34a;
    color: #ffffff !important;
    text-decoration: none;
    font-weight: 800;
    font-size: 14.5px;
    padding: 11px;
    border-radius: 8px;
    transition: background 0.2s;
}
.btn-direct-call:hover {
    background: #15803d;
}

.btn-direct-whatsapp {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: #25d366;
    color: #ffffff !important;
    text-decoration: none;
    font-weight: 800;
    font-size: 14.5px;
    padding: 11px;
    border-radius: 8px;
    transition: background 0.2s;
}
.btn-direct-whatsapp:hover {
    background: #1ebe5d;
}

.s-details-toggle {
    margin-top: auto;
    font-size: 12.5px;
    color: #64748b;
}
.s-details-toggle summary {
    cursor: pointer;
    font-weight: 700;
    color: var(--primary);
    padding: 4px 0;
}
.s-details-content {
    background: #f8fafc;
    padding: 10px 12px;
    border-radius: 6px;
    margin-top: 6px;
    line-height: 1.6;
}

/* Compact Directory Table */
.directory-table-wrap {
    background: #ffffff;
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    overflow-x: auto;
}

.clean-directory-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.clean-directory-table th {
    background: #0c2340;
    color: #ffffff;
    padding: 14px 18px;
    font-weight: 700;
    text-align: right;
}
html[dir="ltr"] .clean-directory-table th {
    text-align: left;
}

.clean-directory-table td {
    padding: 14px 18px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.clean-directory-table tr:hover td {
    background: #f8fafc;
}

.province-table-header td {
    background: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
}

.table-sub-en {
    display: block;
    font-size: 12px;
    color: #64748b;
    margin-top: 2px;
}

.table-city-pill {
    background: #f1f5f9;
    color: var(--navy);
    font-weight: 700;
    font-size: 12.5px;
    padding: 4px 10px;
    border-radius: 20px;
    display: inline-block;
}

.table-phone-link {
    font-size: 16px;
    font-weight: 800;
    color: var(--navy);
    text-decoration: none;
}
.table-phone-link:hover {
    color: #16a34a;
}

.btn-table-call {
    background: #16a34a;
    color: #ffffff !important;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.btn-table-wa {
    background: #25d366;
    color: #ffffff !important;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
}

@media (max-width: 600px) {
    .simple-ngo-grid {
        grid-template-columns: 1fr;
    }
    .s-action-buttons {
        flex-direction: column;
    }
    .province-section-header {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<script>
// Switch between Cards and Quick List views
function switchView(mode) {
    const cardsContainer = document.getElementById('ngos-cards-container');
    const listContainer = document.getElementById('ngos-list-container');
    const btnCards = document.getElementById('btn-view-cards');
    const btnList = document.getElementById('btn-view-list');

    if (mode === 'list') {
        cardsContainer.style.display = 'none';
        listContainer.style.display = 'block';
        btnList.classList.add('active');
        btnCards.classList.remove('active');
    } else {
        cardsContainer.style.display = 'block';
        listContainer.style.display = 'none';
        btnCards.classList.add('active');
        btnList.classList.remove('active');
    }
}

// Global Filter Reset
function resetAllFilters() {
    const searchInput = document.getElementById('portal-search-input');
    const cityDropdown = document.getElementById('city-dropdown-select');
    const provPills = document.querySelectorAll('.province-quick-pills .province-pill');
    const cityPills = document.querySelectorAll('.city-quick-pills .city-pill');

    if (searchInput) searchInput.value = '';
    if (cityDropdown) cityDropdown.value = 'all';

    provPills.forEach(p => {
        if (p.getAttribute('data-province') === 'all') p.classList.add('active');
        else p.classList.remove('active');
    });

    cityPills.forEach(p => {
        if (p.getAttribute('data-city') === 'all') p.classList.add('active');
        else p.classList.remove('active');
    });

    if (window.triggerApplyFilter) {
        window.triggerApplyFilter('all', 'all', '');
    }
}

// Master Filter for Province, City & Search
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('portal-search-input');
    const cityDropdown = document.getElementById('city-dropdown-select');
    const provPills = document.querySelectorAll('.province-quick-pills .province-pill');
    const cityPills = document.querySelectorAll('.city-quick-pills .city-pill');
    const provSections = document.querySelectorAll('.province-group-section');
    const tableHeaders = document.querySelectorAll('.province-table-header');
    const rows = document.querySelectorAll('.dir-table-row');
    const counter = document.getElementById('ngo-counter');
    const filterLabel = document.getElementById('active-filter-label');
    const emptyCards = document.getElementById('no-ngos-found-cards');
    const emptyTable = document.getElementById('no-ngos-found-table');

    let currentProvince = 'all';
    let currentCity = 'all';
    let searchQuery = '';

    const provNamesMap = {
        'all': 'تمام صوبے و پاکستان',
        'federal': 'وفاقی دارالحکومت (اسلام آباد)',
        'punjab': 'صوبہ پنجاب',
        'sindh': 'صوبہ سندھ',
        'kp': 'صوبہ خیبر پختونخوا',
        'balochistan': 'صوبہ بلوچستان',
        'ajk_gb': 'آزاد کشمیر اور گلگت بلتستان'
    };

    function applyFilter() {
        let totalVisibleCards = 0;
        let visibleRowsByProv = {};

        // 1. Filter Cards View grouped by Province Section
        provSections.forEach(section => {
            const secProv = section.getAttribute('data-province');
            const provMatch = (currentProvince === 'all' || secProv === currentProvince);

            if (!provMatch) {
                section.style.display = 'none';
                return;
            }

            let visibleInSec = 0;
            const cardsInSec = section.querySelectorAll('.simple-ngo-card');
            cardsInSec.forEach(card => {
                const cardCity = card.getAttribute('data-city') || '';
                const cardName = card.getAttribute('data-name') || '';

                const cityMatch = (currentCity === 'all' || cardCity.includes(currentCity));
                const searchMatch = (searchQuery === '' || cardName.includes(searchQuery));

                if (cityMatch && searchMatch) {
                    card.style.display = 'flex';
                    visibleInSec++;
                    totalVisibleCards++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Update counter badge inside section header
            const counterSpan = section.querySelector('.prov-card-counter');
            if (counterSpan) {
                counterSpan.innerText = visibleInSec;
            }

            if (visibleInSec > 0) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });

        // 2. Filter Table View Rows
        rows.forEach(row => {
            const rowProv = row.getAttribute('data-province');
            const rowCity = row.getAttribute('data-city') || '';
            const rowName = row.getAttribute('data-name') || '';

            const provMatch = (currentProvince === 'all' || rowProv === currentProvince);
            const cityMatch = (currentCity === 'all' || rowCity.includes(currentCity));
            const searchMatch = (searchQuery === '' || rowName.includes(searchQuery));

            if (provMatch && cityMatch && searchMatch) {
                row.style.display = '';
                visibleRowsByProv[rowProv] = (visibleRowsByProv[rowProv] || 0) + 1;
            } else {
                row.style.display = 'none';
            }
        });

        // 3. Show / Hide Table Headers according to whether their rows are visible
        tableHeaders.forEach(th => {
            const thProv = th.getAttribute('data-province');
            if (visibleRowsByProv[thProv] && visibleRowsByProv[thProv] > 0) {
                th.style.display = '';
            } else {
                th.style.display = 'none';
            }
        });

        // 4. Update Main Counter & Filter Label
        if (counter) {
            counter.innerText = totalVisibleCards;
        }
        if (filterLabel) {
            let labelText = provNamesMap[currentProvince] || '';
            if (currentCity !== 'all') {
                labelText += ' • شہر: ' + currentCity;
            }
            if (searchQuery !== '') {
                labelText += ' • تلاش: "' + searchQuery + '"';
            }
            filterLabel.innerText = '(' + labelText + ')';
        }

        // 5. Empty states
        if (emptyCards) {
            emptyCards.style.display = (totalVisibleCards === 0) ? 'block' : 'none';
        }
        if (emptyTable) {
            emptyTable.style.display = (totalVisibleCards === 0) ? 'block' : 'none';
        }
    }

    // Expose for reset button
    window.triggerApplyFilter = function(p, c, q) {
        currentProvince = p;
        currentCity = c;
        searchQuery = q;
        applyFilter();
    };

    // Province Pills Click
    provPills.forEach(pill => {
        pill.addEventListener('click', function() {
            provPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            currentProvince = this.getAttribute('data-province');
            applyFilter();
        });
    });

    // City Dropdown Change
    if (cityDropdown) {
        cityDropdown.addEventListener('change', function() {
            currentCity = this.value.toLowerCase();
            cityPills.forEach(p => {
                if (p.getAttribute('data-city') === currentCity) {
                    p.classList.add('active');
                } else {
                    p.classList.remove('active');
                }
            });
            applyFilter();
        });
    }

    // City Pills Click
    cityPills.forEach(pill => {
        pill.addEventListener('click', function() {
            cityPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            currentCity = this.getAttribute('data-city').toLowerCase();
            if (cityDropdown) {
                cityDropdown.value = currentCity;
            }
            applyFilter();
        });
    });

    // Live Search Input
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchQuery = this.value.toLowerCase().trim();
            applyFilter();
        });
    }

    // Run initial filter check
    applyFilter();
});
</script>

<?php require_once __DIR__ . '/footer.php'; ?>