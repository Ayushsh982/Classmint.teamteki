<?php
$pdo = new PDO("mysql:host=127.0.0.1;dbname=u400773773_iVLZB;charset=utf8mb4", "u400773773_l22bd", "1iaRlX5haX");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$json_files = [
    'scienceTechnology.json',
    'businessEconomics.json',
    'historyCulture.json',
    'literatureArts.json',
    'environmentEcology.json',
    'politicsSociety.json',
    'psychologyBehaviour.json',
    'oddOneOut.json',
    'paraCompletion.json',
    'paraSummary.json',
    'paraJumble.json'
];

foreach ($json_files as $file) {
    if (!file_exists($file)) {
        echo "<p style='color:red;'>File not found: $file</p>";
        continue;
    }

    $json_data = file_get_contents($file);
    $data = json_decode($json_data, true);
    
    if (!isset($data['topicName'])) {
        echo "<p style='color:red;'>Error: 'topicName' missing in $file</p>";
        continue;
    }
    
    $topic_tag = $data['topicName']; 

    // SCENARIO 1: Reading Comprehension (Passages)
    if (isset($data['passages'])) {
        foreach ($data['passages'] as $passage) {
            $stmt = $pdo->prepare("INSERT INTO passages (passage_text, topic_tag, exam_tag) VALUES (?, ?, 'CAT')");
            $stmt->execute([$passage['text'], $topic_tag]);
            
            $passage_id = $pdo->lastInsertId();

            foreach ($passage['questions'] as $q) {
                $question_text = $q['prompt'] ?? $q['question'] ?? $q['text'] ?? null;
                
                if ($question_text === null) {
                    continue; 
                }

                $stmt_q = $pdo->prepare("
                    INSERT INTO CAT_questions 
                    (passage_id, va_context_id, question_text, option_a, option_b, option_c, option_d, correct_index, explanation, exam_tag, topic_tag) 
                    VALUES (?, NULL, ?, ?, ?, ?, ?, ?, ?, 'CAT', ?)
                ");
                
                $stmt_q->execute([
                    $passage_id,
                    $question_text,
                    $q['options'][0] ?? '', // Replaced null with empty string
                    $q['options'][1] ?? '',
                    $q['options'][2] ?? '',
                    $q['options'][3] ?? '',
                    $q['correct'] ?? '',
                    $q['explain'] ?? '',
                    $topic_tag
                ]);
            }
        }
        echo "<p style='color:green;'>Successfully imported RC passages and questions from: $file</p>";
    } 
    // SCENARIO 2: Verbal Ability (Standalone Questions)
    elseif (isset($data['questions'])) {
        
        // Extract the root instructions to use as the main question_text in CAT_questions
        $instructions = $data['instructions'] ?? 'Follow the instructions provided to answer the question.';
        
        foreach ($data['questions'] as $q) {
            
            // 1. Package the specific VA data into a JSON array for the new table
            $context_payload = [];
            if (isset($q['sentences'])) $context_payload['sentences'] = $q['sentences'];
            if (isset($q['passage'])) $context_payload['passage'] = $q['passage'];
            if (isset($q['segments'])) $context_payload['segments'] = $q['segments'];
            if (isset($q['missingSentence'])) $context_payload['missingSentence'] = $q['missingSentence'];
            
            $context_json = json_encode($context_payload);
            
            // 2. Insert into the new verbal_ability_contexts table
            $stmt_va = $pdo->prepare("INSERT INTO verbal_ability_contexts (topic_tag, context_data) VALUES (?, ?)");
            $stmt_va->execute([$topic_tag, $context_json]);
            
            // 3. Get the ID of the newly inserted context
            $va_context_id = $pdo->lastInsertId();

            // 4. Insert into CAT_questions, linking the va_context_id
            $stmt_q = $pdo->prepare("
                INSERT INTO CAT_questions 
                (passage_id, va_context_id, question_text, option_a, option_b, option_c, option_d, correct_index, explanation, exam_tag, topic_tag) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, 'CAT', ?)
            ");
            
            $stmt_q->execute([
                $va_context_id,
                $instructions,
                $q['options'][0] ?? '', // Replaced null with empty string
                $q['options'][1] ?? '',
                $q['options'][2] ?? '',
                $q['options'][3] ?? '',
                $q['correct'] ?? '',
                $q['explain'] ?? '',
                $topic_tag
            ]);
        }
        echo "<p style='color:green;'>Successfully imported Verbal Ability contexts and questions from: $file</p>";
    } else {
        echo "<p style='color:orange;'>No 'passages' or 'questions' array found in $file. Skipping.</p>";
    }
}

echo "<h3>All files processed! You may now delete them from Hostinger.</h3>";
?>