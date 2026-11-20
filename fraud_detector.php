<?php
require_once __DIR__ . '/header.php';
?>

<!-- Include Tesseract.js for In-Browser Optical Character Recognition -->
<script src="assets/vendor/tesseract/tesseract.min.js"></script>

<div class="container" style="padding: 40px 20px 60px;">
    <div class="section-head" data-aos="fade-up">
        <span class="section-tag" style="color: var(--danger);"><i class="fa fa-camera"></i> AI کیمرہ اسکینر &middot; Hiba & Gift Deed Fraud Detector</span>
        <h1 class="section-title">
            <?php echo $lang === 'en' ? 'AI Document Scanner & Inheritance Fraud Detector' : ($lang === 'ur' ? 'اسٹامپ پیپر و ہبہ نامہ کیمرا اسکینر - اینٹی فراڈ ڈیٹیکٹر' : 'اسٹامپ پیپر و ہبہ نامہ کیمرا اسکینر / AI Fraud & Gift Deed Scanner'); ?>
        </h1>
        <p class="section-desc">
            <?php echo $lang === 'en' 
                ? 'Capture or upload a photo of any stamp paper, deed, or affidavit. The system automatically detects whether someone is deceitfully getting your signature on a Hiba Nama (Gift Deed), uncompensated waiver, or title-less relinquishment under Supreme Court Precedent (2026 SCLR 90).' 
                : ($lang === 'ur' 
                    ? 'اسٹامپ پیپر، ہبہ نامہ، یا سادہ اقرار نامے کی کیمرے سے تصویر لیں یا اپلوڈ کریں۔ سسٹم بغیر عنوان کے بھی خفیہ گفٹ ڈیڈ یا وراثت چھیننے کے فراڈ کو خود بخود پکڑ کر فوری وارننگ دے گا کہ دستخط ہرگز نہ کریں۔' 
                    : 'اسٹامپ پیپر یا ہبہ نامے کی تصویر لیں یا اپلوڈ کریں۔ سسٹم سپریم کورٹ نظائر (2026 SCLR 90) کے تحت بغیر عنوان کے بھی خفیہ گفٹ ڈیڈ اور دستبرداری کی فوری جانچ کرے گا۔'); ?>
        </p>
    </div>

    <!-- AI Disclaimer & Mandatory Legal Advisory Banner -->
    <div class="ai-disclaimer-card" data-aos="fade-up" style="background: #fffbeb; border: 2px solid #fde68a; border-radius: var(--radius-lg); padding: 18px 24px; margin-bottom: 30px; box-shadow: 0 4px 14px rgba(217, 119, 6, 0.08); display: flex; align-items: flex-start; gap: 16px;">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: #fef3c7; color: #b45309; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; box-shadow: 0 2px 6px rgba(180, 83, 9, 0.15);">
            <i class="fa fa-triangle-exclamation"></i>
        </div>
        <div style="flex: 1;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px; flex-wrap: wrap;">
                <span style="background: #dc2626; color: #ffffff; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 4px; text-transform: uppercase;">
                    <?php echo dual_val('اہم قانونی انتباہ', 'Important Legal Notice'); ?>
                </span>
                <h4 style="font-size: 16px; font-weight: 800; color: #78350f; margin: 0;">
                    <?php echo dual_val('مصنوعی ذہانت (AI) کا انتباہ اور وکیل سے قانونی مشاورت کی اہمیت', 'AI Output Advisory & Mandatory Legal Consultation'); ?>
                </h4>
            </div>
            <p style="font-size: 14.5px; color: #92400e; line-height: 1.8; margin: 0; font-weight: 600;">
                <?php echo dual_val(
                    'یہ فراڈ ڈیٹیکٹر ایک معاون AI ٹول ہے۔ مصنوعی ذہانت (AI) بعض اوقات غلطی کر سکتی ہے اور غلط جواب یا غلط نتیجہ بھی دے سکتی ہے۔ اس لیے کسی بھی اسٹامپ پیپر یا دستاویز پر دستخط کرنے یا حتمی فیصلہ لینے سے پہلے کسی مستند اور باضابطہ وکیل (Advocate / Lawyer) سے تفصیلی بات چیت اور قانونی مشاورت کرنا لازمی اور نہایت ضروری ہے۔',
                    'This fraud detector is an AI-powered awareness assistant. Artificial Intelligence may occasionally produce errors or incorrect results. Therefore, before signing any document or making legal decisions, consulting a licensed Advocate / Lawyer is essential and mandatory.'
                ); ?>
            </p>
            <div style="margin-top: 10px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <a href="tel:03227653464" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 800; background: #b45309; color: #ffffff; padding: 5px 14px; border-radius: 6px; text-decoration: none;">
                    <i class="fa fa-phone"></i> <?php echo dual_val('قانونی رہنمائی: 0322 7653464 (ایڈووکیٹ اشراق علی)', 'Legal Consult: 0322 7653464 (Advocate Ishraq Ali)'); ?>
                </a>
                <a href="help.php" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #78350f; text-decoration: underline;">
                    <i class="fa fa-hand-holding-heart"></i> <?php echo dual_val('صوبہ وار مفت این جی اوز و ہیلپ لائنز', 'Free Province-wise Legal Helplines'); ?>
                </a>
            </div>
        </div>
    </div>

    <div class="scanner-main-wrapper" data-aos="fade-up">
        <!-- 1. Mode Switcher (Camera vs Upload vs Sample Deeds) -->
        <div class="scanner-mode-selector">
            <button type="button" class="scanner-tab-btn active" id="tabCameraBtn">
                <i class="fa fa-camera"></i>
                <span><?php echo dual_val('کیمرہ سے تصویر لیں', 'Live Camera Scan'); ?></span>
            </button>
            <button type="button" class="scanner-tab-btn" id="tabUploadBtn">
                <i class="fa fa-cloud-arrow-up"></i>
                <span><?php echo dual_val('تصویر اپلوڈ کریں', 'Upload Document'); ?></span>
            </button>
            <button type="button" class="scanner-tab-btn" id="tabSamplesBtn">
                <i class="fa fa-file-contract"></i>
                <span><?php echo dual_val('آزمائشی نمونہ جات', 'Test Samples'); ?></span>
            </button>
        </div>

        <!-- 2. LIVE CAMERA VIEWPORT -->
        <div id="cameraViewportBlock" class="camera-viewfinder-card">
            <div class="camera-stream-container" id="streamContainer">
                <video id="cameraVideo" autoplay playsinline muted></video>
                <canvas id="cameraCanvas"></canvas>
                <img id="capturedImagePreview" class="preview-snapshot-img" alt="Captured Deed">
                
                <!-- Laser Scanning Beam -->
                <div class="scanning-beam" id="scannerLaserBeam"></div>

                <!-- Viewfinder Framing Guides -->
                <div class="camera-frame-overlay" id="cameraFrameOverlay">
                    <span class="frame-corner-tr"></span>
                    <span class="frame-corner-bl"></span>
                    <div class="camera-frame-hint">
                        <i class="fa fa-expand"></i> <?php echo dual_val('اسٹامپ پیپر یا دستاویز کو فریم کے اندر سیدھا رکھیں', 'Position stamp paper within the frame'); ?>
                    </div>
                </div>
            </div>

            <!-- Camera Control Toolbar -->
            <div class="camera-controls-bar">
                <button type="button" class="btn-camera-util" id="flipCameraBtn" title="کیمرہ تبدیل کریں (Flip Camera)">
                    <i class="fa fa-camera-rotate"></i> <?php echo dual_val('کیمرہ سوئچ', 'Flip'); ?>
                </button>

                <button type="button" class="btn-snap-photo" id="snapPhotoBtn">
                    <i class="fa fa-circle-dot"></i> <?php echo dual_val('تصویر لیں اور جانچیں', 'Capture & Scan'); ?>
                </button>

                <button type="button" class="btn-camera-util" id="retakePhotoBtn" style="display: none;">
                    <i class="fa fa-rotate-left"></i> <?php echo dual_val('دوبارہ تصویر لیں', 'Retake'); ?>
                </button>
            </div>
        </div>

        <!-- 3. FILE UPLOAD DROPZONE BLOCK -->
        <div id="uploadDropzoneBlock" style="display: none;">
            <div class="upload-dropzone-card" id="dropzoneCard">
                <div class="dropzone-icon">
                    <i class="fa fa-file-invoice"></i>
                </div>
                <h3 style="font-size: 18px; color: var(--navy); margin-bottom: 6px;">
                    <?php echo dual_val('اسٹامپ پیپر یا دستاویز کی تصویر یہاں ڈریگ کریں یا کلک کریں', 'Drag & drop stamp paper or deed image here'); ?>
                </h3>
                <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 16px;">
                    <?php echo dual_val('JPG, PNG, JPEG فارمیٹس قبول کیے جاتے ہیں۔ آپ موبائل کیمرے سے بھی براہِ راست تصویر لے سکتے ہیں۔', 'Supports JPG, PNG, WebP. Also supports paste via Ctrl+V.'); ?>
                </p>
                <input type="file" id="documentFileInput" accept="image/*" style="display: none;">
                <button type="button" class="btn btn-primary" onclick="document.getElementById('documentFileInput').click();">
                    <i class="fa fa-folder-open"></i> <?php echo dual_val('فائل منتخب کریں (Choose File)', 'Select Image File'); ?>
                </button>
            </div>
        </div>

        <!-- 4. SAMPLE DEEDS SHELF (FOR INSTANT 1-CLICK TESTING) -->
        <div id="samplesBlock" class="sample-deeds-shelf" style="display: none;">
            <h4 style="font-size: 16px; color: var(--navy); margin-bottom: 4px;">
                <i class="fa fa-vial" style="color: var(--primary);"></i>
                <?php echo dual_val('فوری ٹیسٹ کے لیے آزمائشی دستاویز منتخب کریں:', 'Select a sample document for instant evaluation:'); ?>
            </h4>
            <p style="font-size: 13.5px; color: var(--text-muted);">
                <?php echo dual_val('اگر آپ کے پاس اصل اسٹامپ پیپر نہیں ہے تو درج ذیل نمونہ جات پر کلک کر کے سسٹم کی اسکیننگ چیک کریں:', 'Click any sample below to simulate scanning and fraud detection:'); ?>
            </p>

            <div class="sample-deeds-grid">
                <!-- Sample 1: Title-less Stealth Gift Deed (Disguised under simple Iqrar-Nama) -->
                <div class="sample-deed-btn danger" onclick="loadSampleDeed(1)">
                    <div>
                        <span class="sample-deed-tag danger">⚠️ خفیہ ہبہ نامہ (بغیر عنوان)</span>
                        <h5 style="font-size: 14.5px; color: #991b1b; margin-bottom: 6px;">بغیر عنوان کا خفیہ ہبہ نامہ (سادہ اقرار نامہ)</h5>
                        <p style="font-size: 12.5px; color: #475569; line-height: 1.6;">
                            عنوان صرف "اقرار نامہ" ہے (لفظ ہبہ غائب ہے)، لیکن اندر تحفتاً بلا معاوضہ حصہ بھائی کے حوالے کرنے اور حق چھوڑنے کی خفیہ شقیں درج ہیں...
                        </p>
                    </div>
                    <div style="font-size: 12px; font-weight: 700; color: #dc2626; margin-top: 10px;">
                        <i class="fa fa-arrow-left"></i> یہ نمونہ اسکین کریں
                    </div>
                </div>

                <!-- Sample 2: Explicit Titled Gift Deed & Power of Attorney -->
                <div class="sample-deed-btn danger" onclick="loadSampleDeed(2)">
                    <div>
                        <span class="sample-deed-tag danger">⚠️ واضح ہبہ نامہ (گفٹ ڈیڈ)</span>
                        <h5 style="font-size: 14.5px; color: #991b1b; margin-bottom: 6px;">ہبہ نامہ ترکہ جائیداد و مختار نامہ بیع</h5>
                        <p style="font-size: 12.5px; color: #475569; line-height: 1.6;">
                            "مسماۃ نے اپنا وراثتی حصہ بھائی کے حق میں ہبہ کر دیا ہے اور بیع و فروخت کا بلا منسوخی مختار نامہ تفویض ہے..."
                        </p>
                    </div>
                    <div style="font-size: 12px; font-weight: 700; color: #dc2626; margin-top: 10px;">
                        <i class="fa fa-arrow-left"></i> یہ نمونہ اسکین کریں
                    </div>
                </div>

                <!-- Sample 3: Legitimate Equal Share Partition -->
                <div class="sample-deed-btn safe" onclick="loadSampleDeed(3)">
                    <div>
                        <span class="sample-deed-tag safe">✅ قانونی و شرعی دستاویز</span>
                        <h5 style="font-size: 14.5px; color: #065f46; margin-bottom: 6px;">جائز شرعی تقسیم نامہ بمعہ نقد معاوضہ</h5>
                        <p style="font-size: 12.5px; color: #475569; line-height: 1.6;">
                            "تمام خواتین وارثان کو ان کا مکمل شرعی حصہ اور نقد معاوضہ بمطابق ڈی سی ریٹ بذریعہ بینک پے آرڈر ادا کر دیا گیا ہے..."
                        </p>
                    </div>
                    <div style="font-size: 12px; font-weight: 700; color: #059669; margin-top: 10px;">
                        <i class="fa fa-arrow-left"></i> یہ نمونہ اسکین کریں
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. REAL-TIME FRAUD ANALYSIS RESULT CARD -->
        <div id="fraudAnalysisResult" class="fraud-analysis-result">
            <!-- Urgent "DO NOT SIGN" Warning Banner -->
            <div id="doNotSignBanner" class="do-not-sign-banner" style="display: none;">
                <div class="do-not-sign-icon">
                    <i class="fa fa-hand"></i>
                </div>
                <div class="do-not-sign-text">
                    <h3>🛑 خبردار! اس دستاویز پر ہرگز دستخط یا انگوٹھا نہ لگائیں!</h3>
                    <p id="doNotSignSub">
                        یہ ہبہ نامہ (Gift Deed) یا دستبرداری کا کاغذ آپ سے آپ کا شرعی و قانونی وراثتی حق ہمیشہ کے لیے چھیننے کی کوشش ہے۔
                    </p>
                </div>
            </div>

            <!-- Interactive Voice Audio Alert Banner (صوتی انتباہ) -->
            <div id="voiceWarningBox" class="voice-warning-box" style="display: none;">
                <div class="voice-warning-inner">
                    <div class="voice-pulse-indicator" id="voicePulseIndicator">
                        <span class="voice-wave wave1"></span>
                        <span class="voice-wave wave2"></span>
                        <span class="voice-wave wave3"></span>
                        <i class="fa fa-volume-high voice-icon"></i>
                    </div>
                    <div class="voice-info">
                        <div class="voice-status-badge" id="voiceStatusBadge">
                            <span class="live-dot"></span> صوتی وارننگ (Urdu Voice Alert)
                        </div>
                        <div class="voice-text-preview" id="voiceTextPreview">
                            "خبردار! اس دستاویز پر ہرگز دستخط یا انگوٹھا نہ لگائیں..."
                        </div>
                    </div>
                    <div class="voice-actions">
                        <button type="button" id="playVoiceBtn" class="btn-voice-play" onclick="speakCurrentWarning()">
                            <i class="fa fa-play" id="voicePlayIcon"></i> <span id="voicePlayText">آواز دوبارہ سنیں</span>
                        </button>
                        <button type="button" id="stopVoiceBtn" class="btn-voice-stop" onclick="stopVoiceWarning()" style="display: none;">
                            <i class="fa fa-stop"></i> خاموش کریں
                        </button>
                    </div>
                </div>
            </div>

            <!-- Explicit Titled Hiba Detection Alert Badge -->
            <div id="explicitTitleAlert" style="display: none; padding: 0 28px 10px;">
                <div class="stealth-title-badge" style="background: #fee2e2; color: #991b1b; border-color: #f87171;">
                    <i class="fa fa-file-signature"></i> 
                    <span><strong>واضح ہبہ نامہ / گفٹ ڈیڈ (Explicit Gift Deed):</strong> اس دستاویز پر واضح طور پر "ہبہ نامہ / گفٹ ڈیڈ" کا عنوان درج ہے۔ قانون اور شریعت کے مطابق بہن یا بیٹی کے حصے کا ہبہ نامہ لکھوانا وراثت غصب کرنے کا حربہ ہے۔ اس پر ہرگز دستخط نہ کریں!</span>
                </div>
            </div>

            <!-- Stealth Title-less Hiba Detection Alert Badge -->
            <div id="stealthTitleAlert" style="display: none; padding: 0 28px 10px;">
                <div class="stealth-title-badge">
                    <i class="fa fa-user-secret"></i> 
                    <span><strong>خفیہ ہبہ نامہ پکڑا گیا (بغیر عنوان کے):</strong> اس دستاویز پر جان بوجھ کر 'ہبہ نامہ' کا عنوان نہیں دیا گیا تاکہ آپ کو شک نہ ہو، لیکن اندرونی متن میں آپ کی جائیداد کو 'تحفے' اور 'بلا معاوضہ' کے بہانے مفت منتقل کروایا جا رہا ہے!</span>
                </div>
            </div>

            <!-- Main Status Banner -->
            <div id="resultBanner" class="result-header-banner critical">
                <div class="result-header-icon" id="resultIcon">
                    <i class="fa fa-triangle-exclamation"></i>
                </div>
                <div>
                    <span id="resultBadge" style="font-size: 12px; font-weight: 800; background: rgba(255,255,255,0.25); padding: 3px 10px; border-radius: 12px; display: inline-block; margin-bottom: 6px;">
                        CRITICAL INHERITANCE FRAUD DETECTED
                    </span>
                    <h2 id="resultHeading" style="font-size: 22px; font-weight: 800; margin: 0; line-height: 1.3;">
                        شدید خطرہ: وراثت سے محروم کرنے کی غیر قانونی کوشش
                    </h2>
                    <p id="resultSub" style="font-size: 14px; margin: 4px 0 0; opacity: 0.95;">
                        اسٹامپ پیپر میں ایسی شقیں موجود ہیں جو سپریم کورٹ نظائر کے تحت قانوناً باطل اور دھوکہ دہی ہیں۔
                    </p>
                </div>
            </div>

            <!-- Inline AI Caution Advisory -->
            <div style="background: #fffbeb; border: 1.5px solid #fde68a; border-radius: 8px; padding: 10px 18px; margin: 12px 24px 0; display: flex; align-items: center; gap: 10px; font-size: 13.5px; color: #92400e; line-height: 1.6;">
                <i class="fa fa-circle-exclamation" style="color: #b45309; font-size: 18px; flex-shrink: 0;"></i>
                <span><strong>ضروری مشورہ (Mandatory Legal Check):</strong> AI نتائج میں تکنیکی غلطی کا امکان ہو سکتا ہے۔ کسی بھی دستاویز کی حتمی تصدیق اور قانونی فیصلے کے لیے اپنے وکیل (Advocate) یا لیگل ہیلپ لائن سے بات کرنا لازمی ہے۔</span>
            </div>

            <div class="result-body-card">
                <!-- Flagged Suspicious Clauses -->
                <div id="flaggedClausesSection" class="flagged-clauses-box">
                    <h4 style="font-size: 16px; color: #991b1b; margin-bottom: 6px;">
                        <i class="fa fa-circle-xmark"></i> دستاویز میں پکڑی گئی مشکوک اور خطرناک شقیں:
                    </h4>
                    <p style="font-size: 13.5px; color: #64748b; margin-bottom: 12px;">
                        دستاویز کے اسکین سے درج ذیل دھوکہ دہی کے فقرے دریافت ہوئے ہیں جن پر دستخط کرنے سے آپ کا حصہ چھن سکتا ہے:
                    </p>
                    <div id="flaggedClausesList">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>

                <!-- CRITICAL SECTION: CONSEQUENCES OF SIGNING (اگر دستخط کر دیے تو کیا نقصان ہو گا؟) -->
                <div id="consequencesSection" class="consequences-section" style="display: none;">
                    <div class="consequences-title">
                        <i class="fa fa-triangle-exclamation"></i>
                        <span>اگر آپ نے اس دستاویز پر دستخط یا انگوٹھا لگا دیا تو کیا نقصان ہو گا؟</span>
                    </div>
                    <p style="font-size: 14px; color: #7c2d12; margin: 0 0 14px 0; font-weight: 600; line-height: 1.7;">
                        دستخط یا انگوٹھا لگانے کے بعد قانوناً آپ کے ساتھ درج ذیل ناقابلِ تلافی نقصانات رونما ہو سکتے ہیں جن کے بعد جائیداد واپس لینا انتہائی مشکل ہو جائے گا:
                    </p>
                    <div class="consequences-grid">
                        <div class="consequence-card">
                            <div class="consequence-card-header">
                                <div class="consequence-icon-wrap"><i class="fa fa-house-circle-xmark"></i></div>
                                <h5>۱) ملکیت کا فوری خاتمہ اور پٹوار سے بے دخلی</h5>
                            </div>
                            <p>دستخط ہوتے ہی آپ قانونی طور پر اپنی جائیداد سے بے دخل ہو جائیں گی اور وہ پٹوار یا اراضی ریکارڈ سنٹر (PLRA) جا کر چپکے سے آپ کا نام سرکاری کاغذات سے خارج کروا لیں گے۔</p>
                        </div>

                        <div class="consequence-card">
                            <div class="consequence-card-header">
                                <div class="consequence-icon-wrap"><i class="fa fa-hand-holding-dollar"></i></div>
                                <h5>۲) صفر معاوضہ (کوئی رقم یا قیمت نہیں ملے گی)</h5>
                            </div>
                            <p>چونکہ کاغذ میں لکھا ہوگا کہ آپ نے "تحفہ" یا "بلا معاوضہ" دیا ہے، اس لیے آپ بعد میں اپنے حصے کی کوئی قیمت، رقم یا مارکیٹ ویلیو مانگنے کا قانونی حق بھی کھو دیں گی۔</p>
                        </div>

                        <div class="consequence-card">
                            <div class="consequence-card-header">
                                <div class="consequence-icon-wrap"><i class="fa fa-scale-unbalanced"></i></div>
                                <h5>۳) عدالت میں آپ کے اپنے دستخط آپ ہی کے خلاف ثبوت بنیں گے</h5>
                            </div>
                            <p>کل کو اگر آپ عدالت جائیں گی تو وہ جج کے سامنے یہی کاغذ پیش کر کے کہیں گے کہ "اس نے خود اپنی مرضی سے تحفہ دیا تھا"۔ پھر اسے منسوخ کروانے کے لیے دہائیوں تک مقدمہ بازی کرنی پڑے گی۔</p>
                        </div>

                        <div class="consequence-card">
                            <div class="consequence-card-header">
                                <div class="consequence-icon-wrap"><i class="fa fa-children"></i></div>
                                <h5>۴) آپ کی اولاد اور بیٹیوں کا حق بھی ہمیشہ کے لیے ختم</h5>
                            </div>
                            <p>آپ کے بعد آپ کے بچے یا بیٹیاں بھی اس آبائی جائیداد پر اپنا حق نہیں مانگ سکیں گی کیونکہ آپ نے اپنی زندگی میں ہی اسے "ہبہ / تحفہ" کر دیا تھا۔</p>
                        </div>

                        <div class="consequence-card">
                            <div class="consequence-card-header">
                                <div class="consequence-icon-wrap"><i class="fa fa-user-xmark"></i></div>
                                <h5>۵) تیسرے انجان شخص کو فروخت یا بینک گروی کا خطرہ</h5>
                            </div>
                            <p>وہ یہ جائیداد فوری طور پر کسی تیسرے خریدار کو فروخت کر دیں گے یا اس پر بینک سے بھاری قرض لے لیں گے، جس کے بعد جائیداد واپس لینا عدالت کے ذریعے بھی ناممکن ہو جائے گا۔</p>
                        </div>
                    </div>
                </div>

                <!-- Supreme Court Landmark Precedent Shield -->
                <div class="supreme-court-shield">
                    <h4 style="font-size: 16px; color: #065f46; margin-bottom: 8px;">
                        <i class="fa fa-scale-balanced" style="color: var(--primary);"></i>
                        سپریم کورٹ آف پاکستان کا قانونی تحفظ (2026 SCLR 90):
                    </h4>
                    <p style="font-size: 14px; line-height: 1.85; color: #1e293b;" id="precedentExplanation">
                        سپریم کورٹ آف پاکستان نے <strong>غلام شبیر بنام مسماۃ نور بیگم (2026 SCLR 90)</strong> میں واشگاف فیصلہ دیا ہے کہ خواتین سے بلا معاوضہ دستبرداری لینا، حق بخشوانا، خاندانی دباؤ میں ہبہ نامہ لکھوانا یا خفیہ اختیارات والا مختار نامہ حاصل کرنا شروع ہی سے غیر قانونی اور کالعدم (Void Ab Initio) ہے۔ اس دستاویز پر دستخط ہرگز نہ کریں۔
                    </p>
                </div>

                <!-- Recommended Immediate Actions -->
                <div style="background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 20px; margin-bottom: 24px;">
                    <h4 style="font-size: 16px; color: var(--navy); margin-bottom: 12px;">
                        <i class="fa fa-shield-halved" style="color: var(--gold);"></i>
                        آپ کو فوری طور پر کیا کرنا چاہیے؟
                    </h4>
                    <ul style="font-size: 14px; line-height: 2; color: #334155; padding-right: 20px;">
                        <li><strong>کسی بھی اسٹامپ پیپر، سادہ کاغذ یا رجسٹری پر انگوٹھا یا دستخط ہرگز نہ کریں۔</strong></li>
                        <li>اگر خاندان مکان یا اراضی اپنے پاس رکھنا چاہتا ہے، تو صاف کہیں کہ <strong>میرا پورا شرعی حصہ سرکاری ڈی سی ریٹ کے مطابق نقد بینک پے آرڈر کے ذریعے ادا کیا جائے۔</strong></li>
                        <li>دستخط کے وقت اپنے ذاتی آزاد وکیل (Independent Counsel) کی موجودگی لازمی قرار دیں؛ خاندان کے وکیل پر بھروسہ نہ کریں۔</li>
                        <li>اگر بھائی، چچا یا رشتہ دار زبردستی یا جذباتی دباؤ ڈالیں تو فوری طور پر نیچے دیے گئے مفت نمبرز پر کال کریں۔</li>
                    </ul>

                    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 16px;">
                        <a href="tel:1099" class="btn btn-danger" style="padding: 10px 22px; font-weight: 800;">
                            <i class="fa fa-phone-alt"></i> 1099 مفت قانونی ہیلپ لائن
                        </a>
                        <a href="tel:1055" class="btn btn-secondary" style="padding: 10px 22px; font-weight: 800; background: var(--navy); color: #fff;">
                            <i class="fa fa-building-shield"></i> 1055 وفاقی محتسب (FOSPAH)
                        </a>
                        <a href="help.php" class="btn btn-primary" style="padding: 10px 22px; font-weight: 800;">
                            <i class="fa fa-hand-holding-heart"></i> مفت قانونی ایڈ و این جی اوز سے رابطہ کریں
                        </a>
                    </div>
                </div>

                <!-- Extracted Text Viewer & Editor (Accordion) -->
                <div class="extracted-text-details">
                    <div style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;" onclick="toggleExtractedText()">
                        <h5 style="font-size: 14.5px; color: var(--navy); margin: 0;">
                            <i class="fa fa-file-lines" style="color: var(--primary);"></i> تصویر سے پڑھا گیا متن (Scanned Text Details)
                        </h5>
                        <span style="font-size: 13px; color: var(--primary); font-weight: 700;">
                            <span id="textToggleLabel">دیکھیں / ترمیم کریں</span> <i class="fa fa-angle-down" id="textToggleIcon"></i>
                        </span>
                    </div>

                    <div id="extractedTextContainer" style="display: none; margin-top: 12px;">
                        <p style="font-size: 12.5px; color: var(--text-muted); margin-bottom: 6px;">
                            اگر کیمرے کی تصویر دھندلی تھی تو آپ نیچے متن خود بھی درست کر کے "دوبارہ جانچیں" پر کلک کر سکتے ہیں:
                        </p>
                        <textarea id="extractedTextarea" class="extracted-textarea"></textarea>
                        <div style="margin-top: 10px; display: flex; gap: 10px;">
                            <button type="button" class="btn btn-primary btn-sm" onclick="reAnalyzeEditedText()">
                                <i class="fa fa-arrows-rotate"></i> دوبارہ جانچیں (Re-Analyze Text)
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="resetScanner()">
                                <i class="fa fa-camera"></i> نئی دستاویز اسکین کریں (Scan Another)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Legal Knowledge Base Precedent Reference -->
