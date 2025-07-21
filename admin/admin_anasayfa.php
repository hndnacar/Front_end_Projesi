<?php
include 'egitim.php'; // Veritabanı bağlantısı

// İçerik güncelleme
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];

    $stmt = $pdo->prepare("UPDATE anasayfa SET title = ?, content = ?, image_url = ? WHERE id = ?");
    $stmt->execute([$title, $content, $image_url, $id]);
}

// İçerikleri çekme
$query = $pdo->query("SELECT * FROM anasayfa");
$homepageContents = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli | Dinamik Site</title>
</head>
<body>
    <h1>Anasayfa İçerik Yönetimi</h1>
    <form action="admin.anasayfa" method="POST">
        <select name="id">
            <?php foreach ($homepageContents as $content): ?>
                <option value="<?php echo $content['id']; ?>"><?php echo $content['section_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="title">Başlık</label>
        <input type="text" name="title" required>

        <label for="content">İçerik</label>
        <textarea name="content" required></textarea>

        <label for="image_url">Görsel Yolu</label>
        <input type="text" name="image_url">

        <button type="submit">Güncelle</button>
    </form>
</body>
</html>
