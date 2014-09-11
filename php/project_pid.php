<?php include("includes/header.php");?>
    <div class="mainpage">
        <div id="row4" class="container">
            <div class="pDesc">
                <p class="largest clr3"><span class="b-right">36</span></p>
                <p class="dText"><img src="images/6942.jpg" alt="Cover"/></p>
                <p class="dText awards"><i class="fa fa-tag clr5" title="Selected for Seminar / Exhibition"></i><i class="fa fa-trophy clr2" title="Project of the year"></i></p>
            </div>
            <p class="title-bar">Engine Performance and Emission Characteristics of Single Cylinder Diesel Engine Working on Liquid Fuels Produced From Agricultural Plastic Waste</p>
            <div class="box card-holder-desc">
                <div class="card l-edge-hl1">
                    <p class="others">
                        <span class="heading">Team</span><br /><br />
                        <span class="student-span">Arunakumara H. N.</span><br />
                        <span class="student-span">Divakar S. M.</span><br />
                        <span class="student-span">Errol Basil Tauro</span><br />
                        <span class="student-span">Manruth Shetty S.</span>
                    </p>
                </div>
                <div class="card  l-edge-hl3">
                    <p class="others">
                        <span class="heading">Advisors</span><br /><br />
                        <span class="guide-span">Dr. S. Kumarappa</span><br /><span class="guide-span tiny">(Professor and PG Coordinator)</span><br /><br />
                        <span class="guide-span">Dr. B. M. Kulkarni</span><br /><span class="guide-span tiny">(Professor)</span><br />
                    </p>
                </div>
                <div class="card l-edge-hl1">
                    <p class="others">
                        <span class="heading">Dept. / College</span><br /><br />
                        <span class="dept-span">Dept. of Mechanical Engineering,</span><br /><br />
                        <span class="college-span">Bapuji Institute of Engineering and Technology</span><br />
                    </p>
                </div>
            </div>
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
<script>
    var navdrawerContainer = document.querySelector('.navdrawer-container');
    var appbarElement = document.querySelector('.app-bar');
    var menuBtn = document.querySelector('.menu');

    menuBtn.addEventListener('click', function() {
        var isOpen = navdrawerContainer.classList.contains('open');
        if(isOpen) {
            appbarElement.classList.remove('open');
            navdrawerContainer.classList.remove('open');
        } else {
          appbarElement.classList.add('open');
          navdrawerContainer.classList.add('open');
        }
    }, true);
</script>

</html>
