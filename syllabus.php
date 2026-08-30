<?php
require_once('wp-load.php');
if (!is_user_logged_in()) { wp_redirect(home_url('?action=login')); exit; }

$exam = isset($_GET['exam']) ? $_GET['exam'] : 'cuet';
$exam_title = ($exam === 'jeemain') ? 'JEE MAINS 2026 Core Track' : 'CUET 2026 Examination Track';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Syllabus Directory — ClassMint</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FAFCFF; color: #0A1128; margin: 0; padding: 40px; -webkit-font-smoothing: antialiased; }
        .container { max-width: 1100px; margin: 0 auto; }
        h2 { font-size: 32px; font-weight: 800; margin: 0 0 8px 0; color: #071133; letter-spacing: -0.5px; }
        p { color: #5C6B8E; font-size: 16px; margin: 0 0 40px 0; }
        .subject-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.02); border: 1px solid #EAEFF8; }
        .subject-table th { background: #071133; color: #fff; text-align: left; padding: 18px 24px; font-size: 14px; font-weight: 700; text-transform: uppercase; }
        .subject-table td { padding: 18px 24px; border-bottom: 1px solid #EAEFF8; font-size: 15px; color: #4A597A; }
        .subject-table tr:last-child td { border-bottom: none; }
        .subject-table tr:hover { background: #FAFCFF; }
        .subject-link { color: #3B4CB4; text-decoration: none; font-weight: 700; transition: color 0.2s; }
        .subject-link:hover { color: #2E3C96; text-decoration: underline; }
        .tag { background: #F1F4FA; color: #5C6B8E; padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo $exam_title; ?></h2>
        <p>Select an active curriculum chapter node beneath to enter your mock test workspace environment in this same tab window view.</p>
        
        <table class="subject-table">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Subject Code</th>
                    <th>Subject Curriculum Track</th>
                    <th>Specification Type</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($exam === 'cuet'): ?>
                    <tr>
                        <td>1</td>
                        <td>101</td>
                        <td><a href="quiz.php?topic=English" target="_self" class="subject-link">Section IA: English Language Mock Test</a></td>
                        <td><span class="tag">Language Core</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>319</td>
                        <td><a href="quiz.php?topic=Mathematics" target="_self" class="subject-link">Section II: Domain Mathematics Full Simulation</a></td>
                        <td><span class="tag">Domain Mandatory</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>304</td>
                        <td><a href="quiz.php?topic=Business Studies" target="_self" class="subject-link">Section II: Domain Business Studies Full Simulation</a></td>
                        <td><span class="tag">Domain Mandatory</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>322</td>
                        <td><a href="quiz.php?topic=Physics" target="_self" class="subject-link">Section II: Domain Physics Full Simulation</a></td>
                        <td><span class="tag">Domain Mandatory</span></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>301</td>
                        <td><a href="quiz.php?topic=Accountancy" target="_self" class="subject-link">Section II: Domain Accountancy Full Simulation</a></td>
                        <td><span class="tag">Domain Mandatory</span></td>
                    </tr>
                    <tr>
    <td>6</td>
    <td>501</td>
    <td><a href="quiz.php?topic=GAT&exam=cuet">Section III: General Aptitude Test (GAT) Simulation</a></td>
    <td><span class="badge bg-secondary">Domain Mandatory</span></td>
</tr>
                <?php else: ?>
                    <tr>
                        <td>1</td>
                        <td>JE-M01</td>
                        <td><a href="quiz.php?topic=Mathematics" target="_self" class="subject-link">Advanced Main Mathematics Tracker</a></td>
                        <td><span class="tag">Quantitative Core</span></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>