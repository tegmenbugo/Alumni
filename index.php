<?php
/**
 * Alumni Tracking System - Router & Endpoints
 * 26-27 Web Programming - GET Method Assignment
 */

// UTF-8 karakter desteği
header('Content-Type: text/html; charset=utf-8');

// İstek metodunu al
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Sadece GET metoduna izin ver
if ($method !== 'GET') {
    http_response_code(405);
    echo "Hata: Sadece GET istekleri kabul edilmektedir.";
    exit;
}

// İstek URL yolunu (path) ayrıştır
$rawUri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($rawUri, PHP_URL_PATH);

// Proje bir alt klasörde çalışıyorsa (/Alumni veya /alumni gibi) yoldan temizleyelim
$trimmedRaw = trim($path, '/');

// -------------------------------------------------------------
// 1) http://localhost/Alumni GET -> direkt "ok" desin
// -------------------------------------------------------------
if (strcasecmp($trimmedRaw, 'Alumni') === 0) {
    echo "ok";
    exit;
}

// Eğer alt klasördeyse (/Alumni/hello gibi), öndeki /Alumni kısmını kırp
if (stripos($path, '/Alumni') === 0) {
    $path = substr($path, strlen('/Alumni'));
}

// Normalleştirilmiş yol
$path = '/' . trim($path, '/');
if ($path === '//') {
    $path = '/';
}

// -------------------------------------------------------------
// 2) /hello GET -> "Hello World" desin
// -------------------------------------------------------------
if ($path === '/hello') {
    echo "Hello World";
    exit;
}

// -------------------------------------------------------------
// 3) /hello/{name} GET -> "Hello {name}!" desin
// -------------------------------------------------------------
if (preg_match('#^/hello/([^/]+)$#u', $path, $matches)) {
    $name = urldecode($matches[1]);
    echo "Hello " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "!";
    exit;
}

// -------------------------------------------------------------
// 4) /sum/{number1}/{number2} GET -> İkisinin toplamını versin
// -------------------------------------------------------------
if (preg_match('#^/sum/([^/]+)/([^/]+)$#', $path, $matches)) {
    $num1 = $matches[1];
    $num2 = $matches[2];

    if (is_numeric($num1) && is_numeric($num2)) {
        $sum = $num1 + $num2;
        echo $sum;
    } else {
        http_response_code(400);
        echo "Hata: Lütfen geçerli iki sayı giriniz. Örn: /sum/5/10";
    }
    exit;
}