<div class="container" style="padding-bottom: 60px;">
    <div style="background: #ffffff; border-radius: var(--radius-lg); padding: 30px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);" data-aos="fade-up">
        <h3 style="color: var(--navy); font-size: 18px; margin-bottom: 12px;">
            <i class="fa fa-book-scale" style="color: var(--primary);"></i> 
            <?php echo $lang === 'en' ? 'Historic Supreme Court of Pakistan Judgements on Gift Deeds & Forfeiture:' : ($lang === 'ur' ? 'ہبہ نامہ، گفٹ ڈیڈ اور دستبرداری پر سپریم کورٹ آف پاکستان کا تاریخی فیصلہ:' : 'ہبہ نامہ و دستبرداری پر سپریم کورٹ فیصلے / Historic Supreme Court Precedents:'); ?>
        </h3>
        <div style="font-size: 14.5px; line-height: 1.9; color: var(--text-main);">
            <?php
            $precedent_ur = 'سپریم کورٹ آف پاکستان نے اپنے تاریخی فیصلوں خصوصاً <strong>غلام شبیر بنام مسماۃ نور بیگم (2026 SCLR 90)</strong>، <strong>مسماۃ سکینہ بنام بورڈ آف ریونیو</strong> اور <strong>PLD 2021 SC 873</strong> میں دو ٹوک قانون طے کیا ہے کہ پاکستانی معاشرے میں پردہ نشین یا خاندانی دباؤ میں رہنے والی خواتین سے لیے گئے تمام ہبہ نامے (Gift Deeds)، زبانی ہبہ نامے، بلا معاوضہ تنازل نامے، اور خفیہ اختیارات والے مختار نامے شروع ہی سے مشتبہ اور باطل (Void Ab Initio) تصور ہوں گے۔ عدالتِ عظمیٰ نے یہ شرط عائد کی ہے کہ اگر کوئی بھائی یا مرد رشتہ دار یہ دعویٰ کرے کہ بہن یا ماں نے اپنا حصہ "ہبہ" یا "تحفہ" کر دیا ہے، تو اس ہبہ کے حقیقی اور رضاکارانہ ہونے، معقول مالی ادائیگی ہونے اور خاتون کے ذاتی آزاد وکیل کی موجودگی کو ثابت کرنے کا 100 فیصد بوجھ مرد پر ہوگا ورنہ ہبہ فوری منسوخ کر دیا جائے گا۔';
            $precedent_en = 'In landmark precedents including <strong>Ghulam Shabbir v. Mst. Noor Begum (2026 SCLR 90)</strong> and <strong>PLD 2021 SC 873</strong>, the Supreme Court of Pakistan established that uncompensated gift deeds (Hiba-nama) or waivers executed by female family members under familial influence are presumptively fraudulent and void ab initio. The entire legal burden lies upon the male beneficiary to demonstrate that the gift was voluntary, independent legal counsel was present, and fair compensation was tendered.';
            ?>
            <?php if ($lang === 'both'): ?>
                <div class="dual-block">
                    <div class="dual-ur" style="font-family: 'Noto Nastaliq Urdu', serif; line-height: 2.1; margin-bottom: 15px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
                        <?php echo $precedent_ur; ?>
                    </div>
                    <div class="dual-en" style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 1.6; color: #334155;">
                        <?php echo $precedent_en; ?>
                    </div>
                </div>
            <?php elseif ($lang === 'ur'): ?>
                <div style="font-family: 'Noto Nastaliq Urdu', serif; line-height: 2.1;"><?php echo $precedent_ur; ?></div>
            <?php else: ?>
                <div style="font-family: 'Plus Jakarta Sans', sans-serif; line-height: 1.6;"><?php echo $precedent_en; ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- ==========================================================================
     DOCUMENT CAMERA SCANNER & INTELLIGENT FRAUD ANALYZER ENGINE (JAVASCRIPT)
     ========================================================================== -->
