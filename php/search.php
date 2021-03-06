<?php include("includes/header.php");?>
    <div class="mainpage">
        <div id="row4" class="container">
            <div class="pDesc">
                <p class="largest-text clr3"><span class="b-right">Search</span></p>
            </div>
<?php
include("connect.php");
require_once("common.php");

$db = @new mysqli('localhost', "$user", "$password", "$database");
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>";
    include("includes/footer.php");
	exit(1);
}
?>
            <form method="get" action="search-result.php">
                <div class="search w-500">
                    <div class="otherp">
                        <ul>
                            <li>
                                <label for="snum">Series (Year)</label><br />
                                <select class="rinput" name="snum" id="snum">
                                    <option value="" selected>All</option>
                                    <option value="001">Series 01 (1977-1978)</option>
                                    <option value="002">Series 02 (1978-1979)</option>
                                    <option value="003">Series 03 (1979-1980)</option>
                                    <option value="004">Series 04 (1980-1981)</option>
                                    <option value="005">Series 05 (1981-1982)</option>
                                    <option value="006">Series 06 (1982-1983)</option>
                                    <option value="007">Series 07 (1983-1984)</option>
                                    <option value="008">Series 08 (1984-1985)</option>
                                    <option value="009">Series 09 (1985-1986)</option>
                                    <option value="010">Series 10 (1986-1987)</option>
                                    <option value="011">Series 11 (1987-1988)</option>
                                    <option value="012">Series 12 (1988-1989)</option>
                                    <option value="013">Series 13 (1989-1990)</option>
                                    <option value="014">Series 14 (1990-1991)</option>
                                    <option value="015">Series 15 (1991-1992)</option>
                                    <option value="016">Series 16 (1992-1993)</option>
                                    <option value="017">Series 17 (1993-1994)</option>
                                    <option value="018">Series 18 (1994-1995)</option>
                                    <option value="019">Series 19 (1995-1996)</option>
                                    <option value="020">Series 20 (1996-1997)</option>
                                    <option value="021">Series 21 (1997-1998)</option>
                                    <option value="022">Series 22 (1998-1999)</option>
                                    <option value="023">Series 23 (1999-2000)</option>
                                    <option value="024">Series 24 (2000-2001)</option>
                                    <option value="025">Series 25 (2001-2002)</option>
                                    <option value="026">Series 26 (2002-2003)</option>
                                    <option value="027">Series 27 (2003-2004)</option>
                                    <option value="028">Series 28 (2004-2005)</option>
                                    <option value="029">Series 29 (2005-2006)</option>
                                    <option value="030">Series 30 (2006-2007)</option>
                                    <option value="031">Series 31 (2007-2008)</option>
                                    <option value="032">Series 32 (2008-2009)</option>
                                    <option value="033">Series 33 (2009-2010)</option>
                                    <option value="034">Series 34 (2010-2011)</option>
                                    <option value="035">Series 35 (2011-2012)</option>
                                    <option value="036">Series 36 (2012-2013)</option>
                                </select>
                            </li>
                            <li>
                                <label for="title">Project title</label><br />
                                <input class="rinput" type="text" name="title" id="title" />
                            </li>
                            <li>
                                <label for="department">Discipline / Department</label><br />
                                <input class="rinput" type="text" name="department" id="department" />
                            </li>
                            <li>
                                <label for="college">College</label><br />
                                <input class="rinput" type="text" name="college" id="college" />
                            </li>
                            <li>
                                <label for="advisor">Advisors</label><br />
                                <input class="rinput" type="text" name="advisor" id="advisor" />
                            </li>
                            <li>
                                <label for="members">Team members</label><br />
                                <input class="rinput" type="text" name="members" id="members" />
                            </li>
                            <li>
                                <label for="text">Full text</label><br />
                                <input class="rinput" type="text" name="text" id="text" />
                            </li>
                            <li id="regForm">
                                <input class="rsubmit" type="submit" name="submit" value="submit"/>
                                <input class="rsubmit" type="reset" name="reset" value="reset"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php include("includes/footer.php");?>
