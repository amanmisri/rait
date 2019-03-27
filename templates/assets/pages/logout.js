$(function () {
    $('#logout-btn').on('click', function () {
        localStorage.clear();
        if((localStorage.getItem('uid') === null) && (localStorage.getItem('uname') === null)){
            window.location.href = 'admin-login.html';
        }
    });
});