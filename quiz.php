<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('wp-load.php');
if (!is_user_logged_in()) { wp_redirect(home_url('?action=login')); exit; }

$filter_topic = isset($_GET['topic']) ? trim(urldecode($_GET['topic'])) : '';

// --- QUICK FIX FOR PLURAL URL MISMATCH ---
if ($filter_topic === 'Para Jumbles') {
    $filter_topic = 'Para Jumble';
}

$exam_type = isset($_GET['exam']) ? $_GET['exam'] : 'cuet';
$table = 'wp_custom_question_bank'; // Default fallback

if ($exam_type == 'jee') {
    $table = 'wp_jee_question_bank';
} elseif ($exam_type == 'NEET') {
    $table ='wp_jipmat_question_bank';
} elseif ($exam_type == 'CAT') {
    $table ='CAT_questions';
} elseif ($exam_type == 'jipmat') {
    $table ='wp_jipmat_question_bank';
}

$test_seed = isset($_POST['test_seed']) ? (int)$_POST['test_seed'] : mt_rand(10000, 99999);

function getShuffledQuestionData($row, $seed) {
    // TITA CHECK: If option_a is empty, this is a Type-In-The-Answer question (no shuffling possible)
    if (empty($row['option_a'])) {
        return [
            'options' => [], // Empty array triggers text input on frontend
            'new_correct_index' => $row['correct_index'] // Pass raw answer like "4132" or "4"
        ];
    }

    $original = [$row['option_a'], $row['option_b'], $row['option_c'], $row['option_d']];
    
    // Failsafe for standard options
    $idx = (int)$row['correct_index'];
    if ($idx < 0 || $idx > 3) $idx = 0; 
    $correct_text = $original[$idx];
    
    mt_srand($seed + (int)$row['id']);
    
    $shuffled = $original;
    for ($i = count($shuffled) - 1; $i > 0; $i--) {
        $j = mt_rand(0, $i);
        $tmp = $shuffled[$i];
        $shuffled[$i] = $shuffled[$j];
        $shuffled[$j] = $tmp;
    }
    mt_srand(); 
    
    $new_index = array_search($correct_text, $shuffled);
    
    return [
        'options' => [
            'A' => $shuffled[0],
            'B' => $shuffled[1],
            'C' => $shuffled[2],
            'D' => $shuffled[3]
        ],
        'new_correct_index' => $new_index
    ];
}

$selected_questions = [];
$conn = new mysqli("127.0.0.1", "u400773773_l22bd", "1iaRlX5haX", "u400773773_iVLZB");
if ($conn->connect_error) { die("Database connection failure."); }

$is_submit_exam = ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_exam']));
$posted_question_ids = [];

if ($is_submit_exam && !empty($_POST['selected_question_ids'])) {
    $decoded = json_decode(stripslashes($_POST['selected_question_ids']), true);
    if (is_array($decoded)) {
        $posted_question_ids = array_values(array_map('intval', $decoded));
    }
}

$is_cat = ($table === 'CAT_questions');
$select_base = $is_cat
    ? "SELECT q.id, q.question_text, q.option_a, q.option_b, q.option_c, q.option_d, q.correct_index, q.explanation, q.topic_tag, p.passage_text, vac.context_data 
       FROM $table q 
       LEFT JOIN passages p ON q.passage_id = p.id 
       LEFT JOIN verbal_ability_contexts vac ON q.va_context_id = vac.id"
    : "SELECT id, question_text, option_a, option_b, option_c, option_d, correct_index, explanation, topic_tag, NULL as passage_text, NULL as context_data 
       FROM $table";

