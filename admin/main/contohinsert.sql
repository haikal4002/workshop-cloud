INSERT INTO obat (nama_obat, kategori_obat, harga, stok, deskripsi)
VALUES 
('Paracetamol', 'Analgesik', 5000, 100, 'Digunakan untuk menurunkan demam dan mengurangi nyeri.'),
('Amoxicillin', 'Antibiotik', 10000, 50, 'Digunakan untuk infeksi bakteri.'),
('Ibuprofen', 'Anti-inflamasi', 7500, 80, 'Meredakan nyeri ringan hingga sedang dan peradangan.'),
('Cetirizine', 'Antihistamin', 6000, 60, 'Untuk mengatasi alergi dan gatal-gatal.'),
('Ranitidine', 'Antasida', 8000, 40, 'Digunakan untuk mengurangi produksi asam lambung.'),
('Metformin', 'Antidiabetik', 12000, 30, 'Digunakan untuk mengontrol kadar gula darah.'),
('Salbutamol', 'Bronkodilator', 9000, 25, 'Mengatasi gejala asma dan gangguan pernapasan.'),
('Loperamide', 'Antidiare', 7000, 75, 'Untuk mengatasi diare akut.'),
('Captopril', 'Antihipertensi', 9500, 50, 'Mengontrol tekanan darah tinggi.'),
('Omeprazole', 'Proton Pump Inhibitor', 11000, 20, 'Mengatasi tukak lambung dan GERD.');

INSERT INTO pasien (nama_pasien, tanggal_lahir, alamat, no_telepon, jenis_kelamin)
VALUES 
('Siti Aisyah', '1992-07-21', 'Jl. Mawar No. 5', '081234567891', 'P'),
('Ahmad Fauzi', '1990-05-15', 'Jl. Merdeka No. 10', '081234567890', 'L'),
('Budi Santoso', '1985-03-10', 'Jl. Kenanga No. 23', '081345678901', 'L'),
('Dewi Kartika', '1998-11-05', 'Jl. Melati No. 12', '081987654321', 'P'),
('Rina Andayani', '2000-01-19', 'Jl. Anggrek No. 8', '081223344556', 'P'),
('Wahyudi Saputra', '1975-08-11', 'Jl. Dahlia No. 15', '081987654322', 'L'),
('Nurhalimah', '1988-12-30', 'Jl. Flamboyan No. 7', '081334455667', 'P'),
('Andi Wijaya', '1995-04-17', 'Jl. Cemara No. 9', '081112223334', 'L'),
('Sri Rahayu', '2003-09-24', 'Jl. Cempaka No. 2', '081778899001', 'P'),
('Hendra Purnama', '1982-06-12', 'Jl. Tulip No. 14', '081999888777', 'L');

INSERT INTO riwayat_pasien (id_pasien, id_obat, penyakit, tanggal_masuk, tanggal_keluar)
VALUES 
(1, 1, 'Demam dan Nyeri', '2023-12-01', '2023-12-03'),
(2, 2, 'Infeksi Saluran Pernapasan', '2023-12-02', '2023-12-05'),
(3, 3, 'Nyeri Sendi dan Otot', '2023-12-03', '2023-12-07'),
(4, 4, 'Alergi Ringan', '2023-12-04', '2023-12-06'),
(5, 5, 'Asam Lambung Tinggi', '2023-12-05', '2023-12-08'),
(6, 6, 'Diabetes Mellitus Tipe 2', '2023-12-06', NULL),
(7, 7, 'Sesak Napas', '2023-12-07', '2023-12-10'),
(8, 8, 'Diare Akut', '2023-12-08', '2023-12-09'),
(9, 9, 'Hipertensi', '2023-12-09', NULL),
(10, 10, 'Tukak Lambung', '2023-12-10', '2023-12-13');
