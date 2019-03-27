$(function () {
    setInterval(function () {
        updateNotifications();
    }, 300000);

    if(localStorage.getItem('notifCount') !== null){
        var count = localStorage.getItem('notifCount');
        if(count > 0){
            var html1 = `<span class="badge badge-danger noti-icon-badge">${count}</span>`;
            $('#notification-dropdown').append(html1);
            $('div.noti-title').text(`Notification (${count})`);
            var html2 = `<a href="enquiry.html" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details"><b>New Enquiries received</b><small class="text-muted">You have ${count} unattended enquiries</small></p>
                        </a>`;
            $('#notification-section').append(html2);
        }else{
            $('div.noti-title').text(`Notification (0)`);
            var html2 = `<a href="enquiry.html" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details"><b>No new enquiries !</b><small class="text-muted">You have 0 unattended enquiries</small></p>
                        </a>`;
            $('#notification-section').append(html2);
        }
    }else {
        $('div.noti-title').text(`Notification (0)`);
        var html2 = `<a href="enquiry.html" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                        <p class="notify-details"><b>No new enquiries !</b><small class="text-muted">You have 0 unattended enquiries</small></p>
                    </a>`;
        $('#notification-section').append(html2);
    }

    $(document).off('.dropdown-item, .notify-item', 'click');
    $(document).on('.dropdown-item, .notify-item', 'click', function () {
        $('div.noti-title').text(`Notification (0)`);
        var html2 = `<a href="enquiry.html" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                        <p class="notify-details"><b>No new enquiries !</b><small class="text-muted">You have 0 unattended enquiries</small></p>
                    </a>`;
        $('#notification-section').append(html2);
    });

    function updateNotifications() {
        ajax('json', {trigger: 'getUpdatedNotificationCount', classInvoker: 'user'},
            {},
            function (data) {
                var res = data['response'];
                if(res == "success"){
                    localStorage.setItem('notifCount', data['count']);
                }else {
                    localStorage.setItem('notifCount', '0');
                }
                changeNotificationHTML();
            },
            function (xhr, errorType, error) {
                console.log("Error Type: " + errorType + " Error is: " + error);
            }
        );
    }

    function changeNotificationHTML() {
        var count = localStorage.getItem('notifCount');
        if(count > 0){
            var html1 = `<span class="badge badge-danger noti-icon-badge">${count}</span>`;
            $('#notification-dropdown').append(html1);
            $('div.noti-title').text(`Notification (${count})`);
            var html2 = `<a href="enquiry.html" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details"><b>New Enquiries received</b><small class="text-muted">You have ${count} unattended enquiries</small></p>
                        </a>`;
            $('#notification-section').append(html2);
        }else{
            $('div.noti-title').text(`Notification (0)`);
            var html2 = `<a href="enquiry.html" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                            <p class="notify-details"><b>No new enquiries !</b><small class="text-muted">You have 0 unattended enquiries</small></p>
                        </a>`;
            $('#notification-section').append(html2);
        }
    }
});