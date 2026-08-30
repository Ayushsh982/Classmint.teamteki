<?php 
require_once('wp-load.php'); 
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2 class="mb-4 fw-bold">JIPMAT 2026 Core Track</h2>
    
    <?php 
    // Data structure separated into two main categories
    $jipmat_data = [
        'Chapter-wise Mock Test' => [
            'Quantitative Aptitude' => ['Algebra', 'Number Systems', 'Arithmetic', 'Geometry & Mensuration', 'TSD & Time & Work', 'Probability & P&C', 'Data Interpretation'],
            'LRDI' => ['Verbal Reasoning', 'Non-Verbal Reasoning', 'Data Interpretation Sets'],
            'VARC' => ['Reading Comprehension', 'Grammar', 'Vocabulary', 'Para Jumbles']
        ],
        'Full Paper Mock Test' => [
            'Full Mocks' => ['Mock Paper-1', 'Mock Paper-2']
        ]
    ];

    foreach ($jipmat_data as $category => $subjects): ?>
        <h3 class="mt-5 mb-3 fw-bold text-primary"><?php echo $category; ?></h3>
        <hr class="mb-4">
        
        <?php foreach ($subjects as $subject => $topics): 
            $sub_id = preg_replace('/[^A-Za-z0-9]/', '', $subject);
        ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-dark text-white p-3" data-bs-toggle="collapse" 
                     data-bs-target="#sub_<?php echo $sub_id; ?>" style="cursor:pointer;" aria-expanded="false">
                    <h5 class="m-0">▼ <?php echo $subject; ?></h5>
                </div>
                
                <div id="sub_<?php echo $sub_id; ?>" class="collapse">
                    <div class="card-body">
                        <div class="row g-3">
                            <?php foreach ($topics as $topic): ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="card p-3 h-100 border-primary">
                                        <h6 class="fw-bold text-center"><?php echo $topic; ?></h6>
                                        <a href="quiz.php?topic=<?php echo urlencode($topic); ?>&exam=jipmat" 
                                           class="btn btn-primary btn-sm mt-2">Start Test</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>