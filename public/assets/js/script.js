document.addEventListener("DOMContentLoaded", function () {
    
    // --- 1. HERO SLIDER LOGIC (Auto Slide + Manual) ---
    let currentHeroIndex = 0;
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.h-dot');
    const slideInterval = 5000; 
    let autoSlideTimer;

    const header = document.getElementById('main-header');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            // Jika discroll lebih dari 50px, tambahkan class 'scrolled'
            header.classList.add('scrolled');
        } else {
            // Jika kembali ke atas, hapus class 'scrolled'
            header.classList.remove('scrolled');
        }
    });

    function showHeroSlide(index) {
        // Handle index looping
        if (index >= heroSlides.length) currentHeroIndex = 0;
        else if (index < 0) currentHeroIndex = heroSlides.length - 1;
        else currentHeroIndex = index;

        // Reset class active
        heroSlides.forEach(slide => slide.classList.remove('active'));
        heroDots.forEach(dot => dot.classList.remove('active'));

        // Set active baru
        heroSlides[currentHeroIndex].classList.add('active');
        heroDots[currentHeroIndex].classList.add('active');
    }

    // Expose function ke window agar bisa dipanggil onclick di HTML
    window.changeHeroSlide = function(n) {
        showHeroSlide(currentHeroIndex + n);
        resetAutoSlide();
    }

    window.setHeroSlide = function(n) {
        showHeroSlide(n);
        resetAutoSlide();
    }

    function startAutoSlide() {
        autoSlideTimer = setInterval(() => {
            showHeroSlide(currentHeroIndex + 1);
        }, slideInterval);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideTimer);
        startAutoSlide();
    }

    // Jalankan Hero Slider
    if(heroSlides.length > 0) startAutoSlide();


    // --- 2. INFINITE LOOP LOGIC FOR CARDS (Psychologist & Testimonials) ---
    
    /**
     * Fungsi Helper untuk membuat Slider Looping
     * @param {string} containerSelector - Selector untuk wadah scroll
     * @param {string} prevBtnSelector - Selector tombol kiri
     * @param {string} nextBtnSelector - Selector tombol kanan
     * @param {number} scrollAmount - Jarak scroll per klik (lebar kartu + gap)
     */
    function setupInfiniteScroll(containerSelector, prevBtnSelector, nextBtnSelector, scrollAmount) {
        const container = document.querySelector(containerSelector);
        const prevBtn = document.querySelector(prevBtnSelector);
        const nextBtn = document.querySelector(nextBtnSelector);

        if (!container || !prevBtn || !nextBtn) return;

        // Logic Tombol NEXT
        nextBtn.addEventListener('click', () => {
            // Hitung batas maksimal scroll kanan
            const maxScrollLeft = container.scrollWidth - container.clientWidth;
            
            // Jika posisi scroll sudah mendekati ujung kanan (toleransi 10px)
            if (container.scrollLeft >= maxScrollLeft - 10) {
                // LOOPING: Kembali ke awal (Kiri)
                container.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                // Scroll Biasa ke Kanan
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        });

        // Logic Tombol PREV
        prevBtn.addEventListener('click', () => {
            // Jika posisi scroll ada di awal (0 atau mendekati 0)
            if (container.scrollLeft <= 10) {
                // LOOPING: Lompat ke Akhir (Kanan)
                container.scrollTo({ left: container.scrollWidth, behavior: 'smooth' });
            } else {
                // Scroll Biasa ke Kiri
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            }
        });
    }

    // Terapkan Logic Infinite Loop ke Psikolog
    // Angka 320 adalah lebar kartu (300px) + gap/margin (20px)
    setupInfiniteScroll('.psy-slider-container', '.psy-prev', '.psy-next', 320);

    // Terapkan Logic Infinite Loop ke Testimoni
    // Angka 340 adalah lebar kartu estimasi + gap
    setupInfiniteScroll('.testi-container', '.testi-prev', '.testi-next', 340);

});