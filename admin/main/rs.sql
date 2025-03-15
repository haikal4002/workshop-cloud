-- Active: 1730378624452@@127.0.0.1@3306@asrama
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

CREATE TABLE riwayat_pasien (
    id_riwayat INT AUTO_INCREMENT PRIMARY KEY,
    id_pasien INT NOT NULL,
    id_obat INT NOT NULL,
    penyakit VARCHAR(255) NOT NULL,
    tanggal_masuk DATE NOT NULL,
    tanggal_keluar DATE,
    FOREIGN KEY (id_pasien) REFERENCES pasien(id_pasien),
    FOREIGN KEY (id_obat) REFERENCES obat(id_obat)
);
