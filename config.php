<?php
// ==============================================================
// WIRASAT LEGAL PORTAL - CONFIGURATION & LOCALIZATION
// ==============================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Language Handling: 'both' (Bilingual), 'ur' (Urdu), 'en' (English)
if (isset($_GET['lang'])) {
    $requested_lang = strtolower(trim($_GET['lang']));
    if (in_array($requested_lang, ['both', 'ur', 'en', 'bilingual'])) {
        $_SESSION['lang'] = ($requested_lang === 'bilingual') ? 'both' : $requested_lang;
    }
}

// Default mode: 'both' (Urdu ke sath English bhi ho - Bilingual Dual Mode)
$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'both';

function get_lang() {
    global $current_lang;
    return $current_lang;
}

function is_bilingual() {
    return get_lang() === 'both';
}

function is_rtl() {
    return get_lang() === 'ur' || get_lang() === 'both';
}

function safe($data) {
    return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
}

// 2. Database Connection (SQLite via PDO)
$db_path = __DIR__ . '/data/wirasat.db';
$db_exists = file_exists($db_path);

try {
    $pdo = new PDO('sqlite:' . $db_path);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database Connection Error: " . $e->getMessage());
}

// Auto-initialize DB if not already populated
if (!$db_exists || filesize($db_path) === 0) {
    require_once __DIR__ . '/db_init.php';
    initialize_wirasat_database($pdo);
}

// 3. UI Translations
$translations = [
    'ur' => [
        'site_title' => 'میرا حق - حقِ وراثت و قانونی معاونت پورٹل',
        'site_tagline' => 'اثاثہ جات کی تلاش، جانشینی، زمین کی تقسیم اور شہریوں کے لیے مفت قانونی امداد',
        'nav_home' => 'صفحہ اول',
        'nav_guide' => 'مکمل قانونی رہنمائی',
        'nav_videos' => 'ویڈیو گائیڈز',
        'nav_ngos' => '1 سکرین ہیلپ (این جی اوز)',
        'nav_fraud' => 'فراڈ ڈیٹیکٹر',
        'nav_team' => 'ہماری ٹیم',
        'nav_inquiry' => 'قانونی مدد کی درخواست',
        'nav_switch_lang' => 'English',
        'nav_switch_lang_code' => 'en',
        'hero_badge' => 'حکومتِ پاکستان، عدالتی نظائر اور نادرا قوانین پر مبنی مستند گائیڈ',
        'hero_title' => 'حق وراثت حاصل کرنے کے لیے درکار قانونی طریقہ کار اور ضروری دستاویزات',
        'hero_subtitle' => 'بینک اکاؤنٹس، گاڑیاں، زرعی و شہری اراضی کی قانونی کھوج، نادرا سکسیشن، اور خواتین کے شرعی و آئینی حقوق کا تحفظ',
        'btn_explore_guide' => 'قانونی طریقہ کار دیکھیں',
        'btn_ngo_help' => '1 سکرین ہیلپ (این جی اوز)',
        'btn_check_fraud' => 'فراڈ رسک چیک کریں',
        'search_placeholder' => 'اثاثے، بینک، نادرا، زمین تقسیم، یا اپنے شہر کا نام تلاش کریں...',
        'search_btn' => 'تلاش کریں',
        'sec_overview' => 'پورٹل کا تعارف',
        'sec_categories' => 'اہم قانونی شعبہ جات',
        'emergency_banner' => 'فوری مفت قانونی امداد کے قومی نمبرز:',
        'quick_portals' => 'سرکاری ڈیجیٹل پورٹلز تک براہِ راست رسائی',
        'filter_city' => 'شہر منتخب کریں:',
        'all_cities' => 'تمام شہر (پاکستان بھر میں)',
        'category_filter' => 'خدمت کی قسم:',
        'all_categories' => 'تمام شعبہ جات',
        'call_now' => 'کال کریں',
        'whatsapp' => 'واٹس ایپ',
        'view_details' => 'تفصیلات دیکھیں',
        'official_link' => 'سرکاری پورٹل لنک',
        'video_guide' => 'ویڈیو رہنمائی گائیڈ',
        'sc_precedent' => 'سپریم کورٹ آف پاکستان کا اہم فیصلہ (2026 SCLR 90):',
        'sc_precedent_text' => 'خواتین کو وراثت سے دستبردار کروانے کے تمام زبانی یا بلا معاوضہ تنازل نامے شروع ہی سے باطل اور کالعدم ہیں۔ ثبوت کی ذمہ داری مرد وارث پر ہے۔',
        'read_more' => 'مزید پڑھیں',
        'footer_rights' => 'حق وراثت آگاہی و شہری قانونی معاونت کا آزاد ڈیجیٹل پلیٹ فارم۔ جملہ حقوق محفوظ ہیں۔',
        'legal_disclaimer' => 'یہ پورٹل عوامی آگاہی اور قانونی رہنمائی کے لیے ترتیب دیا گیا ہے۔ مخصوص قانونی نزاعات میں مستند وکیل یا مفت قانونی ایڈ سیل سے براہِ راست رجوع کریں۔'
    ],
    'en' => [
        'site_title' => 'Mera Haq - Pakistan Inheritance & Legal Rights Portal',
        'site_tagline' => 'Asset Tracing, Succession, Land Partition & Free Legal Aid Directory for Citizens',
        'nav_home' => 'Home',
        'nav_guide' => 'Legal Guide',
        'nav_videos' => 'Video Guides',
        'nav_ngos' => '1-Screen Help (NGOs)',
        'nav_fraud' => 'Fraud Detector',
        'nav_team' => 'Our Team',
        'nav_inquiry' => 'Request Legal Assistance',
        'nav_switch_lang' => 'اردو',
        'nav_switch_lang_code' => 'ur',
        'hero_badge' => 'Authoritative Legal Compendium Based on Pakistan Supreme Court & NADRA Laws',
        'hero_title' => 'Legal Procedures for Requiring Documents to Attain Right of Inheritance',
        'hero_subtitle' => 'Comprehensive Guide to Tracing Deceased Bank Accounts, Vehicles, Land Mutation, Succession Certificates & Safeguarding Women\'s Inheritance',
        'btn_explore_guide' => 'Explore Procedures',
        'btn_ngo_help' => '1-Screen Help (NGOs)',
        'btn_check_fraud' => 'Check Tanazul / Fraud Risk',
        'search_placeholder' => 'Search assets, bank accounts, NADRA, land partition, or your city...',
        'search_btn' => 'Search',
        'sec_overview' => 'Portal Overview',
        'sec_categories' => 'Major Legal Sections',
        'emergency_banner' => 'National Free Legal Aid & Emergency Hotlines:',
        'quick_portals' => 'Direct Access to Official Government Portals',
        'filter_city' => 'Select City:',
        'all_cities' => 'All Cities (Nationwide)',
        'category_filter' => 'Service Category:',
        'all_categories' => 'All Services',
        'call_now' => 'Call Now',
        'whatsapp' => 'WhatsApp',
        'view_details' => 'View Details',
        'official_link' => 'Official Portal Link',
        'video_guide' => 'Video Guide',
        'sc_precedent' => 'Supreme Court Precedent (2026 SCLR 90):',
        'sc_precedent_text' => 'Uncompensated or coerced relinquishment of women\'s inheritance rights is void ab initio. The burden of proof rests entirely on the male beneficiary.',
        'read_more' => 'Read More',
        'footer_rights' => 'Independent Digital Platform for Inheritance Rights Awareness & Citizen Assistance. All rights reserved.',
        'legal_disclaimer' => 'This portal provides educational and legal information. For specific legal litigation, consult an advocate or an accredited legal aid NGO.'
    ]
];

