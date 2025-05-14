<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>ResumeCraft - Create Resume</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: white;
            padding: 20px;
            color: black;
        }

        .container {
            width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ccc;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="number"], textarea {
            width: 100%;
            padding: 6px;
            margin: 5px 0 15px 0;
            border: 1px solid #999;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            height: 60px;
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .col {
            width: 48%;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Resume Builder</h1>
    <form action="result.php" method="POST" enctype="multipart/form-data">

        <label>Upload Profile Picture:</label>
        <input type="file" name="profile" required>

        <label>Full Name:</label>
        <input type="text" name="name" required>

        <label>Job Title:</label>
        <input type="text" name="job_title" required>

        <label>Phone Number:</label>
        <input type="text" name="phone" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>LinkedIn / GitHub / Portfolio:</label>
        <input type="text" name="linkedin">

        <label>Address:</label>
        <textarea name="address"></textarea>

        <div class="row">
            <div class="col">
                <label>Degree:</label>
                <input type="text" name="degree" placeholder="e.g., Electrical & Electronics Engineering">

                <label>BE Percentage:</label>
                <input type="text" name="be_percentage">
                <label>BE Year:</label>
                <input type="text" name="be_year">

                <label>HSC Board:</label>
                <input type="text" name="hsc_board">
                <label>HSC Percentage:</label>
                <input type="text" name="hsc_percentage">
                <label>HSC Year:</label>
                <input type="text" name="hsc_year">

                <label>SSLC Board:</label>
                <input type="text" name="sslc_board">
                <label>SSLC Percentage:</label>
                <input type="text" name="sslc_percentage">
                <label>SSLC Year:</label>
                <input type="text" name="sslc_year">
            </div>

            <div class="col">
                <label>Core Skills (one per line):</label>
                <textarea name="skills"></textarea>

                <label>Languages Known:</label>
                <input type="text" name="languages">

                <label>Software Known:</label>
                <input type="text" name="software">
            </div>
        </div>

        <label>Key Strengths (one per line):</label>
        <textarea name="strengths"></textarea>

        <label>Certifications (one per line):</label>
        <textarea name="certifications"></textarea>

        <label>Areas of Interest (one per line):</label>
        <textarea name="interests"></textarea>

        <label>Internships / Industrial Visits (one per line):</label>
        <textarea name="internships"></textarea>

        <label>Mini Project Title:</label>
        <input type="text" name="mini_title">
        <label>Mini Project Year:</label>
        <input type="text" name="mini_year">
        <label>Mini Project Description:</label>
        <textarea name="mini_desc"></textarea>

        <label>Main Project Title:</label>
        <input type="text" name="main_title">
        <label>Main Project Year:</label>
        <input type="text" name="main_year">
        <label>Main Project Description:</label>
        <textarea name="main_desc"></textarea>

        <label>Co-Curricular Activities (one per line):</label>
        <textarea name="co_curricular"></textarea>

        <label>Extra-Curricular Activities (one per line):</label>
        <textarea name="extra_curricular"></textarea>

        <input type="submit" value="Generate Resume">
    </form>
</div>
</body>
</html>