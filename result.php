<?php
// Enable full error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Define the nl2li() function (fix for your error)
function nl2li($text) {
    $lines = explode("\n", $text);
    $list = '';
    foreach ($lines as $line) {
        if (trim($line) !== '') {
            $list .= '<li>' . htmlspecialchars(trim($line)) . '</li>';
        }
    }
    return $list;
}

// Profile image upload
$profileFileName = '';
if (isset($_FILES['profile']) && $_FILES['profile']['error'] === 0) {
    $uploadDir = 'uploads/';
    $profileFileName = basename($_FILES['profile']['name']);
    $targetPath = $uploadDir . $profileFileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    move_uploaded_file($_FILES['profile']['tmp_name'], $targetPath);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Resume Result</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 40px 0;
      background: #f0f2f5;
      color: #222;
    }

    .resume {
      width: 794px;
      height: 1123px;
      margin: auto;
      padding: 30px 40px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      display: none;
      overflow: auto;
    }

    .header {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .profile-pic {
      width: 120px;
      height: 140px;
      object-fit: cover;
      margin-right: 20px;
      border-radius: 8px;
      border: 2px solid #666;
    }

    .contact-info h1 {
      margin: 0;
      font-size: 24px;
      font-weight: 600;
    }

    .contact-info p {
      margin: 4px 0;
      font-size: 14px;
      color: #555;
    }

    .section {
      margin-top: 20px;
    }

    h2 {
      font-size: 18px;
      margin-bottom: 10px;
      color: #333;
      border-bottom: 2px solid #667eea;
      padding-bottom: 5px;
      display: inline-block;
    }

    .columns {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
    }

    .left-col, .right-col {
      flex: 1 1 48%;
    }

    ul {
      margin: 10px 0;
      padding-left: 20px;
    }

    li {
      font-size: 14px;
      line-height: 1.6;
      color: #444;
    }

    button {
      margin-top: 30px;
      padding: 10px 20px;
      font-size: 16px;
      background-color: #667eea;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #5a63d6;
    }
  </style>

  <script>
    $(document).ready(function () {
      $('.resume').fadeIn(1000);
      $(window).on('scroll', function () {
        $('.section').each(function () {
          if ($(this).offset().top < $(window).scrollTop() + $(window).height() - 100) {
            $(this).animate({ opacity: 1, marginTop: '0px' }, 600);
          }
        });
      });
      $('.section').css({ opacity: 0, marginTop: '30px' });
    });
  </script>
</head>

<body>
<div class="resume">
  <div class="header">
    <?php if (!empty($profileFileName)): ?>
      <img src="uploads/<?php echo htmlspecialchars($profileFileName); ?>" class="profile-pic" alt="Profile Picture">
    <?php endif; ?>
    <div class="contact-info">
      <h1><?php echo htmlspecialchars($_POST['name']); ?></h1>
      <p><?php echo htmlspecialchars($_POST['job_title']); ?></p>
      <p>📞 <?php echo htmlspecialchars($_POST['phone']); ?> |
         ✉️ <?php echo htmlspecialchars($_POST['email']); ?></p>
      <p>🔗 <?php echo htmlspecialchars($_POST['linkedin']); ?></p>
      <p>🏠 <?php echo htmlspecialchars($_POST['address']); ?></p>
    </div>
  </div>

  <div class="section">
    <h2>ACADEMIC BACKGROUND</h2>
    <ul>
      <li><strong>BE - <?php echo htmlspecialchars($_POST['degree']); ?></strong>: <?php echo htmlspecialchars($_POST['be_percentage']); ?>% (<?php echo htmlspecialchars($_POST['be_year']); ?>)</li>
      <li><strong>HSC - <?php echo htmlspecialchars($_POST['hsc_board']); ?></strong>: <?php echo htmlspecialchars($_POST['hsc_percentage']); ?>% (<?php echo htmlspecialchars($_POST['hsc_year']); ?>)</li>
      <li><strong>SSLC - <?php echo htmlspecialchars($_POST['sslc_board']); ?></strong>: <?php echo htmlspecialchars($_POST['sslc_percentage']); ?>% (<?php echo htmlspecialchars($_POST['sslc_year']); ?>)</li>
    </ul>
  </div>

  <div class="columns">
    <div class="left-col">
      <div class="section">
        <h2>KEY STRENGTHS</h2>
        <ul><?php echo nl2li($_POST['strengths']); ?></ul>
      </div>

      <div class="section">
        <h2>CERTIFICATIONS</h2>
        <ul><?php echo nl2li($_POST['certifications']); ?></ul>
      </div>

      <div class="section">
        <h2>AREAS OF INTEREST</h2>
        <ul><?php echo nl2li($_POST['interests']); ?></ul>
      </div>

      <div class="section">
        <h2>INTERNSHIPS/INDUSTRIAL VISIT</h2>
        <ul><?php echo nl2li($_POST['internships']); ?></ul>
      </div>
    </div>

    <div class="right-col">
      <div class="section">
        <h2>CORE SKILLS</h2>
        <ul><?php echo nl2li($_POST['skills']); ?></ul>
      </div>

      <div class="section">
        <h2>IT SKILLS</h2>
        <p><strong>Languages:</strong> <?php echo htmlspecialchars($_POST['languages']); ?><br>
           <strong>Software:</strong> <?php echo htmlspecialchars($_POST['software']); ?></p>
      </div>

      <div class="section">
        <h2>PROJECTS</h2>
        <ul>
          <li><strong>Mini Project</strong> (<?php echo htmlspecialchars($_POST['mini_year']); ?>) <br>
              <strong>Title:</strong> <?php echo htmlspecialchars($_POST['mini_title']); ?> <br>
              <strong>Description:</strong> <?php echo htmlspecialchars($_POST['mini_desc']); ?></li>
          <li><strong>Main Project</strong> (<?php echo htmlspecialchars($_POST['main_year']); ?>) <br>
              <strong>Title:</strong> <?php echo htmlspecialchars($_POST['main_title']); ?> <br>
              <strong>Description:</strong> <?php echo htmlspecialchars($_POST['main_desc']); ?></li>
        </ul>
      </div>

      <div class="section">
        <h2>CO-CURRICULAR ACTIVITIES</h2>
        <ul><?php echo nl2li($_POST['co_curricular']); ?></ul>
      </div>

      <div class="section">
        <h2>EXTRA-CURRICULAR ACTIVITIES</h2>
        <ul><?php echo nl2li($_POST['extra_curricular']); ?></ul>
      </div>
    </div>
  </div>

  <form action="generate_pdf.php" method="POST">
    <?php
    foreach ($_POST as $key => $value) {
        echo '<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($value).'">';
    }
    echo '<input type="hidden" name="profile" value="' . htmlspecialchars($profileFileName) . '">';
    ?>
    <button type="submit">Download PDF</button>
  </form>
</div>
</body>
</html>
