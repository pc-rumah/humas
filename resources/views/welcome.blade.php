<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Humas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Header -->
    @include('partwelcome.header')

    <!-- Hero Carousel Section -->
    <section class="hero-carousel">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Office Team Meeting">
                    <div class="slide-content">
                        <div class="container">
                            <h1>Professional Team Collaboration</h1>
                            <p>Experience seamless teamwork and efficient communication with our comprehensive public
                                relations services.</p>
                            <div class="slide-buttons">
                                <button class="btn btn-primary">Get Started</button>
                                <button class="btn btn-secondary">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/3183197/pexels-photo-3183197.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Modern Office Space">
                    <div class="slide-content">
                        <div class="container">
                            <h1>Modern Workspace Solutions</h1>
                            <p>Streamline your workflow with our innovative inventory management and document processing
                                systems.</p>
                            <div class="slide-buttons">
                                <a href="inventory.html" class="btn btn-primary">Browse Inventory</a>
                                <button class="btn btn-secondary">View Services</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="Business Meeting">
                    <div class="slide-content">
                        <div class="container">
                            <h1>Strategic Business Planning</h1>
                            <p>Stay organized with our agenda management and news update systems designed for modern
                                businesses.</p>
                            <div class="slide-buttons">
                                <a href="news-agenda.html" class="btn btn-primary">View News & Agenda</a>
                                <button class="btn btn-secondary">Latest Updates</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <div class="section-header">
                <h2>Our Services</h2>
                <p>Comprehensive public relations solutions designed to streamline your workflow and improve efficiency
                </p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon blue">📦</div>
                    <h3>Inventory Management</h3>
                    <p>Browse and manage available items with real-time stock tracking</p>
                    <a href="/inven" class="learn-more">Learn More →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon green">📄</div>
                    <h3>Document Borrowing</h3>
                    <p>Request and track borrowed items with easy-to-use forms</p>
                    <a href="/pinjam" class="learn-more">Learn More →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon orange">✉️</div>
                    <h3>Letter Requests</h3>
                    <p>Request official letters and documents with automated processing</p>
                    <a href="/surat" class="learn-more">Learn More →</a>
                </div>
                <div class="service-card">
                    <div class="service-icon purple">📰</div>
                    <h3>News & Agenda</h3>
                    <p>Stay informed with the latest news and announcements</p>
                    <a href="/news class="learn-more">Learn More →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p>Experience the power of streamlined public relations management. Access all our services from one
                convenient platform.</p>
            <div class="cta-buttons">
                <a href="/inven" class="btn btn-primary">Browse Inventory</a>
                <a href="/pinjam" class="btn btn-outline">Request Items</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partwelcome.footer')
</body>

</html>
