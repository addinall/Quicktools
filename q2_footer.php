<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       q2_footer.php       
//  SYSTEM:     quicktools version 2 
//  AUTHOR:     Mark Addinall
//  DATE:       29/10/2010
//  SYNOPSIS:   The footer!
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 29/10/2010 | Initial creation              |  MA
//------------+-------------------------------+------------
//
//

$foot = <<< EOF
        <div id="sidebar">
            <ul>
                <li>
                    <h2>Latest News!</h2>
                        <div id="m">
                            <marquee bgcolor=#CEEDED scrollamount=1 loop=true direction=up height=80
                            onmouseover="this.stop()" onmouseout="this.start()" 
                            style="Filter:Alpha(Opacity=100, FinishOpacity=0, Style=1, StartX=0, StartY=40, FinishX=0, FinishY=0);" >
                            <em>
                                $message_list    
                            </em>
                            </marquee>
                        </div>
                </li>
                <li>
                    <h2>Applications</h2>
                    <ul>
                        <li><a href="q2_customers_list.php">Quicktools Customers</a></li>
                        <li><a href="q2_datacenters_list.php">Quicktools Datacenters</a></li>
                        <li><a href="q2_datarooms_list.php">Quicktools Datarooms
                        <li><a href="q2_networks_list.php">Quicktools Networks 
                        <li><a href="q2_machines_list.php">Quicktools Machines</a></li>
                        <li><a href="q2_applications_list.php">Quicktools Applications and services</a></li>
                        <li><a href="q2_sql.php">Quicktools SQL</a></li>
                        <li><a href="q2_recover.php">Quicktools Backup/Recover application</a></li>
                        <li><a href="q2_chameleon.php">Quicktools CMS</a></li>
                        <li><a href="q2_tutorial.php">Quicktools Tutorial</a></li>
                    </ul>
                </li>
                <li>
                    <h2 class="title">Blogroll</h2>
                        <div id="blog">     
                            <li><a href="q2_nimple.php">Newest BLOG Entry</a>
                            <em>$blog_entry ...........</em>
                        </div> 
                        </li>
                </li>
            </ul>
        </div>
        <!-- end #sidebar -->
        <div style="clear: both;">&nbsp;</div>
    </div>
    </div>
    </div>
    <!-- end #page -->
    <div id="footer">
        <br>
        <p>Copyright (c) 2010 Addinall. All rights reserved. by <a href="http://www.addinall.net/">Addinall</a>.</p>
    </div>
    <!-- end #footer -->

</div>
</body>
</html>

EOF;

print $foot ;

?>

