<style>
    #messageBox {
    display: flex;
    position: absolute;
    top: 0;
    left: 0;
    background-color: rgba(133, 128, 128, 0.527);
    z-index: 50;
    height: 100vh;
    width: 100vw;
}

#messageBox .box {
    position: relative;
    margin: auto;
    border-radius: 20px;
    padding: 20px;
    color: White;
    font-size: large;
    font-weight: 500;
    width: max-content;
    height: max-content;
    background-color: rebeccapurple;
}
</style>
<div onClick="closeMessageBox()" class="hide" id="messageBox">
    <div id="messageBoxScreen" class="box"></div>
</div>