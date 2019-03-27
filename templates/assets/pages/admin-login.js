$(function () {
    $(document).on("click", "[data-hide]", function(e) {
        e.preventDefault();
        $("." + $(this).attr("data-hide")).slideUp();
    });

    $('#login-form').on('submit', function (e) {
        e.preventDefault();
        $('#loader-part').busyLoad("show",{
            containerClass: "loader-container",
            spinnerClass: "loader-item",
            spinner: "cube"
        });
        var uname = $('#username').val();
        var upass = $('#userpassword').val();
        if(uname == ""){
            $('.alert').hide();
            var errorHTML = `<div class="alert alert-danger" id="errAlert">
                                        <button type="button" class="close" aria-hidden="true" data-hide="alert">&times;</button>
                                        Please fill in your username
                                    </div>`;
            $('#login-form').prepend(errorHTML);
            $('#loader-part').busyLoad("hide");
        }else if(upass == ""){
            $('.alert').hide();
            var errorHTML = `<div class="alert alert-danger" id="errAlert">
                                        <button type="button" class="close" aria-hidden="true" data-hide="alert">&times;</button>
                                        Please fill in your password
                                    </div>`;
            $('#login-form').prepend(errorHTML);
            $('#loader-part').busyLoad("hide");
        }else {
            ajax('json', {trigger: 'verifyLogin', classInvoker: 'user'},
                {username: uname, password: upass},
                function (data) {
                    var res = data['response'];
                    if (res == "success") {
                        setUserID(uname);
                    } else if (res == "insufficient_data") {
                        $('.alert').hide();
                        var errorHTML = `<div class="alert alert-danger" id="errAlert">
                                        <button type="button" class="close" aria-hidden="true" data-hide="alert">&times;</button>
                                        Please fill in both the fields
                                    </div>`;
                        $('#login-form').prepend(errorHTML);
                        $('#loader-part').busyLoad("hide");
                    } else {
                        $('.alert').hide();
                        var errorHTML = `<div class="alert alert-danger" id="errAlert">
                                        <button type="button" class="close" aria-hidden="true" data-hide="alert">&times;</button>
                                        Incorrect username or password
                                    </div>`;
                        $('#login-form').prepend(errorHTML);
                        $('#loader-part').busyLoad("hide");
                    }
                },
                function (xhr, errorType, error) {
                    console.log("Error type: " + errorType + " Error: " + error);
                    console.log(xhr);
                }
            );
        }
    });

    function setUserID(username) {
        ajax('json', {trigger: 'getUserID', classInvoker: 'user'},
            {username: username},
            function (data) {
                var res = data['response'];
                if(res == "success"){
                    localStorage.clear();
                    localStorage.setItem('uid', data['user_id']);
                    localStorage.setItem('uname', username);
                    storePreviousLastlogin(data['user_id']);
                }else {
                    $('#loader-part').busyLoad("hide");
                }
            },
            function (xhr, errorType, error) {
                console.log('Error Type: ' + errorType + ', Error: ' + error);
            }
        )
    }

    function storePreviousLastlogin(id) {
        ajax('json', {trigger: 'selectLastLogin', classInvoker: 'user'},
            {id: id},
            function (data) {
                var res = data['response'];
                if(res == "success"){
                    localStorage.setItem('notifCount', data['count']);
                    changeUserlogin(id);
                }else {
                    localStorage.setItem('notifCount', '0');
                    changeUserlogin(id);
                }
            },
            function (xhr, errorType, error) {
                console.log('Error Type: ' + errorType + ', Error: ' + error);
            }
        );
    }

    function changeUserlogin(id) {
        ajax('json', {trigger: 'updateLastLogin', classInvoker: 'user'},
            {id: id},
            function (data) {
                var res = data['response'];
                if((localStorage.getItem('uid') !== null) && (localStorage.getItem('uname') !== null)){
                    $('#loader-part').busyLoad("hide");
                    window.location.href = 'main-page.html';
                }else{
                    localStorage.clear();
                    $('#loader-part').busyLoad("hide");
                }
            },
            function (xhr, errorType, error) {
                console.log('Error Type: ' + errorType + ', Error: ' + error);
            }
        );
    }
});