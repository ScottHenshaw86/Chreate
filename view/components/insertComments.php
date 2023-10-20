<?php
$user_id = $_POST['user_id'] ?? false;
$text_content = $_POST['text_content'] ?? false;

echo "<br>user_id: $user_id";
echo "<br>text_content: $text_content";

if ($user_id && $text_content) {
  echo "<br>inside if";

  $db = new PDO("mysql:host=localhost;dbname=chreate;charset=utf8", "root", "root");

  $req = $db->prepare("INSERT INTO comments (user_id, text_content) VALUES (:user_id, :text_content)");

  $req->execute([
    "user_id" => $userName,
    "text_content" => $text_content
  ]);
  $newMsg = $db->lastInsertId();
  echo "<br>newMsg: $newMsg";
  header("Location: home.php?newMsgAdded=$newMsg");
} else {
  echo "Error: ALL fields are required.";
}
