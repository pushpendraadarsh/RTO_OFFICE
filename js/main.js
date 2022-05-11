function closeMessageBox() {
    let BoxCut = document.getElementById("messageBox");
    let MessageScreen = document.getElementById("messageBoxScreen");
    MessageScreen.innerHTML = "";
    BoxCut.classList.add("hide");
}

function message(text, time, fontSizes, mode) {
    let MessageScreen = document.getElementById("messageBoxScreen");
    let BoxCut = document.getElementById("messageBox");
    MessageScreen.innerHTML = text;
    if (mode == "danger") {
        MessageScreen.style.color = "red";
        MessageScreen.style.backgroundColor = "whitesmoke";
    }
    MessageScreen.style.fontSize = fontSizes;
    BoxCut.classList.remove("hide");
    if (time) {
        setTimeout(() => {
            closeMessageBox();
        }, time);
    }
}


function LoginUsers(data) {
    $.ajax({
        type: 'POST',
        url: 'api/login.php',
        data: data,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {},
        success: function(response) {
            if (response == "200") {
                window.location.replace("../");
            } else if (response == "300") {
                $("#errorLoginForm").html('Email or Password not valid. Kindly enter valid credentials.');
            } else {
                $("#errorLoginForm").html('Please Try Again');
            }

        }
    });
}

function Certificate(fff) {
    $.ajax({
        type: 'POST',
        url: 'api/certificateDownload.php',
        data: fff,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            console.log(fff);
        },
        success: function(response) {
            if (response.status == "200") {
                message("Your Certificate Is Downloaded soon.", 1500);
                setTimeout(() => {
                    window.open("../certificates?certificateNo=" + response.url, '_blank');
                }, 1000);
            } else if (response.status == "300") {
                message("Your Certificate Is Not Exists.");
            } else {
                message(response);
            }

        }
    });
}

function UserDataRegister(fff) {
    $.ajax({
        type: 'POST',
        url: 'api/UserDataRegister.php',
        data: fff,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $("#SubBtn").html("Sending");
        },
        success: function(response) {
            $("#SubBtn").html("Success");
            if (response.status == "200") {
                message("Your Data Is Successfully Registered Your <br> Certificate No. " + response.no + ".", 1500);
                window.location.replace("../certificates?certificateNo=" + response.no);
                $("#AddUserData").reset();
            } else {
                $("#SubBtn").html("Retry");
                message("Please Sure your Allotment Serial No. is 5 Digit.");

            }

        }
    });
}

function DealerList(output) {
    $.ajax({
        type: 'POST',
        url: '../api/fetchDealers.php',
        data: {
            event: "dealerList"
        },
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {},
        success: function(response) {
            output.empty();
            if (response[0].status == "200") {
                let x = "'";
                for (var i = 1; i <= response.length; i++) {
                    output.append('<tr>' +
                        '<td>' + i + '</td>' +
                        '<td>' + response[i].fullName + ' ( ' + response[i].id + ')</td>' +
                        '<td>' + response[i].address + '</td>' +
                        '<td>' + response[i].status + '</td>' +
                        '<td id="' + response[i].id + '"><span class="iconify" data-icon="el:edit"></span></td>' +
                        '<td><a href="javascript:void(0)" onclick="deleteUsers(' + x + response[i].id + x + ')"><span class="iconify" data-icon="fluent:delete-arrow-back-20-filled"></span></a></td>' +
                        '</tr>');
                    //Scripts Relative
                    $("#" + response[i].id).click(function() {
                        EditFormOpen(this);
                    });
                }

            } else {
                output.append('<tr>' +
                    '<td colspan="6">No Data Found !!</td>' +
                    '</tr>');

            }

        }
    });
}

