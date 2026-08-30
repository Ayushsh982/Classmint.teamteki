<?php 
require_once('wp-load.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>JEE MAINS 2026 Core Track</title>
    
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
      
      .cm-navbar { 
          font-family: 'Plus Jakarta Sans', sans-serif; 
          -webkit-font-smoothing: antialiased;
          display: flex; 
          justify-content: space-between; 
          align-items: center; 
          background-color: #ffffff; 
          padding: 20px 8%; 
          border-bottom: 1px solid #EAEFF8; 
      }
      .cm-nav-logo { font-size: 24px; font-weight: 500; color: #0A1128; display: flex; align-items: center; }
      .cm-nav-logo .logo-bold { font-weight: 800; color: #3B4CB4; }
      .cm-nav-logo .logo-dot { color: #F3A033; font-size: 32px; line-height: 0; margin-left: 2px; }
      .cm-nav-menu { display: flex; gap: 32px; margin: 0; padding: 0; list-style: none; }
      .cm-nav-menu .menu-item { text-decoration: none; color: #5C6B8E; font-weight: 500; font-size: 15px; transition: color 0.2s ease; }
      .cm-nav-menu .menu-item:hover, .cm-nav-menu .menu-item.active { color: #3B4CB4; }
      .cm-nav-auth { display: flex; align-items: center; gap: 16px; }
      .btn-login { text-decoration: none; color: #3B4CB4; font-weight: 600; font-size: 15px; padding: 10px 24px; border: 1px solid #3B4CB4; border-radius: 6px; transition: background 0.2s ease; cursor: pointer; white-space: nowrap; }
      .btn-login:hover { background: rgba(59, 76, 180, 0.05); }

      @media (max-width: 1024px) { 
          .cm-navbar { padding: 20px 4%; } 
      }
      @media (max-width: 768px) { 
          .cm-navbar { flex-direction: column !important; gap: 16px !important; padding: 15px 4% !important; text-align: center !important; } 
          .cm-nav-menu { display: flex !important; flex-wrap: wrap !important; justify-content: center !important; gap: 16px !important; margin: 10px 0 !important; } 
          .cm-nav-auth { width: 100% !important; justify-content: center !important; } 
      }
    </style>
</head>
<body class="bg-light">

<header class="cm-navbar">
  <div class="cm-nav-logo">
    <span class="logo-text">Class<span class="logo-bold">Mint</span></span><span class="logo-dot">&bull;</span>
  </div>
  
  <nav class="cm-nav-menu">
    <a href="https://classmint.teamteki.com/" class="menu-item">Home</a>
    <a href="/our-courses" class="menu-item active">Courses</a>
    <a href="https://classmint.teamteki.com/practice/" class="menu-item" id="cmPracticeNavLink" onclick="handlePracticeClick(event)">Practice</a>
    <a href="#" class="menu-item">Tutorials</a>
    <a href="https://classmint.teamteki.com/profile/" class="menu-item">Admin</a>
  </nav>
      
  <div class="cm-nav-auth" id="cmDynamicAuthNav">
    <a href="javascript:void(0);" class="btn-login" onclick="openAuthModal()">Log In / Sign Up</a>
  </div>
</header>
<div class="container mt-5 mb-5">
    <h2 class="mb-4 fw-bold">JEE MAINS 2026 Core Track</h2>
    <?php 
    $jee_data = [
        'Physics' => [
            'Class 11th' => ['Unit & Dimension', 'Laws of Motion', 'Work Energy & Power', 'Kinematics', 'Rigid Body', 'Kinetic Theory', 'Oscillation Wave'],
            'Class 12th' => ['Current Electricity' , 'Electrostatics' , 'Electromagnetic Waves' , 'Magnetism' , 'Electromagnetic Induction ' , 'Alternating Currents' ,'Optics' , 'Dual Nature of Radiation and Matter' ,'Semiconductor Electronics' , 'Atoms & Nuclei']
        ],
        'Chemistry' => [
            'Class 11th' => ['Mole Concept', 'Structure of Atom', 'Chemical Bonding','Thermodynamics' ,'Equilibrium', 'THE S- BLOCK ELEMENTS' ,'THE REDOX -REACTIONS' , 'THE HYDROGEN'],
            'Class 12th' => []
        ],
        'Mathematics' => [
            'Class 11th' => ['Sets', 'Relations', 'Functions', 'Limits'],
            'Class 12th' => []
        ]
    ];

    foreach ($jee_data as $subject => $grades) {
        $subject_id = preg_replace('/[^A-Za-z0-9]/', '', $subject);
        echo '<div class="card mb-3 shadow-sm">';
        echo '<div class="card-header bg-dark text-white p-3" data-bs-toggle="collapse" data-bs-target="#sub_'.$subject_id.'" style="cursor:pointer;">';
        echo '<h5 class="m-0">+ '.$subject.' Track</h5></div>';
        echo '<div id="sub_'.$subject_id.'" class="collapse"><div class="card-body">';

        foreach ($grades as $grade => $chapters) {
            $grade_id = preg_replace('/[^A-Za-z0-9]/', '', $subject . $grade);
            
            echo '<div class="mb-3">';
            echo '<button class="btn btn-outline-primary w-100 text-start fw-bold" data-bs-toggle="collapse" data-bs-target="#grade_'.$grade_id.'">';
            echo '▶ ' . $grade;
            echo '</button>';
            
            echo '<div id="grade_'.$grade_id.'" class="collapse mt-2">';
            echo '<div class="row g-2 p-2">';
            
            if (empty($chapters)) {
                echo '<div class="col-12"><div class="alert alert-info p-2 text-center">Content coming soon!</div></div>';
            } else {
                foreach ($chapters as $chapter) {
                    echo '<div class="col-md-4"><div class="card p-2 text-center border-primary">';
                    echo '<small class="fw-bold">'.$chapter.'</small>';
                    echo '<a href="quiz.php?topic='.urlencode($chapter).'&exam=jee" class="btn btn-primary btn-sm mt-1">Start Test </a>';
                    echo '</div></div>';
                }
            }
            echo '</div></div></div>';
        }
        echo '</div></div></div>';
    }
    ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var authContainer = document.getElementById("cmDynamicAuthNav");
    var userIsLoggedIn = document.body.classList.contains("logged-in");

    if (userIsLoggedIn && authContainer) {
        authContainer.innerHTML = `
            <a href="https://classmint.teamteki.com/profile/" class="btn-login">Go to Dashboard</a>
            <a href="https://classmint.teamteki.com/wp-login.php?action=logout&redirect_to=https%3A%2F%2Fclassmint.teamteki.com%2F" class="menu-item" style="margin-left: 15px; text-decoration: none; color: #5C6B8E; font-size: 15px; font-weight: 500;">Log Out</a>
        `;
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>