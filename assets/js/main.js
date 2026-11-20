// ==============================================================
// WIRASAT PORTAL - JAVASCRIPT
// Interactive City Filtering, Search, Fraud Meter & Accordions
// ==============================================================

document.addEventListener('DOMContentLoaded', function () {
    // 1. NGO Directory City Filter
    const cityPills = document.querySelectorAll('.city-pill');
    const ngoCards = document.querySelectorAll('.ngo-card');

    if (cityPills.length > 0 && ngoCards.length > 0) {
        cityPills.forEach(pill => {
            pill.addEventListener('click', function () {
                cityPills.forEach(p => p.classList.remove('active'));
                this.classList.add('active');

                const selectedCity = this.getAttribute('data-city').toLowerCase();

                ngoCards.forEach(card => {
                    const cardCity = card.getAttribute('data-city').toLowerCase();
                    if (selectedCity === 'all' || cardCity.includes(selectedCity) || selectedCity.includes(cardCity)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // 2. Real-time Search Filter for NGOs & Guide
    const searchInput = document.getElementById('portal-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();

            if (ngoCards.length > 0) {
                ngoCards.forEach(card => {
                    const text = card.innerText.toLowerCase();
                    if (text.includes(query)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            const guideArticles = document.querySelectorAll('.guide-article');
            if (guideArticles.length > 0) {
                guideArticles.forEach(article => {
                    const text = article.innerText.toLowerCase();
                    if (text.includes(query)) {
                        article.style.display = 'block';
                    } else {
                        article.style.display = 'none';
                    }
                });
            }
        });
    }

    // 3. Interactive Fraud & Coercion Risk Meter
    const fraudCheckboxes = document.querySelectorAll('.fraud-check-input');
    const riskBox = document.getElementById('risk-result-box');
    const riskTitle = document.getElementById('risk-title');
    const riskAdvice = document.getElementById('risk-advice');

    if (fraudCheckboxes.length > 0 && riskBox) {
        fraudCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateRiskScore);
        });

        function updateRiskScore() {
            let checkedCount = 0;
            let criticalCount = 0;

            fraudCheckboxes.forEach(cb => {
                if (cb.checked) {
                    checkedCount++;
                    if (cb.getAttribute('data-risk') === 'CRITICAL') {
                        criticalCount++;
                    }
                }
            });

            if (checkedCount === 0) {
                riskBox.style.display = 'none';
                return;
            }

            riskBox.style.display = 'block';

            const isUrdu = document.documentElement.getAttribute('dir') === 'rtl';

            if (criticalCount > 0 || checkedCount >= 2) {
                riskBox.className = 'risk-result-box critical';
                if (isUrdu) {
                    riskTitle.innerHTML = '⚠️ انتہائی شدید خطرہ (Critical Fraud Risk) - کالعدم دستاویز';
                    riskAdvice.innerHTML = 'سپریم کورٹ آف پاکستان (2016 SCMR 1225 - پھول پیر شاہ بنام حفیظ فاطمہ) کے تحت یہ شرائط شروع ہی سے باطل اور کالعدم ہیں۔ کسی بھی اسٹامپ پیپر یا بیانِ حلفی پر دستخط نہ کریں، اور فوری طور پر فری لیگل ایڈ ہیلپ لائن <strong>1099</strong> یا فوسپاہ (FOSPAH) <strong>1055</strong> پر کال کریں۔';
                } else {
                    riskTitle.innerHTML = '⚠️ CRITICAL FRAUD RISK - Void Ab Initio Clause Detected';
                    riskAdvice.innerHTML = 'Under Supreme Court Precedent (2016 SCMR 1225 - Phool Peer Shah v. Hafeez Fatima), uncompensated surrender or stealth power of attorney is legally void. Do NOT sign any paper. Contact the Free Legal Helpline <strong>1099</strong> or FOSPAH <strong>1055</strong> immediately.';
                }
            } else {
                riskBox.className = 'risk-result-box critical';
                if (isUrdu) {
                    riskTitle.innerHTML = '⚠️ درمیانہ تا ہائی رسک (High Risk Clause)';
                    riskAdvice.innerHTML = 'یہ شق وراثتی حق سے دستبردار کروانے کے لیے استعمال ہو سکتی ہے۔ آزادانہ وکیل سے تصدیق کروانا قانونی طور پر لازم ہے۔';
                } else {
                    riskTitle.innerHTML = '⚠️ High Risk Warning - Independent Review Required';
                    riskAdvice.innerHTML = 'This clause poses serious risks to inheritance entitlement. Consult an independent legal counsel before signing.';
                }
            }
        }
    }

    // 4. Initialize AOS (Animate on Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 40
        });
    }

    // 5. Initialize VanillaTilt (3D Tactile Hover)
    if (typeof VanillaTilt !== 'undefined') {
        VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
            max: 8,
            speed: 400,
            glare: true,
            "max-glare": 0.12,
            scale: 1.02
        });
    }

    // 6. Floating Emergency Quick-Action Speed Dial & Back to Top
    const floatingWidget = document.getElementById('floatingWidget');
    const speedDialToggle = document.getElementById('speedDialToggle');
    const backToTopBtn = document.getElementById('backToTopBtn');

    if (speedDialToggle && floatingWidget) {
        speedDialToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            floatingWidget.classList.toggle('active');
        });

        document.addEventListener('click', function (e) {
            if (!floatingWidget.contains(e.target)) {
                floatingWidget.classList.remove('active');
            }
        });
    }

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // 7. Animated Number Counters
    const counters = document.querySelectorAll('.stat-number-animated');
    if (counters.length > 0 && 'IntersectionObserver' in window) {
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const targetVal = parseInt(el.getAttribute('data-target'), 10) || 0;
                    const suffix = el.getAttribute('data-suffix') || '';
                    const duration = 1200;
                    const startTime = performance.now();

                    function step(now) {
                        const progress = Math.min((now - startTime) / duration, 1);
                        const current = Math.floor(progress * targetVal);
                        el.textContent = current + suffix;
                        if (progress < 1) {
                            requestAnimationFrame(step);
                        } else {
                            el.textContent = targetVal + suffix;
                        }
                    }
                    requestAnimationFrame(step);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(c => counterObserver.observe(c));
    }

    // 8. Interactive Form Submission with Confetti & SweetAlert2
    const inquiryForm = document.getElementById('inquiryForm');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', function (e) {
            // Check HTML5 validity
            if (!inquiryForm.checkValidity()) {
                return;
            }
            // Trigger Confetti Celebration
            if (typeof confetti === 'function') {
                confetti({
                    particleCount: 80,
                    spread: 70,
                    origin: { y: 0.6 }
                });
            }
        });
    }
});
