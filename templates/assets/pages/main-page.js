$(function () {
    addMaps('#gmaps-markers');
    var curr = new Date();
    var arr = [new Date(curr.getTime() - 180*60000),new Date(curr.getTime() - 120*60000),new Date(curr.getTime() - 60*60000),curr,
        new Date(curr.getTime() + 60*60000), new Date(curr.getTime() + 120*60000)];

    generateAjax(arr, generateChart);

    var enumerateDaysBetweenDates = function(startDate, endDate, change) {
        var dates = [];
        var currDate = moment(startDate).startOf('day');
        var lastDate = moment(endDate).startOf('day');
        while(currDate.add(change, 'days').diff(lastDate) < 0) {
            dates.push(currDate.clone().toDate());
        }
        return dates;
    };

    $('#hourlyBtn').on('click',function(){
        var curr = new Date();
        var arr = [new Date(curr.getTime() - 180*60000),new Date(curr.getTime() - 120*60000),new Date(curr.getTime() - 60*60000),curr,
            new Date(curr.getTime() + 60*60000), new Date(curr.getTime() + 120*60000)];
        generateAjax(arr, generateChart);
    });

    $('#weeklyBtn').on('click',function(){
        var startOfWeek = moment().startOf('isoweek').toDate();
        var endOfWeek = moment().endOf('isoweek').toDate();
        var arr = enumerateDaysBetweenDates(startOfWeek, endOfWeek, 1);
        arr.unshift(startOfWeek);
        arr.push(endOfWeek);
        generateAjax(arr, generateWeeklyChart);
    });
    $('#monthlyBtn').on('click', function (){
        var startOfMonth = moment().startOf('month').toDate();
        var endOfMonth   = moment().endOf('month').toDate();
        var arr = enumerateDaysBetweenDates(startOfMonth, endOfMonth ,6);
        arr.unshift(startOfMonth);
        arr.push(endOfMonth);
        generateAjax(arr, generateMonthlyChart);
    });

    ajax('json', {trigger: 'getEnquiryCount', classInvoker: 'enquiry'},
        {},
        function(data) {
            var res = data['response'];
            if(res == 'success') {
                $('#enquiry-count').text(data['count']);
            } else {
                $('#enquiry-count').text("Error! Refresh now");
            }
        },
        function (xhr, errorType, error) {
            console.log('Error Type: ' + errorType + ', Error: ' + error);
        }
    );

    ajax('json', {trigger: 'getTestimonialCount', classInvoker: 'testimonial'},
        {},
        function(data) {
            var res = data['response'];
            if(res == 'success') {
                $('#testimonial-count').text(data['count']);
            } else {
                $('#testimonial-count').text("Error! Refresh now");
            }
        },
        function (xhr, errorType, error) {
            console.log('Error Type: ' + errorType + ', Error: ' + error);
        }
    );

    ajax('json', {trigger: 'getVisitorCount', classInvoker: 'visitor'},
        {},
        function(data) {
            var res = data['response'];
            if(res == 'success') {
                $('#visitor-count').text(data['count']);
            } else {
                $('#visitor-count').text("Error! Refresh now");
            }
        },
        function (xhr, errorType, error) {
            console.log('Error Type: ' + errorType + ', Error: ' + error);
            console.log(xhr);
        }
    );

    ajax('json', {trigger: 'getCaseStudyCount', classInvoker: 'casestudy'},
        {},
        function(data) {
            var res = data['response'];
            if(res == 'success') {
                $('#casestudy-count').text(data['count']);
            } else {
                $('#casestudy-count').text("Error! Refresh now");
            }
        },
        function (xhr, errorType, error) {
            console.log('Error Type: ' + errorType + ', Error: ' + error);
        }
    );
    ajax('json',{trigger: 'selectAllEnquiry', classInvoker: 'enquiry'},
        {},
        function (data) {
            var res = data['response'];
            if( res == "success" ) {
                for (let i = 0; i < data['rows'].length ; i++) {
                    if (i == 5) {
                        break;
                    } else {
                        var date = new Date(data['rows'][i]['enquiry_timestamp']);
                        var html = `<tr>
                                        <td>
                                            ${date.toLocaleDateString("hi-IN")}
                                        </td>
                                        <td><cite>${data['rows'][i]['name']}</cite></td>
                                        <td>${data['rows'][i]['email']}</td>
                                        <td>${data['rows'][i]['mobile']}</td>                                        
                                    </tr>`;
                        $('#enquiry-table-body').append(html);
                    }
                }
            } else {
                var html = `<tr>
                                <td>No Enquiries Found :(</td>
                             </tr>`;
                $('#enquiry-table-body').append(html);
            }
        },
        function (xhr, errorType, error) {
            console.log('Error Type: ' + errorType + ', Error: ' + error);
        }
    );

    ajax('json', {trigger: 'selectAllTestimonial', classInvoker: 'testimonial'},
        {},
        function (data) {
            var res = data['response'];
            if( res == "success" ) {

                for (let i = 0; i < data['rows'].length ; i++) {
                    if (i == 5) {
                        break;
                    } else {
                        var date = new Date(data['rows'][i]['ts_given_on']);
                        var line = "";
                        var ch = data['rows'][i]['ts_rating'].trim();
                        switch (ch) {
                            case 'good':
                                line = '<input type="hidden" class="rating" data-filled="mdi mdi-star font-32 text-primary" data-empty="mdi mdi-star-outline font-32 text-muted" data-readonly value="4"/>';
                                break;
                            case 'very good':
                                line = '<input type="hidden" class="rating" data-filled="mdi mdi-star font-32 text-primary" data-empty="mdi mdi-star-outline font-32 text-muted" data-readonly value="5"/>';
                                break;
                            case 'bad':
                                line = '<input type="hidden" class="rating" data-filled="mdi mdi-star font-32 text-primary" data-empty="mdi mdi-star-outline font-32 text-muted" data-readonly value="2"/>';
                                break;
                            case 'very bad':
                                line = '<input type="hidden" class="rating" data-filled="mdi mdi-star font-32 text-primary" data-empty="mdi mdi-star-outline font-32 text-muted" data-readonly value="1"/>';
                                break;
                            case 'normal':
                                line = '<input type="hidden" class="rating" data-filled="mdi mdi-star font-32 text-primary" data-empty="mdi mdi-star-outline font-32 text-muted" data-readonly value="3"/>';
                                break;
                            default:
                                line = '<input type="hidden" class="rating" data-filled="mdi mdi-star font-32 text-primary" data-empty="mdi mdi-star-outline font-32 text-muted" data-readonly value="3"/>';
                                break;
                        }
                        var html = `<tr>
                                        <td>
                                            <img src="${data['rows'][i]['ts_img']}" alt="user-image" class="thumb-sm rounded-circle backup-picture"/>
                                             ${data['rows'][i]['ts_patient_name']}
                                        </td>
                                        <td>${line}</td>
                                        <td>${data['rows'][i]['ts_details']}</td>
                                    </tr>`;
                        $('#testimonial-table-body').append(html);
                    }
                }
                $('.rating').rating();
                $('img').on("error", function(){
                    $(this).attr('src', 'assets/images/users/avatar-1.jpg');
                });
            } else {
                var html = `<tr>
                                <td>No Testimonials Found :(
                                <a href="testimonial.html" class="btn btn-sm btn-primary btn-add-data waves-effect waves-light">Add one</a></td>
                             </tr>`;
                $('#testimonial-table-body').append(html);
            }
        },
        function (xhr, errorType, error) {
            console.log('Error Type: ' + errorType + ', Error: ' + error);
        }
    );
});

