$(document).ready(function () {

    user_id = localStorage.getItem("uid");
    $.busyLoadFull("show",{
        spinnerClass: "loader-item",
        spinner: "cube",
        text: "Setting your profile up..."
    });
    if(user_id !== null){
        var params = {
            work: 'fill_form'
        };
        getProfileData(user_id, params);
    }

    $('#profile-img').change(function () {
        readURL(this);
    });

    /*
        Validating Entire form
    */
    $.validator.setDefaults({
        ignore: [],
        errorElement: 'em',
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            element.closest(".form-group").addClass("has-feedback");
            if (element.prop("type") === "radio") {
                error.insertBefore(element.parents(".form-group"));
            } else {
                error.insertAfter(element.closest(".form-group"));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).closest(".form-group").addClass("has-error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest(".form-group").removeClass("has-error");
        }
    });

    $.validator.addMethod("validText", function (value, element) {
        return this.optional(element)
            || /^[a-z0-9\-\s\,\.\;\:\(\)]+$/i.test(value);
    }, "Please enter valid text");

    $.validator.addMethod("simpleText", function (value, element) {
        return this.optional(element)
            || /^[a-z\s\.\(\)]+$/i.test(value);
    }, "Only Alphabets and spaces are allowed");

    $.validator.addMethod('validEmail', function(value, element) {
        return this.optional(element)
            || /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value);
    },'Please enter a valid email address');

    $.validator.addMethod('mobileIN', function (value, element) {
        var up_value = replaceAll(value, ' ', '');
        return this.optional(element) ||
            up_value.match(/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[6789]\d{9}$/g);
    }, 'Please enter a valid phone number');

    $.validator.addMethod('addressIN', function (value, element) {
        return this.optional(element) ||
            value.match(/^[a-zA-Z0-9-_ \,\/] ?([a-zA-Z0-9-_ \,\/]|[a-zA-Z0-9-_ \,\/] )*[a-zA-Z0-9-_ \,\/]$/g);
    }, 'Please enter a valid address');

    $.validator.addMethod("validFile", function(value, element) {
        return this.optional(element)
            || /(?:\/|\\)?((?:[a-z0-9_])+\.(?:png|jpeg|jpg|svg))$/i.test(value);
    }, "Incorect file type");

    $.validator.addMethod('filesize', function (value, element) {
        var minsize=1000;
        var maxsize=4000000;
        return this.optional(element)
            || ( element.files[0].size>minsize && element.files[0].size<=maxsize );
    },'File size must be between 1Kb and 4Mb');

    $('#user-profile-form').validate({
        rules: {
            username: {
                required: true,
                simpleText: true
            },
            experience: {
                number: true
            },
            emailid:{
                validEmail: true
            },
            phonenum:{
                mobileIN: true
            },
            biodata: {
                validText: true
            },
            education:{
                validText: true
            },
            speciality:{
                validText: true
            },
            address: {
                addressIN: true
            }
        },
        messages: {
            username: {
                required: "Please enter your name",
                simpleText: "Please enter name in valid format"
            },
            experience: {
                number: "Enter Experience in years"
            },
            emailid:{
                validEmail: "Please provide a valid email address"
            },
            phonenum:{
                mobileIN: "Please enter a valid phone number"
            },
            biodata: {
                validText: "No special characters are allowed"
            },
            education:{
                validText: "No special characters are allowed"
            },
            speciality:{
                validText: "No special characters are allowed"
            },
            address: {
                addressIN: "Please enter a valid address"
            }
        }
    });

    $('#profile-image-field').validate({
        rules: {
            profileImage: {
                validFile: true,
                filesize: true
            }
        },
        messages: {
            profileImage: {
                validFile: "Please enter a valid image",
                filesize: "Image size cannot be greater than 4Mb"
            }
        }
    });

    $('#pf-img-lbl').click(function () {
       if(!$('#profile-image-field').valid()){
           return;
       }
    });


    $('#profile-save-btn').click(function () {
       if($('#user-profile-form').valid()){
           $.busyLoadFull("show", {
               spinnerClass: "loader-item",
               spinner: "cube"
           });
           var uname = $('#user-name').val();
           var email = $('#email-id').val();
           var exp = $('#user-exp').val();
           var phone = $('#phone-num').val();
           var bio = $('#user-bio').val();
           var spec = $('#user-spec').val();
           var edu = $('#user-edu').val();
           var addr = $('#user-addr').val();
           ajax('json',{trigger: 'updateUserProfile', classInvoker: 'user'},
               {uid: user_id, uname: uname, uspec: spec, uedu: edu, ubio: bio, uaddr: addr, exp:exp},
               function (data) {
                    var res = data['response'];
                    if(res == 'updation_success'){
                        updateUserInfo(user_id, email, phone);
                        if(bio !== null){
                            $('#profile-bio').text(bio.substring(0,140) + '...');
                        }else {
                            $('#profile-bio').text('');
                        }
                        if(uname !== null){
                            $('.profile-name').text('Dr. ' + uname);
                        } else{
                            $('.profile-name').text('');
                        }
                    }else {
                        $.busyLoadFull("hide");
                        alertify.error("Profile updation failed");
                    }
               },
               function (xhr, errorType, error) {
                   console.log("Error TYpe: " + errorType + " Error: " + error);
               }
           );
       }
    });
});

