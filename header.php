<?php
require_once __DIR__ . '/config.php';
$lang = get_lang();
$is_rtl = is_rtl();
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html dir="<?php echo $is_rtl ? 'rtl' : 'ltr'; ?>" lang="<?php echo $lang === 'both' ? 'ur' : $lang; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t_plain('site_title'); ?></title>
    <meta name="description" content="Mera Haq (میرا حق) is an accessible LegalTech platform dedicated to empowering women across Pakistan to claim and protect their rightful inheritance, featuring gift deed fraud detection, video guides, and 27+ pro-bono helplines.">

    <!-- Open Graph / LinkedIn / Facebook / WhatsApp Social Preview -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://merahaq.site/">
    <meta property="og:site_name" content="Mera Haq (میرا حق)">
    <meta property="og:title" content="Mera Haq | Women's Legal Inheritance & Fraud Protection Platform">
    <meta property="og:description" content="Empowering Pakistani women to claim their lawful inheritance through automated Hiba Nama fraud detection (Urdu voice alerts), legal video guides, and 27+ verified pro-bono helplines.">
    <meta property="og:image" content="https://merahaq.site/assets/images/og-banner.jpg">
    <meta property="og:image:secure_url" content="https://merahaq.site/assets/images/og-banner.jpg">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Mera Haq - Women's Legal Inheritance & Fraud Protection Platform">

    <!-- Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://merahaq.site/">
    <meta name="twitter:title" content="Mera Haq | Women's Legal Inheritance & Fraud Protection Platform">
    <meta name="twitter:description" content="Empowering Pakistani women to claim their lawful inheritance through automated Hiba Nama fraud detection, legal video guides, and 27+ verified helplines.">
    <meta name="twitter:image" content="https://merahaq.site/assets/images/og-banner.jpg">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <!-- Vendor Libraries (AOS Animation, SweetAlert2) -->
    <link rel="stylesheet" href="assets/vendor/aos/aos.css">
    <link rel="stylesheet" href="assets/vendor/sweetalert2/sweetalert2.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="lang-mode-<?php echo $lang; ?>">

<!-- Top Emergency & Free Legal Aid Bar -->
<div class="top-emergency-bar">
    <div class="container emergency-flex">
        <div class="emergency-tag">
            <span class="pulse-dot"></span>
            <span><?php echo t('emergency_banner'); ?></span>
        </div>
        <div class="hotline-pills">
            <a href="tel:1099" class="hotline-pill" title="Ministry of Human Rights Free Legal Aid">
                <i class="fa fa-phone-alt"></i> 1099 <span class="hotline-lbl"><?php echo $lang === 'en' ? '(Free Legal Aid)' : ($lang === 'ur' ? '(مفت قانونی ایڈ)' : '(مفت قانونی ایڈ / Free Legal Aid)'); ?></span>
            </a>
            <a href="tel:1098" class="hotline-pill" title="Sindh Legal Aid Society">
                <i class="fa fa-balance-scale"></i> 1098 <span class="hotline-lbl"><?php echo $lang === 'en' ? '(Sindh Legal Aid)' : ($lang === 'ur' ? '(سندھ لیگل ایڈ)' : '(سندھ لیگل ایڈ / Sindh Legal Aid)'); ?></span>
            </a>
            <a href="tel:1043" class="hotline-pill" title="Women Protection Helpline">
                <i class="fa fa-female"></i> 1043 <span class="hotline-lbl"><?php echo $lang === 'en' ? '(Women Protection)' : ($lang === 'ur' ? '(خواتین پروٹیکشن)' : '(خواتین تحفظ / Women Helpline)'); ?></span>
            </a>
            <a href="tel:1055" class="hotline-pill" title="Federal Ombudsman Property Rights">
                <i class="fa fa-home"></i> 1055 <span class="hotline-lbl"><?php echo $lang === 'en' ? '(Property Ombudsman)' : ($lang === 'ur' ? '(وفاقی محتسب جائیداد)' : '(جائیداد محتسب / Ombudsman)'); ?></span>
            </a>
        </div>
    </div>
