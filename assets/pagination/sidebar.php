<section class="sidebar">
            <header>
                <div class="person"></div>
                <div class="demoDetail">
                    <div><?php echo $dealerName; ?></div>
                    <div><?php echo $dealerEmail; ?><i class="material-icons">expand_more</i></div> 
                </div>
                <div class="dialogueBox hide">
                    <div><a href="changePassword"><i class="icon-pg material-icons">remove_red_eye</i><span> Change Password</span></a></div>
                    <div><a href="logout"><i class="icon-pg material-icons">input</i><span> Sign out</span></a></div>
                </div>
            </header>
            <p style="font-weight: bold;
    font-size: small;"><span style="margin-left:10px;">MAIN NAVIGATION</span></p>
            <ul>
                <li>
                    <a class="active" href="/">
                        <i class="material-icons">home</i><span class="active">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);">
                        <i class="material-icons">view_list</i>
                        <span>AMC MODULE</span>
                        <i class="right-align material-icons">add</i>
                    </a>
                    <div class="height-null submenuContent">
                        <a href="sld_renewal"><i class="material-icons">receipt</i><span>SLD Renewal</span></a>
                        <a href="print_certificate"><i class="material-icons">print</i><span>Print Renewal Certificate</span></a>
                    </div>
                </li>
            </ul>

        </section>
<script>
    $(document).ready(function(){
        $(".sidebar ul li a").click(function(){
            $(".submenuContent").toggleClass("height-null");
            let rightAligh = $(".right-align");
            if (rightAligh.html()=="add") {
                $(".right-align").html("remove");
            }else{
            $(".right-align").html("add");
            }
        });
        $(".sidebar header .demoDetail div i").click(function(){
            $(".sidebar header .demoDetail div i").toggleClass("active");
            $(".sidebar header .dialogueBox").toggleClass("hide");
        });
    });
</script>