function generateAjax(arr, funcName){
    var dataPointEnquiry = [];
    var dataPointVisit = [];
    var statusCount = 0;
    ajax('json',{trigger: 'getEnquiryGraphData', classInvoker: 'enquiry'},
        {xArray: arr},
        function (data) {
            var res = data['response'];
            statusCount += 1;
            if(res == "success") {
                dataPointEnquiry = data['dataPoints'];
            }else{
                dataPointEnquiry = ['Enquiries', 0, 0, 0, 0, 0, 0, 0];
            }
            if (statusCount == 2){
                arr.unshift('x');
                funcName(arr, dataPointEnquiry, dataPointVisit);
            }
        },
        function (xhr, errorType, error) {
            console.log('Error Type: ' + errorType + ', Error: ' + error);
        }
    );

    ajax('json',{trigger: 'getVisitGraphData', classInvoker: 'visitor'},
        {xArray: arr},
        function (data) {
            var res = data['response'];
            statusCount += 1;
            if(res == "success") {
                dataPointVisit = data['dataPoints'];
            }else{
                dataPointVisit = ['Visits', 0, 0, 0, 0, 0, 0, 0];
            }
            if(statusCount == 2){
                arr.unshift('x');
                funcName(arr, dataPointEnquiry, dataPointVisit);
            }
        },
        function (xhr, errorType, error) {
            console.log('Error Type: ' + errorType + ', Error: ' + error);
        }
    );
}

