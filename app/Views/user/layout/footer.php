<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-logo">KONSERKU<span>.</span></div>
                <p class="footer-desc">
                    Platform ticketing konser nomor #1 di Indonesia yang memberikan pengalaman booking tercepat, aman, dan tanpa hambatan untuk event musik impianmu.
                </p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-links">
                <h4>Discovery</h4>
                <ul>
                    <li><a href="#">Semua Konser</a></li>
                    <li><a href="#">Festival Musik</a></li>
                    <li><a href="#">Venue Terpopuler</a></li>
                    <li><a href="#">Artis Lineup</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Pusat Bantuan</a></li>
                    <li><a href="#">Kebijakan Refund</a></li>
                    <li><a href="#">Panduan Pembayaran</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>

            <div class="footer-newsletter">
                <h4>Newsletter</h4>
                <p>Dapatkan info presale dan kode promo konser langsung di email lu.</p>
                <div class="newsletter-form">
                    <input type="email" placeholder="Email lu di sini...">
                    <button type="button"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="footer-bottom">
            <p>© <?= date('Y') ?> <span>KONSERKU</span>. All rights reserved.</p>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* CSS UNTUK FOOTER PREMIUM */
    :root {
        --f-bg: #030712;
        --f-text: rgba(255, 255, 255, 0.5);
        --f-primary: #8b5cf6;
        --f-accent: #00f2fe;
        --f-border: rgba(255, 255, 255, 0.05);
    }

    .footer {
        background-color: var(--f-bg);
        border-top: 1px solid var(--f-border);
        padding: 80px 0 40px;
        position: relative;
        z-index: 10;
        color: white;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 40px;
        margin-bottom: 50px;
    }

    /* Brand Style */
    .footer-logo {
        font-size: 28px;
        font-weight: 900;
        letter-spacing: -1px;
        background: linear-gradient(to right, #fff, var(--f-primary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }
    .footer-logo span { color: var(--f-accent); }

    .footer-desc {
        color: var(--f-text);
        line-height: 1.6;
        font-size: 0.95rem;
        margin-bottom: 25px;
    }

    /* Social Icons */
    .social-links { display: flex; gap: 15px; }
    .social-icon {
        width: 40px; height: 40px;
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--f-border);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: white; text-decoration: none;
        transition: 0.3s;
    }
    .social-icon:hover {
        background: var(--f-primary);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3);
    }

    /* Links Style */
    .footer-links h4, .footer-newsletter h4 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .footer-links ul { list-style: none; padding: 0; }
    .footer-links ul li { margin-bottom: 12px; }
    .footer-links ul li a {
        color: var(--f-text);
        text-decoration: none;
        font-size: 0.95rem;
        transition: 0.3s;
    }
    .footer-links ul li a:hover {
        color: var(--f-accent);
        padding-left: 8px;
    }

    /* Newsletter Style */
    .footer-newsletter p { color: var(--f-text); font-size: 0.9rem; margin-bottom: 20px; }
    .newsletter-form {
        display: flex;
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--f-border);
        padding: 5px;
        border-radius: 15px;
    }
    .newsletter-form input {
        flex: 1;
        background: transparent;
        border: none;
        padding: 12px 15px;
        color: white;
        outline: none;
    }
    .newsletter-form button {
        background: var(--f-primary);
        color: white;
        border: none;
        width: 45px; height: 45px;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.3s;
    }
    .newsletter-form button:hover { background: var(--f-accent); color: black; }

    /* Bottom Footer */
    .footer-divider { border: 0; border-top: 1px solid var(--f-border); margin: 40px 0; }
    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--f-text);
        font-size: 0.85rem;
    }
    .footer-bottom span { font-weight: 700; color: white; }
    .footer-legal a {
        color: var(--f-text);
        text-decoration: none;
        margin-left: 20px;
        transition: 0.3s;
    }
    .footer-legal a:hover { color: white; }

    /* Responsive */
    @media (max-width: 992px) {
        .footer-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 576px) {
        .footer-grid { grid-template-columns: 1fr; }
        .footer-bottom { flex-direction: column; gap: 20px; text-align: center; }
    }
</style>

</body>
</html>