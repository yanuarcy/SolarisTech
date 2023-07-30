// Mendapatkan elemen input harga produk
var inputHarga = document.getElementById("harga_produk");

// Menambahkan event listener untuk setiap perubahan pada input
inputHarga.addEventListener("input", function() {
    // Menghapus semua karakter non-digit dari input
    var harga = this.value.replace(/\D/g, "");

    // Menambahkan titik setiap tiga angka dari belakang
    var hargaFormatted = harga.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Menyisipkan format rupiah "Rp " pada depan input
    this.value = "Rp " + hargaFormatted;
});