<script>
let currentStream = null;
let currentFacingMode = 'environment';
let isCameraActive = false;

// Sample Test Deeds Database
const sampleDeeds = {
    1: {
        stampTitle: "اقرار نامہ ترکہ", // Notice: Word 'Hiba' or 'Gift' intentionally omitted from title
        title: "بغیر عنوان کا خفیہ ہبہ نامہ (Title-less Concealed Gift Deed)",
        text: "باعث تحریر آنکہ میں مسمات زینب بی بی دختر عبداللہ ساکن لاہور۔ اقرار کرتی ہوں کہ والد کے ترکہ مکان واقع لاہور کا اپنا جملہ وراثتی حصہ اپنے بھائی کے پیار و محبت اور جذبۂ خدمت کے تحت خوشی سے تحفتاً بلا معاوضہ و بلا عوض بھائی کو دیتی ہوں اور قبضہ حوالے کر دیا ہے۔ کوئی رقم یا معاوضہ نہیں لیا۔ آئندہ میرا یا میری اولاد کا اس پر کوئی دعویٰ نہ ہوگا۔",
        risk: "CRITICAL"
    },
    2: {
        stampTitle: "ہبہ نامہ ترکہ جائیداد",
        title: "ہبہ نامہ ترکہ جائیداد و مختار نامہ بیع (Titled Hiba Deed)",
        text: "مسمات کلثوم اختر ساکن راولپنڈی اپنے والد مرحوم کی وراثتی اراضی کا اپنا شرعی حصہ اپنے بھائی کے حق میں بلا معاوضہ ہبہ کرتی ہوں اور دستبردار ہوتی ہوں۔ مختار نامہ عام برائے بیع و فروخت بھی تفویض ہے۔ میرا کوئی آزاد وکیل نہیں ہے۔",
        risk: "CRITICAL"
    },
    3: {
        stampTitle: "تقسیم نامہ ترکہ شرعی",
        title: "جائز شرعی و قانونی تقسیم نامہ (Fair Statutory Partition)",
        text: "جملہ وارثان محمد اقبال مرحوم کے مابین شرعی حصص کے مطابق باہمی رضامندی سے منصفانہ تقسیم عمل میں لائی جا رہی ہے۔ تمام خواتین وارثان بشمول بیوہ اور بیٹیوں کو ان کا مکمل شرعی حصہ اور نقد معاوضہ بمطابق سرکاری ڈی سی ریٹ بذریعہ بینک پے آرڈر ادا کر دیا گیا ہے۔ تمام فریقین نے آزاد قانونی وکیل کی موجودگی میں فنگر پرنٹ اور دستخط ثبت کیے ہیں۔",
        risk: "SAFE"
    }
};

