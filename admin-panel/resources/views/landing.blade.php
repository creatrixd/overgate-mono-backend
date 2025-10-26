<div>
    <style>
    /* ========================================
   Глобальные стили и переменные
   ======================================== */
:root {
    --primary-color: #4F46E5;
    --primary-dark: #4338CA;
    --primary-light: #818CF8;
    --secondary-color: #06B6D4;
    --accent-color: #F59E0B;
    --success-color: #10B981;
    --danger-color: #EF4444;
    
    --text-primary: #1F2937;
    --text-secondary: #6B7280;
    --text-light: #9CA3AF;
    
    --bg-primary: #FFFFFF;
    --bg-secondary: #F9FAFB;
    --bg-dark: #111827;
    --bg-darker: #0F172A;
    
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --gradient-hero: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    
    --border-radius: 12px;
    --border-radius-lg: 20px;
    
    --transition: all 0.3s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: var(--text-primary);
    background-color: var(--bg-primary);
    line-height: 1.6;
    overflow-x: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ========================================
   Навигация
   ======================================== */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-sm);
    z-index: 1000;
    transition: var(--transition);
}

.navbar.scrolled {
    box-shadow: var(--shadow-md);
}

.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

.logo i {
    font-size: 1.75rem;
}

.nav-menu {
    display: flex;
    list-style: none;
    gap: 2rem;
    align-items: center;
}

.nav-link {
    text-decoration: none;
    color: var(--text-primary);
    font-weight: 500;
    transition: var(--transition);
    padding: 0.5rem 0;
}

.nav-link:hover {
    color: var(--primary-color);
}

.mobile-menu-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--text-primary);
    cursor: pointer;
}

/* Мобильное меню */
.mobile-menu {
    position: fixed;
    top: 0;
    right: -100%;
    width: 100%;
    max-width: 350px;
    height: 100vh;
    background: var(--bg-primary);
    box-shadow: var(--shadow-xl);
    z-index: 2000;
    transition: right 0.3s ease;
}

.mobile-menu.active {
    right: 0;
}

.mobile-menu-content {
    padding: 2rem;
}

.mobile-menu-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--text-primary);
    cursor: pointer;
    margin-bottom: 2rem;
}

.mobile-nav-links {
    list-style: none;
}

.mobile-nav-link {
    display: block;
    padding: 1rem 0;
    text-decoration: none;
    color: var(--text-primary);
    font-weight: 500;
    font-size: 1.1rem;
    border-bottom: 1px solid var(--bg-secondary);
    transition: var(--transition);
}

.mobile-nav-link:hover {
    color: var(--primary-color);
    padding-left: 0.5rem;
}

/* ========================================
   Кнопки
   ======================================== */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    font-family: inherit;
    font-size: 1rem;
}

.btn-primary {
    background: var(--gradient-primary);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-secondary {
    background: rgba(79, 70, 229, 0.1);
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.btn-secondary:hover {
    background: var(--primary-color);
    color: white;
}

.btn-large {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

.btn-full {
    width: 100%;
    justify-content: center;
}

/* ========================================
   Hero секция
   ======================================== */
.hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 8rem 0 4rem;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--gradient-hero);
    opacity: 0.05;
    z-index: -1;
}

.hero-background::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(102, 126, 234, 0.2) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 20s ease-in-out infinite;
}

.hero-background::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(118, 75, 162, 0.2) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 15s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) translateX(0);
    }
    50% {
        transform: translateY(-50px) translateX(30px);
    }
}

.hero-content {
    text-align: center;
    max-width: 900px;
    margin: 0 auto;
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    color: var(--text-primary);
}

.gradient-text {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.5rem;
    color: var(--text-secondary);
    margin-bottom: 2.5rem;
    line-height: 1.6;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 4rem;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
    padding: 2rem 0;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-top: 0.5rem;
}

.hero-scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
}

.hero-scroll-indicator a {
    display: inline-block;
    color: var(--primary-color);
    font-size: 2rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

/* ========================================
   Секции
   ======================================== */
.section {
    padding: 6rem 0;
}

.section-dark {
    background: linear-gradient(180deg, var(--bg-darker) 0%, var(--bg-dark) 100%);
    color: white;
}

.section-dark .section-title,
.section-dark .section-subtitle {
    color: white;
}

.section-header {
    text-align: center;
    max-width: 800px;
    margin: 0 auto 4rem;
}

.section-title {
    font-size: 2.75rem;
    font-weight: 800;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.25rem;
    color: var(--text-secondary);
    line-height: 1.6;
}

/* ========================================
   Workflow секция
   ======================================== */
.workflow {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex-wrap: wrap;
    justify-content: center;
}

.workflow-step {
    flex: 1;
    min-width: 250px;
    max-width: 280px;
    background: var(--bg-secondary);
    padding: 2rem;
    border-radius: var(--border-radius-lg);
    text-align: center;
    transition: var(--transition);
    position: relative;
}

.workflow-step:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.step-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
}