function escapeRegExp(str) {
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}
function replaceAll(str, find, replace) {
    return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function updateUserInfo(uid, email, phone) {
    var up_phone = replaceAll(phone, ' ', '');
    ajax('json',{trigger: 'updateUserData', classInvoker: 'user'},
        {uid: uid, phone: up_phone, mail: email},
        function (data) {
            var res = data['response'];
            if(res == 'success'){
                alertify.success("Profile updated successfully");
            }else {
                alertify.error("Profile updation failed");
            }
            $.busyLoadFull("hide");
        },
        function (xhr, errorType, error) {
            console.log("Error TYpe: " + errorType + " Error: " + error);
        }
    );
}

function getProfileData(user_id, params) {
    ajax('json', {trigger: 'selectProfileByID', classInvoker: 'user'},
        {uid: user_id},
        function (data) {
            var res = data['response'];
            if(res == "success"){
                if(params['work'] == 'fill_form'){
                    getUserData(user_id, data['row']);
                }else if(params['work'] == 'change_image'){
                    deleteCurrentImage(user_id, data['row']);
                }
            }
        },
        function (xhr, errorType, error) {
            console.log("Error Type: " + errorType + " Error: " + error);
        }
    );
}

function getUserData(user_id, profile_data){
    ajax('json', {trigger: 'selectUserByID', classInvoker: 'user'},
        {uid: user_id},
        function (data) {
            var res = data['response'];
            if(res == "success"){
                var user_data = data['row'];
                fillExistingData(profile_data, user_data);
            }
        },
        function (xhr, errorType, error) {
            console.log("Error Type: " + errorType + " Error: " + error);
        }
    );
}

function fillExistingData(profile_data, user_data) {
    if(profile_data !== null && user_data !== null){
        $('#profile-img-tag').attr('src', profile_data['profile_image']);
        $('#user-name').val(profile_data['user_name']);
        if(profile_data['user_name'] !== null){
            $('.profile-name').text('Dr. ' + profile_data['user_name']);
        } else{
            $('.profile-name').text('');
        }
        $('#email-id').val(user_data['user_email']);
        $('#user-exp').val(profile_data['user_experience']);
        $('#phone-num').val(user_data['user_mobile']);
        $('#user-bio').val(profile_data['user_bio']);
        if(profile_data['user_bio'] !== null){
            $('#profile-bio').text(profile_data['user_bio'].substring(0,140) + '...');
        }else {
            $('#profile-bio').text('');
        }
        $('#user-spec').val(profile_data['user_speciality']);
        $('#user-edu').val(profile_data['user_education']);
        $('#user-addr').val(profile_data['user_address']);
    }
    $.busyLoadFull("hide");
}



function readURL(input) {
    if (input.files && input.files[0]) {
        getProfileData(user_id, {work: 'change_image'});
        var neuron = {trigger: 'updateProfileImage', classInvoker: 'user'};
        var fdata = new FormData();
        Object.keys(neuron)
            .forEach(function eachKey(key) {
                fdata.append(key, neuron[key]);
            });
        fdata.append("profile_img", input.files[0]);
        if(user_id !== null){
            fdata.append("uid", user_id);
        }else {
            fdata.append("uid", "not_found");
        }
        ajaxMultiData('json', fdata,
            function(data) {
                var res = data['response'];
                if(res == "update_success"){
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }else if(res == "duplicate_file"){
                    alertify.log("Cant change current image with same image");
                }else {
                    alertify.error("Profile picture updation failed");
                }
            },
            function(xhr, errorType, error) {
                console.log("Error is: " + error + " Error type: " + errorType);
            }
        );
    }
}

function deleteCurrentImage(user_id, profile_data) {
    ajax('json', {trigger: 'deleteCurrentImg', classInvoker: 'user'},
        {uid: user_id, profile_img: profile_data['profile_image']},
        function (data) {
        },
        function (xhr, errorType, error) {
            console.log("Error is: " + error + " Error type: " + errorType);
        }
    );
}