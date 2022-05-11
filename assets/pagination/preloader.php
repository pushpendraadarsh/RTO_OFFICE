<style>
#preloader {
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    background-color: white;
    width: 100vw;
    height: 100vh;
    z-index: 500000;
    flex-wrap: nowrap;
    align-content: center;
    align-items: center;
}
        #preloader div{
            width: 100px;
            height: 100px;
            background-image: url(https://icaengineeringacademy.com/wp-content/uploads/2019/01/ajax-loading-gif-transparent-background-2.gif);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    <div id="preloader">
        <div></div>
        <br><p>Please Wait..</p>
    </div>
    <script>
    $(document).ready(function(){
        setTimeout(() => {
            $("#preloader").fadeOut();
        }, 100);
});
</script>