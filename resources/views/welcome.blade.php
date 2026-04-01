<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaundryBBW - Aesthetic Laundry Service</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#0b1220;
            color:white;
        }

        /* HERO */
        .hero{
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            padding:20px;
            background: radial-gradient(circle at top, #1e3a8a, #0b1220 60%);
        }

        .hero h1{
            font-size:54px;
            font-weight:700;
        }

        .hero p{
            color:#cbd5e1;
            margin-top:10px;
            font-size:18px;
        }

        .btn{
            margin-top:25px;
            display:inline-block;
            padding:12px 26px;
            background:#38bdf8;
            color:#0b1220;
            border-radius:12px;
            text-decoration:none;
            font-weight:600;
            transition:0.3s;
        }

        .btn:hover{
            background:#0ea5e9;
            color:white;
        }

        /* SECTION */
        .section{
            padding:80px 20px;
            text-align:center;
        }

        .section h2{
            font-size:32px;
            margin-bottom:10px;
        }

        .section p{
            color:#94a3b8;
        }

        /* GRID */
        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
            margin-top:40px;
            max-width:1100px;
            margin-left:auto;
            margin-right:auto;
        }

        /* CARD */
        .card{
            background:rgba(255,255,255,0.05);
            border:1px solid rgba(255,255,255,0.08);
            padding:25px;
            border-radius:16px;
            backdrop-filter:blur(10px);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-6px);
            background:rgba(255,255,255,0.08);
        }

        /* STATS */
        .stats{
            display:flex;
            justify-content:center;
            gap:30px;
            flex-wrap:wrap;
            margin-top:40px;
        }

        .stat-box{
            background:#111827;
            padding:20px;
            border-radius:14px;
            min-width:160px;
        }

        .stat-box h3{
            font-size:22px;
            color:#38bdf8;
        }

        /* RATING */
        .stars{
            color:#fbbf24;
            font-size:18px;
            margin:5px 0;
        }

        /* CTA */
        .cta{
            background:linear-gradient(90deg,#38bdf8,#0ea5e9);
            color:#0b1220;
            text-align:center;
            padding:70px 20px;
            margin-top:50px;
        }

        .cta h2{
            font-size:30px;
        }

        .footer{
            text-align:center;
            padding:20px;
            font-size:12px;
            color:#64748b;
            background:#020617;
        }
    </style>
</head>

<body>

<!-- HERO -->
<div class="hero">
    <div>
        <h1>🧺 LaundryBBW</h1>
        <p>Laundry modern, cepat, bersih, wangi & terpercaya</p>
        <a href="#services" class="btn">Lihat Layanan</a>
    </div>
</div>

<!-- STATISTIK -->
<div class="section">
    <h2>Dipercaya Ribuan Pelanggan</h2>
    <p>Kami terus memberikan pelayanan terbaik</p>

    <div class="stats">
        <div class="stat-box">
            <h3>1.250+</h3>
            <p>Order Selesai</p>
        </div>

        <div class="stat-box">
            <h3>980+</h3>
            <p>Pelanggan</p>
        </div>

        <div class="stat-box">
            <h3>4.9 ⭐</h3>
            <p>Rating Kepuasan</p>
        </div>
    </div>
</div>

<!-- LAYANAN -->
<div class="section" id="services">
    <h2>Layanan Kami</h2>
    <p>Apa saja yang bisa kamu dapatkan</p>

    <div class="grid">
        <div class="card">
            <h3>👕 Cuci Kering</h3>
            <p>Untuk pakaian harian dengan hasil bersih maksimal</p>
        </div>

        <div class="card">
            <h3>🧥 Cuci Setrika</h3>
            <p>Pakaian rapi, licin, dan siap pakai</p>
        </div>

        <div class="card">
            <h3>🛏️ Laundry Bed Cover</h3>
            <p>Cuci khusus barang besar seperti selimut & sprei</p>
        </div>

        <div class="card">
            <h3>⚡ Express 1 Hari</h3>
            <p>Layanan cepat untuk kebutuhan mendadak</p>
        </div>
    </div>
</div>

<!-- REVIEW / RATING -->
<div class="section">
    <h2>Review Pelanggan</h2>
    <p>Yang mereka katakan tentang LaundryBBW</p>

    <div class="grid">
        <div class="card">
            <h3>Rina</h3>
            <div class="stars">⭐⭐⭐⭐⭐</div>
            <p>“Pelayanannya cepat banget, baju saya wangi dan rapi!”</p>
        </div>

        <div class="card">
            <h3>Budi</h3>
            <div class="stars">⭐⭐⭐⭐⭐</div>
            <p>“Harga murah tapi kualitas premium, recommended!”</p>
        </div>

        <div class="card">
            <h3>Siti</h3>
            <div class="stars">⭐⭐⭐⭐⭐</div>
            <p>“Laundry paling rapi yang pernah saya pakai.”</p>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta">
    <h2>🔥 Laundry Banyak, Tapi Yang Berkualitas Hanya LaundryBBW</h2>
    <p>Yuk laundry sekarang dan rasakan bedanya!</p>
    <br>
    <a href="{{ route('login') }}" class="btn">Mulai Sekarang</a>
</div>

<!-- FOOTER -->
<div class="footer">
    © {{ date('Y') }} LaundryBBW - All Rights Reserved
</div>

</body>
</html>