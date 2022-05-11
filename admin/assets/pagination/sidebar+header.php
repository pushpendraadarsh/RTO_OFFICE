<section class="sidebar">
            <header></header>
            <ul>
                <li><i class="mar-10 fa-solid fa-house-chimney"></i><a href="/">Dashboard</a></li>
                <li>
                    
                    <i class="mar-10 fa-solid fa-scale-balanced"></i> User Maintenance
                    <i class="mar-10 fa-solid fa-chevron-down"></i>
                    <div class="submenuContent">
                        <a href="user_module"> Add/Delete Users</a>
                    </div>
                </li>
                <li>
                    <i class="mar-10 fa-solid fa-database"></i><a href="dealer_report">Dealers Report</a>
                </li>
            </ul>
        </section>
<script>
    $(document).ready(function(){
        $(".SidebarBtn").click(function(){
            $(".sidebar").toggleClass("horizontal-null");
        });
    });
</script>