.step-number {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary-light);
    opacity: 0.3;
}

.step-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.step-description {
    font-size: 0.95rem;
    color: var(--text-secondary);
    line-height: 1.6;
}

.workflow-arrow {
    font-size: 2rem;
    color: var(--primary-color);
}

/* ========================================
   Benefits секция
   ======================================== */
.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
}

.benefit-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    padding: 2.5rem;
    border-radius: var(--border-radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
}

.benefit-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.2);
}

.benefit-icon {
    width: 70px;
    height: 70px;
    background: var(--gradient-primary);
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: 1.5rem;
}

.benefit-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
}

.benefit-description {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.7;
}

/* ========================================
   Technology секция
   ======================================== */
.technology-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.tech-card {
    background: var(--bg-secondary);
    padding: 2.5rem;
    border-radius: var(--border-radius-lg);
    border: 2px solid transparent;
    transition: var(--transition);
}

.tech-card:hover {
    border-color: var(--primary-color);
    box-shadow: var(--shadow-xl);
    transform: translateY(-5px);
}

.tech-icon {
    width: 70px;
    height: 70px;
    background: var(--gradient-primary);
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: 1.5rem;
}

.tech-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.tech-description {
    font-size: 1rem;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: 1.5rem;
}

.tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag {
    padding: 0.4rem 0.8rem;
    background: rgba(79, 70, 229, 0.1);
    color: var(--primary-color);
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* ========================================
   Cases секция
   ======================================== */
.cases-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.case-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    padding: 2.5rem;
    border-radius: var(--border-radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: var(--transition);
}

.case-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.08);
}

.case-image {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    margin-bottom: 1.5rem;
}

.case-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
}

.case-description {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.7;
    margin-bottom: 1.5rem;
}

.case-features {
    list-style: none;
}

.case-features li {
    padding: 0.5rem 0;
    color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.case-features i {
    color: var(--success-color);
    font-size: 1.1rem;
}

/* ========================================
   Contact секция
   ======================================== */
.contact-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: start;
}

.contact-info {
    position: sticky;
    top: 100px;
}

.contact-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
}

.contact-subtitle {
    font-size: 1.15rem;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: 2rem;
}

.contact-features {
    margin-bottom: 2rem;
}

.contact-feature {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem 0;
    font-size: 1rem;
    font-weight: 500;
}

.contact-feature i {
    color: var(--success-color);
    font-size: 1.25rem;
}

.contact-methods {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 2rem;
}

.contact-method {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius);
}

.contact-method i {
    font-size: 1.5rem;
    color: var(--primary-color);
}