if ($is_submit_exam && !empty($posted_question_ids)) {
    $idList = implode(',', $posted_question_ids);
    $where = $is_cat ? "WHERE q.id IN ($idList)" : "WHERE id IN ($idList)";
    $sql = "$select_base $where";
    
    $result = $conn->query($sql);
    
    $rowById = [];
    while ($row = $result->fetch_assoc()) {
        $rowById[(int)$row['id']] = $row;
    }

    $selected_questions = [];
    foreach ($posted_question_ids as $qid) {
        if (!isset($rowById[$qid])) continue;
        $row = $rowById[$qid];
        
        $shuffledData = getShuffledQuestionData($row, $test_seed);
        
        $selected_questions[] = [
            'id' => $row['id'],
            'category' => $row['topic_tag'],
            'passage_text' => isset($row['passage_text']) ? $row['passage_text'] : null,
            'context_data' => isset($row['context_data']) ? json_decode($row['context_data'], true) : null,
            'question' => $row['question_text'],
            'answer' => $shuffledData['new_correct_index'], 
            'explanation' => $row['explanation'],
            'options' => $shuffledData['options'] 
        ];
    }
} elseif (!empty($filter_topic)) {
    $subject = $conn->real_escape_string($filter_topic);
    
    $rc_topics = [
        'Science & Technology', 'Business & Economics', 'History & Culture', 
        'Literature & Arts', 'Philosophy & Ethics', 'Politics & Society', 
        'Psychology & Behaviour', 'Environment & Ecology'
    ];
    $va_topics = ['Para Jumble', 'Odd One Out', 'Para Summary', 'Para Completion']; 
    
    $is_rc_topic = ($table === 'CAT_questions' && in_array($subject, $rc_topics));
    $is_varc_section = ($table === 'CAT_questions' && (in_array($subject, $rc_topics) || in_array($subject, $va_topics)));
    
    $timer_minutes = $is_varc_section ? 30 : 60;
    
    if (strpos($subject, 'Mock Paper') !== false) {
        $where = $is_cat ? "WHERE q.exam_tag = 'JIPMAT'" : "WHERE exam_tag = 'JIPMAT'";
        $sql = "$select_base $where ORDER BY RAND() LIMIT 50";
        
    } elseif ($is_rc_topic) {
        $sql = "SELECT q.id, q.question_text, q.option_a, q.option_b, q.option_c, q.option_d, q.correct_index, q.explanation, q.topic_tag, p.passage_text, vac.context_data
                FROM $table q
                LEFT JOIN passages p ON q.passage_id = p.id
                LEFT JOIN verbal_ability_contexts vac ON q.va_context_id = vac.id
                WHERE q.topic_tag = '$subject'
                ORDER BY p.id ASC, q.id ASC
                LIMIT 35";
                
    } else {
        $where = $is_cat ? "WHERE q.topic_tag = '$subject'" : "WHERE topic_tag = '$subject'";
        $sql = "$select_base $where ORDER BY RAND() LIMIT 50";
    }
            
    $result = $conn->query($sql);
    
    if (!$result) {
        die("SQL Error: " . $conn->error);
    }
    
    while ($row = $result->fetch_assoc()) {
        $shuffledData = getShuffledQuestionData($row, $test_seed);
        
        $selected_questions[] = [
            'id' => $row['id'], 
            'category' => $row['topic_tag'], 
            'passage_text' => isset($row['passage_text']) ? $row['passage_text'] : null,
            'context_data' => isset($row['context_data']) ? json_decode($row['context_data'], true) : null,
            'question' => $row['question_text'],
            'answer' => $shuffledData['new_correct_index'], 
            'explanation' => $row['explanation'],
            'options' => $shuffledData['options'] 
        ];
    }
}
$conn->close();

if (empty($selected_questions)) {
    die("No questions found.");
}

$total_qs = count($selected_questions);