// -------------------------------------------------------------
// 6) /about GET -> Temporary About Page (Geçici Hakkında Sayfası)
// -------------------------------------------------------------
if ($path === '/about') {
    ?>
    <!DOCTYPE html>
    <html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Temporary About Page - Alumni Tracking System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background: #f8f9fa; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
            .hero-card { border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        </style>
    </head>
    <body>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card hero-card p-4 p-md-5 bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-3 py-2 rounded-pill">
                                ℹ️ Temporary About Page
                            </span>
                            <a href="/" class="btn btn-sm btn-outline-secondary">← Ana Sayfaya Dön</a>
                        </div>
                        <h1 class="display-6 fw-bold text-dark mb-3">Hakkında (About)</h1>
                        <p class="lead text-muted mb-4">
                            Bu sayfa, <strong>Mezun Takip Sistemi (Alumni Tracking System)</strong> projesi için hazırlanmış geçici hakkında (Temporary About Page) sayfasıdır.
                        </p>
                        
                        <div class="card bg-light border-0 p-4 rounded-3 mb-4">
                            <h5 class="fw-bold mb-3">📌 Proje Bilgileri:</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><strong>Ders:</strong> 26-27 Web Programming</li>
                                <li class="mb-2"><strong>Proje Adı:</strong> Alumni Tracking System (Mezun Takip Sistemi)</li>
                                <li class="mb-2"><strong>Geliştirici:</strong> Buğra Karataş</li>
                                <li class="mb-2"><strong>Yöntem:</strong> HTTP GET Routing (Native PHP Mimarisi)</li>
                                <li><strong>GitHub Reposu:</strong> <a href="https://github.com/tegmenbugo/Alumni" target="_blank" class="text-decoration-none">tegmenbugo/Alumni</a></li>
                            </ul>
                        </div>

                        <div class="text-center">
                            <a href="/" class="btn btn-primary px-4 py-2">Ana Sayfayı Ziyaret Et ➔</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// -------------------------------------------------------------
// 5) / GET -> Temporary one main page (Geçici Ana Sayfa)
// -------------------------------------------------------------
if ($path === '/' || $path === '') {
    ?>
    <!DOCTYPE html>
    <html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alumni Tracking System - Temporary Main Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background: #f8f9fa; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
            .hero-card { border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
            .endpoint-badge { font-family: monospace; font-size: 0.95rem; }
        </style>
    </head>
    <body>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Temporary Main Page Hero -->
                    <div class="card hero-card p-4 p-md-5 mb-4 bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill">
                                🎓 26-27 Web Programming
                            </span>
                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2 rounded-pill">
                                Temporary Main Page
                            </span>
                        </div>
                        <h1 class="display-6 fw-bold text-dark mb-2">Alumni Tracking System</h1>
                        <p class="lead text-muted mb-4">
                            Mezun Takip Sistemi projesi için geçici ana sayfa. Aşağıdaki bağlantıları kullanarak hocanın istediği tüm <strong>GET</strong> uç noktalarını (endpoints) canlı olarak test edebilirsiniz:
                        </p>

                        <!-- Test Endpoints Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle border">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 25%;">Görev</th>
                                        <th scope="col" style="width: 35%;">Uç Nokta (GET URL)</th>
                                        <th scope="col" style="width: 25%;">Beklenen Yanıt</th>
                                        <th scope="col" style="width: 15%; text-align: center;">Test Et</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>1. Alumni Durumu</strong></td>
                                        <td><span class="badge bg-light text-dark border endpoint-badge">/Alumni</span></td>
                                        <td><code>ok</code></td>
                                        <td class="text-center">
                                            <a href="Alumni" class="btn btn-sm btn-outline-primary" target="_blank">Aç ↗</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>2. Hello World</strong></td>
                                        <td><span class="badge bg-light text-dark border endpoint-badge">/hello</span></td>
                                        <td><code>Hello World</code></td>
                                        <td class="text-center">
                                            <a href="hello" class="btn btn-sm btn-outline-primary" target="_blank">Aç ↗</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>3. Dinamik İsim</strong></td>
                                        <td><span class="badge bg-light text-dark border endpoint-badge">/hello/Buğra</span></td>
                                        <td><code>Hello Buğra!</code></td>
                                        <td class="text-center">
                                            <a href="hello/Bu%C4%9Fra" class="btn btn-sm btn-outline-primary" target="_blank">Aç ↗</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>4. Toplama İşlemi</strong></td>
                                        <td><span class="badge bg-light text-dark border endpoint-badge">/sum/15/27</span></td>
                                        <td><code>42</code></td>
                                        <td class="text-center">
                                            <a href="sum/15/27" class="btn btn-sm btn-outline-primary" target="_blank">Aç ↗</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>5. Ana Sayfa</strong></td>
                                        <td><span class="badge bg-light text-dark border endpoint-badge">/</span></td>
                                        <td><em>Temporary Main Page</em></td>
                                        <td class="text-center">
                                            <span class="badge bg-success-subtle text-success">Aktif</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>6. Hakkında Sayfası</strong></td>
                                        <td><span class="badge bg-light text-dark border endpoint-badge">/about</span></td>
                                        <td><em>Temporary About Page</em></td>
                                        <td class="text-center">
                                            <a href="about" class="btn btn-sm btn-outline-primary" target="_blank">Aç ↗</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Canlı Deneme Alanı -->
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold mb-2">⚡ Dinamik /hello/{isim} Dene:</h6>
                                    <div class="input-group">
                                        <input type="text" id="nameInput" class="form-control" placeholder="Örn: Ahmet" value="Buğra">
                                        <button class="btn btn-primary" onclick="testHello()">Git ➔</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold mb-2">⚡ Dinamik /sum/{sayı1}/{sayı2} Dene:</h6>
                                    <div class="input-group">
                                        <input type="number" id="num1" class="form-control" placeholder="Sayı 1" value="12">
                                        <span class="input-group-text">+</span>
                                        <input type="number" id="num2" class="form-control" placeholder="Sayı 2" value="28">
                                        <button class="btn btn-success" onclick="testSum()">Topla ➔</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top text-muted small d-flex justify-content-between align-items-center">
                            <span>Geliştirici: <strong>Buğra Karataş</strong></span>
                            <a href="about" class="text-decoration-none">Hakkında Sayfasına Git ➔</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function testHello() {
                const name = document.getElementById('nameInput').value.trim() || 'Misafir';
                window.open('hello/' + encodeURIComponent(name), '_blank');
            }
            function testSum() {
                const n1 = document.getElementById('num1').value || '0';
                const n2 = document.getElementById('num2').value || '0';
                window.open('sum/' + n1 + '/' + n2, '_blank');
            }
        </script>
    </body>
    </html>
    <?php
    exit;
}

// Eşleşmeyen rotalar için 404
http_response_code(404);
echo "404 - Sayfa Bulunamadı: " . htmlspecialchars($path, ENT_QUOTES, 'UTF-8');