// Document Fraud Keyword Patterns & Rule Database
const fraudRules = [
    {
        id: "hiba_gift_explicit",
        isHiba: true,
        regex: /(ہبہ\s*نامہ|گفٹ\s*ڈیڈ|ہبہ\s*کرتی|ہبہ\s*کیا|ہبہ\s*کرتا|ہبہ\s*بالقبض|زبانی\s*ہبہ|تملیک\s*نامہ|gift\s*deed|deed\s*of\s*gift|hiba\s*nama|tamleek)/i,
        category: "CRITICAL",
        title_ur: "ہبہ نامہ / گفٹ ڈیڈ شق (Hiba / Gift Deed Clause)",
        explanation_ur: "دستاویز میں آپ کے شرعی وراثتی حق کو 'ہبہ' (Gift) کروا کے مفت ہتھیانے کی صریح کوشش کی جا رہی ہے۔ سپریم کورٹ کے مطابق خواتین سے خاندانی وراثتی جائیداد کا ہبہ کروانا فراڈ تصور ہوگا۔",
        legal_basis: "2026 SCLR 90 / PLD 2021 SC 873 / تعزیراتِ پاکستان دفعہ 498-A"
    },
    {
        id: "stealth_hiba_titleless",
        isHiba: true,
        isStealth: true,
        // Matches body text transferring property as gift/uncompensated even if title has no "Hiba"
        regex: /(تحفہ|تحفتاً|خوشی\s*سے\s*دے\s*دیا|عطا\s*کر\s*دیا|جذبۂ\s*محبت|محبت\s*و\s*خلوص|خدمت\s*کے\s*تحت|حوالے\s*کر\s*دیا|بلا\s*معاوضہ\s*و\s*بلا\s*عوض|بغیر\s*رقم|بغیر\s*معاوضہ|natural\s*love\s*and\s*affection|gifted\s*without|gratuitous\s*transfer)/i,
        category: "CRITICAL",
        title_ur: "بغیر عنوان کے خفیہ ہبہ نامہ (Stealth Gift / Uncompensated Transfer)",
        explanation_ur: "اس دستاویز پر بظاہر 'اقرار نامہ' یا سادہ بیان لکھا ہے مگر اندرونی عبارت میں آپ سے جائیداد 'تحفے'، 'محبت و خدمت' یا 'بلا معاوضہ' کے بہانے چھینی جا رہی ہے!",
        legal_basis: "سپریم کورٹ قانونی اصول: دستاویز کی اصل روح دیکھی جائے گی، محض عنوان نہیں"
    },
    {
        id: "tanazul_uncompensated",
        isHiba: true,
        regex: /(بلا\s*معاوضہ|حق\s*بخش|دستبردار|ہبہ\s*بلا\s*عوض|چھوڑ\s*دیا|کوئی\s*دعویٰ\s*نہ|دستبرداری|تنازل|relinquish|surrender|waive\s*inheritance|without\s*consideration)/i,
        category: "CRITICAL",
        title_ur: "بلا معاوضہ دستبرداری یا 'حق بخشوانا' (Uncompensated Relinquishment)",
        explanation_ur: "دستاویز میں آپ سے بغیر معقول رقم یا مارکیٹ ویلیو کے وراثتی حق چھوڑنے کا اقرار کروایا جا رہا ہے۔ سپریم کورٹ نظیر (2026 SCLR 90) کے تحت یہ تحریر شروع ہی سے باطل اور کالعدم ہے۔",
        legal_basis: "2026 SCLR 90 / دفعہ 498-A مجموعہ تعزیرات پاکستان (عورت کو وراثت سے محروم کرنے پر 10 سال تک قید)"
    },
    {
        id: "power_of_attorney_sale",
        isHiba: false,
        regex: /(مختار\s*نامہ\s*عام|مختار\s*عام|بیع\s*کرنے|فروخت\s*کرنے|نہ\s*منسوخ|زر\s*ثمن\s*وصول|power\s*of\s*attorney|irrevocable|sell\s*and\s*transfer)/i,
        category: "CRITICAL",
        title_ur: "جائیداد بیع و فروخت کا خفیہ اختیارات والا مختار نامہ (Sale Power of Attorney)",
        explanation_ur: "اس شق کے ذریعے آپ سے جائیداد کی فروخت اور رقم وصول کرنے کے لامحدود اختیارات لیے جا رہے ہیں۔ ایسے مختار ناموں کے ذریعے خواتین کے حصے کی جائیداد بیچ کر رقم ہڑپ کر لی جاتی ہے۔",
        legal_basis: "پاور آف اٹارنی ایکٹ اور سپریم کورٹ آف پاکستان نظائر"
    },
    {
        id: "male_only_transfer",
        isHiba: false,
        regex: /(بھائیوں\s*کے\s*نام|مرد\s*وارثان|صرف\s*بھائی|خاندانی\s*روایت|male\s*heirs\s*only|transferred\s*to\s*brothers)/i,
        category: "CRITICAL",
        title_ur: "جائیداد صرف مرد وارثان کو منتقل کرنے کی پابندی (Male-Only Transfer)",
        explanation_ur: "قرآن و سنت اور آئینِ پاکستان کے تحت جائیداد خود بخود تمام وارثان میں تقسیم ہوتی ہے۔ روایات یا رسم و رواج کی آڑ میں بہنوں یا بیٹیوں کو بے دخل کرنا سنگین فوجداری جرم ہے۔",
        legal_basis: "شریعت اپیل بینچ سپریم کورٹ نظائر"
    },
    {
        id: "no_independent_counsel",
        isHiba: false,
        regex: /(عدم\s*موجودگی\s*وکیل|کوئی\s*وکیل\s*نہ|بغیر\s*وکیل|without\s*counsel|unrepresented)/i,
        category: "WARNING",
        title_ur: "آزادانہ وکیل کی عدم موجودگی (Absence of Independent Female Legal Counsel)",
        explanation_ur: "خواتین کے دستخط لیتے وقت ان کا ذاتی آزاد وکیل موجود ہونا قانونی شرط ہے۔ اگر وکیل مخالف فریق کا تھا تو دستاویز عدالت میں منسوخ ہو جائے گی۔",
        legal_basis: "ہائی کورٹ و سپریم کورٹ آف پاکستان اصول"
    }
];

