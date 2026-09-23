# 🎓 Alumni Tracking System (Mezun Takip Sistemi)

> **26-27 Web Programming Dersi Dönem Projesi**  
> Üniversite mezunları ile mevcut öğrenciler ve yönetim arasındaki iletişimi güçlendiren, mezunların kariyer yolculuklarını takip eden ve staj/iş fırsatlarını bir araya getiren kapsamlı web platformu.

---

## 📌 Proje Amacı ve Kapsamı
Bu sistem, mezunların mezuniyet sonrası kariyer adımlarını (çalıştıkları kurum, pozisyon, sektör, iletişim) güncel tutmalarını; mevcut öğrencilerin ise mezunların deneyimlerinden faydalanmasını ve staj/iş ilanlarına tek noktadan erişebilmesini amaçlar.

---

## 👥 Kullanıcı Rolleri ve Temel Özellikler

### 1. 🎓 Mezun & Öğrenci Modülü
- **Kayıt ve Profil:** Bölüm, mezuniyet yılı, biyografi, sosyal medya (LinkedIn, GitHub vb.), profil fotoğrafı ve CV yükleme.
- **Kariyer Bilgisi:** Çalışma durumu (Özel Sektör, Kamu, Akademik, Yüksek Lisans, İş Arıyor), şirket adı ve unvanı.
- **Mezun Ağı (Networking):** Mezunları bölüme, mezuniyet yılına, şehre veya çalışma alanına göre arama/filtreleme.
- **İlanlar & Duyurular:** Yayınlanan iş/staj ilanlarını ve üniversite duyurularını görüntüleme.

### 2. 💼 İşveren / Temsilci Modülü *(Opsiyonel)*
- Şirket adına staj ve iş ilanı oluşturma, yayından kaldırma.

### 3. 🛡️ Yönetici (Admin) Modülü
- **Mezun Onaylama/Denetleme:** Kaydolan mezunların doğrulanması ve yönetimi.
- **İlan & Duyuru Yönetimi:** İlanları onaylama, düzenleme ve silme.
- **İstatistik & Raporlama:** Mezunların sektör dağılımı, istihdam oranı ve bölüm bazlı grafiksel raporlar.

---

## 🛠️ Teknoloji Yığını (Tech Stack)

- **Backend:** PHP 8.x (Native PHP, OOP & PDO Mimarisi)
- **Veritabanı:** MySQL / MariaDB (İlişkisel Veritabanı)
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5 (Modern & Responsive UI)
- **Güvenlik:** SQL Injection Koruması (Prepared Statements), XSS Koruması, CSRF Token, `password_hash()` Şifreleme, Session Yönetimi
- **Sürüm Kontrolü:** Git & GitHub

---

## 🗂️ Proje Dizin Yapısı (Planlanan Mimari)

```text
Alumni/
├── config/              # Veritabanı ve genel sistem ayarları
│   └── database.php     # PDO veritabanı bağlantı sınıfı
├── public/              # Dışa açık web kök dizini
│   ├── css/             # Özel stil dosyaları
│   ├── js/              # İstemci tarafı scriptler
│   ├── uploads/         # Yüklenen profil resimleri ve CV'ler
│   └── index.php        # Uygulama giriş noktası
├── views/               # Arayüz şablonları (HTML + PHP)
│   ├── layouts/         # Header, footer, navbar bileşenleri
│   ├── auth/            # Giriş, kayıt ekranları
│   ├── profile/         # Profil detay ve düzenleme sayfaları
│   ├── jobs/            # İlan listesi ve detayları
│   └── admin/           # Yönetici paneli ve istatistikler
├── src/                 # İş mantığı ve sınıflar (Controllers, Models, Helpers)
│   ├── Auth.php         # Giriş/çıkış ve oturum kontrolleri
│   ├── User.php         # Kullanıcı ve mezun veri işlemleri
│   ├── Job.php          # İlan veri işlemleri
│   └── Helper.php       # Güvenlik ve yardımcı fonksiyonlar
├── sql/                 # Veritabanı şeması ve örnek veriler
│   └── schema.sql       # Tablo yapısı (DDL)
├── README.md            # Proje dokümantasyonu
└── .gitignore           # Git takip dışı dosyalar
```

---

## 🗓️ Dönem Yol Haritası (Development Roadmap)

- [x] **Adım 1:** Repo ve çalışma ortamının hazırlanması, `README.md` dokümantasyonu.
- [ ] **Adım 2:** Veritabanı şemasının (ERD) çizilmesi ve `schema.sql` oluşturulması.
- [ ] **Adım 3:** Proje mimarisi, PDO bağlantısı ve temel şablon (Navbar, Header, Footer).
- [ ] **Adım 4:** Güvenli Kimlik Doğrulama (Auth: Kayıt, Giriş, Session, Çıkış).
- [ ] **Adım 5:** Mezun Profil Yönetimi (Profil güncelleme, fotoğraf/CV yükleme).
- [ ] **Adım 6:** Mezun Listeleme, Dinamik Arama ve Filtreleme.
- [ ] **Adım 7:** İş & Staj İlanları Modülü (CRUD).
- [ ] **Adım 8:** Admin Yönetim Paneli, İstatistiksel Raporlar ve Güvenlik Testleri.
- [ ] **Adım 9:** Final testleri, sunum ve teslimat hazırlığı.

---

## 🚀 Yerel Geliştirme (Local Setup)

1. Bu repoyu bilgisayarınıza klonlayın:
   ```bash
   git clone https://github.com/tegmenbugo/Alumni.git
   ```
2. Yerel PHP sunucusunu başlatın (veya MAMP/XAMPP kullanın):
   ```bash
   cd Alumni
   php -S localhost:8000
   ```
3. Veritabanını içe aktarın:
   - `sql/schema.sql` dosyasını MySQL veritabanınıza import edin.
4. `config/database.php` dosyasındaki veritabanı kullanıcı adı ve şifrenizi güncelleyin.
5. Tarayıcınızdan `http://localhost:8000` adresine gidin.
