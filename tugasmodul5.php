<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital STITEK Bontang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
        }
        h1, h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        form input[type="text"],
        form input[type="email"],
        form textarea {
            width: calc(100% - 20px); /* Adjust for padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding in width */
        }
        form textarea {
            resize: vertical; /* Allow vertical resizing */
            min-height: 100px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }
        .success {
            color: #3c763d;
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: left; /* Adjust alignment for data display */
            word-wrap: break-word; /* Ensure long words break */
        }
        .success p {
            margin: 5px 0;
        }
        .success strong {
            color: #2e6da4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buku Tamu Digital STITEK Bontang</h1>

        <?php
        // Inisialisasi variabel untuk pesan error dan data
        $errors = [];
        $nama_lengkap = $alamat_email = $pesan_komentar = "";
        $display_data = false; // Flag untuk menampilkan data yang dikirim

        // Memproses form jika disubmit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // 1. Validasi sederhana: Pastikan tidak ada kolom input yang kosong
            if (empty($_POST["nama_lengkap"])) {
                $errors[] = "Nama Lengkap harus diisi.";
            } else {
                // Gunakan htmlspecialchars() untuk membersihkan input
                $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
            }

            if (empty($_POST["alamat_email"])) {
                $errors[] = "Alamat Email harus diisi.";
            } else {
                $alamat_email = htmlspecialchars($_POST["alamat_email"]);
                // Validasi format email sederhana
                if (!filter_var($alamat_email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Format Alamat Email tidak valid.";
                }
            }

            if (empty($_POST["pesan_komentar"])) {
                $errors[] = "Pesan/Komentar harus diisi.";
            } else {
                $pesan_komentar = htmlspecialchars($_POST["pesan_komentar"]);
            }

            // 4. Jika semua data valid
            if (empty($errors)) {
                $display_data = true; // Set flag untuk menampilkan data
            }
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo isset($_POST['nama_lengkap']) ? htmlspecialchars($_POST['nama_lengkap']) : ''; ?>">

            <label for="alamat_email">Alamat Email:</label>
            <input type="email" id="alamat_email" name="alamat_email" value="<?php echo isset($_POST['alamat_email']) ? htmlspecialchars($_POST['alamat_email']) : ''; ?>">

            <label for="pesan_komentar">Pesan/Komentar:</label>
            <textarea id="pesan_komentar" name="pesan_komentar"><?php echo isset($_POST['pesan_komentar']) ? htmlspecialchars($_POST['pesan_komentar']) : ''; ?></textarea>

            <input type="submit" value="Kirim Pesan">
        </form>
        <hr> <h2>Status Pengiriman:</h2>
        <?php
        // Menampilkan pesan kesalahan jika ada
        if (!empty($errors)) {
            echo '<div class="error">';
            echo '<h3>Terjadi Kesalahan:</h3>';
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
        // Menampilkan pesan konfirmasi dan data yang baru saja dikirim
        if ($display_data) {
            echo '<div class="success">';
            echo '<h3>Pesan Anda Berhasil Dikirim!</h3>';
            echo '<p><strong>Nama Lengkap:</strong> ' . $nama_lengkap . '</p>';
            echo '<p><strong>Alamat Email:</strong> ' . $alamat_email . '</p>';
            echo '<p><strong>Pesan/Komentar:</strong> ' . nl2br($pesan_komentar) . '</p>'; // nl2br() untuk mempertahankan baris baru di textarea
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>