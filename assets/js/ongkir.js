$( document ).ready(function() {
    var segments = window.location.href.split( '/' );
    if(segments[4]=='checkout')
    {
        load_city();
    }
});

function load_city(){
    var province = $("#province").val();
    $.ajax({
        url: '/omid/ajax/city',
        data:{province_id:province},
        type: 'POST',
        beforeSend: function() { $("body").addClass("loading");},
        success: function (data) {
            $('.district').html(data);
            
            load_subdistrict();
        }
    });
}


function load_subdistrict(){
    var cityId = $("#city").val();
    $.ajax({
        url: '/omid/ajax/subdistrict',
        data:{city_id:cityId},
        type: 'POST',
        success: function (data) {
            $('.sub-district').html(data);
            count_cost();
        }
    });
}


function count_cost(){
    var subDistrictId   = $("#subdistrict").val();
    var courier         = $("#courier").val();
    var weight          = $("#weight").val();
    $.ajax({
        url: '/omid/ajax/cost',
        data:{
            subdistrict_id:subDistrictId,
            courier:courier,
            weight:weight
        },
        type: 'POST',
        success: function (data) {
            $('.cost').html(data);
            getTotal();
            getOngkir();
        }
    });
}

function getOngkir() {
    var ongkir = $("#service").val();
    $.ajax({
        url: '/omid/ajax/ongkir',
        type: 'POST',
        data:{ongkir:ongkir},
        success: function (data) {
            $('.ongkir').html(data);
            $('#ongkir').val(data);
        }
    });
}


function getTotal(){
    var ongkir = $("#service").val();
    $.ajax({
        url: '/omid/ajax/total',
        type: 'POST',
        data:{ongkir:ongkir},
        success: function (data) {
            $('.total').html(data);
            $('#total').val(data);
        }
    });
}