var generateChart = function(arr, dataPointEnquiry, dataPointVisit){
    var chart = c3.generate({
        bindto: '#combine-chart',
        data: {
            x: 'x',
            xFormat: '%H:%M',
            columns: [
                arr,
                dataPointEnquiry,
                dataPointVisit
            ],
            types: {
                Enquiries: 'area-spline',
                Visits: 'area-spline'
            },
            colors: {
                Enquiries: '#4ac18e',
                Visits: '#ffbb44',
            }
        },
        axis: {
            x: {
                type: 'timeseries',
                localtime: true,
                tick: {
                    format: '%H:%M %p'
                }
            }
        }
    });
}

var generateMonthlyChart =function(arr, dataPointEnquiry, dataPointVisit) {
    var chart = c3.generate({
        bindto: '#combine-chart',
        data: {
            x: 'x',
            xFormat: '%d-%m-%Y',
            columns: [
                arr,
                dataPointEnquiry,
                dataPointVisit
            ],
            types: {
                Enquiries: 'area-spline',
                Visits: 'area-spline'
            },
            colors: {
                Enquiries: '#4ac18e',
                Visits: '#ffbb44',
            }
        },
        axis: {
            x: {
                type: 'timeseries',
                localtime: true,
                tick: {
                    format: '%d-%m-%Y'
                }
            }
        }
    });
}

var generateWeeklyChart = function(arr, dataPointEnquiry, dataPointVisit){
    var chart = c3.generate({
        bindto: '#combine-chart',
        data: {
            x: 'x',
            xFormat: '%a %d-%m-%Y',
            columns: [
                arr,
                dataPointEnquiry,
                dataPointVisit
            ],
            types: {
                Enquiries: 'area-spline',
                Visits: 'area-spline'
            },
            colors: {
                Enquiries: '#4ac18e',
                Visits: '#ffbb44',
            }
        },
        axis: {
            x: {
                type: 'timeseries',
                localtime: true,
                tick: {
                    format:  '%d-%m-%Y'
                }
            }
        }
    });
}


function addMaps($container) {
    var markerArray = [];
    var map = new GMaps({
        div: $container,
        lat: 19.0760,
        lng: 72.8777,
        zoom: 12
    });

    ajax('json', {trigger: 'selectVisitors', classInvoker: 'visitor'},
        {},
        function (data) {
            var res = data['response'];
            var result = data['rows'];
            if(res == 'success') {
                var bounds = [];
                if(result.length > 10) {
                    for (let i = 0; i < 10; i++) {
                        var latlng = new google.maps.LatLng(result[i]['latitude'], result[i]['longitude']);
                        bounds.push(latlng);
                        markerArray.push({
                            lat: result[i]['latitude'],
                            lng: result[i]['longitude'],
                            title: result[i]['region'],
                            infoWindow: {
                                content: `<p>result['region'], result['zipcode']<br></br>result['country'], result['country_code']</p>`
                            }
                        });
                    }
                    map.fitLatLngBounds(bounds);
                    map.addMarkers(markerArray);
                }
            }
        },
        function (xhr, errorType, error) {
            console.log("Error type: " + errorType + " Error: " + error);
        }
    );
    return map;
}
