<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Glamour Cuts — Premium Hair Salon</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --cream:#FAF7F2; --sand:#F0EAE0; --blush:#E8D5C4; --rose:#C4957A;
    --bark:#8B6651; --espresso:#3D2B1F; --charcoal:#1A1410; --white:#FFFFFF;
    --gray-soft:#9A8E84;
    --serif:'Cormorant Garamond',Georgia,serif;
    --sans:'DM Sans',system-ui,sans-serif;
    --transition:0.28s cubic-bezier(0.4,0,0.2,1);
  }
  html{scroll-behavior:smooth;}
  body{font-family:var(--sans);background:var(--cream);color:var(--charcoal);font-size:16px;line-height:1.65;overflow-x:hidden;}
  nav{position:fixed;top:0;left:0;right:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1.25rem 4rem;background:rgba(250,247,242,0.92);backdrop-filter:blur(12px);border-bottom:1px solid rgba(196,149,122,0.2);transition:var(--transition);}
  .nav-logo{font-family:var(--serif);font-size:1.6rem;font-weight:300;letter-spacing:0.08em;color:var(--espresso);text-decoration:none;}
  .nav-logo span{color:var(--rose);font-style:italic;}
  .nav-links{display:flex;gap:2.5rem;list-style:none;}
  .nav-links a{font-family:var(--sans);font-size:0.85rem;font-weight:400;letter-spacing:0.12em;text-transform:uppercase;color:var(--espresso);text-decoration:none;position:relative;transition:color var(--transition);}
  .nav-links a::after{content:'';position:absolute;bottom:-3px;left:0;right:0;height:1px;background:var(--rose);transform:scaleX(0);transform-origin:left;transition:transform var(--transition);}
  .nav-links a:hover{color:var(--rose);}
  .nav-links a:hover::after{transform:scaleX(1);}
  .nav-cta{background:var(--espresso);color:var(--cream);border:none;padding:0.65rem 1.6rem;font-family:var(--sans);font-size:0.82rem;font-weight:500;letter-spacing:0.1em;text-transform:uppercase;cursor:pointer;text-decoration:none;transition:background var(--transition);}
  .nav-cta:hover{background:var(--rose);}
  .hero{min-height:100vh;display:grid;grid-template-columns:1fr 1fr;padding-top:80px;}
  .hero-content{display:flex;flex-direction:column;justify-content:center;padding:6rem 4rem 6rem 8rem;}
  .hero-tag{display:inline-flex;align-items:center;gap:0.6rem;font-size:0.75rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--rose);margin-bottom:1.8rem;font-weight:500;}
  .hero-tag::before{content:'';display:block;width:32px;height:1px;background:var(--rose);}
  .hero h1{font-family:var(--serif);font-size:clamp(3rem,5vw,4.8rem);font-weight:300;line-height:1.1;color:var(--espresso);margin-bottom:1.5rem;}
  .hero h1 em{color:var(--rose);font-style:italic;}
  .hero-sub{font-size:1.05rem;color:var(--bark);line-height:1.7;max-width:420px;margin-bottom:2.8rem;font-weight:300;}
  .hero-actions{display:flex;gap:1rem;align-items:center;}
  .btn-primary{background:var(--espresso);color:var(--cream);padding:0.9rem 2.2rem;text-decoration:none;font-size:0.85rem;font-weight:500;letter-spacing:0.1em;text-transform:uppercase;transition:background var(--transition);}
  .btn-primary:hover{background:var(--rose);}
  .btn-ghost{color:var(--espresso);text-decoration:none;font-size:0.85rem;font-weight:400;letter-spacing:0.08em;padding:0.9rem 0;border-bottom:1px solid var(--espresso);transition:color var(--transition),border-color var(--transition);}
  .btn-ghost:hover{color:var(--rose);border-color:var(--rose);}
  .hero-stats{display:flex;gap:3rem;margin-top:4rem;padding-top:2.5rem;border-top:1px solid var(--blush);}
  .stat-num{font-family:var(--serif);font-size:2rem;font-weight:300;color:var(--espresso);display:block;}
  .stat-label{font-size:0.78rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-soft);margin-top:0.2rem;}
  .hero-visual{position:relative;overflow:hidden;background:var(--sand);}
  .hero-visual-img{width:100%;height:100%;object-fit:cover;filter:sepia(8%) contrast(1.02);}
  .hero-visual-overlay{position:absolute;inset:0;background:linear-gradient(to right,rgba(250,247,242,0.3) 0%,transparent 40%);}
  .hero-badge{position:absolute;bottom:3rem;left:2rem;background:var(--white);padding:1.2rem 1.6rem;border-left:3px solid var(--rose);box-shadow:0 8px 32px rgba(61,43,31,0.12);}
  .hero-badge-main{font-family:var(--serif);font-size:1.4rem;color:var(--espresso);font-weight:300;}
  .hero-badge-sub{font-size:0.78rem;color:var(--gray-soft);letter-spacing:0.1em;text-transform:uppercase;margin-top:0.2rem;}
  section{padding:7rem 8rem;}
  .section-tag{font-size:0.75rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--rose);font-weight:500;margin-bottom:1rem;display:flex;align-items:center;gap:0.6rem;}
  .section-tag::before{content:'';width:28px;height:1px;background:var(--rose);}
  .section-title{font-family:var(--serif);font-size:clamp(2rem,3.5vw,3rem);font-weight:300;color:var(--espresso);line-height:1.15;margin-bottom:1.2rem;}
  .section-title em{font-style:italic;color:var(--rose);}
  .section-sub{font-size:1rem;color:var(--bark);max-width:520px;line-height:1.7;margin-bottom:3.5rem;font-weight:300;}
  .services-bg{background:var(--white);}
  .services-header{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:3.5rem;}
  .services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5px;background:var(--blush);}
  .service-card{background:var(--white);padding:2.5rem 2rem;transition:background var(--transition);cursor:pointer;}
  .service-card:hover{background:var(--cream);}
  .service-icon{font-size:1.6rem;margin-bottom:1.2rem;display:block;}
  .service-name{font-family:var(--serif);font-size:1.3rem;color:var(--espresso);margin-bottom:0.4rem;font-weight:300;}
  .service-meta{display:flex;gap:1.2rem;font-size:0.82rem;color:var(--gray-soft);letter-spacing:0.06em;margin-bottom:1rem;}
  .service-price{font-family:var(--serif);font-size:1.5rem;color:var(--rose);font-weight:300;}
  .service-arrow{display:inline-block;margin-top:1.2rem;font-size:0.8rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--espresso);text-decoration:none;border-bottom:1px solid transparent;transition:border-color var(--transition),color var(--transition);}
  .service-card:hover .service-arrow{border-color:var(--rose);color:var(--rose);}
  .booking-section{background:var(--espresso);display:grid;grid-template-columns:1fr 1fr;gap:0;padding:0;}
  .booking-info{padding:6rem 5rem;}
  .booking-info .section-tag{color:var(--blush);}
  .booking-info .section-tag::before{background:var(--blush);}
  .booking-info .section-title{color:var(--cream);}
  .booking-info .section-sub{color:var(--blush);}
  .booking-perks{list-style:none;margin-top:2rem;}
  .booking-perks li{display:flex;align-items:center;gap:0.8rem;padding:0.7rem 0;border-bottom:1px solid rgba(255,255,255,0.08);font-size:0.9rem;color:var(--sand);}
  .perk-dot{width:6px;height:6px;border-radius:50%;background:var(--rose);flex-shrink:0;}
  .booking-form-panel{background:var(--cream);padding:4rem;display:flex;flex-direction:column;justify-content:center;}
  .form-title{font-family:var(--serif);font-size:1.8rem;color:var(--espresso);margin-bottom:2rem;font-weight:300;}
  .form-group{margin-bottom:1.4rem;}
  .form-group label{display:block;font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--bark);margin-bottom:0.5rem;font-weight:500;}
  .form-group input,.form-group select{width:100%;padding:0.85rem 1rem;background:var(--white);border:1px solid var(--blush);font-family:var(--sans);font-size:0.9rem;color:var(--charcoal);transition:border-color var(--transition);outline:none;appearance:none;}
  .form-group input:focus,.form-group select:focus{border-color:var(--rose);}
  .form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
  .form-submit{width:100%;padding:1rem;background:var(--espresso);color:var(--cream);border:none;font-family:var(--sans);font-size:0.85rem;font-weight:500;letter-spacing:0.12em;text-transform:uppercase;cursor:pointer;margin-top:0.5rem;transition:background var(--transition);}
  .form-submit:hover{background:var(--rose);}
  .team-section{background:var(--sand);}
  .team-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2.5rem;margin-top:3rem;}
  .team-card{text-align:center;}
  .team-img-wrap{width:100%;aspect-ratio:3/4;overflow:hidden;margin-bottom:1.5rem;position:relative;}
  .team-img-wrap img{width:100%;height:100%;object-fit:cover;filter:sepia(10%) contrast(1.02);transition:transform 0.5s ease;}
  .team-card:hover .team-img-wrap img{transform:scale(1.04);}
  .team-name{font-family:var(--serif);font-size:1.4rem;color:var(--espresso);font-weight:300;}
  .team-title{font-size:0.78rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--rose);margin:0.3rem 0 0.2rem;}
  .team-spec{font-size:0.88rem;color:var(--gray-soft);}
  .reviews-section{background:var(--white);}
  .reviews-header{display:flex;justify-content:space-between;align-items:flex-end;}
  .google-badge{display:flex;align-items:center;gap:0.6rem;font-size:0.85rem;color:var(--bark);}
  .google-g{width:32px;height:32px;border-radius:50%;background:#fff;border:1.5px solid #ddd;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;color:#4285F4;font-family:serif;}
  .reviews-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-top:3rem;}
  .review-card{padding:2rem;background:var(--cream);border-left:2px solid var(--blush);transition:border-color var(--transition);}
  .review-card:hover{border-color:var(--rose);}
  .review-stars{color:var(--rose);font-size:1rem;letter-spacing:0.1em;margin-bottom:1rem;}
  .review-text{font-family:var(--serif);font-size:1.05rem;color:var(--espresso);line-height:1.7;font-weight:300;margin-bottom:1.2rem;font-style:italic;}
  .review-author{display:flex;align-items:center;gap:0.75rem;}
  .review-avatar{width:36px;height:36px;border-radius:50%;background:var(--blush);display:flex;align-items:center;justify-content:center;font-size:0.72rem;font-weight:500;color:var(--bark);letter-spacing:0.05em;flex-shrink:0;}
  .review-name{font-size:0.88rem;font-weight:500;color:var(--espresso);}
  .review-date{font-size:0.78rem;color:var(--gray-soft);}
  .instagram-section{background:var(--cream);padding-bottom:5rem;}
  .insta-header{display:flex;align-items:center;gap:1rem;margin-bottom:2.5rem;}
  .insta-handle{font-family:var(--serif);font-size:1.3rem;color:var(--espresso);font-weight:300;}
  .insta-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:4px;}
  .insta-item{aspect-ratio:1;overflow:hidden;position:relative;cursor:pointer;background:var(--sand);}
  .insta-item img{width:100%;height:100%;object-fit:cover;transition:transform 0.4s ease,filter 0.4s ease;filter:sepia(8%);}
  .insta-item:hover img{transform:scale(1.06);filter:sepia(0%);}
  .insta-overlay{position:absolute;inset:0;background:rgba(61,43,31,0);display:flex;align-items:center;justify-content:center;transition:background var(--transition);color:var(--cream);font-size:1.3rem;opacity:0;}
  .insta-item:hover .insta-overlay{background:rgba(61,43,31,0.35);opacity:1;}
  footer{background:var(--charcoal);padding:5rem 8rem 2.5rem;color:var(--sand);}
  .footer-grid{display:grid;grid-template-columns:1.8fr 1fr 1fr 1.2fr;gap:4rem;margin-bottom:4rem;}
  .footer-brand{font-family:var(--serif);font-size:1.8rem;font-weight:300;color:var(--cream);letter-spacing:0.06em;margin-bottom:1rem;}
  .footer-brand span{color:var(--rose);font-style:italic;}
  .footer-desc{font-size:0.88rem;color:var(--gray-soft);line-height:1.75;}
  .footer-col h4{font-size:0.72rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--gray-soft);margin-bottom:1.2rem;font-weight:500;}
  .footer-col ul{list-style:none;}
  .footer-col ul li{margin-bottom:0.6rem;}
  .footer-col ul li a,.footer-col p{font-size:0.88rem;color:var(--blush);text-decoration:none;transition:color var(--transition);}
  .footer-col ul li a:hover{color:var(--rose);}
  .footer-hours p{margin-bottom:0.4rem;font-size:0.88rem;color:var(--blush);}
  .footer-hours span{color:var(--gray-soft);font-size:0.8rem;}
  .footer-bottom{border-top:1px solid rgba(255,255,255,0.08);padding-top:2rem;display:flex;justify-content:space-between;align-items:center;font-size:0.78rem;color:var(--gray-soft);}
  .fade-up{opacity:0;transform:translateY(28px);animation:fadeUp 0.65s cubic-bezier(0.4,0,0.2,1) forwards;}
  @keyframes fadeUp{to{opacity:1;transform:translateY(0);}}
  .delay-1{animation-delay:0.1s;}.delay-2{animation-delay:0.2s;}.delay-3{animation-delay:0.35s;}.delay-4{animation-delay:0.5s;}
  @media(max-width:1100px){nav{padding:1.25rem 2.5rem;}section{padding:5rem 2.5rem;}.hero-content{padding:5rem 2.5rem;}.hero h1{font-size:2.8rem;}.footer-grid{grid-template-columns:1fr 1fr;}.insta-grid{grid-template-columns:repeat(4,1fr);}}
  @media(max-width:768px){.hero{grid-template-columns:1fr;}.hero-visual{display:none;}.services-grid{grid-template-columns:1fr;}.booking-section{grid-template-columns:1fr;}.team-grid{grid-template-columns:repeat(2,1fr);}.reviews-grid{grid-template-columns:1fr;}.insta-grid{grid-template-columns:repeat(3,1fr);}.nav-links{display:none;}.footer-grid{grid-template-columns:1fr;gap:2rem;}}