document.addEventListener('DOMContentLoaded', function () {
    // UI Elements
    const tabCameraBtn = document.getElementById('tabCameraBtn');
    const tabUploadBtn = document.getElementById('tabUploadBtn');
    const tabSamplesBtn = document.getElementById('tabSamplesBtn');
    const cameraViewportBlock = document.getElementById('cameraViewportBlock');
    const uploadDropzoneBlock = document.getElementById('uploadDropzoneBlock');
    const samplesBlock = document.getElementById('samplesBlock');

    const cameraVideo = document.getElementById('cameraVideo');
    const cameraCanvas = document.getElementById('cameraCanvas');
    const capturedImagePreview = document.getElementById('capturedImagePreview');
    const snapPhotoBtn = document.getElementById('snapPhotoBtn');
    const flipCameraBtn = document.getElementById('flipCameraBtn');
    const retakePhotoBtn = document.getElementById('retakePhotoBtn');
    const cameraFrameOverlay = document.getElementById('cameraFrameOverlay');
    const scannerLaserBeam = document.getElementById('scannerLaserBeam');

    const documentFileInput = document.getElementById('documentFileInput');
    const dropzoneCard = document.getElementById('dropzoneCard');

    // 1. Tab Switching Logic
    tabCameraBtn.addEventListener('click', function () {
        stopVoiceWarning();
        setActiveTab(tabCameraBtn);
        cameraViewportBlock.style.display = 'block';
        uploadDropzoneBlock.style.display = 'none';
        samplesBlock.style.display = 'none';
        startCameraStream();
    });

    tabUploadBtn.addEventListener('click', function () {
        stopVoiceWarning();
        setActiveTab(tabUploadBtn);
        stopCameraStream();
        cameraViewportBlock.style.display = 'none';
        uploadDropzoneBlock.style.display = 'block';
        samplesBlock.style.display = 'none';
    });

    tabSamplesBtn.addEventListener('click', function () {
        stopVoiceWarning();
        setActiveTab(tabSamplesBtn);
        stopCameraStream();
        cameraViewportBlock.style.display = 'none';
        uploadDropzoneBlock.style.display = 'none';
        samplesBlock.style.display = 'block';
    });

    function setActiveTab(btn) {
        [tabCameraBtn, tabUploadBtn, tabSamplesBtn].forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    // 2. Camera Access Engine
    async function startCameraStream() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            try {
                if (currentStream) {
                    currentStream.getTracks().forEach(track => track.stop());
                }
                const constraints = {
                    video: {
                        facingMode: currentFacingMode,
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    }
                };
                currentStream = await navigator.mediaDevices.getUserMedia(constraints);
                cameraVideo.srcObject = currentStream;
                cameraVideo.style.display = 'block';
                capturedImagePreview.style.display = 'none';
                cameraFrameOverlay.style.display = 'flex';
                snapPhotoBtn.style.display = 'inline-flex';
                retakePhotoBtn.style.display = 'none';
                isCameraActive = true;
            } catch (err) {
                console.warn('Camera stream error:', err);
                cameraFrameOverlay.querySelector('.camera-frame-hint').innerHTML = 
                    '⚠️ کیمرہ تک رسائی حاصل نہیں ہو سکی۔ براہِ کرم براؤزر پرمیشن چیک کریں یا "تصویر اپلوڈ کریں" پر کلک کریں۔';
            }
        }
    }

    function stopCameraStream() {
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
            currentStream = null;
        }
        isCameraActive = false;
    }

    // Auto-start camera on initial page load if supported
    startCameraStream();

    // Flip Camera Toggle
    flipCameraBtn.addEventListener('click', function () {
        currentFacingMode = currentFacingMode === 'environment' ? 'user' : 'environment';
        startCameraStream();
    });

    // Snap Photo Action
    snapPhotoBtn.addEventListener('click', function () {
        if (!cameraVideo.videoWidth) {
            Swal.fire({
                icon: 'warning',
                title: 'کیمرہ ویڈیو لوڈ ہو رہی ہے',
                text: 'براہِ کرم ایک سیکنڈ انتظار کریں اور دوبارہ تصویر لیں۔',
                confirmButtonText: 'ٹھیک ہے'
            });
            return;
        }

        // Draw video frame to canvas
        cameraCanvas.width = cameraVideo.videoWidth;
        cameraCanvas.height = cameraVideo.videoHeight;
        const ctx = cameraCanvas.getContext('2d');
        ctx.drawImage(cameraVideo, 0, 0, cameraCanvas.width, cameraCanvas.height);

        // Snapshot to image
        const imgDataUrl = cameraCanvas.toDataURL('image/jpeg', 0.85);
        capturedImagePreview.src = imgDataUrl;
        capturedImagePreview.style.display = 'block';
        cameraVideo.style.display = 'none';
        cameraFrameOverlay.style.display = 'none';

        snapPhotoBtn.style.display = 'none';
        retakePhotoBtn.style.display = 'inline-flex';

        // Trigger AI Analysis Animation
        analyzeDocumentImage(imgDataUrl);
    });

    // Retake Photo
    retakePhotoBtn.addEventListener('click', function () {
        resetScanner();
    });

    // 3. File Upload & Drag-and-Drop Handling
    documentFileInput.addEventListener('change', function (e) {
        if (this.files && this.files[0]) {
            handleUploadedFile(this.files[0]);
        }
    });

    dropzoneCard.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropzoneCard.classList.add('drag-over');
    });

    dropzoneCard.addEventListener('dragleave', function (e) {
        e.preventDefault();
        dropzoneCard.classList.remove('drag-over');
    });

    dropzoneCard.addEventListener('drop', function (e) {
        e.preventDefault();
        dropzoneCard.classList.remove('drag-over');
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
            handleUploadedFile(e.dataTransfer.files[0]);
        }
    });

    // Clipboard Paste Image Support (Ctrl+V)
    document.addEventListener('paste', function (e) {
        const items = (e.clipboardData || e.originalEvent.clipboardData).items;
        for (let index in items) {
            const item = items[index];
            if (item.kind === 'file' && item.type.startsWith('image/')) {
                const blob = item.getAsFile();
                handleUploadedFile(blob);
                break;
            }
        }
    });

    function handleUploadedFile(file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            const imgDataUrl = event.target.result;
            // Switch to preview
            cameraViewportBlock.style.display = 'block';
            uploadDropzoneBlock.style.display = 'none';
            cameraVideo.style.display = 'none';
            cameraFrameOverlay.style.display = 'none';
            capturedImagePreview.src = imgDataUrl;
            capturedImagePreview.style.display = 'block';
            snapPhotoBtn.style.display = 'none';
            retakePhotoBtn.style.display = 'inline-flex';

            analyzeDocumentImage(imgDataUrl);
        };
        reader.readAsDataURL(file);
    }
});