function deleteUsers(a) {
    console.log(a);
    if (confirm("Do you want to delete (" + a + ") user?") == true) {
        $.ajax({
            type: 'GET',
            url: '../api/deleteUser?dealerId=' + a,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(response) {
                if (response == "200") {
                    message("Your (" + a + ") User Successfully deleted (:");
                    DealerList($("tbody"));
                } else {
                    message("Somethings Went wrong :)");

                }

            }
        });
    } else {
        return
    }
}

function dealerEditForms(fff) {
    $.ajax({
        type: 'POST',
        url: '../api/editDealerForm.php',
        data: fff,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {},
        success: function(response) {
            if (response == "200") {
                message('Data Updated Successfully.');
                $(".close").click();
                DealerList($("tbody"));
            } else {
                message("Try Again");
            }

        }
    });
}

function EditFormOpen(id) {
    let dealerId = id.id;
    $.ajax({
        type: 'POST',
        url: '../api/dealerData.php',
        data: {
            dealerId: dealerId
        },
        dataType: "json",
        beforeSend: function() {},
        success: function(response) {
            if (response[0].status == "200") {
                $("#edit_firstName").val(response[1].firstName);
                $("#edit_lastName").val(response[1].lastName);
                $("#edit_username").val(dealerId);
                $("#edit_email").val(response[1].email);
                $("#edit_address").val(response[1].address);
                $("#edit_password").val(response[1].password);
                $("#edit_status").val(response[1].status);
            } else {
                message("Try Again");

            }

        }
    });
    $(".editDealerForm").parent().removeClass('hide');
}

function AdminRechargeToken(fff) {
    $.ajax({
        type: 'POST',
        url: '../api/AdminRechargeToken.php',
        data: fff,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {},
        success: function(response) {
            if (response == "200") {
                message("Token Alloted Successfully!!", 1500);
            } else if (response == 300) {
                message('Your Quantity is too Low', '', 'large', 'danger');
            } else {
                message("Try Again");

            }

        }
    });
}

function dealerRegisForms(fff, a) {
    $.ajax({
        type: 'POST',
        url: '../api/dealerRegisForm',
        data: fff,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {},
        success: function(response) {
            if (response == "200") {
                message("Dealer added Successfully!!", 1500);
                a.reset();
                DealerList($("tbody"));
            } else if (true) {
                message("UserName or Email Already Taken", '', 'large', 'danger');
            } else {
                message("Try Again");
            }

        }
    });
}

function ChangePassword(a, b) {
    $.ajax({
        type: 'POST',
        url: '../api/ChangePassword',
        data: a,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            if (response == 200) {
                message("Your Password is Successfully Updated.", "", "large");
                b.reset();
            } else if (response == 300) {
                message("Your Old Password is not Match with ours Detail.", "", "large", "danger");
            } else if (response == 400) {
                message("Your New Password is not Match.", "", "large", "danger");
            } else {
                message("Please Try again :)", "", "large", "danger");
            }
        }
    });
}

function info(a) {
    $("#viewBoxClient").toggleClass("hide");
    if (a > 0) {
        $.ajax({
            type: 'POST',
            url: '../api/infoClientData',
            data: {
                certificateNo: a
            },
            dataType: 'json',
            // contentType: false,
            // cache: false,
            // processData: false,
            success: function(response) {
                if (response.status == 200) {
                    $(".certNo").html(a);
                    $(".generatedDate").html(response.generatedDate);
                    $(".nextRenewalDate").html(response.nextRenewal);
                    $(".clientName").html(response.name);
                    $(".clientAddress").html(response.address);
                    $(".srNoInNoInDate").html(response.srInD);
                    $(".placStatRto").html(response.placeRto);
                } else if (response.status == 300) {
                    message("Data Not Fetch.", "", "large", "danger");
                } else {
                    message("Please Try again :)", "", "large", "danger");
                }
            }
        });
    }
}

function update(a) {
    var updateInterval = 100;
    if (a == "play" || a == "" || !a) {
        plot.setData([getRandomData()]);
        plot.draw();
    }
    setTimeout(function() { update(a) }, updateInterval);
}