</style>
</head>
<body>

<!-- NAVIGATION -->
<nav>
  <a class="nav-logo" href="#"><span>Glamour</span> Cuts</a>
  <ul class="nav-links">
    <li><a href="#services">Services</a></li>
    <li><a href="#team">Our Team</a></li>
    <li><a href="#reviews">Reviews</a></li>
    <li><a href="#gallery">Gallery</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
  <a class="nav-cta" href="#booking">Book Now</a>
</nav>

<!-- HERO -->
<section class="hero" id="home">
  <div class="hero-content">
    <p class="hero-tag fade-up">Johannesburg's Premier Salon</p>
    <h1 class="fade-up delay-1">Where Hair<br>Becomes <em>Art</em></h1>
    <p class="hero-sub fade-up delay-2">Eight years of crafting beauty, one strand at a time. Personalised service, expert stylists, and a space that feels like yours.</p>
    <div class="hero-actions fade-up delay-3">
      <a class="btn-primary" href="#booking">Book Appointment</a>
      <a class="btn-ghost" href="#services">View Services</a>
    </div>
    <div class="hero-stats fade-up delay-4">
      <div><span class="stat-num">8+</span><p class="stat-label">Years of Excellence</p></div>
      <div><span class="stat-num">200+</span><p class="stat-label">Regular Clients</p></div>
      <div><span class="stat-num">5★</span><p class="stat-label">Google Rating</p></div>
    </div>
  </div>
  <div class="hero-visual">
    <img class="hero-visual-img" src="https://images.unsplash.com/photo-1562322140-8baeececf3df?w=900&q=80" alt="Glamour Cuts salon">
    <div class="hero-visual-overlay"></div>
    <div class="hero-badge">
      <p class="hero-badge-main">Same-day Bookings</p>
      <p class="hero-badge-sub">Available · Walk-ins welcome</p>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="services-bg" id="services">
  <div class="services-header">
    <div>
      <p class="section-tag">What We Offer</p>
      <h2 class="section-title">Services Crafted<br>with <em>Precision</em></h2>
    </div>
    <a class="btn-ghost" href="#booking">Book a Service →</a>
  </div>
  <div class="services-grid">
    <div class="service-card"><span class="service-icon">✂️</span><h3 class="service-name">Precision Cut</h3><div class="service-meta"><span>⏱ 45 min</span></div><p class="service-price">R350</p><a class="service-arrow" href="#booking">Book now →</a></div>
    <div class="service-card"><span class="service-icon">🎨</span><h3 class="service-name">Colour &amp; Highlights</h3><div class="service-meta"><span>⏱ 2.5 hrs</span></div><p class="service-price">R850</p><a class="service-arrow" href="#booking">Book now →</a></div>
    <div class="service-card"><span class="service-icon">💨</span><h3 class="service-name">Blowout &amp; Style</h3><div class="service-meta"><span>⏱ 60 min</span></div><p class="service-price">R280</p><a class="service-arrow" href="#booking">Book now →</a></div>
    <div class="service-card"><span class="service-icon">✨</span><h3 class="service-name">Keratin Treatment</h3><div class="service-meta"><span>⏱ 3 hrs</span></div><p class="service-price">R1,200</p><a class="service-arrow" href="#booking">Book now →</a></div>
    <div class="service-card"><span class="service-icon">🌿</span><h3 class="service-name">Scalp Treatment</h3><div class="service-meta"><span>⏱ 30 min</span></div><p class="service-price">R200</p><a class="service-arrow" href="#booking">Book now →</a></div>
    <div class="service-card"><span class="service-icon">👑</span><h3 class="service-name">Bridal Package</h3><div class="service-meta"><span>⏱ 4 hrs</span></div><p class="service-price">R2,500</p><a class="service-arrow" href="#booking">Book now →</a></div>
  </div>
