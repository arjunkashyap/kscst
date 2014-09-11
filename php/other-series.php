<?php include("includes/header.php");?>
    <div class="mainpage">
        <div id="row4" class="container">
            <div class="pDesc" style="flex-basis: 100%;margin-bottom: 40px;padding-left: 100px;">
                <p class="larger clr3"><span class="b-right">SPP Series</span></p>
                <p class="dText clr4" style="line-height: 2em;">
                    <span class="clr2 yes-ul">Yearwise</span>
                </p>
            </div>
<?php
include("connect.php");
require_once("common.php");

$db = @new mysqli('localhost', "$user", "$password", "$database");
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>
        <footer>
            <p>&copy;2014 All rights reserved</p>
            <p>
                            ಕರ್ನಾಟಕ ರಾಜ್ಯ ವಿಜ್ಞಾನ ಮತ್ತು ತಂತ್ರವಿದ್ಯಾ ಮಂಡಳಿ<br />            
                Karnataka State Council for<br />Science and Technology<br />
                Indian Institute of Science Campus<br />
                Bangalore - 560 012            
            </p>
            <p>
                <i class=\"fa fa-phone\" title=\"Phone\"></i> +91 80 2334 1652/8848/8849<br />
                <i class=\"fa fa-phone\" title=\"Fax\"></i> +91 80 2334 8840<br />
                <i class=\"fa fa-envelope-o\" title=\"Email\"></i> office@kscst.org.in<br />
                <i class=\"fa fa-envelope-o\" title=\"Email\"></i> office@kscst.iisc.ernet.in
            </p>
        </footer>
    </body>
    </html>";
	exit(1);
}

$query = "select distinct snum,year from project order by snum";

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		$row = $result->fetch_assoc();
		
        $snum = $row['snum'];
        $year = $row['year'];
        
        echo "<div class=\"box\" style=\"width: 200px;margin-bottom: 40px;\">";
        echo "  <p class=\"large clr3\"><span class=\"b-right\"><a href=\"series.php?snum=".$snum."\">".str_pad(intval($snum), 2, "0", STR_PAD_LEFT)."</a></span></p>";
        echo "  <p class=\"dText clr4\"><span class=\"clr2 yes-ul\">".$year."</span><br /></p>";
        echo "</div>";
        
	}
}
else
{
	echo "No data in the database";
}

if($result){$result->free();}
$db->close();

?>
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
