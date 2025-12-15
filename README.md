# Product, Purchase & Inventory Management System (PPIMS) v1.0.0

Aplikasi manajemen **Produk**, **Pembelian**, **Penjualan**, dan **Kontrol Stok** berbasis **Laravel 12**.
Dibangun dengan **best practice**, **service layer**, dan **audit stok** agar data konsisten dan scalable.

---

## Fitur Utama

### Product Management
- Master data produk
- SKU unik
- Status produk:
  - draft
  - active
  - inactive
  - discontinued

### Pembelian (Purchase)
- Tambah & edit pembelian
- Multi item produk dalam satu transaksi
- Hitung subtotal & total otomatis
- Update stok masuk otomatis
- Histori item pembelian

### Penjualan (Sales)
- Multi item penjualan
- Validasi stok sebelum transaksi
- Stok keluar otomatis
- Cegah stok minus

### Inventory Management
- Stok real-time per produk
- Histori pergerakan stok (IN / OUT)
- Aman terhadap transaksi bersamaan (concurrency)
- Siap dikembangkan ke multi gudang

---

## Arsitektur Aplikasi

```
app/
├── Http/
│   └── Controllers/
│       ├── PurchaseController.php
│       └── SalesController.php
│
├── Services/
│   ├── PurchaseService.php
│   ├── SalesService.php
│   └── InventoryService.php
│
├── Models/
│   ├── Product.php
│   ├── Purchase.php
│   ├── PurchaseItem.php
│   ├── Sale.php
│   ├── SaleItem.php
│   ├── Stock.php
│   └── StockMovement.php
```

---

## Instalasi
1. Clone repository: `git clone https://github.com/sobocamp/pms_app.git`
2. Copy file `.env.example` menjadi `.env`
3. Buat database baru: `php artisan migrate`
4. Jalankan perintah `composer install`
5. Jalankan perintah `php artisan key:generate`
7. Jalankan perintah `php artisan serve`
8. Buka browser di `http://localhost:8000`