</section>

<!-- BOOKING -->
<div class="booking-section" id="booking">
  <div class="booking-info">
    <p class="section-tag">Appointments</p>
    <h2 class="section-title">Reserve Your<br><em>Moment</em></h2>
    <p class="section-sub">Skip the wait. Book your preferred time and stylist online in under a minute.</p>
    <ul class="booking-perks">
      <li><span class="perk-dot"></span>Instant confirmation via SMS &amp; email</li>
      <li><span class="perk-dot"></span>No double-booking guarantee</li>
      <li><span class="perk-dot"></span>Free cancellation up to 2 hours before</li>
      <li><span class="perk-dot"></span>Reminder sent the night before</li>
      <li><span class="perk-dot"></span>Choose your preferred stylist</li>
    </ul>
  </div>
  <div class="booking-form-panel">
    <h3 class="form-title">Book Your Visit</h3>
    <form action="booking_process.php" method="POST">
      <div class="form-row">
        <div class="form-group"><label>First Name</label><input type="text" name="fname" placeholder="Zanele" required></div>
        <div class="form-group"><label>Last Name</label><input type="text" name="lname" placeholder="Mokoena" required></div>
      </div>
      <div class="form-group"><label>Phone Number</label><input type="tel" name="phone" placeholder="+27 71 234 5678" required></div>
      <div class="form-group"><label>Email</label><input type="email" name="email" placeholder="zanele@example.com" required></div>
      <div class="form-group"><label>Service</label>
        <select name="service" required>
          <option value="">Select a service...</option>
          <option value="Precision Cut">Precision Cut — R350</option>
          <option value="Colour & Highlights">Colour &amp; Highlights — R850</option>
          <option value="Blowout & Style">Blowout &amp; Style — R280</option>
          <option value="Keratin Treatment">Keratin Treatment — R1,200</option>
          <option value="Scalp Treatment">Scalp Treatment — R200</option>
          <option value="Bridal Package">Bridal Package — R2,500</option>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group"><label>Date</label><input type="date" name="date" required></div>
        <div class="form-group"><label>Preferred Time</label>
          <select name="time" required>
            <option value="">Select time...</option>
            <option>08:00</option><option>09:00</option><option>10:00</option>
            <option>11:00</option><option>12:00</option><option>13:00</option>
            <option>14:00</option><option>15:00</option><option>16:00</option><option>17:00</option>
          </select>
        </div>
      </div>
      <button class="form-submit" type="button" onclick="submitBooking()">Confirm Booking</button>
