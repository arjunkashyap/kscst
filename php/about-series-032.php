<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Home | KSCST | Student Project Program</title>
    <meta name="description" content="Student Project Programme, KSCST">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="style/normalize.css" media="all" rel="stylesheet" type="text/css" />
    <link href="style/indexstyle.css" media="all" rel="stylesheet" type="text/css" />
    <link href="style/font-awesome-4.1.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
</head>

<body>
    <header class="app-bar">
        <div class="htitle short"><img src="images/logo.png" alt="KSCST Logo"/> <p>KSCST</p></div>
        <div class="htitle long"><img src="images/logo.png" alt="KSCST Logo"/> <p>Karnataka State Council for Science and Technology</p></div>
        <nav class="navdrawer-container">
            <ul>
                <li><span class="typ-a"><a href="../index.php">Home</a></span></li>
                <li><span class="typ-a"><a href="about.php">About SPP</a></span></li>
                <li><span class="typ-a"><a href="search.php">Search</a></span></li>
                <?php session_start(); echo ($_SESSION['login'] == 'yes') ? "<li><span class=\"typ-a\"><a href=\"logout.php\">Logout</a></span></li>" : "<li><span class=\"typ-a\"><a href=\"login.php\">Login</a></span></li>"?>
            </ul>
        </nav>
        <button class="menu">☰</button>        
    </header>    
    <div class="mainpage">
        <div id="row4" class="container">
            <div class="pDesc">
                <p class="largest-text clr3"><span class="b-right">Series 32</span></p>
            </div>
            <p class="about_heading">Student Project Programme (SPP)</p>
            <p class="about">KSCST sponsored project details from 1977 to 2014 information is available online. Students can get information about completed projects and note the Library Accession Number to avoid duplication of projects while applying to KSCST for project sanctions. Students can approach KSCST library with their identity card during office hours and refer to the completed project reports.</p><br/>
            <p class="about_heading">Background</p>
            <p class="about">Motivated by the desire to build a strong base for practical problem solving in several engineering colleges as well as to build their R &amp; D potential, KSCST decided to promote student project programmes in a large number of educational institutions, located Karnataka, in areas of engineering, medicine, fisheries and agriculture. It saw an enormous reservoir of talent and creativity in the students and the faculty of engineering colleges in Karnataka. Another important factor is the abundant availability of basic and infrastructure facilities in the engineering colleges for experimentation, design, fabrication and testing. KSCST, therefore, ventured into launching and implementing a programme called STUDENT PROJECT PROGRAMME (SPP) for providing financial and academic support for Bachelor of Engineering projects. Discussions held with the Director of Technical Education and the Principals of engineering colleges indicated that such a programme would be worthwhile.
            Started in 1977-78, this programme is a unique experiment in Karnataka and it is a tribute to the foresight and inspired through on the part of a group of dedicated scientists, engineers and executives and administrators of Government of Karnataka. This programme is also a major innovation and first of its kind in technical education in the country and has a major impact in improving the quality of technical education. It links together developmental efforts with educational institutions so that relevant problems flow to the institutions and hopefully feasible technical solutions might flow back to the implementers.</p>
            <p class="about">Recognition of the need to address problems and issues of segments of our society, particularly the rural and the urban poor not in the purview of Science &amp; Technology [S &amp; T] initiatives, the strong emotional appeal, touching a soft chord of every human being particularly scientists and technologists created the initiative.</p><br/>
            <p class="about_heading">Objectives:</p>
            <ul class="about">
            <li>Creativity of students applied to solve development problems of our people and State through Science and Technology.</li>
            <li>Enrich Collegiate education through finding solutions to real life problems.</li>
            <li>Improve understanding and develop methodology of solving complex issues.</li>
            </ul>
            <p class="about_heading">Issues Focused:</p>
            <ul class="about">
            <li>Several studies focused on rural issues have helped in development activities in Karnataka. Dissemination of technology pertaining to low cost housing technology pertaining to low cost housing technology, ground water study, low cost agricultural implements, assessment of drinking water potential, in specific areas have been notable examples.</li>
            <li>This programme has enriched collegiate education through finding solutions to real life problems. This has also improved the understanding and development of a methodology to solve complex issues.</li>
            <li>This programme has utilized the services of experts from various scientific and technical institutions like Indian Institute of Science, Indian Institute of Management, National Aerospace Laboratory and in addition to local organizations like Village Panchayats, Block Development Boards, Municipalities, Zilla Panchayats, etc.</li>
            </ul>
            <p class="about_heading">Methodology</p>
            <p class="about">Each proposal is reviewed by an expert and only those recommended are supported by the KSCST (Approximately one project proposal out of three gets funded) More than one hundred senior faculty of Indian Institute of Science, scientists in national labs and other experts review the proposals. They also provide guidelines and suggestions to make a project innovative and meaningful. A modest financial support is also provided.</p>
            <p class="about">On the completion of the project, a team of experts examines the project at a nodal centre and selects the better ones for the annual Seminar and Exhibition. It helps to identify motivated faculty from the respective academic institutions and initiate interactions that could lead to even better projects.</p>
            <p class="about">An annual Seminar and Exhibition of selected student projects (about 150 projects selected by the evaluation team of experts) is held every year in one of the engineering colleges wherein all the Principals, faculty members and students of engineering colleges and some experts from all over the country are invited to participate. Awards for the best projects and project guides are also given during the seminar and exhibition.</p><br/>

            <p class="about_heading">Progress in Thirty seven Years</p>
            <p class="about">So far 37 Seminar and Exhibitions have been organized in different engineering colleges. An expert panel is constituted to select best projects for the PROJECT OF THE YEAR award. A trophy is also presented every year to the Best Performance College along with cash prizes. In order to encourage all the students of the selected projects for Seminar and Exhibition, each one of them will be given a certificate and a prize in the form a technical book.</p>
            <p class="about">The 37th Series SPP Seminar and Exhibition was organised at B.V. Bhoomaraddi College of Engineering and Technology, Hubli between 28 -29th July 2014.</p>

        </div>
    </div>
    <footer>
        <p>&copy;2014 All rights reserved</p>
        <p>
                        ಕರ್ನಾಟಕ ರಾಜ್ಯ ವಿಜ್ಞಾನ ಮತ್ತು ತಂತ್ರವಿದ್ಯಾ ಮಂಡಳಿ<br />            
            Karnataka State Council for<br />Science and Technology<br />
            Indian Institute of Science Campus<br />
            Bangalore - 560 012            
        </p>
        <p>
            <i class="fa fa-phone" title="Phone"></i> +91 80 2334 1652/8848/8849<br />
            <i class="fa fa-phone" title="Fax"></i> +91 80 2334 8840<br />
            <i class="fa fa-envelope-o" title="Email"></i> office@kscst.org.in<br />
            <i class="fa fa-envelope-o" title="Email"></i> office@kscst.iisc.ernet.in
        </p>
    </footer>
</body>
</html>
