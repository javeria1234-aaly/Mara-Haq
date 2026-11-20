</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <div style="margin-bottom: 14px;">
                    <img src="assets/images/logo-footer.png" alt="میرا حق - Mera Haq" style="height: 56px; width: auto; object-fit: contain;">
                </div>
                <h4 style="font-size: 18px; color: #ffffff; margin-bottom: 10px;">
                    <?php echo dual_val('میرا حق - وراثت پورٹل پاکستان', 'Mera Haq - Wirasat Legal Portal'); ?>
                </h4>
                <p style="font-size: 14.5px; line-height: 1.9; margin-bottom: 18px; color: #f8fafc; font-weight: 500;">
                    <?php echo dual_val('اثاثہ جات کی تلاش، جانشینی، زمین کی تقسیم اور شہریوں کے لیے مفت قانونی امداد', 'Asset Tracing, Succession, Land Mutation & Free Legal Aid Directory for Citizens'); ?>
                </p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="tel:1099" class="btn btn-secondary btn-sm" style="background: var(--gold); color: #0c2340; font-weight: 800; border: none;">
                        <i class="fa fa-phone"></i> 1099 <?php echo dual_val('ہیلپ لائن', 'Helpline'); ?>
                    </a>
                    <a href="help.php" class="btn btn-primary btn-sm" style="background: var(--primary-light); color: #ffffff; border: 1px solid rgba(255,255,255,0.3);">
                        <i class="fa fa-list"></i> <?php echo dual_val('این جی اوز لسٹ', 'NGOs List'); ?>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4 style="font-size: 17px; color: var(--gold-light); margin-bottom: 14px;"><?php echo dual_val('اہم لنکس', 'Quick Links'); ?></h4>
                <ul class="footer-nav-list">
                    <li><a href="index.php"><i class="fa fa-angle-left"></i> <?php echo dual_val('صفحہ اول', 'Home'); ?></a></li>
                    <li><a href="guide.php"><i class="fa fa-angle-left"></i> <?php echo dual_val('قانونی طریقہ کار', 'Legal Guide'); ?></a></li>
                    <li><a href="videos.php"><i class="fa fa-angle-left"></i> <?php echo dual_val('تمام ویڈیو گائیڈز', 'Video Guides'); ?></a></li>
                    <li><a href="help.php"><i class="fa fa-angle-left"></i> <?php echo dual_val('1 سکرین ہیلپ (این جی اوز)', '1-Screen Help (NGOs)'); ?></a></li>
                    <li><a href="fraud_detector.php"><i class="fa fa-angle-left"></i> <?php echo dual_val('فراڈ ڈیٹیکٹر', 'Fraud Detector'); ?></a></li>
                    <li><a href="team.php"><i class="fa fa-angle-left"></i> <?php echo dual_val('ہماری ٹیم (Creators)', 'Our Team'); ?></a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 style="font-size: 17px; color: var(--gold-light); margin-bottom: 14px;"><?php echo dual_val('سرکاری پورٹلز', 'Official Portals'); ?></h4>
                <ul class="footer-nav-list">
                    <li><a href="https://www.nadra.gov.pk" target="_blank" rel="noopener"><i class="fa fa-external-link-alt" style="color: var(--gold-light);"></i> نادرا سکسیشن (NADRA)</a></li>
                    <li><a href="https://fbr.gov.pk" target="_blank" rel="noopener"><i class="fa fa-external-link-alt" style="color: var(--gold-light);"></i> ایف بی آر معلومات (FBR)</a></li>
                    <li><a href="https://www.sbp.org.pk" target="_blank" rel="noopener"><i class="fa fa-external-link-alt" style="color: var(--gold-light);"></i> اسٹیٹ بینک ان کلیمڈ (SBP)</a></li>
                    <li><a href="https://www.punjab-zameen.gov.pk" target="_blank" rel="noopener"><i class="fa fa-external-link-alt" style="color: var(--gold-light);"></i> پنجاب اراضی ریکارڈ (PLRA)</a></li>
                    <li><a href="https://mtmis.excise.punjab.gov.pk" target="_blank" rel="noopener"><i class="fa fa-external-link-alt" style="color: var(--gold-light);"></i> پنجاب ایم ٹی ایم آئی ایس (MTMIS)</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 style="font-size: 17px; color: var(--gold-light); margin-bottom: 14px;"><?php echo dual_val('مفت قانونی امداد و رابطہ', 'Free Legal Aid & Helplines'); ?></h4>
                <p style="font-size: 14px; line-height: 1.8; margin-bottom: 14px; color: #f1f5f9;">
                    <?php echo dual_val('اگر آپ کو وراثت سے محروم کیا جا رہا ہے یا سکسیشن میں رکاوٹ ہے، تو قومی ہیلپ لائنز یا اپنے قریبی این جی او سیل سے فوری مفت رابطہ کریں۔', 'If facing disinheritance, coercion, or succession hurdles, contact national legal aid helplines or nearest NGO cells.'); ?>
                </p>
                <a href="help.php" class="btn btn-secondary btn-sm" style="width: 100%; background: #ffffff; color: var(--navy); font-weight: 800; border: none; padding: 10px;">
                    <i class="fa fa-hand-holding-heart" style="color: var(--primary);"></i> <?php echo dual_val('1 سکرین ہیلپ ڈائریکٹری', '1-Screen Help Directory'); ?>
                </a>
            </div>
        </div>

        <!-- High-Contrast Footer Bottom -->
        <div class="footer-bottom">
            <p style="color: #ffffff; font-size: 14px; font-weight: 600; line-height: 1.8;">
                <i class="fa fa-shield-halved" style="color: var(--gold-light); margin-left: 6px;"></i>
                <?php echo dual_val($translations['ur']['footer_rights'], $translations['en']['footer_rights']); ?>
            </p>
            <p style="color: #e2e8f0; font-size: 13px; line-height: 1.8; margin-top: 6px; background: rgba(0,0,0,0.25); padding: 8px 14px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">
                <i class="fa fa-circle-info" style="color: var(--gold-light); margin-left: 6px;"></i>
                <?php echo dual_val($translations['ur']['legal_disclaimer'], $translations['en']['legal_disclaimer']); ?>
            </p>
        </div>
    </div>
