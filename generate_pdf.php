<?php
require 'vendor/autoload.php'; // Ensure Dompdf is installed via Composer
use Dompdf\Dompdf;

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

$profile = isset($_POST['profile']) ? $_POST['profile'] : '';

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Resume PDF</title>
  <style>
    @page { margin: 30px 40px; }
    body {
      font-family: "Poppins", sans-serif;
      font-size: 14px;
      color: #222;
      margin: 0;
    }
    .resume {
      width: 100%;
      padding: 20px 30px;
    }
    .header {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .profile-pic {
      width: 100px;
      height: 120px;
      object-fit: cover;
      margin-right: 20px;
      border-radius: 8px;
      border: 2px solid #666;
    }
    .contact-info h1 {
      margin: 0;
      font-size: 20px;
      font-weight: 600;
    }
    .contact-info p {
      margin: 4px 0;
      font-size: 12px;
      color: #555;
    }
    h2 {
      font-size: 16px;
      margin-top: 15px;
      color: #333;
      border-bottom: 2px solid #667eea;
      padding-bottom: 5px;
    }
    .columns {
      display: flex;
      justify-content: space-between;
    }
    .left-col, .right-col {
      width: 48%;
    }
    ul {
      margin: 10px 0;
      padding-left: 20px;
    }
    li {
      margin-bottom: 5px;
      line-height: 1.5;
    }
    p {
      line-height: 1.5;
    }
  </style>
</head>
<body>
<div class="resume">
  <div class="header">
';

if (!empty($profile)) {
    $html .= '<img src="uploads/' . htmlspecialchars($profile) . '" class="profile-pic" alt="Profile Picture">';
}

$html .= '
    <div class="contact-info">
      <h1>' . htmlspecialchars($_POST['name']) . '</h1>
      <p>' . htmlspecialchars($_POST['job_title']) . '</p>
      <p> ' . htmlspecialchars($_POST['phone']) . ' | ✉️ ' . htmlspecialchars($_POST['email']) . '</p>
      <p> ' . htmlspecialchars($_POST['linkedin']) . '</p>
      <p> ' . htmlspecialchars($_POST['address']) . '</p>
    </div>
  </div>

  <h2>ACADEMIC BACKGROUND</h2>
  <ul>
    <li><strong>BE - ' . htmlspecialchars($_POST['degree']) . '</strong>: ' . htmlspecialchars($_POST['be_percentage']) . '% (' . htmlspecialchars($_POST['be_year']) . ')</li>
    <li><strong>HSC - ' . htmlspecialchars($_POST['hsc_board']) . '</strong>: ' . htmlspecialchars($_POST['hsc_percentage']) . '% (' . htmlspecialchars($_POST['hsc_year']) . ')</li>
    <li><strong>SSLC - ' . htmlspecialchars($_POST['sslc_board']) . '</strong>: ' . htmlspecialchars($_POST['sslc_percentage']) . '% (' . htmlspecialchars($_POST['sslc_year']) . ')</li>
  </ul>

  <div class="columns">
    <div class="left-col">
      <h2>KEY STRENGTHS</h2>
      <ul>' . nl2li($_POST['strengths']) . '</ul>

      <h2>CERTIFICATIONS</h2>
      <ul>' . nl2li($_POST['certifications']) . '</ul>

      <h2>AREAS OF INTEREST</h2>
      <ul>' . nl2li($_POST['interests']) . '</ul>

      <h2>INTERNSHIPS/INDUSTRIAL VISIT</h2>
      <ul>' . nl2li($_POST['internships']) . '</ul>
    </div>

    <div class="right-col">
      <h2>CORE SKILLS</h2>
      <ul>' . nl2li($_POST['skills']) . '</ul>

      <h2>IT SKILLS</h2>
      <p><strong>Languages:</strong> ' . htmlspecialchars($_POST['languages']) . '<br>
         <strong>Software:</strong> ' . htmlspecialchars($_POST['software']) . '</p>

      <h2>PROJECTS</h2>
      <ul>
        <li><strong>Mini Project</strong> (' . htmlspecialchars($_POST['mini_year']) . ')<br>
            <strong>Title:</strong> ' . htmlspecialchars($_POST['mini_title']) . '<br>
            <strong>Description:</strong> ' . htmlspecialchars($_POST['mini_desc']) . '</li>
        <li><strong>Main Project</strong> (' . htmlspecialchars($_POST['main_year']) . ')<br>
            <strong>Title:</strong> ' . htmlspecialchars($_POST['main_title']) . '<br>
            <strong>Description:</strong> ' . htmlspecialchars($_POST['main_desc']) . '</li>
      </ul>

      <h2>CO-CURRICULAR ACTIVITIES</h2>
      <ul>' . nl2li($_POST['co_curricular']) . '</ul>

      <h2>EXTRA-CURRICULAR ACTIVITIES</h2>
      <ul>' . nl2li($_POST['extra_curricular']) . '</ul>
    </div>
  </div>
</div>
</body>
</html>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("resume.pdf", ["Attachment" => true]);