.method-label {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.method-value {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.contact-form-wrapper {
    background: var(--bg-secondary);
    padding: 3rem;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-lg);
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.95rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.875rem 1rem;
    border: 2px solid #E5E7EB;
    border-radius: var(--border-radius);
    font-family: inherit;
    font-size: 1rem;
    transition: var(--transition);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

/* ========================================
   Footer
   ======================================== */
.footer {
    background: var(--bg-darker);
    color: white;
    padding: 4rem 0 2rem;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 3rem;
    margin-bottom: 3rem;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.footer-logo i {
    font-size: 1.75rem;
    color: var(--primary-light);
}

.footer-description {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.7;
    margin-bottom: 1.5rem;
}

.footer-social {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: var(--transition);
}

.social-link:hover {
    background: var(--primary-color);
    transform: translateY(-3px);
}

.footer-heading {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.footer-links {
    list-style: none;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: var(--transition);
}

.footer-links a:hover {
    color: white;
    padding-left: 5px;
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.footer-bottom p {
    color: rgba(255, 255, 255, 0.6);
}

.footer-legal {
    display: flex;
    gap: 2rem;
}

.footer-legal a {
    color: rgba(255, 255, 255, 0.6);
    text-decoration: none;
    transition: var(--transition);
}

.footer-legal a:hover {
    color: white;
}

/* ========================================
   Адаптивность
   ======================================== */
@media (max-width: 1024px) {
    .hero-title {
        font-size: 3rem;
    }
    
    .hero-subtitle {
        font-size: 1.25rem;
    }
    
    .contact-wrapper {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .contact-info {
        position: static;
    }
    
    .footer-content {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 768px) {
    .nav-menu {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: block;
    }
    
    .hero {
        padding: 6rem 0 3rem;
        min-height: auto;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .hero-stats {
        gap: 2rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .section {
        padding: 4rem 0;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .section-subtitle {
        font-size: 1.1rem;
    }
    
    .workflow {
        flex-direction: column;
    }
    
    .workflow-arrow {
        transform: rotate(90deg);
        font-size: 1.5rem;
    }
    
    .contact-form-wrapper {
        padding: 2rem;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 1.75rem;
    }
    
    .btn-large {
        padding: 0.875rem 1.5rem;
        font-size: 1rem;
    }
    
    .benefits-grid,
    .technology-grid,
    .cases-grid {
        grid-template-columns: 1fr;
    }
    
    .contact-form-wrapper {
        padding: 1.5rem;
    }
}
    </style>
    <!-- Навигация -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <i class="fas fa-shield-alt"></i>
                    <span>Умный КПП</span>
                </div>
                <ul class="nav-menu">
                    <li><a href="#hero" class="nav-link">Главная</a></li>
                    <li><a href="#how-it-works" class="nav-link">Как работает</a></li>
                    <li><a href="#benefits" class="nav-link">Преимущества</a></li>
                    <li><a href="#technology" class="nav-link">Технологии</a></li>
                    <li><a href="#cases" class="nav-link">Применение</a></li>
                    <li><a style="padding: 10px; border-radius: 10px;" href="#contact" class="nav-link btn-primary">Связаться</a></li>
                </ul>
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Мобильное меню -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-content">
            <button class="mobile-menu-close" id="mobileMenuClose">
                <i class="fas fa-times"></i>
            </button>
            <ul class="mobile-nav-links">
                <li><a href="#hero" class="mobile-nav-link">Главная</a></li>
                <li><a href="#how-it-works" class="mobile-nav-link">Как работает</a></li>
                <li><a href="#benefits" class="mobile-nav-link">Преимущества</a></li>
                <li><a href="#technology" class="mobile-nav-link">Технологии</a></li>
                <li><a href="#cases" class="mobile-nav-link">Применение</a></li>
                <li><a href="#contact" class="mobile-nav-link">Связаться</a></li>
            </ul>
        </div>
    </div>

    <!-- Главный экран -->
    <section id="hero" class="hero">
        <div class="hero-background"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Умный КПП
                    <span class="gradient-text">нового поколения</span>
                </h1>
                <p class="hero-subtitle">
                    Автоматическая система контроля доступа на основе компьютерного зрения. 
                    Распознавание лиц и автомобильных номеров без участия человека.
                </p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-primary btn-large">
                        <i class="fas fa-rocket"></i>
                        Начать использовать
                    </a>
                    <a href="#how-it-works" class="btn btn-secondary btn-large">
                        <i class="fas fa-play-circle"></i>
                        Как это работает
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">97%</div>
                        <div class="stat-label">Точность распознавания</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">&lt;2 сек</div>
                        <div class="stat-label">Время обработки</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Работа без остановок</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator">
            <a href="#how-it-works">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>

    <!-- Как это работает -->
    <section id="how-it-works" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Как работает система</h2>
                <p class="section-subtitle">Простой и прозрачный процесс от регистрации до автоматического пропуска</p>
            </div>
            <div class="workflow">
                <div class="workflow-step">
                    <div class="step-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="step-number">01</div>
                    <h3 class="step-title">Регистрация в приложении</h3>
                    <p class="step-description">
                        Клиент загружает мобильное приложение и проходит быструю регистрацию: 
                        делает фото лица, фотографирует автомобиль и его номер.
                    </p>
                </div>
                <div class="workflow-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
                <div class="workflow-step">
                    <div class="step-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="step-number">02</div>
                    <h3 class="step-title">Загрузка в базу данных</h3>
                    <p class="step-description">
                        Данные шифруются и безопасно передаются в облачную базу данных. 
                        Система обрабатывает и сохраняет информацию для быстрого доступа.
                    </p>
                </div>
                <div class="workflow-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
                <div class="workflow-step">
                    <div class="step-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="step-number">03</div>
                    <h3 class="step-title">Распознавание на КПП</h3>
                    <p class="step-description">
                        При подъезде к КПП камеры автоматически сканируют номер и лицо водителя. 
                        Компьютерное зрение сравнивает данные с базой в режиме реального времени.
                    </p>
                </div>
                <div class="workflow-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>
                <div class="workflow-step">
                    <div class="step-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="step-number">04</div>
                    <h3 class="step-title">Автоматический пропуск</h3>
                    <p class="step-description">
                        При успешной верификации шлагбаум открывается автоматически. 
                        Весь процесс занимает менее 2 секунд без остановки автомобиля.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Преимущества -->
    <section id="benefits" class="section section-dark">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Ключевые преимущества</h2>
                <p class="section-subtitle">Почему наша система превосходит традиционные методы контроля доступа</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3 class="benefit-title">Высокая скорость</h3>
                    <p class="benefit-description">
                        Обработка за 1-2 секунды. Автомобили проезжают без остановки, 
                        что исключает очереди и пробки на въезде.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="benefit-title">Максимальная безопасность</h3>
                    <p class="benefit-description">
                        Двойная верификация: лицо + номер автомобиля. 
                        Шифрование данных и защита от подделок.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-user-slash"></i>
                    </div>
                    <h3 class="benefit-title">Без охранников</h3>
                    <p class="benefit-description">
                        Полная автоматизация процесса исключает человеческий фактор 
                        и снижает операционные расходы до 70%.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="benefit-title">Умная аналитика</h3>
                    <p class="benefit-description">
                        Статистика въездов/выездов, отчеты, выявление подозрительной активности 
                        и прогнозирование нагрузки.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="benefit-title">Простая регистрация</h3>
                    <p class="benefit-description">
                        Интуитивное мобильное приложение. Регистрация занимает 
                        всего 2-3 минуты без очередей и документов.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="benefit-title">Работа 24/7</h3>
                    <p class="benefit-description">
                        Система работает круглосуточно в любую погоду. 
                        Инфракрасные камеры обеспечивают работу в темноте.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Технологии -->
    <section id="technology" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Передовые технологии</h2>
                <p class="section-subtitle">Современный стек технологий для надежной и быстрой работы</p>
            </div>
            <div class="technology-grid">
                <div class="tech-card">
                    <div class="tech-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="tech-title">Компьютерное зрение</h3>
                    <p class="tech-description">
                        AI-алгоритмы для распознавания лиц и номерных знаков с точностью 99%. 
                        Работает в любых условиях освещения и погоды.
                    </p>
                    <div class="tech-tags">
                        <span class="tag">Deep Learning</span>
                        <span class="tag">OpenCV</span>
                        <span class="tag">TensorFlow</span>
                    </div>
                </div>
                <div class="tech-card">
                    <div class="tech-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="tech-title">Облачная база данных</h3>
                    <p class="tech-description">
                        Высокоскоростное хранилище с мгновенным доступом к данным. 
                        Автоматическое резервное копирование и масштабирование.
                    </p>
                    <div class="tech-tags">
                        <span class="tag">Cloud Storage</span>
                        <span class="tag">Encryption</span>
                        <span class="tag">99.9% Uptime</span>
                    </div>
                </div>
                <div class="tech-card">
                    <div class="tech-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="tech-title">Мобильное приложение</h3>
                    <p class="tech-description">
                        Кроссплатформенное приложение для iOS и Android. 
                        Простой интерфейс, быстрая регистрация и управление доступом.
                    </p>
                    <div class="tech-tags">
                        <span class="tag">iOS</span>
                        <span class="tag">Android</span>
                    </div>
                </div>
                <div class="tech-card">
                    <div class="tech-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="tech-title">Защита данных</h3>
                    <p class="tech-description">
                        Шифрование по стандарту AES-256. GDPR-совместимость. 
                        Многоуровневая система защиты от взлома и утечек.
                    </p>
                    <div class="tech-tags">
                        <span class="tag">AES-256</span>
                        <span class="tag">GDPR</span>
                        <span class="tag">SSL/TLS</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Применение -->
    <section id="cases" class="section section-dark">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Примеры применения</h2>
                <p class="section-subtitle">Универсальное решение для различных типов объектов</p>
            </div>
            <div class="cases-grid">
                <div class="case-card">
                    <div class="case-image">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="case-title">Жилые комплексы</h3>
                    <p class="case-description">
                        Контроль доступа жителей и их гостей. Автоматическое открытие шлагбаума 
                        для зарегистрированных резидентов. Временные пропуски для посетителей.
                    </p>
                    <ul class="case-features">
                        <li><i class="fas fa-check"></i> Учет жильцов и гостей</li>
                        <li><i class="fas fa-check"></i> Временные пропуска</li>
                        <li><i class="fas fa-check"></i> История въездов/выездов</li>
                    </ul>
                </div>
                <div class="case-card">
                    <div class="case-image">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="case-title">Бизнес-центры</h3>
                    <p class="case-description">
                        Многоуровневый доступ для сотрудников разных компаний. 
                        Интеграция с системами учета рабочего времени и пропускными системами.
                    </p>
                    <ul class="case-features">
                        <li><i class="fas fa-check"></i> Разграничение прав доступа</li>
                        <li><i class="fas fa-check"></i> Учет рабочего времени</li>
                        <li><i class="fas fa-check"></i> Отчетность для арендаторов</li>
                    </ul>
                </div>
                <div class="case-card">
                    <div class="case-image">
                        <i class="fas fa-parking"></i>
                    </div>
                    <h3 class="case-title">Парковки</h3>
                    <p class="case-description">
                        Автоматизация платных и закрытых парковок. Распознавание номеров 
                        для абонентов. Интеграция с системами оплаты.
                    </p>
                    <ul class="case-features">
                        <li><i class="fas fa-check"></i> Абонементное обслуживание</li>
                        <li><i class="fas fa-check"></i> Учет свободных мест</li>
                        <li><i class="fas fa-check"></i> Интеграция с оплатой</li>
                    </ul>
                </div>
                <div class="case-card">
                    <div class="case-image">
                        <i class="fas fa-industry"></i>
                    </div>
                    <h3 class="case-title">Производственные объекты</h3>
                    <p class="case-description">
                        Строгий контроль доступа на территорию предприятия. 
                        Учет транспорта поставщиков. Безопасность периметра.
                    </p>
                    <ul class="case-features">
                        <li><i class="fas fa-check"></i> Строгая верификация</li>
                        <li><i class="fas fa-check"></i> Учет поставщиков</li>
                        <li><i class="fas fa-check"></i> Контроль периметра</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Форма контакта -->
    <section id="contact" class="section">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h2 class="contact-title">Готовы начать?</h2>
                    <p class="contact-subtitle">
                        Оставьте заявку, и наш специалист свяжется с вами для обсуждения 
                        внедрения системы на вашем объекте.
                    </p>
                    <div class="contact-features">
                        <div class="contact-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Бесплатная консультация</span>
                        </div>
                        <div class="contact-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Расчет стоимости за 24 часа</span>
                        </div>
                        <div class="contact-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Демонстрация системы</span>
                        </div>
                        <div class="contact-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Пилотный проект</span>
                        </div>
                    </div>
                    <div class="contact-methods">
                        <div class="contact-method">
                            <i class="fas fa-phone"></i>
                            <div>
                                <div class="method-label">Телефон</div>
                                <div class="method-value">+7 (927) 226-97-40</div>
                            </div>
                        </div>
                        <div class="contact-method">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <div class="method-label">Email</div>
                                <div class="method-value">corp@gipno.tech</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form-wrapper">
                    <form class="contact-form" id="contactForm">
                        <div class="form-group">
                            <label for="name">Ваше имя</label>
                            <input type="text" id="name" name="name" required placeholder="Иван Иванов">
                        </div>
                        <div class="form-group">
                            <label for="company">Компания</label>
                            <input type="text" id="company" name="company" placeholder="ООО 'Название'">
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" id="phone" name="phone" required placeholder="+7 (___) ___-__-__">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label for="objectType">Тип объекта</label>
                            <select id="objectType" name="objectType" required>
                                <option value="">Выберите тип объекта</option>
                                <option value="residential">Жилой комплекс</option>
                                <option value="business">Бизнес-центр</option>
                                <option value="parking">Парковка</option>
                                <option value="industrial">Производство</option>
                                <option value="other">Другое</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Сообщение</label>
                            <textarea id="message" name="message" rows="4" placeholder="Расскажите о вашем проекте..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-large btn-full">
                            <i class="fas fa-paper-plane"></i>
                            Отправить заявку
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <div class="footer-logo">
                        <i class="fas fa-shield-alt"></i>
                        <span>Умный КПП</span>
                    </div>
                    <p class="footer-description">
                        Современная система контроля доступа на основе компьютерного зрения 
                        и искусственного интеллекта.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-link"><i class="fab fa-telegram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h4 class="footer-heading">Продукт</h4>
                    <ul class="footer-links">
                        <li><a href="#how-it-works">Как работает</a></li>
                        <li><a href="#benefits">Преимущества</a></li>
                        <li><a href="#technology">Технологии</a></li>
                        <li><a href="#cases">Применение</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4 class="footer-heading">Компания</h4>
                    <ul class="footer-links">
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Команда</a></li>
                        <li><a href="#">Карьера</a></li>
                        <li><a href="#">Пресс-центр</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4 class="footer-heading">Поддержка</h4>
                    <ul class="footer-links">
                        <li><a href="#">Документация</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#contact">Контакты</a></li>
                        <li><a href="#">Техподдержка</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Умный КПП. Все права защищены.</p>
                <div class="footer-legal">
                    <a href="#">Политика конфиденциальности</a>
                    <a href="#">Условия использования</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
    // ========================================
// Навигация и мобильное меню
// ========================================

// Получаем элементы
const navbar = document.querySelector('.navbar');
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const mobileMenu = document.getElementById('mobileMenu');
const mobileMenuClose = document.getElementById('mobileMenuClose');
const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
const navLinks = document.querySelectorAll('.nav-link');

// Скролл навигации
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Открытие мобильного меню
mobileMenuToggle.addEventListener('click', () => {
    mobileMenu.classList.add('active');
    document.body.style.overflow = 'hidden';
});

// Закрытие мобильного меню
mobileMenuClose.addEventListener('click', () => {
    mobileMenu.classList.remove('active');
    document.body.style.overflow = '';
});

// Закрытие меню при клике на ссылку
mobileNavLinks.forEach(link => {
    link.addEventListener('click', () => {
        mobileMenu.classList.remove('active');
        document.body.style.overflow = '';
    });
});

// Закрытие меню при клике вне его
mobileMenu.addEventListener('click', (e) => {
    if (e.target === mobileMenu) {
        mobileMenu.classList.remove('active');
        document.body.style.overflow = '';
    }
});

// ========================================
// Плавная прокрутка
// ========================================

// Плавная прокрутка для всех навигационных ссылок
const allNavLinks = [...navLinks, ...mobileNavLinks];

allNavLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        const href = link.getAttribute('href');
        
        // Проверяем, является ли это якорной ссылкой
        if (href.startsWith('#')) {
            e.preventDefault();
            
            const targetId = href.substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 80; // Учитываем высоту навигации
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        }
    });
});

// ========================================
// Активная ссылка в навигации
// ========================================

function setActiveNavLink() {
    const sections = document.querySelectorAll('section[id]');
    const scrollPosition = window.scrollY + 100;

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        const sectionId = section.getAttribute('id');

        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            // Удаляем активный класс у всех ссылок
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${sectionId}`) {
                    link.classList.add('active');
                }
            });
        }
    });
}

window.addEventListener('scroll', setActiveNavLink);

// ========================================
// Форма контакта
// ========================================

const contactForm = document.getElementById('contactForm');

contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Получаем данные формы
    const formData = {
        name: document.getElementById('name').value,
        company: document.getElementById('company').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('email').value,
        objectType: document.getElementById('objectType').value,
        message: document.getElementById('message').value,
        submittedAt: new Date().toISOString()
    };
    
    // Получаем кнопку отправки
    const submitButton = contactForm.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    
    // Блокируем кнопку и меняем текст
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Отправка...';
    
    try {
        // Здесь можно добавить отправку данных на сервер
        // Например: await fetch('/api/contact', { method: 'POST', body: JSON.stringify(formData) });
        
        // Симуляция отправки (удалить в production)
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        // Сохраняем в localStorage для демонстрации
        const submissions = JSON.parse(localStorage.getItem('contactSubmissions') || '[]');
        submissions.push(formData);
        localStorage.setItem('contactSubmissions', JSON.stringify(submissions));
        
        // Показываем сообщение об успехе
        showNotification('Спасибо за заявку! Мы свяжемся с вами в ближайшее время.', 'success');
        
        // Очищаем форму
        contactForm.reset();
        
    } catch (error) {
        console.error('Ошибка отправки формы:', error);
        showNotification('Произошла ошибка при отправке. Попробуйте позже.', 'error');
    } finally {
        // Восстанавливаем кнопку
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
    }
});

// ========================================
// Уведомления
// ========================================

function showNotification(message, type = 'success') {
    // Создаем элемент уведомления
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        <span>${message}</span>
    `;
    
    // Добавляем стили для уведомления
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${type === 'success' ? '#10B981' : '#EF4444'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
        z-index: 10000;
        animation: slideIn 0.3s ease;
        max-width: 400px;
    `;
    
    // Добавляем на страницу
    document.body.appendChild(notification);
    
    // Удаляем через 5 секунд
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
}

// Добавляем CSS анимации для уведомлений
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// ========================================
// Анимация при прокрутке (Intersection Observer)
// ========================================

const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Элементы для анимации
const animatedElements = document.querySelectorAll(`
    .workflow-step,
    .benefit-card,
    .tech-card,
    .case-card,
    .contact-wrapper > *
`);

// Устанавливаем начальные стили
animatedElements.forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// ========================================
// Маска для телефонного номера
// ========================================

const phoneInput = document.getElementById('phone');

phoneInput.addEventListener('input', (e) => {
    let value = e.target.value.replace(/\D/g, '');
    
    // Ограничиваем до 11 цифр
    if (value.length > 11) {
        value = value.substring(0, 11);
    }
    
    // Форматируем номер
    let formattedValue = '';
    
    if (value.length > 0) {
        formattedValue = '+7';
        
        if (value.length > 1) {
            formattedValue += ' (' + value.substring(1, 4);
        }
        
        if (value.length >= 5) {
            formattedValue += ') ' + value.substring(4, 7);
        }
        
        if (value.length >= 8) {
            formattedValue += '-' + value.substring(7, 9);
        }
        
        if (value.length >= 10) {
            formattedValue += '-' + value.substring(9, 11);
        }
    }
    
    e.target.value = formattedValue;
});

// Устанавливаем начальное значение
phoneInput.addEventListener('focus', (e) => {
    if (!e.target.value) {
        e.target.value = '+7 ';
    }
});

phoneInput.addEventListener('blur', (e) => {
    if (e.target.value === '+7 ') {
        e.target.value = '';
    }
});

// ========================================
// Счетчики статистики (анимированные)
// ========================================

function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16); // 60 FPS
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

// Запускаем анимацию счетчиков при входе в viewport
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const statNumbers = entry.target.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const text = stat.textContent;
                // Извлекаем числа из текста, если они есть
                const match = text.match(/\d+/);
                if (match) {
                    const number = parseInt(match[0]);
                    // Временно очищаем
                    const originalText = stat.textContent;
                    stat.textContent = '0';
                    // Анимируем
                    setTimeout(() => {
                        stat.textContent = originalText;
                    }, 500);
                }
            });
            statsObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

const heroStats = document.querySelector('.hero-stats');
if (heroStats) {
    statsObserver.observe(heroStats);
}

// ========================================
// Preloader (опционально)
// ========================================

window.addEventListener('load', () => {
    document.body.classList.add('loaded');
    
    // Скрываем прелоадер, если он есть
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 300);
    }
});

// ========================================
// Отслеживание взаимодействий (аналитика)
// ========================================

// Клики по кнопкам CTA
document.querySelectorAll('.btn-primary, .btn-secondary').forEach(button => {
    button.addEventListener('click', (e) => {
        const buttonText = e.target.textContent.trim();
        console.log('CTA Button Clicked:', buttonText);
        
        // Здесь можно добавить отправку события в аналитику
        // Например: gtag('event', 'click', { button_text: buttonText });
    });
});

// Время на странице
let timeOnPage = 0;
setInterval(() => {
    timeOnPage += 1;
    // Каждые 30 секунд можно отправлять данные
    if (timeOnPage % 30 === 0) {
        console.log('Time on page:', timeOnPage, 'seconds');
    }
}, 1000);

// ========================================
// Эффект параллакса для hero секции
// ========================================

window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroContent = document.querySelector('.hero-content');
    
    if (heroContent && scrolled < window.innerHeight) {
        heroContent.style.transform = `translateY(${scrolled * 0.3}px)`;
        heroContent.style.opacity = 1 - (scrolled / window.innerHeight);
    }
});

console.log('🚀 Умный КПП - система загружена и готова к работе!');
    </script>
</div>