</footer>

<!-- Floating Emergency Quick-Action Speed Dial & Back to Top -->
<div class="floating-widget-wrapper" id="floatingWidget">
    <div class="speed-dial-menu" id="speedDialMenu">
        <a href="tel:1099" class="speed-dial-item item-call" title="1099 مفت قانونی ہیلپ لائن (Free Legal Aid)">
            <i class="fa fa-phone"></i>
            <span class="speed-dial-tooltip">1099 قانونی ہیلپ لائن</span>
        </a>
        <a href="help.php" class="speed-dial-item item-directory" title="ہیلپ لائنز و این جی اوز (Directory)">
            <i class="fa fa-hand-holding-heart"></i>
            <span class="speed-dial-tooltip">ہیلپ لائنز و این جی اوز</span>
        </a>
        <a href="tel:1055" class="speed-dial-item item-call" title="1055 وفاقی محتسب تحفظِ جائیداد (FOSPAH)" style="background: var(--navy); color: #fff;">
            <i class="fa fa-building-shield"></i>
            <span class="speed-dial-tooltip">1055 وفاقی محتسب</span>
        </a>
        <button type="button" class="speed-dial-item item-top" id="backToTopBtn" title="اوپر جائیں (Back to top)">
            <i class="fa fa-arrow-up"></i>
            <span class="speed-dial-tooltip">اوپر جائیں</span>
        </button>
    </div>
    <button type="button" class="speed-dial-main-btn" id="speedDialToggle" aria-label="ایمرجنسی و فوری رابطہ">
        <i class="fa fa-bolt-lightning pulse-icon"></i>
        <i class="fa fa-xmark close-icon"></i>
        <span class="main-btn-badge">فوری مدد</span>
    </button>
</div>

<!-- Vendor Libraries (AOS Animation, SweetAlert2, Confetti, Tilt.js) -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
<script src="assets/vendor/confetti/confetti.browser.min.js"></script>
<script src="assets/vendor/vanilla-tilt/vanilla-tilt.min.js"></script>
<!-- Main Interactive Scripts -->
<script src="assets/js/main.js"></script>
</body>
</html>