</form>
<div id="booking-msg" style="display:none;margin-top:1.2rem;padding:1rem 1.2rem;font-size:0.9rem;font-weight:500;letter-spacing:0.05em;"></div>
  </div>
</div>

<!-- TEAM -->
<section class="team-section" id="team">
  <p class="section-tag">Meet the Artists</p>
  <h2 class="section-title">The Hands Behind<br>Your <em>Look</em></h2>
  <div class="team-grid">
    <div class="team-card"><div class="team-img-wrap"><img src="https://i.pravatar.cc/400?img=47" alt="Aisha M."></div><h3 class="team-name">Aisha M.</h3><p class="team-title">Creative Director</p><p class="team-spec">Colour Specialist</p></div>
    <div class="team-card"><div class="team-img-wrap"><img src="https://i.pravatar.cc/400?img=48" alt="Lerato D."></div><h3 class="team-name">Lerato D.</h3><p class="team-title">Senior Stylist</p><p class="team-spec">Precision Cuts</p></div>
    <div class="team-card"><div class="team-img-wrap"><img src="https://i.pravatar.cc/400?img=49" alt="Nandi K."></div><h3 class="team-name">Nandi K.</h3><p class="team-title">Stylist</p><p class="team-spec">Natural Hair</p></div>
  </div>
