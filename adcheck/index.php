<?php
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = strtolower($_POST["content"]);
    $field = $_POST["field"];

    $violations = [];

    // Quy tắc đơn giản (demo nghiên cứu)
    if (str_contains($content, "chữa khỏi") || str_contains($content, "100%")) {
        $violations[] = "❌ Quảng cáo cam kết tuyệt đối (vi phạm pháp luật)";
    }

    if ($field == "tpcn" && str_contains($content, "thuốc")) {
        $violations[] = "❌ Thực phẩm chức năng nhưng quảng cáo như thuốc";
    }

    if (empty($violations)) {
        $result = "✅ Nội dung KHÔNG phát hiện vi phạm rõ ràng (theo luật công khai)";
    } else {
        $result = implode("<br>", $violations);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kiểm tra xác thực quảng cáo</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            padding: 30px;
        }
        .box {
            background: white;
            padding: 20px;
            max-width: 700px;
            margin: auto;
            border-radius: 8px;
        }
        textarea {
            width: 100%;
            height: 150px;
        }
        button {
            padding: 10px 20px;
            margin-top: 10px;
        }
        .result {
            margin-top: 15px;
            padding: 10px;
            background: #eef;
        }
    </style>
</head>

<body>

<div class="box">
    <h2>🔍 Kiểm tra mức độ xác thực quảng cáo</h2>

    <form method="post">
        <label>Nội dung quảng cáo:</label><br>
        <textarea name="content" required></textarea><br>

        <label>Lĩnh vực:</label><br>
        <select name="field">
            <option value="mypham">Mỹ phẩm</option>
            <option value="tpcn">Thực phẩm chức năng</option>
        </select><br><br>

        <button type="submit">Kiểm tra</button>
    </form>

    <?php if ($result): ?>
        <div class="result">
            <strong>Kết quả:</strong><br>
            <?= $result ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