// SUBMISSION LOGIC
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_exam'])) {
    $results_data = []; 
    $right_count = 0; $wrong_count = 0; $unanswered_count = 0;
    $positive_marks = 5; $negative_marks = 1; 

    foreach ($selected_questions as $index => $q) {
        $input_name_radio = 'temp_radio_' . $index;
        $input_name_text = 'temp_text_' . $index;
        
        $user_ans = '';
        if (isset($_POST[$input_name_radio])) {
            $user_ans = strtoupper(trim($_POST[$input_name_radio]));
        } elseif (isset($_POST[$input_name_text])) {
            $user_ans = trim($_POST[$input_name_text]);
        }
        
        // TITA SCORING (No options)
        if (empty($q['options'])) {
            $correct_ans = (string)$q['answer'];
            if ($user_ans === '') { $unanswered_count++; }
            elseif ($user_ans === $correct_ans) { $right_count++; }
            else { $wrong_count++; }
            
            $results_data[] = [
                'question' => $q['question'],
                'user_ans' => $user_ans,
                'correct_ans' => $correct_ans
            ];
        } 
        // MCQ SCORING
        else {
            $map = [0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D'];
            $correct_ans = $map[$q['answer']] ?? 'N/A';
            
            $results_data[] = [
                'question' => $q['question'],
                'user_ans' => $user_ans,
                'correct_ans' => $correct_ans
            ];
            
            $letter_to_index = ['A' => 0, 'B' => 1, 'C' => 2, 'D' => 3];
            $user_ans_index = isset($letter_to_index[$user_ans]) ? $letter_to_index[$user_ans] : -1;
            
            if ($user_ans === '') { $unanswered_count++; }
            elseif ($user_ans_index === (int)$q['answer']) { $right_count++; }
            else { $wrong_count++; }
        }
    }
    
    $max_possible_score = $total_qs * $positive_marks;
    $aggregate_score = ($right_count * $positive_marks) - ($wrong_count * $negative_marks);
    
    $total_test_time = array_sum(json_decode(stripslashes($_POST['time_spent_metrics'] ?? '[]'), true) ?: [0]);
    $simulated_rank = rand(1, 500); 
    $strengths = ['Basic Concepts']; 
    $weaknesses = ['Speed'];
    $current_user_id = get_current_user_id();

    $current_user = wp_get_current_user();
    $user_name = $current_user->user_login; 

    $db = new mysqli("127.0.0.1", "u400773773_l22bd", "1iaRlX5haX", "u400773773_iVLZB");
    $stmt = $db->prepare("INSERT INTO wp_exam_results (user_name, exam_type, topic_tag, score, total_marks) VALUES (?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssii", $user_name, $exam_type, $filter_topic, $aggregate_score, $max_possible_score);
        $stmt->execute();
        $stmt->close();
    }
    $db->close();

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"><title>Performance Analytics — ClassMint</title>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; background: #FAFCFF; color: #0A1128; padding: 50px 20px; margin: 0; -webkit-font-smoothing: antialiased; }
            .cm-analysis-container { max-width: 950px; margin: 0 auto; background: #ffffff; border: 1px solid #EAEFF8; border-radius: 20px; padding: 45px; box-shadow: 0 20px 50px rgba(7, 17, 51, 0.03); }
            .cm-results-header { border-bottom: 1px solid #EAEFF8; padding-bottom: 30px; margin-bottom: 40px; }
            .cm-results-header h2 { font-size: 32px; font-weight: 800; color: #0A1128; margin: 0; }
            .cm-score-hero-card { background: linear-gradient(135deg, #3B4CB4 0%, #2E3C96 100%); border-radius: 16px; padding: 35px; color: #ffffff; display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; }
            .cm-score-meta p { font-size: 54px; font-weight: 800; margin: 0; }
            .cm-score-meta p span { font-size: 20px; color: rgba(255,255,255,0.6); }
            .cm-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 15px; margin-bottom: 40px; }
            .cm-stat-box { background: #FAFCFF; border: 1px solid #EAEFF8; padding: 22px 15px; border-radius: 14px; text-align: center; }
            .cm-stat-box h4 { font-size: 12px; font-weight: 700; color: #5C6B8E; margin: 0 0 8px 0; text-transform: uppercase; }
            .cm-stat-box p { font-size: 26px; font-weight: 800; margin: 0; }
            .cm-insights-panel { background: #FAFCFF; border: 1px solid #EAEFF8; border-radius: 16px; padding: 35px; }
            .cm-tag-row { display: flex; gap: 10px; margin-bottom: 25px; align-items: center; }
            .cm-insight-tag { font-size: 13px; font-weight: 700; padding: 6px 14px; border-radius: 50px; }
            .cm-insight-tag.strength { background: rgba(16, 185, 129, 0.1); color: #10B981; }
            .cm-insight-tag.weakness { background: rgba(239, 68, 68, 0.1); color: #EF4444; }
            .cm-recommendation-banner { background: rgba(243, 160, 51, 0.06); border-left: 4px solid #F3A033; padding: 20px 25px; border-radius: 8px; margin-top: 25px; }
            .cm-btn-return { display: inline-block; text-decoration: none; background: #3B4CB4; color: #fff; font-weight: 700; padding: 15px 35px; border-radius: 10px; }
        </style>
    </head>
    <body>
        <div class="cm-analysis-container">
            <div class="cm-results-header"><h2>Performance Report Analytics</h2></div>
            
            <div class="cm-score-hero-card">
                <div class="cm-score-meta"><p><?php echo $aggregate_score; ?> <span>/ <?php echo $max_possible_score; ?> Marks</span></p></div>
                <div><span style="font-size: 24px; font-weight: 700; color: #F3A033;"><?php echo $total_qs > 0 ? round(($right_count / $total_qs) * 100, 1) : 0; ?>%</span></div>
            </div>

            <div class="cm-stats-grid">
                <div class="cm-stat-box" style="border-bottom: 3px solid #10B981;"><h4>Right Answers</h4><p style="color:#10B981;"><?php echo $right_count; ?></p></div>
                <div class="cm-stat-box" style="border-bottom: 3px solid #EF4444;"><h4>Wrong Answers</h4><p style="color:#EF4444;"><?php echo $wrong_count; ?></p></div>
                <div class="cm-stat-box" style="border-bottom: 3px solid #64748B;"><h4>Unattempted</h4><p style="color:#64748B;"><?php echo $unanswered_count; ?></p></div>
                <div class="cm-stat-box" style="border-bottom: 3px solid #3B4CB4;"><h4>Avg Time</h4><p><?php echo round($total_test_time / max(1, ($total_qs - $unanswered_count))); ?>s</p></div>
                <div class="cm-stat-box" style="border-bottom: 3px solid #F3A033;"><h4>All India Rank</h4><p style="color:#F3A033;">#<?php echo number_format($simulated_rank); ?></p></div>
            </div>

            <div class="cm-insights-panel">
                <div class="cm-tag-row"><span>Strengths:</span><?php foreach($strengths as $s): ?><span class="cm-insight-tag strength"><?php echo esc_html($s); ?></span><?php endforeach; ?></div>
                <div class="cm-tag-row"><span>Weaknesses:</span><?php foreach($weaknesses as $w): ?><span class="cm-insight-tag weakness"><?php echo esc_html($w); ?></span><?php endforeach; ?></div>
                
                <h4 style="margin: 20px 0 10px 0; border-top: 1px solid #EAEFF8; padding-top: 15px;">Detailed Question Review</h4>
                <div style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
                    <?php foreach ($results_data as $i => $data): ?>
                        <div style="margin-bottom: 12px; font-size: 14px; padding: 10px; background: #fff; border-radius: 8px; border: 1px solid #EAEFF8;">
                            <strong>Q<?php echo $i+1; ?>:</strong> <?php echo htmlspecialchars($data['question']); ?><br>
                            <span style="color: <?php echo ($data['user_ans'] === $data['correct_ans']) ? '#10B981' : '#EF4444'; ?>">
                                Your Answer: <strong><?php echo $data['user_ans'] ?: 'Unanswered'; ?></strong>
                            </span> 
                            <span style="color: #64748B; margin-left: 10px;">| Correct: <strong><?php echo $data['correct_ans']; ?></strong></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if(!empty($weaknesses)): ?>
                    <div class="cm-recommendation-banner" style="margin-top:20px;"><strong>Action Target Plan:</strong> You need to practice at least 3-4 more mock setups tracking across: <?php echo esc_html(implode(', ', $weaknesses)); ?>.</div>
                <?php endif; ?>
            </div>
            <a href="/our-courses" target="_self" class="cm-btn-return">Return to Dashboard</a>
            <a href="/practice" target="_self" class="cm-btn-return">Return to Practice</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulation Engine Workspace</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body { margin: 0 !important; padding: 0 !important; width: 100vw !important; max-width: 100vw !important; overflow-x: hidden !important; font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FAFCFF; }
        .cm-exam-container { display: grid; grid-template-columns: 1fr 340px; width: 100vw; min-height: 100vh; }
        .cm-main-panel { padding: 40px; display: flex; flex-direction: column; justify-content: space-between; background: #FAFCFF; }
        .cm-exam-title-bar { background: #071133; color: #fff; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; border-radius: 8px; margin-bottom: 30px; }
        .cm-exam-title-bar h3 { margin: 0; font-size: 18px; font-weight: 700; }
        .cm-timer-badge { background: rgba(243, 160, 51, 0.15); color: #F3A033; padding: 10px 20px; font-weight: 700; border-radius: 6px; border: 1px solid #F3A033; }
        .cm-question-view-wrapper { display: none; background: #fff; border: 1px solid #EAEFF8; border-radius: 12px; padding: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.01); }
        .cm-question-view-wrapper.active { display: block; }
        .cm-q-meta-label { color: #8C9AB8; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 15px; }
        .cm-passage-box { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 20px; margin-bottom: 25px; max-height: 250px; overflow-y: auto; font-size: 15px; line-height: 1.6; color: #334155; }
        .cm-question-prompt { font-size: 19px; font-weight: 700; margin: 0 0 30px 0; line-height: 1.6; }
        .cm-options-stack { display: flex; flex-direction: column; gap: 14px; }
        
        /* TITA Input Box */
        .cm-tita-input { width: 100%; max-width: 320px; padding: 15px; border: 2px solid #EAEFF8; border-radius: 8px; font-size: 16px; font-weight: 700; color: #0A1128; outline: none; transition: border-color 0.2s; font-family: inherit; }
        .cm-tita-input:focus { border-color: #3B4CB4; }

        .cm-option-row { display: flex; align-items: center; border: 1px solid #EAEFF8; padding: 18px 24px; border-radius: 8px; cursor: pointer; transition: all 0.2s; font-weight: 500; color: #4A597A; }
        .cm-option-row:hover { border-color: #3B4CB4; background: rgba(59,76,180,0.02); }
        .cm-option-row.selected { border-color: #3B4CB4; background: rgba(59,76,180,0.06); color: #3B4CB4; font-weight: 700; }
        .cm-option-row input { margin-right: 15px; accent-color: #3B4CB4; transform: scale(1.1); }
        .cm-control-action-bar { display: flex; justify-content: space-between; margin-top: 40px; background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #EAEFF8; }
        .btn-action { font-family: inherit; font-weight: 700; padding: 12px 24px; border-radius: 6px; cursor: pointer; font-size: 14px; }
        .btn-outline { background: #fff; border: 1px solid #D2DCF0; color: #5C6B8E; }
        .btn-outline:hover { border-color: #3B4CB4; color: #3B4CB4; }
        .btn-warning { background: #FFF9E6; border: 1px solid #F3A033; color: #F3A033; }
        .btn-warning:hover { background: #F3A033; color: #fff; }
        .btn-primary { background: #3B4CB4; border: 1px solid #3B4CB4; color: #fff; }
        .btn-primary:hover { background: #2E3C96; }
        .cm-sidebar-navigator { background: #fff; border-left: 1px solid #EAEFF8; padding: 40px 25px; display: flex; flex-direction: column; }
        .cm-nav-grid-title { font-size: 15px; font-weight: 700; margin: 0 0 20px 0; color: #071133; }
        .cm-question-grid-matrix { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-bottom: 40px; }
        .cm-matrix-cell { aspect-ratio: 1; border: 1px solid #EAEFF8; background: #FAFCFF; color: #4A597A; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; border-radius: 6px; cursor: pointer; }
        .cm-matrix-cell.answered { background: #10B981 !important; color: #fff !important; border-color: #10B981 !important; }
        .cm-matrix-cell.marked { background: #F3A033 !important; color: #fff !important; border-color: #F3A033 !important; }
        .cm-matrix-cell.active-cell { background: #3B4CB4 !important; color: #fff !important; border-color: #3B4CB4 !important; }
        .cm-legend-stack { display: flex; flex-direction: column; gap: 12px; font-size: 13px; font-weight: 600; color: #5C6B8E; flex-grow: 1; }
        .cm-legend-item { display: flex; align-items: center; gap: 12px; }
        .cm-bullet { width: 14px; height: 14px; border-radius: 4px; display: inline-block; }
        .btn-submit-test { width: 100%; background: #3B4CB4; color: #fff; border: none; padding: 16px; border-radius: 8px; font-weight: 700; font-size: 15px; cursor: pointer; box-shadow: 0 8px 20px rgba(59,76,180,0.15); }
    </style>
</head>
<body>

<form id="cmGlobalExamForm" method="POST" action="">
    <input type="hidden" name="submit_exam" value="1">
    <input type="hidden" name="selected_question_ids" value='<?php echo esc_attr(json_encode(array_column($selected_questions, "id"))); ?>'>
    <input type="hidden" name="test_seed" value="<?php echo $test_seed; ?>">
    <input type="hidden" id="cmTimeMetricsInput" name="time_spent_metrics" value="">
    <input type="hidden" id="cmCompiledAnswersJSON" name="compiled_answers_json" value="{}">

    <div class="cm-exam-container">
       <div class="cm-main-panel">
            <div class="cm-exam-title-bar">
                <h3><?php echo htmlspecialchars($filter_topic); ?> Simulation Desk</h3>
               <div class="cm-timer-badge" id="cmClockTimer"><?php echo isset($timer_minutes) ? $timer_minutes : 60; ?>:00</div>
            </div>

            <div class="cm-quiz-cards-viewport">
                <?php foreach ($selected_questions as $index => $q): ?>
                    <?php $q_id = $q['id']; ?>
                    <div class="cm-question-view-wrapper <?php echo $index === 0 ? 'active' : ''; ?>" id="q-card-<?php echo $index; ?>" data-qindex="<?php echo $index; ?>" data-qid="<?php echo $q_id; ?>">
                        <div class="cm-q-meta-label">Question <?php echo ($index + 1); ?> of <?php echo $total_qs; ?> — <span style="color:#3B4CB4;"><?php echo esc_html($q['category']); ?></span></div>
                        
                        <?php if (!empty($q['passage_text'])): ?>
                            <div class="cm-passage-box">
                                <strong style="color: #0A1128;">Reading Passage:</strong><br/><br/>
                                <?php echo nl2br(esc_html($q['passage_text'])); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($q['context_data'])): ?>
                            <?php $va = $q['context_data']; ?>
                            <div class="cm-passage-box" style="border-left: 4px solid #3B4CB4; background: #fff;">
                                <?php if (!empty($va['passage'])): ?>
                                    <strong style="color: #0A1128;">Read the following paragraph:</strong><br/><br/>
                                    <?php echo nl2br(esc_html($va['passage'])); ?>
                                <?php endif; ?>

                                <?php if (!empty($va['sentences'])): ?>
                                    <strong style="color: #0A1128;">Consider the following sentences:</strong><br/><br/>
                                    <?php foreach ($va['sentences'] as $s_idx => $sentence): ?>
                                        <div style="margin-bottom: 8px;"><strong>(<?php echo $s_idx + 1; ?>)</strong> <?php echo esc_html($sentence); ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if (!empty($va['segments']) && !empty($va['missingSentence'])): ?>
                                    <strong style="color: #0A1128;">Missing Sentence:</strong><br/>
                                    <div style="background: #FFF9E6; padding: 12px; border-radius: 6px; margin: 10px 0 20px 0; border: 1px solid #F3A033;">
                                        <em>"<?php echo esc_html($va['missingSentence']); ?>"</em>
                                    </div>
                                    <strong style="color: #0A1128;">Paragraph Context:</strong><br/><br/>
                                    <?php foreach ($va['segments'] as $seg_idx => $segment): ?>
                                        <?php if ($seg_idx > 0): ?>
                                            <span style="display:inline-block; background:#3B4CB4; color:#fff; border-radius:50%; width:22px; height:22px; text-align:center; line-height:22px; font-size:12px; margin: 0 5px; font-weight:bold;">
                                                <?php echo $seg_idx; ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php echo esc_html($segment); ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <p class="cm-question-prompt">
                            <?php echo esc_html($q['question']); ?>
                        </p>
                        
                        <div class="cm-options-stack">
                            <?php if (empty($q['options'])): ?>
                                <!-- TITA TEXT INPUT BOX -->
                                <div style="padding: 10px 0;">
                                    <label style="font-weight: 600; color: #4A597A; display: block; margin-bottom: 10px;">Type your answer below:</label>
                                    <input type="text" name="temp_text_<?php echo $index; ?>" class="cm-tita-input" 
                                           oninput="selectExamOptionTITA('<?php echo $q_id; ?>', this.value, <?php echo $index; ?>)" 
                                           placeholder="E.g., 4132 or 4">
                                </div>
                            <?php else: ?>
                                <!-- STANDARD RADIO BUTTONS -->
                                <?php foreach ($q['options'] as $key => $val): ?>
                                    <label class="cm-option-row" onclick="selectExamOption('<?php echo $q_id; ?>', '<?php echo $key; ?>', <?php echo $index; ?>)">
                                        <input type="radio" name="temp_radio_<?php echo $index; ?>" value="<?php echo $key; ?>">
                                        <span><strong><?php echo $key; ?>:</strong> <?php echo esc_html($val); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cm-control-action-bar">
                <button type="button" class="btn-action btn-outline" onclick="navigateQuestion(-1)">&larr; Previous</button>
                <div>
                    <button type="button" class="btn-action btn-warning" onclick="markForReview()">Mark for Review</button>
                    <button type="button" class="btn-action btn-outline" onclick="clearActiveSelection()" style="margin-left: 10px;">Clear</button>
                </div>
                <button type="button" class="btn-action btn-primary" onclick="navigateQuestion(1)">Save & Next &rarr;</button>
            </div>
        </div>

        <div class="cm-sidebar-navigator">
            <h4 class="cm-nav-grid-title">Question Navigator</h4>
            <div class="cm-question-grid-matrix">
                <?php for ($i = 0; $i < $total_qs; $i++): ?>
                    <div class="cm-matrix-cell <?php echo $i === 0 ? 'active-cell' : ''; ?>" id="cell-<?php echo $i; ?>" onclick="jumpToQuestion(<?php echo $i; ?>)">
                        <?php echo ($i + 1); ?>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="cm-legend-stack">
                <div class="cm-legend-item"><span class="cm-bullet" style="background:#10B981;"></span> Answered</div>
                <div class="cm-legend-item"><span class="cm-bullet" style="background:#F3A033;"></span> Marked for Review</div>
                <div class="cm-legend-item"><span class="cm-bullet" style="background:#3B4CB4;"></span> Current Question</div>
            </div>
            
            <button type="button" class="btn-submit-test" onclick="triggerExamSubmission()">Submit Test</button>
        </div>
    </div>
</form>

<script>
    let violationCount = 0;
    const maxViolations = 2; 
    let isSubmitting = false;

    function handleViolation() {
        if (isSubmitting) return;
        violationCount++;
        
        if (violationCount >= maxViolations) {
            isSubmitting = true;
            alert("Violation limit reached. Your exam is now being submitted automatically.");
            forceSubmitExam();
        } else {
            alert("WARNING: Tab switching detected! This is warning " + violationCount + " of 2. On the next violation, your exam will be automatically submitted.");
        }
    }

    function forceSubmitExam() {
        updateActiveQuestionTimeTime();
        clearInterval(timerInterval);
        
        const form = document.getElementById('cmGlobalExamForm');
        document.getElementById('cmTimeMetricsInput').value = JSON.stringify(timeSpentTracker);
        
        const autoInput = document.createElement("input");
        autoInput.type = "hidden";
        autoInput.name = "auto_submitted";
        autoInput.value = "1";
        form.appendChild(autoInput);
        
        form.submit();
    }

    document.addEventListener("visibilitychange", () => {
        if (document.hidden) handleViolation();
    });

    window.addEventListener("blur", () => {
        if (document.hidden) handleViolation();
    });

    let currentActiveIndex = 0; 
    const totalQuestionsCount = <?php echo $total_qs; ?>; 
    let timeLimitSeconds = <?php echo isset($timer_minutes) ? $timer_minutes : 60; ?> * 60;
    let masterAnswersObject = {}; 
    let timeSpentTracker = Array(totalQuestionsCount).fill(0); 
    let questionActiveTimestamp = Date.now();

    const timerInterval = setInterval(() => {
        timeLimitSeconds--;
        let minutes = Math.floor(timeLimitSeconds / 60); 
        let seconds = timeLimitSeconds % 60;
        document.getElementById('cmClockTimer').textContent = (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
        if (timeLimitSeconds <= 0) { clearInterval(timerInterval); triggerExamSubmission(); }
    }, 1000);

    function updateActiveQuestionTimeTime() {
        let now = Date.now(); 
        let secondsPassed = Math.floor((now - questionActiveTimestamp) / 1000);
        if(currentActiveIndex < totalQuestionsCount) { timeSpentTracker[currentActiveIndex] += secondsPassed; }
        questionActiveTimestamp = now;
    }

    function selectExamOption(questionId, selectedValue, questionIndex) {
        const card = document.getElementById(`q-card-${questionIndex}`);
        const radioInput = card.querySelector(`input[value="${selectedValue}"]`);
        if (radioInput) radioInput.checked = true;

        masterAnswersObject[questionId] = selectedValue;

        const rows = card.getElementsByClassName('cm-option-row');
        for (let row of rows) {
            row.classList.remove('selected');
        }
        event.currentTarget.classList.add('selected');

        const cell = document.getElementById(`cell-${questionIndex}`);
        if (cell) cell.classList.add('answered'); 
    }

    // NEW LOGIC: Marks cell as answered when typing in TITA text box
    function selectExamOptionTITA(questionId, textValue, questionIndex) {
        masterAnswersObject[questionId] = textValue;
        const cell = document.getElementById(`cell-${questionIndex}`);
        if (textValue.trim() !== '') {
            if (cell) cell.classList.add('answered'); 
        } else {
            if (cell) cell.classList.remove('answered');
        }
    }

    function jumpToQuestion(targetIndex) {
        if (targetIndex < 0 || targetIndex >= totalQuestionsCount) return;
        
        const currentCard = document.getElementById(`q-card-${currentActiveIndex}`);
        const checked = currentCard.querySelector('input[type="radio"]:checked');
        if (checked) {
            const qId = currentCard.getAttribute('data-qid');
            masterAnswersObject[qId] = checked.value;
        }

        updateActiveQuestionTimeTime();
        document.getElementById(`q-card-${currentActiveIndex}`).classList.remove('active');
        document.getElementById(`cell-${currentActiveIndex}`).classList.remove('active-cell');
        
        currentActiveIndex = targetIndex;
        
        document.getElementById(`q-card-${currentActiveIndex}`).classList.add('active');
        document.getElementById(`cell-${currentActiveIndex}`).classList.add('active-cell');
    }

    function navigateQuestion(direction) {
        let nextTarget = currentActiveIndex + direction;
        jumpToQuestion(nextTarget);
    }

    function markForReview() {
        const cell = document.getElementById('cell-' + currentActiveIndex);
        cell.classList.add('marked'); 
        navigateQuestion(1);
    }

    function clearActiveSelection() {
        const card = document.getElementById(`q-card-${currentActiveIndex}`);
        const qId = card.getAttribute('data-qid');
        delete masterAnswersObject[qId];
        
        // Clear Radio
        const checkedInput = card.querySelector('input[type="radio"]:checked'); 
        if (checkedInput) checkedInput.checked = false;
        const rows = card.getElementsByClassName('cm-option-row'); 
        for (let row of rows) row.classList.remove('selected');
        
        // Clear TITA Text Input
        const textInput = card.querySelector('input[type="text"]');
        if (textInput) textInput.value = '';

        const cell = document.getElementById(`cell-${currentActiveIndex}`); 
        cell.classList.remove('marked', 'answered');
    }

    function triggerExamSubmission() {
        if (confirm("Are you certain you want to submit your exam?")) {
            updateActiveQuestionTimeTime();
            clearInterval(timerInterval);
            
            document.getElementById('cmTimeMetricsInput').value = JSON.stringify(timeSpentTracker);
            document.getElementById('cmGlobalExamForm').submit();
        }
    }
</script>
</body>
</html>