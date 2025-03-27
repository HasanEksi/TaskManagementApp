# Task Management App

Bu proje, Laravel ve Livewire kullanılarak geliştirilmiş modern bir görev yönetim uygulamasıdır.

## Gereksinimler

- PHP 8.2 veya üzeri
- Composer
- Node.js ve npm
- MySQL veya SQLite

## Kurulum

1. Projeyi klonlayın:
```bash
git clone https://github.com/HasanEksi/TaskManagementApp
cd TaskManagementApp
```

2. Composer bağımlılıklarını yükleyin:
```bash
composer install
```

3. NPM bağımlılıklarını yükleyin:
```bash
npm install
```

4. .env dosyasını oluşturun:
```bash
cp .env.example .env
```

5. Uygulama anahtarını oluşturun:
```bash
php artisan key:generate
```

6. Veritabanı ayarlarını yapılandırın:
- `.env` dosyasında veritabanı bağlantı bilgilerinizi düzenleyin
- SQLite kullanmak için: `database/database.sqlite` dosyasını oluşturun

7. Veritabanı tablolarını oluşturun:
```bash
php artisan migrate
```

8. Geliştirme sunucusunu başlatın:
```bash
composer dev
```

Bu komut aşağıdaki servisleri başlatacaktır:
- Laravel geliştirme sunucusu
- Kuyruk dinleyicisi
- Log izleyici
- Vite geliştirme sunucusu

## Özellikler

- Görev oluşturma ve düzenleme
- Görev durumu takibi
- Görev önceliklendirme

## Teknolojiler

- Laravel 12
- Livewire 3
- Laravel Sanctum (API kimlik doğrulama) 
- Tailwind CSS
- Alpine.js

## Lisans

Bu proje MIT lisansı altında lisanslanmıştır. 

## API Kullanımı

API isteklerinde aşağıdaki header'ların kullanılması gerekmektedir:

```bash
Accept: application/json
Authorization: Bearer {token}
```

Sanctum token'ı almak için:
1. `/api/auth/token` endpoint'ine POST isteği gönderin
2. Başarılı yanıtta dönen token'ı `Authorization` header'ında kullanın 

## Tasks API Endpoint'leri

### Görev Listesi
```bash
GET /api/tasks
```

### Görev Detayı
```bash
GET /api/tasks/{id}
```

### Görev Oluşturma
```bash
POST /api/tasks
```

### Görev Güncelleme
```bash
PUT /api/tasks/{id}
```

### Görev Silme
```bash
DELETE /api/tasks/{id}
```

Tüm endpoint'ler için yukarıda belirtilen header'ların kullanılması gerekmektedir.