</section>

<!-- GOOGLE REVIEWS -->
<section class="reviews-section" id="reviews">
  <div class="reviews-header">
    <div>
      <p class="section-tag">Client Love</p>
      <h2 class="section-title">What Our Clients<br><em>Say</em></h2>
    </div>
    <div class="google-badge">
      <div class="google-g">G</div>
      <div><div style="font-weight:500;color:#3D2B1F">4.9 / 5</div><div style="font-size:0.75rem;color:#9A8E84">Google Reviews</div></div>
    </div>
  </div>
  <div class="reviews-grid">
    <div class="review-card"><div class="review-stars">★★★★★</div><p class="review-text">"Absolutely incredible experience! Aisha transformed my hair completely. The salon is spotless, the staff are warm and professional."</p><div class="review-author"><div class="review-avatar">ZM</div><div><p class="review-name">Zanele M.</p><p class="review-date">2 weeks ago · Google</p></div></div></div>
    <div class="review-card"><div class="review-stars">★★★★★</div><p class="review-text">"Best keratin treatment I've ever had. My hair has never been smoother. Will definitely be coming back every few months!"</p><div class="review-author"><div class="review-avatar">PS</div><div><p class="review-name">Priya S.</p><p class="review-date">1 month ago · Google</p></div></div></div>
    <div class="review-card"><div class="review-stars">★★★★★</div><p class="review-text">"Booked my bridal package here and it was worth every rand. The team made me feel like royalty on my big day."</p><div class="review-author"><div class="review-avatar">TN</div><div><p class="review-name">Thandi N.</p><p class="review-date">3 weeks ago · Google</p></div></div></div>
  </div>
  <div style="text-align:center;margin-top:2.5rem">
    <a href="https://g.page/glamour-cuts" target="_blank" class="btn-ghost" style="display:inline-block">See all reviews on Google →</a>
  </div>
