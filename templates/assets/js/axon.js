/*
    Axon file
*/

// Main Ajax function
function ajax(datatype, neuron, parameters, callback, error, async=true) {
    var neuron = typeof neuron == 'string' ? neuron : Object.keys(neuron).map(
        function (k) { return encodeURIComponent(k) + '=' + encodeURIComponent(neuron[k]) }
    ).join('&');

    var params = typeof parameters == 'string' ? parameters : Object.keys(parameters).map(
        function (k) { return encodeURIComponent(k) + '=' + encodeURIComponent(parameters[k]) }
    ).join('&');

    $.ajax({
        type: "POST",
        dataType: datatype,
        async: async,
        url: "../Server/neuron.php",
        data: neuron + '&' + params,
        success: callback,
        error: error
    });
}

// AJAX fucntion for multipart data
function ajaxMultiData(datatype, formdata, callback, error){
    $.ajax({
       type: "POST",
       dataType: datatype,
       url: '../Server/neuron.php',
       data: formdata,
       contentType: false,
       processData: false,
       success: callback,
       error: error
    });
}