function t($key, $raw = false) {
    global $translations, $current_lang;
    if ($current_lang === 'both') {
        $ur = $translations['ur'][$key] ?? '';
        $en = $translations['en'][$key] ?? '';
        if ($ur && $en) {
            if ($raw) {
                return $ur . ' / ' . $en;
            }
            return '<span class="bi-ur">' . $ur . '</span> <span class="bi-divider">/</span> <span class="bi-en">' . $en . '</span>';
        }
        return $ur ?: $en ?: $key;
    }
    if (isset($translations[$current_lang][$key])) {
        return $translations[$current_lang][$key];
    }
    return isset($translations['ur'][$key]) ? $translations['ur'][$key] : $key;
}

function t_plain($key) {
    global $translations, $current_lang;
    if ($current_lang === 'both') {
        $ur = $translations['ur'][$key] ?? '';
        $en = $translations['en'][$key] ?? '';
        return ($ur && $en) ? "$ur / $en" : ($ur ?: $en ?: $key);
    }
    return strip_tags(t($key));
}

function dual_val($ur, $en, $block = false) {
    global $current_lang;
    if ($current_lang === 'en') {
        return htmlspecialchars((string)$en);
    }
    if ($current_lang === 'ur') {
        return htmlspecialchars((string)$ur);
    }
    // 'both' mode
    if (empty($en)) return htmlspecialchars((string)$ur);
    if (empty($ur)) return htmlspecialchars((string)$en);
    if ($block) {
        return '<div class="dual-block"><div class="dual-ur">' . nl2br(htmlspecialchars((string)$ur)) . '</div><div class="dual-en">' . nl2br(htmlspecialchars((string)$en)) . '</div></div>';
    }
    return '<span class="dual-ur">' . htmlspecialchars((string)$ur) . '</span> <span class="dual-divider">/</span> <span class="dual-en">' . htmlspecialchars((string)$en) . '</span>';
}

function get_youtube_id($url) {
    if (empty($url)) return null;
    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $url, $matches)) {
        return $matches[1];
    }
    return null;
}
