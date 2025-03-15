CREATE TABLE obat (
    id_obat INT AUTO_INCREMENT PRIMARY KEY,
    nama_obat VARCHAR(100) NOT NULL,
    kategori_obat VARCHAR(50),
    harga DECIMAL(10, 2),
    stok INT NOT NULL,
    deskripsi TEXT
);

CREATE TABLE pasien (
    id_pasien INT AUTO_INCREMENT PRIMARY KEY,
    nama_pasien VARCHAR(100) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    alamat TEXT,
    no_telepon VARCHAR(15),
    jenis_kelamin ENUM('L', 'P') NOT NULL
);