</section>

<!-- INSTAGRAM FEED -->
<section class="instagram-section" id="gallery">
  <div class="insta-header">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" stroke="#C4957A" stroke-width="1.5"/><circle cx="12" cy="12" r="5" stroke="#C4957A" stroke-width="1.5"/><circle cx="17.5" cy="6.5" r="1" fill="#C4957A"/></svg>
    <p class="insta-handle">@glamourcuts.salon</p>
    <a href="https://instagram.com/glamourcuts.salon" target="_blank" class="btn-ghost" style="margin-left:auto;font-size:0.8rem">Follow us →</a>
  </div>
  <!-- Replace these img src values with your Instagram Basic Display API images or an embed service like Curator.io -->
  <div class="insta-grid">
    <div class="insta-item"><img src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?w=300&q=80" alt="" loading="lazy"><div class="insta-overlay">♥</div></div>
    <div class="insta-item"><img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=300&q=80" alt="" loading="lazy"><div class="insta-overlay">♥</div></div>
    <div class="insta-item"><img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?w=300&q=80" alt="" loading="lazy"><div class="insta-overlay">♥</div></div>
    <div class="insta-item"><img src="https://images.unsplash.com/photo-1605497788044-5a32c7078486?w=300&q=80" alt="" loading="lazy"><div class="insta-overlay">♥</div></div>
    <div class="insta-item"><img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?w=300&q=80" alt="" loading="lazy"><div class="insta-overlay">♥</div></div>
    <div class="insta-item"><img src="https://images.unsplash.com/photo-1519699047748-de8e457a634e?w=300&q=80" alt="" loading="lazy"><div class="insta-overlay">♥</div></div>
  </div>
</section>

