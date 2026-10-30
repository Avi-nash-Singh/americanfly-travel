<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="4;url=index.php">
    <title>Thank You | American Fly</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">

    <style>
        :root {
            --af-navy: #071c33;
            --af-navy-light: #0c4164;
            --af-blue: #0284c7;
            --af-cyan: #06b6d4;
            --af-text: #172033;
            --af-muted: #7a8799;
            --af-border: #e5ebf2;
            --af-bg: #f5f8fc;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--af-bg);
            color: var(--af-text);
            font-family: Arial, Helvetica, sans-serif;
        }

        main { flex: 1; }

        .thankyou-hero {
            position: relative;
            overflow: hidden;
            padding: 155px 0 35px;
            background: linear-gradient(135deg, rgba(7, 28, 51, .98), rgba(12, 65, 100, .94));
        }

        .thankyou-hero::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            top: -190px;
            right: -100px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.13);
            box-shadow: 0 0 0 35px rgba(255,255,255,.025), 0 0 0 75px rgba(255,255,255,.02);
        }

        .thankyou-content { position: relative; z-index: 1; margin-top:10px }

        .thankyou-eyebrow {
            margin-bottom: 13px;
            color: #67e8f9;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .thankyou-hero h1 {
            margin-bottom: 12px;
            color: #fff;
            font-size: clamp(30px, 4vw, 42px);
            font-weight: 800;
        }

        .thankyou-hero p { max-width: 650px; color: rgba(255,255,255,.78); line-height: 1.7; }

        .thankyou-main {
            position: relative;
            z-index: 2;
            margin-top: -42px;
            padding-bottom: 65px;
        }

        .thankyou-card {
            max-width: 720px;
            margin: 0 auto;
            padding: clamp(28px, 5vw, 52px);
            border: 1px solid rgba(20,40,65,.06);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 12px 35px rgba(20,40,65,.08);
            text-align: center;
        }

        .thankyou-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 78px;
            height: 78px;
            margin: 0 auto 22px;
            border-radius: 50%;
            background: #e8f8ef;
            color: #16834b;
            font-size: 34px;
        }

        .thankyou-card h2 { margin-bottom: 12px; font-size: 26px; font-weight: 800; }
        .thankyou-card p { color: var(--af-muted); line-height: 1.75; }

        .redirect-note {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 12px 0 24px;
            padding: 10px 14px;
            border-radius: 30px;
            background: #f0f8fc;
            color: var(--af-navy-light);
            font-size: 14px;
        }

        .redirect-note strong { min-width: 12px; }

        .home-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 22px;
            border: 0;
            border-radius: 8px;
            background: var(--af-blue);
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            transition: background .2s ease, transform .2s ease;
        }

        .home-button:hover { background: var(--af-navy-light); color: #fff; transform: translateY(-1px); }

        @media (max-width: 575px) {
            .thankyou-hero { padding-top: 130px; }
            .thankyou-card h2 { font-size: 22px; }
        }
    </style>
</head>
<body>

<?php include('_nav.php'); ?>

<section class="thankyou-hero">
    <div class="container thankyou-content">
        <!-- <div class="thankyou-eyebrow"><i class="fa-solid fa-paper-plane me-2"></i>American Fly · Flight support</div> -->
        <h1>Thank You!</h1>
        <p>Your flight enquiry has been received. We appreciate you choosing American Fly.</p>
    </div>
</section>

<main class="container thankyou-main">
    <section class="thankyou-card">
        <div class="thankyou-icon" aria-hidden="true"><i class="fa-solid fa-check"></i></div>
        <h2>Your enquiry has been submitted successfully</h2>
        <p>Our team will review your travel details and contact you shortly to discuss your itinerary and fare availability.</p>
        <div class="redirect-note" role="status" aria-live="polite">
            <i class="fa-regular fa-clock"></i>
            Redirecting to the home page in <strong id="countdown">4</strong> seconds...
        </div>
        <div>
            <a href="index.php" class="home-button"><i class="fa-solid fa-house"></i> Go to Home Page</a>
        </div>
    </section>
</main>

<?php include('_footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    let secondsRemaining = 4;
    const countdown = document.getElementById('countdown');

    const timer = window.setInterval(function () {
        secondsRemaining -= 1;
        if (countdown) countdown.textContent = String(secondsRemaining);

        if (secondsRemaining <= 0) {
            window.clearInterval(timer);
            window.location.href = 'index.php';
        }
    }, 1000);
})();
</script>
</body>
</html>
