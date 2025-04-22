
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $productName = htmlspecialchars($data['productName']);
    $fullName = htmlspecialchars($data['fullName']);
    $phoneNumber = htmlspecialchars($data['phoneNumber']);

    $to = "mohamadaminmarah@gmail.com";
    $subject = "طلب جديد";
    $message = "طلب جديد:\n\n" .
               "اسم الشمعة: $productName\n" .
               "الاسم الكامل: $fullName\n" .
               "رقم الهاتف: $phoneNumber\n";

    $headers = "From: no-reply@yourdomain.com\r\n" .
               "Reply-To: no-reply@yourdomain.com\r\n" .
               "Content-Type: text/plain; charset=UTF-8";

    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200);
        echo json_encode(["message" => "Email sent successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to send email."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed."]);
}
?>