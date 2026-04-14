<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rano LGEA School Inventory & Result Processing System</title>
  <style>
    :root {
      --primary: #0f766e;
      --primary-dark: #134e4a;
      --accent: #f59e0b;
      --bg: #f8fafc;
      --card: #ffffff;
      --text: #0f172a;
      --muted: #475569;
      --border: #dbe4ee;
      --shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
      --radius: 18px;
      --max: 1180px;
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
      margin: 0;
      font-family: Inter, Arial, Helvetica, sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }

    .container {
      width: min(92%, var(--max));
      margin: 0 auto;
    }

    header {
      background: linear-gradient(135deg, rgba(15,118,110,0.95), rgba(20,83,45,0.92));
      color: white;
      padding-bottom: 3rem;
      position: relative;
      overflow: hidden;
    }

    header::before,
    header::after {
      content: "";
      position: absolute;
      border-radius: 50%;
      background: rgba(255,255,255,0.08);
      filter: blur(2px);
    }

    header::before {
      width: 320px;
      height: 320px;
      top: -90px;
      right: -100px;
    }

    header::after {
      width: 220px;
      height: 220px;
      bottom: -60px;
      left: -70px;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.2rem 0;
      position: relative;
      z-index: 2;
    }

    .brand {
      font-size: 1.05rem;
      font-weight: 800;
      letter-spacing: 0.3px;
    }

    .nav-links {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-size: 0.95rem;
      opacity: 0.95;
    }

    .hero {
      display: grid;
      grid-template-columns: 1.2fr 0.8fr;
      gap: 2rem;
      align-items: center;
      padding: 3rem 0 1rem;
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: clamp(2rem, 4vw, 3.8rem);
      line-height: 1.1;
      margin: 0 0 1rem;
    }

    .hero p {
      font-size: 1.05rem;
      max-width: 700px;
      margin-bottom: 1.5rem;
      color: rgba(255,255,255,0.92);
    }

    .hero-actions {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      margin-bottom: 1.2rem;
    }

    .btn {
      display: inline-block;
      padding: 0.95rem 1.35rem;
      border-radius: 999px;
      text-decoration: none;
      font-weight: 700;
      transition: 0.25s ease;
    }

    .btn-primary {
      background: white;
      color: var(--primary-dark);
    }

    .btn-primary:hover { transform: translateY(-2px); }

    .btn-outline {
      border: 1px solid rgba(255,255,255,0.45);
      color: white;
      background: rgba(255,255,255,0.05);
    }

    .hero-card {
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.18);
      backdrop-filter: blur(8px);
      border-radius: 24px;
      padding: 1.4rem;
      box-shadow: var(--shadow);
    }

    .stat-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-top: 1rem;
    }

    .stat {
      background: rgba(255,255,255,0.1);
      padding: 1rem;
      border-radius: 16px;
      border: 1px solid rgba(255,255,255,0.15);
    }

    .stat strong {
      display: block;
      font-size: 1.4rem;
      color: #fff;
    }

    .section {
      padding: 4.5rem 0;
    }

    .section-title {
      font-size: 2rem;
      margin-bottom: 0.7rem;
      color: var(--primary-dark);
    }

    .section-subtitle {
      color: var(--muted);
      max-width: 800px;
      margin-bottom: 2rem;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.25rem;
    }

    .card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.35rem;
      box-shadow: var(--shadow);
    }

    .card h3 {
      margin-top: 0;
      margin-bottom: 0.7rem;
      color: var(--primary-dark);
      font-size: 1.1rem;
    }

    .card p, .card li {
      color: var(--muted);
      font-size: 0.96rem;
    }

    .icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(15, 118, 110, 0.12);
      color: var(--primary);
      font-size: 1.35rem;
      margin-bottom: 0.9rem;
      font-weight: 800;
    }

    .split {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
      align-items: start;
    }

    .feature-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .feature-list li {
      padding: 0.8rem 0;
      border-bottom: 1px solid var(--border);
    }

    .feature-list li:last-child { border-bottom: 0; }

    .feature-list strong {
      color: var(--text);
    }

    .process {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
    }

    .step {
      background: white;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.2rem;
      box-shadow: var(--shadow);
      position: relative;
    }

    .step-number {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--primary);
      color: white;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      margin-bottom: 0.8rem;
    }

    .cta {
      background: linear-gradient(135deg, var(--primary-dark), var(--primary));
      color: white;
      border-radius: 28px;
      padding: 2rem;
      display: grid;
      grid-template-columns: 1.4fr 0.6fr;
      gap: 1rem;
      align-items: center;
      box-shadow: var(--shadow);
    }

    footer {
      padding: 2rem 0 3rem;
      color: var(--muted);
      text-align: center;
      font-size: 0.95rem;
    }

    .badge-row {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
      margin-top: 1rem;
    }

    .badge {
      background: rgba(245, 158, 11, 0.15);
      color: #92400e;
      border: 1px solid rgba(245, 158, 11, 0.25);
      padding: 0.45rem 0.8rem;
      border-radius: 999px;
      font-size: 0.88rem;
      font-weight: 600;
    }

    @media (max-width: 980px) {
      .hero,
      .split,
      .cta,
      .cards,
      .process {
        grid-template-columns: 1fr;
      }

      .cards {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 640px) {
      .nav-links { display: none; }
      .cards,
      .stat-grid {
        grid-template-columns: 1fr;
      }

      .section {
        padding: 3.4rem 0;
      }

      .hero-card {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <nav>
        <div class="brand">Rano LGEA EduSystem</div>
        <div class="nav-links">
          <a href="#overview">Overview</a>
          <a href="#modules">Modules</a>
          <a href="#scope">Expanded Scope</a>
          <a href="#workflow">Workflow</a>
          <a href="#contact">Benefits</a>
        </div>
      </nav>

      <div class="hero">
        <div>
          <h1>School Inventory and Result Processing System for Rano Local Government Education Authority</h1>
          <p>
            A centralized digital platform designed to register schools, manage infrastructure and staff records,
            track learning resources, and process student results accurately across primary education institutions
            under Rano LGEA.
          </p>
          <div class="hero-actions">
            <a class="btn btn-primary" href="#modules">Explore Modules</a>
            <a class="btn btn-outline" href="#scope">View Expanded Scope</a>
          </div>
          <div class="badge-row">
            <span class="badge">School Inventory</span>
            <span class="badge">Student Results</span>
            <span class="badge">Data-Driven Decisions</span>
            <span class="badge">Central Reporting</span>
          </div>
        </div>

        <div class="hero-card">
          <h3 style="margin-top:0; margin-bottom:0.4rem;">Core Objectives</h3>
          <p style="color: rgba(255,255,255,0.88); margin-top:0;">
            Improve educational administration, eliminate paper-based bottlenecks, and provide reliable data for planning,
            supervision, and academic monitoring.
          </p>
          <div class="stat-grid">
            <div class="stat">
              <strong>1</strong>
              Unified school database
            </div>
            <div class="stat">
              <strong>2</strong>
              Faster result computation
            </div>
            <div class="stat">
              <strong>3</strong>
              Better monitoring & reporting
            </div>
            <div class="stat">
              <strong>4</strong>
              Stronger accountability
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main>
    <section class="section" id="overview">
      <div class="container">
        <h2 class="section-title">Project Overview</h2>
        <p class="section-subtitle">
          The proposed system goes beyond basic record keeping. It serves as a digital education management platform for Rano LGEA,
          supporting school inventory administration, student academic result processing, personnel information management, and strategic reporting.
        </p>

        <div class="cards">
          <div class="card">
            <div class="icon">🏫</div>
            <h3>School Inventory Registry</h3>
            <p>
              Maintain complete information about each school, including school name, EMIS code, location, ownership type,
              classrooms, offices, toilets, furniture, laboratories, libraries, ICT facilities, and security condition.
            </p>
          </div>

          <div class="card">
            <div class="icon">📊</div>
            <h3>Result Processing</h3>
            <p>
              Capture scores by subject and term, compute totals, averages, grades, class positions, and generate printable result sheets,
              broadsheets, transcripts, and performance summaries.
            </p>
          </div>

          <div class="card">
            <div class="icon">🗂️</div>
            <h3>Administrative Control</h3>
            <p>
              Enable LGEA administrators, head teachers, and authorized staff to access role-based dashboards for data entry,
              approvals, updates, and institutional monitoring.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="modules" style="background:#eef6f6;">
      <div class="container">
        <h2 class="section-title">Major System Modules</h2>
        <p class="section-subtitle">
          The platform can be structured into interconnected modules to support daily school administration and local government education oversight.
        </p>

        <div class="cards">
          <div class="card">
            <h3>1. School Profile Management</h3>
            <p>Registration of all schools under Rano LGEA with details such as school code, category, year established, address, ward, GPS reference, enrollment, and contact information.</p>
          </div>
          <div class="card">
            <h3>2. Infrastructure & Asset Tracking</h3>
            <p>Capture buildings, classrooms, desks, chairs, whiteboards, water sources, computers, generators, books, sports items, and maintenance status for each school.</p>
          </div>
          <div class="card">
            <h3>3. Staff & Teacher Records</h3>
            <p>Maintain records of teaching and non-teaching staff, qualifications, posting history, attendance summaries, subject allocations, and workload distribution.</p>
          </div>
          <div class="card">
            <h3>4. Student Enrollment Register</h3>
            <p>Manage pupils by class, gender, age, admission number, school transfer history, attendance statistics, and promotion history.</p>
          </div>
          <div class="card">
            <h3>5. Result Entry & Computation</h3>
            <p>Enter CA and examination scores, validate marks, calculate subject totals, final grades, remarks, rankings, and term-based or session-based results.</p>
          </div>
          <div class="card">
            <h3>6. Reports & Analytics</h3>
            <p>Generate reports on school assets, damaged facilities, class performance, teacher distribution, pupil population, exam outcomes, and decision-support summaries.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="scope">
      <div class="container">
        <h2 class="section-title">Expanded Project Scope</h2>
        <p class="section-subtitle">
          To make the system more valuable to Rano LGEA, the scope can be expanded from two basic functions into a complete education information and monitoring solution.
        </p>

        <div class="split">
          <div class="card">
            <h3>Expanded Functional Scope</h3>
            <ul class="feature-list">
              <li><strong>Digital school census:</strong> Yearly updates of school population, facilities, teachers, and resource gaps.</li>
              <li><strong>Subject and class configuration:</strong> Set classes, arms, subjects, grading rules, and academic sessions.</li>
              <li><strong>Automated report cards:</strong> Produce standardized termly result sheets for pupils.</li>
              <li><strong>Promotion and repetition management:</strong> Move students between classes based on performance rules.</li>
              <li><strong>Inspection and supervision log:</strong> Record school visits, observations, compliance issues, and recommendations.</li>
              <li><strong>Attendance monitoring:</strong> Track student and teacher attendance for accountability and intervention planning.</li>
              <li><strong>Resource request management:</strong> Identify shortages and prioritize distribution of desks, books, and teaching materials.</li>
              <li><strong>Data backup and audit trail:</strong> Maintain activity logs and protect records from accidental loss or unauthorized edits.</li>
            </ul>
          </div>

          <div class="card">
            <h3>Strategic Scope for Long-Term Growth</h3>
            <ul class="feature-list">
              <li><strong>GIS/location mapping:</strong> Show geographic distribution of schools for planning and accessibility analysis.</li>
              <li><strong>Performance comparison dashboard:</strong> Compare schools, classes, subjects, and terms visually.</li>
              <li><strong>Special intervention tracking:</strong> Flag schools needing urgent renovation, more teachers, or learning materials.</li>
              <li><strong>Parent communication support:</strong> Enable result access or notices through SMS or printable reports.</li>
              <li><strong>Examination broadsheet generation:</strong> Produce class-wide score sheets for administrators and head teachers.</li>
              <li><strong>Transfer certificate and transcript support:</strong> Simplify movement of pupils between schools.</li>
              <li><strong>Policy planning support:</strong> Help LGEA leadership make budget and staffing decisions using current evidence.</li>
              <li><strong>Multi-school centralized control:</strong> One portal to manage all schools under the authority.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="workflow" style="background:#eef6f6;">
      <div class="container">
        <h2 class="section-title">How the System Works</h2>
        <p class="section-subtitle">
          The workflow is designed to be simple for schools while providing accurate and timely records at the LGEA headquarters.
        </p>

        <div class="process">
          <div class="step">
            <div class="step-number">1</div>
            <h3>Register Schools</h3>
            <p>Create and update profiles for all schools, facilities, classrooms, resources, and staff records.</p>
          </div>
          <div class="step">
            <div class="step-number">2</div>
            <h3>Capture Students & Scores</h3>
            <p>Enroll students into classes and enter continuous assessment and examination scores by subject and term.</p>
          </div>
          <div class="step">
            <div class="step-number">3</div>
            <h3>Compute & Validate</h3>
            <p>The system calculates totals, averages, grades, positions, and remarks while enforcing validation rules.</p>
          </div>
          <div class="step">
            <div class="step-number">4</div>
            <h3>Generate Reports</h3>
            <p>Produce result sheets, school inventory summaries, analytical dashboards, and decision-ready management reports.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="benefits">
      <div class="container">
        <h2 class="section-title">Expected Benefits</h2>
        <p class="section-subtitle">
          A successful deployment will improve operational efficiency, transparency, and evidence-based planning throughout the education authority.
        </p>

        <div class="cards">
          <div class="card">
            <h3>Accurate Records</h3>
            <p>Reduces missing or duplicated information across schools and creates a trusted source of data for the authority.</p>
          </div>
          <div class="card">
            <h3>Time Savings</h3>
            <p>Minimizes manual result computation and paper-based inventory compilation, saving time for teachers and administrators.</p>
          </div>
          <div class="card">
            <h3>Improved Accountability</h3>
            <p>Supports monitoring of school resources, teacher deployment, and academic performance using clear records and reports.</p>
          </div>
          <div class="card">
            <h3>Better Planning</h3>
            <p>Enables data-driven allocation of teachers, furniture, classrooms, learning materials, and budget priorities.</p>
          </div>
          <div class="card">
            <h3>Performance Visibility</h3>
            <p>Highlights high-performing and struggling schools or classes, making intervention faster and more targeted.</p>
          </div>
          <div class="card">
            <h3>Scalable Foundation</h3>
            <p>Creates a platform that can later support attendance, finance, inspection, parent access, and state-level integration.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="cta" id="contact">
          <div>
            <h2 style="margin-top:0; margin-bottom:0.6rem;">A Smarter Digital Foundation for Basic Education in Rano LGEA</h2>
            <p style="margin:0; color: rgba(255,255,255,0.92);">
              This project can serve as both an operational tool and a strategic planning platform, giving Rano Local Government Education Authority a modern system for managing schools and measuring academic outcomes.
            </p>
          </div>
          <div>
            <a class="btn btn-primary" href="#overview">Back to Top</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      © 2026 Rano LGEA EduSystem Concept Page. Designed as a single-page project presentation website.
    </div>
  </footer>
</body>
</html>
