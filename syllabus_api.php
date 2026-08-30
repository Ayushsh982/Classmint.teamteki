<?php
// syllabus_api.php
header('Content-Type: application/json');

$unified_syllabus_data = [
    'jee' => [
        'name' => 'JEE Main',
        'icon' => '🎯',
        'subjects' => [
            'Physics' => [
                'icon' => '⚛️',
                'chapters' => ['Unit & Dimension', 'Laws of Motion', 'Work Energy & Power', 'Kinematics', 'Rigid Body', 'Kinetic Theory', 'Oscillation Wave', 'Current Electricity', 'Electrostatics', 'Electromagnetic Waves', 'Magnetism', 'Electromagnetic Induction', 'Alternating Currents', 'Optics', 'Dual Nature of Radiation and Matter', 'Semiconductor Electronics', 'Atoms & Nuclei']
            ],
            'Chemistry' => [
                'icon' => '🧪',
                'chapters' => ['Mole Concept', 'Structure of Atom', 'Chemical Bonding', 'Thermodynamics', 'Equilibrium', 'THE S- BLOCK ELEMENTS', 'THE REDOX -REACTIONS', 'THE HYDROGEN']
            ],
            'Mathematics' => [
                'icon' => '🧮',
                'chapters' => ['Sets', 'Relations', 'Functions', 'Limits']
            ]
        ]
    ],
        'NEET' => [
        'name' => 'NEET',
        'icon' => '🎯',
        'subjects' => [
            'Physics' => [
                'icon' => '⚛️',
                'chapters' => ['Unit & Dimension']
            ],
            'Chemistry' => [
                'icon' => '🧪',
                'chapters' => []
            ],
            'Biology' => [
                'icon' => '🧮',
                'chapters' => ['Sets', 'Relations', 'Functions', 'Limits']
            ]
        ]
    ],
        'CAT' => [
        'name' => 'CAT',
        'icon' => '🎯',
        'subjects' => [
            'Quantitative Aptitude' => [
                'icon' => '⚛️',
                'chapters' => ['PERCENTAGES' , 'PROFIT & LOSS' , 'SIMPLE & COMPOUND INTEREST' , 'Ratio & Proportion' , 'Mixtures & Alligations' , 'Averages' , 'Time, Speed & Distance', 'Time and Work' , 'Pipes & Cisterns' , 'Linear and Quadratic Equation' ,'Inequalities' , 'Logarithms & Functions' ,'Graphs & Maxima-Minima' , 'Geometry' , 'Sequences, Series & Progressions' , 'Coordinate Geometry' ,'Mensuration' ,'Permutations & Combinations', 'Probability']
            ],
            'VARC' => [
                'icon' => '🧪',
                'is_grouped' => true,
                'groups' => [
                    'Reading Comprehension' => [
                        'title' => 'Reading Comprehension',
                        'description' => 'Passages across History, Science, Philosophy, Economics, and more — 3-5 questions per passage.',
                        'meta' => '78 passages',
                        'chapters' => [
                            'Science & Technology', 'Business & Economics', 'History & Culture', 
                            'Literature & Arts', 'Politics & Society', 
                            'Psychology & Behaviour', 'Environment & Ecology'
                        ]
                    ],
                    'Verbal Ability' => [
                        'title' => 'Verbal Ability',
                        'description' => 'Para Jumbles, Odd One Out, Para Summary, and Para Completion.',
                        'meta' => '1,225 questions',
                        'chapters' => [
                           'Para Jumbles', 'Odd One Out', 'Para Summary', 'Para Completion'
                        ]
                    ]
                ]
            ],
            'DILR' => [
                'icon' => '🧮',
                'chapters' => ['Pie Charts','Bar Charts','Caselets','Venn Diagram', 'Binary Logic' , 'Cubes & Dices','Network Diagrams','Linear & Circular Arrangements','Games and Tournaments' ,'Complex Matrix Match puzzles']
            ]
        ]
    ],
    'jipmat' => [
        'name' => 'JIPMAT',
        'icon' => '📊',
        'subjects' => [
            'Quantitative Aptitude' => [
                'icon' => '📐',
                'chapters' => ['Algebra', 'Number Systems', 'Arithmetic', 'Geometry & Mensuration', 'TSD & Time & Work', 'Probability & P&C', 'Data Interpretation']
            ],
            'LRDI' => [
                'icon' => '🧠',
                'chapters' => ['Verbal Reasoning', 'Non-Verbal Reasoning', 'Data Interpretation Sets']
            ],
            'VARC' => [
                'icon' => '📝',
                'chapters' => ['Reading Comprehension', 'Grammar', 'Vocabulary', 'Para Jumbles']
            ],
            'Full Mocks' => [
                'icon' => '📝',
                'chapters' => ['Mock Paper-1', 'Mock Paper-2']
            ]
        ]
    ],
    'cuet' => [
        'name' => 'CUET',
        'icon' => '🎓',
        'bg' => '#D1FAE5', 
        'iconColor' => '#059669',
        'subjects' => [
            'General Test' => [
                'icon' => '🧠',
                'chapters' => ['General Knowledge', 'Current Affairs', 'Mental Ability', 'Numerical Ability', 'Quantitative Reasoning']
            ],
            'English' => [
                'icon' => '📝',
                'chapters' => ['Reading Comprehension', 'Verbal Ability', 'Rearranging Parts', 'Choosing Correct Word', 'Synonyms/Antonyms']
            ],
            'Accountancy' => [
                'icon' => '📝',
                'chapters' => ['Partnership Fundamentals' , 'Admission of a Partner' , 'Retirement & Death of a Partner' , 'Dissolution of Partnership Firm' ,'Company Accounts - Share Capital' , 'Company Accounts - Debentures', 'Accounting for NPOs' , 'Financial Statements of a Company' ,'Analysis of Financial Statements' ,'Cash Flow Statement' ,'Accounting Concepts, Bases & Standards' ,'Depreciation Accounting', 'Computerised Accounting System & Databases' ,'']
                ],
            'Mathematics' =>[
                'icon' => '🧠',
                'chapters' =>['Relations & Functions', 'Inverse Trigonometry' , 'Matrices & Determinants' , 'Continuity & Differentiability' ,'Application of Derivatives (AOD)' ,'Integrals & Applications (AOI)', 'Differential Equations' , 'Vectors & 3D Geometry' , 'Linear Programming (LPP)' , 'Probability' , 'Statistics', 'Permutations & Combinations' ,'Conic Sections']
                ],
            'Business Studies' => [
                'icon' => '📝',
                'chapters' => ['Business Studies']
                ],    
            'Domain Subjects' => [
                'icon' => '📚',
                'chapters' => [ 'Biology', 'Business Studies', 'Computer Science']
            ]
        ]
    ]
];


echo json_encode($unified_syllabus_data);
exit;
?>