// 4. Main Document Analysis Engine
function analyzeDocumentImage(imageDataUrl, overrideText) {
    const laser = document.getElementById('scannerLaserBeam');
    laser.style.display = 'block';

    // Show SweetAlert Scanning Toast / Feedback
    Swal.fire({
        title: 'اسٹامپ پیپر اسکین کیا جا رہا ہے...',
        html: '<div style="font-size: 14px; margin-top: 10px;"><i class="fa fa-spinner fa-spin" style="color: #0f4c3c;"></i> ہبہ نامہ، گفٹ ڈیڈ اور دستبرداری کی قانونی جانچ جاری ہے...</div>',
        allowOutsideClick: false,
        showConfirmButton: false,
        timer: 1600,
        customClass: { popup: 'mera-haq-swal' }
    }).then(() => {
        laser.style.display = 'none';

        // If sample override text is passed directly, evaluate it immediately
        if (overrideText) {
            evaluateDocumentText(overrideText);
            return;
        }

        // Check if Tesseract.js is available for OCR
        if (typeof Tesseract !== 'undefined') {
            Tesseract.recognize(imageDataUrl, 'eng+urd', {
                logger: m => console.log(m)
            }).then(({ data: { text } }) => {
                let cleanText = text ? text.trim() : '';
                // If OCR extracted reasonable text, run evaluation
                if (cleanText.length > 8) {
                    evaluateDocumentText(cleanText);
                } else {
                    promptUserForDocumentType();
                }
            }).catch(err => {
                console.warn('OCR processing error:', err);
                promptUserForDocumentType();
            });
        } else {
            promptUserForDocumentType();
        }
    });
}

// Helper: Prompt user if image was blurry or OCR could not read clear text
function promptUserForDocumentType() {
    Swal.fire({
        title: 'دستاویز کی قسم منتخب کریں',
        html: '<p style="font-size: 14px; color: #475569; line-height: 1.8;">تصویر کا متن مکمل طور پر اسکین نہیں ہو سکا۔ براہِ کرم بتائیں کہ کاغذ پر کیا عنوان یا شق لکھی ہے؟</p>',
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonText: 'ہبہ نامہ / گفٹ ڈیڈ لکھا ہے',
        denyButtonText: 'سادہ اقرار نامہ / بیانِ حلفی ہے',
        cancelButtonText: 'متن خود ٹائپ کریں',
        customClass: {
            popup: 'mera-haq-swal',
            confirmButton: 'btn btn-danger',
            denyButton: 'btn btn-secondary',
            cancelButton: 'btn btn-primary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            evaluateDocumentText("ہبہ نامہ ترکہ جائیداد\nمسمات اپنے والد مرحوم کی وراثتی اراضی کا اپنا شرعی حصہ اپنے بھائی کے حق میں بلا معاوضہ ہبہ کرتی ہوں اور دستبردار ہوتی ہوں۔ مختار نامہ عام برائے بیع و فروخت بھی تفویض ہے۔");
        } else if (result.isDenied) {
            evaluateDocumentText("اقرار نامہ ترکہ\nباعث تحریر آنکہ میں مسمات اپنے بھائی کے جذبۂ خدمت و محبت کے تحت والد کے ترکہ مکان کا وراثتی حصہ خوشی سے تحفتاً بلا معاوضہ و بلا عوض بھائی کو دیتی ہوں اور قبضہ حوالے کر دیا ہے۔ کوئی رقم نہیں لی۔ آئندہ میرا یا میری اولاد کا کوئی دعویٰ نہ ہوگا۔");
        } else {
            toggleExtractedText();
            document.getElementById('extractedTextarea').focus();
        }
    });
}