<!-- FOOTER -->
<footer id="contact">
  <div class="footer-grid">
    <div>
      <p class="footer-brand"><span>Glamour</span> Cuts</p>
      <p class="footer-desc">A boutique hair salon bringing precision, creativity, and warmth to every client. Located in the heart of our community since 2017.</p>
    </div>
    <div class="footer-col"><h4>Navigate</h4><ul><li><a href="#services">Services</a></li><li><a href="#booking">Book Now</a></li><li><a href="#team">Our Team</a></li><li><a href="#reviews">Reviews</a></li><li><a href="login.php">Staff Login</a></li></ul></div>
    <div class="footer-col footer-hours"><h4>Hours</h4><p>Mon – Fri <span>08:00 – 18:00</span></p><p>Saturday <span>08:00 – 17:00</span></p><p>Sunday <span>09:00 – 14:00</span></p><p style="margin-top:0.8rem;color:#C4957A">Public Holidays: Closed</p></div>
    <div class="footer-col"><h4>Contact</h4><ul><li><a href="tel:+27101234567">+27 10 123 4567</a></li><li><a href="mailto:hello@glamourcuts.co.za">hello@glamourcuts.co.za</a></li><li><a href="#">123 Style Street, Sandton</a></li><li><a href="#">Johannesburg, 2196</a></li></ul></div>
  </div>
  <div class="footer-bottom">
    <p>© 2026 Glamour Cuts Salon. All rights reserved.</p>
    <p>Designed &amp; developed by Group 19 · WIL Project</p>
  </div>
</footer>

<script>
  // Scroll-in animations for cards
  const obs = new IntersectionObserver(entries => {
    entries.forEach(en => {
      if (en.isIntersecting) {
        en.target.style.opacity = '1';
        en.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.service-card, .team-card, .review-card, .insta-item').forEach((el, i) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = `opacity 0.5s ease ${i * 0.07}s, transform 0.5s ease ${i * 0.07}s`;
    obs.observe(el);
  });

  // Nav shadow on scroll
  window.addEventListener('scroll', () => {
    document.querySelector('nav').style.boxShadow =
      window.scrollY > 20 ? '0 4px 24px rgba(61,43,31,0.08)' : 'none';
  });
async function submitBooking() {
  const form = document.querySelector('.booking-form-panel form');
  const btn  = document.querySelector('.form-submit');
  const msg  = document.getElementById('booking-msg');

  // Basic validation
  const inputs = form.querySelectorAll('[required]');
  for (let input of inputs) {
    if (!input.value.trim()) {
      input.focus();
      showMsg('Please fill in all fields.', false);
      return;
    }
  }

  btn.disabled = true;
  btn.textContent = 'Confirming…';
  msg.style.display = 'none';

  const data = new FormData(form);

  try {
    const res  = await fetch('booking_process.php', { method: 'POST', body: data });
    const json = await res.json();
    showMsg(json.message, json.success);
    if (json.success) {
      form.reset();
    }
  } catch (e) {
    showMsg('Network error. Please try again.', false);
  } finally {
    btn.disabled = false;
    btn.textContent = 'Confirm Booking';
  }
}

function showMsg(text, success) {
  const msg = document.getElementById('booking-msg');
  msg.textContent = text;
  msg.style.display = 'block';
  msg.style.background   = success ? '#e8f5e9' : '#fdecea';
  msg.style.color        = success ? '#2e7d32' : '#c62828';
  msg.style.borderLeft   = success ? '3px solid #4caf50' : '3px solid #e53935';
}
</script>
<a href="https://wa.me/27684521635?text=Hi%2C%20I'd%20like%20to%20book%20an%20appointment" class="whatsapp-float" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
  <svg viewBox="0 0 24 24" width="28" height="28" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.478 2 2 6.478 2 12c0 1.988.583 3.84 1.586 5.396L2 22l4.723-1.55A9.947 9.947 0 0012.001 22C17.524 22 22 17.522 22 12S17.524 2 12.001 2zm0 18.117a8.09 8.09 0 01-4.128-1.13l-.296-.176-3.068 1.007 1.02-3.008-.193-.309a8.096 8.096 0 01-1.237-4.34c0-4.482 3.647-8.129 8.13-8.129 4.482 0 8.129 3.647 8.129 8.129 0 4.483-3.647 8.13-8.13 8.13z"/></svg>
</a>
<style>
  .whatsapp-float{position:fixed;bottom:1.8rem;right:1.8rem;width:58px;height:58px;background:#25D366;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(0,0,0,0.25);z-index:200;transition:transform 0.2s ease;}
  .whatsapp-float:hover{transform:scale(1.08);}
  @media(max-width:768px){.whatsapp-float{width:52px;height:52px;bottom:1.2rem;right:1.2rem;}}
</style>
</body>
</html>