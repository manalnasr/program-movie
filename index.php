<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "Movie");

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// عند إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie = $_POST["movie"];
    $time = $_POST["time"];
    $room = $_POST["room"];

    // إدخال البيانات في الجدول
    $sql = "INSERT INTO movie (MovieName, ShowTime, ShowRoom)
            VALUES ('$movie', '$time', '$room')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>✅ تم الحجز بنجاح!</p>";
    } else {
        echo "<p style='color:red;'>⚠️ حدث خطأ: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>🎬 صفحة حجز فيلم</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="container">
    <!-- القسم الأيسر (النموذج) -->
    <div class="form-section">
        <h2> احجز فيلمك</h2>
        <form method="POST" action="">
            <label>اسم الفيلم</label>
            <select name="movie" required>
                <option value="">اختر الفيلم</option>
                <option value="فيلم الأكشن"> فيلم الأكشن</option>
                <option value="الفيلم الكوميدي"> الفيلم الكوميدي</option>
                <option value="الفيلم الدرامي"> الفيلم الدرامي</option>
            </select>

            <label>وقت العرض</label>
            <select name="time" required>
                <option value="">اختر الوقت</option>
                <option value="4:00 PM">4:00 مساءً</option>
                <option value="7:00 PM">7:00 مساءً</option>
                <option value="10:00 PM">10:00 مساءً</option>
            </select>

            <label>الصالة</label>
            <select name="room" required>
                <option value="">اختر الصالة</option>
                <option value="صالة 1">🎞️ صالة 1</option>
                <option value="صالة 2">🎞️ صالة 2</option>
                <option value="صالة 3">🎞️ صالة 3</option>
            </select>

            <button type="submit">احجز الآن</button>
        </form>

        <?php if (isset($message)): ?>
            <div class="message <?php echo (strpos($message, '✅') !== false) ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- القسم الأيمن (التصميم الجانبي) -->
    <div class="info-section">
        <h1>🎬 Movie Time</h1>
        <p>اختر فيلمك المفضل واستمتع بأجمل الأوقات في السينما!</p>
    </div>
</div>

</body>
</html>