// 5. Evaluate Text Against Fraud Rules, Stealth Hiba & Supreme Court 2026 SCLR 90
function evaluateDocumentText(text) {
    const resultBox = document.getElementById('fraudAnalysisResult');
    const resultBanner = document.getElementById('resultBanner');
    const resultBadge = document.getElementById('resultBadge');
    const resultHeading = document.getElementById('resultHeading');
    const resultSub = document.getElementById('resultSub');
    const flaggedSection = document.getElementById('flaggedClausesSection');
    const flaggedList = document.getElementById('flaggedClausesList');
    const extractedTextarea = document.getElementById('extractedTextarea');

    const doNotSignBanner = document.getElementById('doNotSignBanner');
    const doNotSignSub = document.getElementById('doNotSignSub');
    const explicitTitleAlert = document.getElementById('explicitTitleAlert');
    const stealthTitleAlert = document.getElementById('stealthTitleAlert');
    const consequencesSection = document.getElementById('consequencesSection');

    extractedTextarea.value = text;
    flaggedList.innerHTML = '';

    const matchedViolations = [];

    // 1. Broad Check: Does document contain the word "Hiba", "Gift Deed", "Tamleek" anywhere in the entire text?
    const explicitHibaRegex = /(ہبہ|هبة|هبه|گفٹ|gift|hiba|tamleek|تملیک)/i;
    const hasExplicitHibaMention = explicitHibaRegex.test(text);

    // 2. Check for stealth giveaway / uncompensated surrender phrases
    const stealthGiveawayRegex = /(تحفہ|تحفتاً|خوشی\s*سے\s*دے\s*دیا|عطا\s*کر\s*دیا|جذبۂ\s*محبت|محبت\s*و\s*خلوص|خدمت\s*کے\s*تحت|حوالے\s*کر\s*دیا|بلا\s*معاوضہ|بلا\s*عوض|بغیر\s*رقم|بغیر\s*معاوضہ|حق\s*بخش|دستبردار|دستبرداری|چھوڑ\s*دیا|کوئی\s*دعویٰ\s*نہ|natural\s*love|without\s*consideration|relinquish)/i;
    const hasStealthGiveaway = stealthGiveawayRegex.test(text);

    // Test text against all fraud rules
    fraudRules.forEach(rule => {
        if (rule.regex.test(text)) {
            // If the document explicitly has "Hiba" written, don't show the "title-less" clause rule
            if (rule.id === 'stealth_hiba_titleless' && hasExplicitHibaMention) {
                return;
            }
            matchedViolations.push(rule);
        }
    });

    // Determine Hiba Classification:
    // If it mentions Hiba anywhere -> It IS an EXPLICIT Hiba Deed (title is written!)
    const isExplicitHiba = hasExplicitHibaMention;
    // If it does NOT mention Hiba anywhere, but contains stealth surrender phrases -> It is TITLE-LESS
    const isTitlelessStealthHiba = (!hasExplicitHibaMention) && hasStealthGiveaway;

    const isViolation = matchedViolations.length > 0 || isExplicitHiba || isTitlelessStealthHiba;

    resultBox.style.display = 'block';
    resultBox.scrollIntoView({ behavior: 'smooth', block: 'start' });

    if (isViolation) {
        // Critical Fraud / Hiba Detected
        resultBanner.className = 'result-header-banner critical';
        resultBadge.textContent = 'CRITICAL INHERITANCE FRAUD DETECTED';
        resultHeading.innerHTML = '⚠️ شدید خطرہ: وراثتی حصہ چھیننے کی کوشش پکڑی گئی!';

        if (isExplicitHiba) {
            resultSub.innerHTML = 'اس دستاویز پر واضح طور پر <strong>"ہبہ نامہ / گفٹ ڈیڈ"</strong> درج ہے تاکہ آپ کا وراثتی حق تحفے کے بہانے مفت منتقل کروایا جا سکے۔';
        } else if (isTitlelessStealthHiba) {
            resultSub.innerHTML = 'اس دستاویز پر عنوان میں "ہبہ نامہ" نہیں لکھا گیا، لیکن اندرونی متن میں آپ کی جائیداد کو تحفتاً یا بلا معاوضہ منتقل کروایا جا رہا ہے۔';
        } else {
            resultSub.innerHTML = 'اسٹامپ پیپر میں غیر قانونی مختار نامہ عام یا یکطرفہ منتقلی کی شقیں موجود ہیں۔';
        }

        flaggedSection.style.display = 'block';

        // 1. ALWAYS SHOW "DO NOT SIGN" BANNER ON FRAUD/HIBA
        doNotSignBanner.style.display = 'flex';
        if (isExplicitHiba) {
            doNotSignSub.innerHTML = 'اس دستاویز پر واضح طور پر <strong>"ہبہ نامہ / گفٹ ڈیڈ"</strong> کا عنوان درج ہے۔ یہ آپ سے آپ کا وراثتی حصہ ہمیشہ کے لیے چھیننے کی کوشش ہے۔ <strong>اس پر ہرگز دستخط یا انگوٹھا نہ لگائیں!</strong>';
        } else if (isTitlelessStealthHiba) {
            doNotSignSub.innerHTML = 'اس دستاویز پر عنوان چھپایا گیا ہے مگر اندر وراثت مفت تحفے کے نام پر چھینی جا رہی ہے۔ <strong>اس پر ہرگز دستخط یا انگوٹھا نہ لگائیں!</strong>';
        } else {
            doNotSignSub.innerHTML = 'یہ دستاویز آپ کو وراثت سے محروم کرنے کے لیے تیار کی گئی ہے۔ <strong>اس پر ہرگز دستخط یا انگوٹھا نہ لگائیں!</strong>';
        }

        // 2. ACCURATE ALERT BADGES: EXPLICIT vs TITLE-LESS
        if (isExplicitHiba) {
            explicitTitleAlert.style.display = 'block';
            stealthTitleAlert.style.display = 'none'; // NEVER say title is missing when title is written!
        } else if (isTitlelessStealthHiba) {
            explicitTitleAlert.style.display = 'none';
            stealthTitleAlert.style.display = 'block';
        } else {
            explicitTitleAlert.style.display = 'none';
            stealthTitleAlert.style.display = 'none';
        }

        // 3. SHOW CONSEQUENCES SECTION (اگر دستخط کر دیے تو کیا نقصان ہو گا؟)
        consequencesSection.style.display = 'block';

        // Ensure at least one violation card is present
        if (matchedViolations.length === 0) {
            if (isExplicitHiba) matchedViolations.push(fraudRules[0]);
            else if (isTitlelessStealthHiba) matchedViolations.push(fraudRules[1]);
        }

        matchedViolations.forEach(v => {
            const item = document.createElement('div');
            item.className = 'flagged-clause-item';
            item.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                    <strong style="color: #991b1b; font-size: 15px;"><i class="fa fa-triangle-exclamation"></i> ${v.title_ur}</strong>
                    <span style="font-size: 11px; background: #fee2e2; color: #dc2626; padding: 2px 7px; border-radius: 4px; font-weight: 800;">کالعدم شق (Void)</span>
                </div>
                <p style="font-size: 13.5px; color: #1e293b; line-height: 1.7; margin: 4px 0;">${v.explanation_ur}</p>
                <div style="font-size: 12px; color: var(--gold-dark); font-weight: 700;">
                    <i class="fa fa-gavel"></i> قانونی حوالہ: ${v.legal_basis}
                </div>
            `;
            flaggedList.appendChild(item);
        });

        if ('vibrate' in navigator) {
            navigator.vibrate([200, 100, 200, 100, 300]);
        }

        // 4. TRIGGER URDU VOICE WARNING & ALARM CHIME
        triggerFraudVoiceAlert({
            isExplicitHiba: isExplicitHiba,
            isTitlelessStealthHiba: isTitlelessStealthHiba,
            isViolation: true
        });
    } else {
        // Safe / Legitimate Document
        resultBanner.className = 'result-header-banner safe';
        resultBadge.textContent = 'SAFE & LEGITIMATE STATUTORY PARTITION';
        resultHeading.innerHTML = '✅ قانونی و محفوظ دستاویز: کوئی دھوکہ دہی یا ہبہ نامہ نہیں ملا';
        resultSub.innerHTML = 'دستاویز میں شرعی تقسیم، نقد معاوضے اور قانونی حقوق کی باقاعدہ ادائیگی کا ذکر ہے۔ کوئی دستبرداری یا ہبہ نہیں پایا گیا۔';
        flaggedSection.style.display = 'none';

        doNotSignBanner.style.display = 'none';
        explicitTitleAlert.style.display = 'none';
        stealthTitleAlert.style.display = 'none';
        consequencesSection.style.display = 'none';

        // Trigger Safe Confirmation Voice
        triggerFraudVoiceAlert({
            isExplicitHiba: false,
            isTitlelessStealthHiba: false,
            isViolation: false
        });

        if (typeof confetti === 'function') {
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        }
    }
}

// 6. Load Sample Deed on 1-Click
function loadSampleDeed(id) {
    const sample = sampleDeeds[id];
    if (!sample) return;

    const cameraViewportBlock = document.getElementById('cameraViewportBlock');
    const uploadDropzoneBlock = document.getElementById('uploadDropzoneBlock');
    const samplesBlock = document.getElementById('samplesBlock');
    const capturedImagePreview = document.getElementById('capturedImagePreview');
    const cameraVideo = document.getElementById('cameraVideo');
    const cameraFrameOverlay = document.getElementById('cameraFrameOverlay');
    const snapPhotoBtn = document.getElementById('snapPhotoBtn');
    const retakePhotoBtn = document.getElementById('retakePhotoBtn');

    // Generate Visual Stamp Paper Card on Canvas
    const canvas = document.getElementById('cameraCanvas');
    canvas.width = 800;
    canvas.height = 520;
    const ctx = canvas.getContext('2d');

    // Draw Stamp Paper Graphic
    ctx.fillStyle = '#fefce8';
    ctx.fillRect(0, 0, 800, 520);

    // Border
    ctx.strokeStyle = id === 3 ? '#15803d' : '#b91c1c';
    ctx.lineWidth = 12;
    ctx.strokeRect(15, 15, 770, 490);

    // Government of Pakistan header
    ctx.fillStyle = id === 3 ? '#166534' : '#991b1b';
    ctx.font = 'bold 22px Arial, sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('GOVERNMENT OF PAKISTAN - NON-JUDICIAL STAMP (RS. 1200)', 400, 55);

    // Stamp Paper Title
    ctx.fillStyle = '#0f172a';
    ctx.font = 'bold 24px "Noto Nastaliq Urdu", serif';
    ctx.fillText(sample.stampTitle, 400, 105);

    ctx.font = '15.5px "Noto Nastaliq Urdu", serif';
    ctx.fillStyle = '#1e293b';
    
    // Multi-line text wrap
    const lines = [
        sample.text.substring(0, 68),
        sample.text.substring(68, 142),
        sample.text.substring(142, 218),
        sample.text.substring(218)
    ];
    let y = 165;
    lines.forEach(l => {
        if (l.trim()) {
            ctx.fillText(l.trim(), 400, y);
            y += 44;
        }
    });

    // Stamp seal
    ctx.fillStyle = id === 3 ? 'rgba(21, 128, 61, 0.2)' : 'rgba(185, 28, 28, 0.2)';
    ctx.beginPath();
    ctx.arc(400, 400, 45, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = id === 3 ? '#15803d' : '#b91c1c';
    ctx.lineWidth = 2;
    ctx.stroke();

    const dataUrl = canvas.toDataURL('image/jpeg');
    capturedImagePreview.src = dataUrl;
    capturedImagePreview.style.display = 'block';
    cameraVideo.style.display = 'none';
    cameraFrameOverlay.style.display = 'none';

    cameraViewportBlock.style.display = 'block';
    uploadDropzoneBlock.style.display = 'none';
    samplesBlock.style.display = 'none';

    snapPhotoBtn.style.display = 'none';
    retakePhotoBtn.style.display = 'inline-flex';

    // Pass sample.text directly into analyzeDocumentImage so it is 100% deterministic
    analyzeDocumentImage(dataUrl, sample.text);
}

// 7. Toggle Scanned Text Details Accordion
function toggleExtractedText() {
    const container = document.getElementById('extractedTextContainer');
    const label = document.getElementById('textToggleLabel');
    const icon = document.getElementById('textToggleIcon');

    if (container.style.display === 'none' || container.style.display === '') {
        container.style.display = 'block';
        label.textContent = 'بند کریں (Hide)';
        icon.className = 'fa fa-angle-up';
    } else {
        container.style.display = 'none';
        label.textContent = 'دیکھیں / ترمیم کریں';
        icon.className = 'fa fa-angle-down';
    }
}

// 8. Re-Analyze Edited Text
function reAnalyzeEditedText() {
    const text = document.getElementById('extractedTextarea').value;
    if (!text.trim()) {
        Swal.fire({
            icon: 'warning',
            title: 'متن خالی ہے',
            text: 'براہِ کرم اسکین شدہ متن درج کریں۔',
            confirmButtonText: 'ٹھیک ہے'
        });
        return;
    }
    evaluateDocumentText(text);
}

// 9. Reset Scanner for New Document
function resetScanner() {
    stopVoiceWarning();
    const resultBox = document.getElementById('fraudAnalysisResult');
    const capturedImagePreview = document.getElementById('capturedImagePreview');
    const cameraVideo = document.getElementById('cameraVideo');
    const cameraFrameOverlay = document.getElementById('cameraFrameOverlay');
    const snapPhotoBtn = document.getElementById('snapPhotoBtn');
    const retakePhotoBtn = document.getElementById('retakePhotoBtn');
    const voiceBox = document.getElementById('voiceWarningBox');

    if (voiceBox) voiceBox.style.display = 'none';
    resultBox.style.display = 'none';
    capturedImagePreview.style.display = 'none';
    cameraVideo.style.display = 'block';
    cameraFrameOverlay.style.display = 'flex';
    snapPhotoBtn.style.display = 'inline-flex';
    retakePhotoBtn.style.display = 'none';

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// =========================================================================
// 10. URDU VOICE WARNING & AUDIO SYNTHESIS ENGINE (صوتی انتباہ)
// =========================================================================
let currentVoiceText = '';
let isSpeakingVoice = false;

// Pre-warm SpeechSynthesis voices
if ('speechSynthesis' in window) {
    window.speechSynthesis.onvoiceschanged = function () {
        window.speechSynthesis.getVoices();
    };
}

// 10.1 Web Audio API Warning Chime (Zero external files needed)
function playWarningChime() {
    try {
        const AudioCtx = window.AudioContext || window.webkitAudioContext;
        if (!AudioCtx) return;
        const ctx = new AudioCtx();
        if (ctx.state === 'suspended') {
            ctx.resume();
        }
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.type = 'triangle';
        osc.connect(gain);
        gain.connect(ctx.destination);

        const now = ctx.currentTime;
        gain.gain.setValueAtTime(0.28, now);
        gain.gain.exponentialRampToValueAtTime(0.001, now + 0.65);

        // Authoritative two-tone beep: 880Hz -> 659.25Hz -> 880Hz
        osc.frequency.setValueAtTime(880, now);
        osc.frequency.setValueAtTime(659.25, now + 0.14);
        osc.frequency.setValueAtTime(880, now + 0.32);

        osc.start(now);
        osc.stop(now + 0.65);
    } catch (e) {
        console.warn('Audio chime notice:', e);
    }
}

// 10.2 Trigger Urdu Spoken Warning according to Document Type
function triggerFraudVoiceAlert(info) {
    let spokenText = '';
    let previewText = '';

    if (info.isExplicitHiba) {
        // Document has explicit title of Hiba / Gift Deed
        spokenText = "خبردار! خبردار! اس دستاویز پر واضح طور پر ہبہ نامہ یا گفٹ ڈیڈ درج ہے۔ یہ آپ کا وراثتی حق ہمیشہ کے لیے چھیننے کی کوشش ہے۔ اس فارم پر ہرگز دستخط یا انگوٹھا نہ لگائیں۔ اگر آپ نے دستخط کر دیے تو آپ کا شرعی اور قانونی حق ہمیشہ کے لیے ختم ہو جائے گا۔";
        previewText = "🛑 صوتی وارننگ: واضح ہبہ نامہ درج ہے! اس فارم پر ہرگز دستخط یا انگوٹھا نہ لگائیں!";
    } else if (info.isTitlelessStealthHiba) {
        // Document has NO title of Hiba, but transfers property without consideration
        spokenText = "خبردار! خبردار! اگرچہ اس دستاویز پر ہبہ نامہ کا عنوان نہیں لکھا گیا، لیکن اندرونی شقوں کی جانچ سے یہ خفیہ ہبہ نامہ ثابت ہوا ہے۔ آپ سے آپ کا وراثتی حصہ مفت تحفے کے بہانے چھینا جا رہا ہے۔ اس فارم پر ہرگز دستخط یا انگوٹھا نہ لگائیں۔";
        previewText = "⚠️ صوتی وارننگ: بغیر عنوان کا خفیہ ہبہ نامہ پکڑا گیا ہے! اس فارم پر ہرگز دستخط یا انگوٹھا نہ لگائیں!";
    } else if (info.isViolation) {
        // Other fraud violations
        spokenText = "خبردار! اس دستاویز میں آپ کا وراثتی حق چھیننے کی غیر قانونی شقیں موجود ہیں۔ اس فارم پر ہرگز دستخط یا انگوٹھا نہ لگائیں۔";
        previewText = "⚠️ صوتی وارننگ: مشتبہ شقیں موجود ہیں، اس فارم پر دستخط یا انگوٹھا نہ لگائیں!";
    } else {
        // Safe document
        spokenText = "یہ دستاویز محفوظ ہے اور اس میں کوئی غیر قانونی ہبہ نامہ یا دستبرداری نہیں پائی گئی۔";
        previewText = "✅ صوتی پیغام: دستاویز محفوظ ہے، کوئی غیر قانونی شق نہیں ملی۔";
    }

    currentVoiceText = spokenText;

    const voiceBox = document.getElementById('voiceWarningBox');
    const voiceTextPreview = document.getElementById('voiceTextPreview');
    const voiceStatusBadge = document.getElementById('voiceStatusBadge');

    if (voiceBox && voiceTextPreview) {
        voiceTextPreview.innerText = previewText;
        if (info.isViolation) {
            voiceBox.style.background = 'linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%)';
            voiceBox.style.borderColor = 'rgba(254, 202, 202, 0.35)';
            if (voiceStatusBadge) voiceStatusBadge.innerHTML = '<span class="live-dot" style="background: #ef4444; box-shadow: 0 0 8px #ef4444;"></span> صوتی وارننگ (Urdu Voice Alert)';
        } else {
            voiceBox.style.background = 'linear-gradient(135deg, #064e3b 0%, #047857 100%)';
            voiceBox.style.borderColor = 'rgba(167, 243, 208, 0.35)';
            if (voiceStatusBadge) voiceStatusBadge.innerHTML = '<span class="live-dot" style="background: #4ade80; box-shadow: 0 0 8px #4ade80;"></span> تصدیقی صوتی پیغام (Voice Confirmation)';
        }
        voiceBox.style.display = 'block';
    }

    // Play warning alarm beep if fraud/Hiba
    if (info.isViolation) {
        playWarningChime();
    }

    // Auto-speak in clear Urdu
    setTimeout(() => {
        speakCurrentWarning();
    }, 450);
}

// 10.3 Speak Current Warning via SpeechSynthesis
function speakCurrentWarning() {
    if (!currentVoiceText) return;

    if (!('speechSynthesis' in window)) {
        console.warn('Speech synthesis not supported on this browser.');
        return;
    }

    window.speechSynthesis.cancel();

    const utterance = new SpeechSynthesisUtterance(currentVoiceText);
    utterance.rate = 0.88; // Deliberate speed so elderly and distressed women understand clearly
    utterance.pitch = 1.0;
    utterance.lang = 'ur-PK';

    // Prioritize Urdu voices, then Hindi (phonetically compatible)
    const voices = window.speechSynthesis.getVoices();
    if (voices && voices.length > 0) {
        const urduVoice = voices.find(v => v.lang.toLowerCase().includes('ur') || /urdu|pakistan|asma/i.test(v.name));
        const hindiVoice = voices.find(v => v.lang.toLowerCase().includes('hi'));
        if (urduVoice) {
            utterance.voice = urduVoice;
        } else if (hindiVoice) {
            utterance.voice = hindiVoice;
        }
    }

    const pulseIndicator = document.getElementById('voicePulseIndicator');
    const playBtnText = document.getElementById('voicePlayText');
    const playBtnIcon = document.getElementById('voicePlayIcon');
    const stopBtn = document.getElementById('stopVoiceBtn');

    utterance.onstart = function () {
        isSpeakingVoice = true;
        if (pulseIndicator) pulseIndicator.classList.add('speaking');
        if (playBtnText) playBtnText.innerText = 'آواز جاری ہے...';
        if (playBtnIcon) playBtnIcon.className = 'fa fa-volume-high fa-beat';
        if (stopBtn) stopBtn.style.display = 'inline-flex';
    };

    utterance.onend = function () {
        isSpeakingVoice = false;
        if (pulseIndicator) pulseIndicator.classList.remove('speaking');
        if (playBtnText) playBtnText.innerText = 'آواز دوبارہ سنیں';
        if (playBtnIcon) playBtnIcon.className = 'fa fa-play';
        if (stopBtn) stopBtn.style.display = 'none';
    };

    utterance.onerror = function (e) {
        console.warn('SpeechSynthesis error:', e);
        isSpeakingVoice = false;
        if (pulseIndicator) pulseIndicator.classList.remove('speaking');
        if (playBtnText) playBtnText.innerText = 'آواز دوبارہ سنیں';
        if (playBtnIcon) playBtnIcon.className = 'fa fa-play';
        if (stopBtn) stopBtn.style.display = 'none';
    };

    window.speechSynthesis.speak(utterance);
}

// 10.4 Stop Voice Warning
function stopVoiceWarning() {
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
    }
    isSpeakingVoice = false;
    const pulseIndicator = document.getElementById('voicePulseIndicator');
    const playBtnText = document.getElementById('voicePlayText');
    const playBtnIcon = document.getElementById('voicePlayIcon');
    const stopBtn = document.getElementById('stopVoiceBtn');

    if (pulseIndicator) pulseIndicator.classList.remove('speaking');
    if (playBtnText) playBtnText.innerText = 'آواز سنیں';
    if (playBtnIcon) playBtnIcon.className = 'fa fa-play';
    if (stopBtn) stopBtn.style.display = 'none';
}
</script>

<?php require_once __DIR__ . '/footer.php'; ?>