</div>

<!-- Main Header / Navigation -->
<header class="site-header">
    <div class="container header-inner">
        <a href="index.php" class="brand-block" title="میرا حق - Mera Haq Portal">
            <img src="assets/images/logo-header.png" alt="میرا حق - Mera Haq" class="site-main-logo">
            <div class="brand-text">
                <h1>
                    <?php if ($lang === 'ur'): ?>
                        میرا حق <span class="b-sub-tag">حقِ وراثت و قانونی پورٹل</span>
                    <?php elseif ($lang === 'en'): ?>
                        Mera Haq <span class="b-sub-tag">Inheritance Rights Portal</span>
                    <?php else: ?>
                        <span class="b-ur">میرا حق</span> <span class="b-divider">|</span> <span class="b-en">Mera Haq Legal Portal</span>
                    <?php endif; ?>
                </h1>
                <p>
                    <?php if ($lang === 'ur'): ?>
                        اثاثہ جات کی تلاش، جانشینی، نادرا و مفت قانونی رہنمائی
                    <?php elseif ($lang === 'en'): ?>
                        Asset Tracing, Succession, NADRA & Free Legal Directory
                    <?php else: ?>
                        حقِ وراثت، نادرا و اثاثہ جات گائیڈ &middot; Legal Inheritance Compendium
                    <?php endif; ?>
                </p>
            </div>
        </a>

        <!-- Language Switcher Trio -->
        <div class="lang-switch-group">
            <a href="?lang=both" class="lang-pill-btn <?php echo $lang === 'both' ? 'active' : ''; ?>" title="اردو کے ساتھ انگلش دونوں ایک ساتھ">
                <i class="fa-solid fa-globe"></i> اردو + English
            </a>
            <a href="?lang=ur" class="lang-pill-btn <?php echo $lang === 'ur' ? 'active' : ''; ?>" title="صرف اردو">
                اردو
            </a>
            <a href="?lang=en" class="lang-pill-btn <?php echo $lang === 'en' ? 'active' : ''; ?>" title="English Only">
                English
            </a>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="header-nav-strip">
        <div class="container">
            <div style="text-align: center; color: #ffffff; font-size: 15px; font-weight: 700; padding: 8px 10px 4px;">
                For More Information Contact: <a href="tel:03227653464" style="color: #ffffff; text-decoration: none;">0322 7653464</a> &nbsp; | &nbsp; Name: Advocate Ishraq Ali
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>"><i class="fa fa-home"></i> <?php echo t('nav_home'); ?></a></li>
                    <li><a href="guide.php" class="nav-link <?php echo $current_page == 'guide.php' ? 'active' : ''; ?>"><i class="fa fa-book-bookmark"></i> <?php echo t('nav_guide'); ?></a></li>
                    <li><a href="videos.php" class="nav-link <?php echo $current_page == 'videos.php' ? 'active' : ''; ?>"><i class="fa-brands fa-youtube" style="color: #ef4444;"></i> <?php echo t('nav_videos'); ?></a></li>
                    <li><a href="help.php" class="nav-link nav-cta <?php echo $current_page == 'help.php' ? 'active' : ''; ?>"><i class="fa fa-hand-holding-heart"></i> <?php echo t('nav_ngos'); ?></a></li>
                    <li><a href="fraud_detector.php" class="nav-link <?php echo $current_page == 'fraud_detector.php' ? 'active' : ''; ?>"><i class="fa fa-shield-halved"></i> <?php echo t('nav_fraud'); ?></a></li>
                    <li><a href="team.php" class="nav-link <?php echo $current_page == 'team.php' ? 'active' : ''; ?>"><i class="fa fa-users"></i> <?php echo t('nav_team'); ?></a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
