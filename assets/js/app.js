function createSlug() {
    let title = $('#title').val();
    $('#slug').val(string_to_slug(title));
}

// SC : https://gist.github.com/codeguy/6684588
function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaeeeeiiiioooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
}

$(document).ready(function() {
    var baseurl = 
    $.ajax({
        type: 'post',
        url: 'dataprovinsi.php',
        success: function(hasil_provinsi) {
            $("select[name=nama-provinsi]").html(hasil_provinsi);
        }
    });

    $("select[name=nama-provinsi]").on("change", function() {
        // ambil id_prpvinsi dari attribute id_provinsi
        var id_provinsi_terpilih = $('option:selected', this).attr("id_provinsi");
        $.ajax({
            type: 'post',
            url: 'datadistrik.php',
            data: 'id_provinsi=' + id_provinsi_terpilih,
            success: function(hasil_distrik) {
                $("select[name=nama-distrik]").html(hasil_distrik);
            }
        });
    });

    $.ajax({
        type: 'post',
        url: 'dataekspedisi.php',
        success: function(hasil_ekspedisi) {
            $("select[name=nama-ekspedisi]").html(hasil_ekspedisi);
        }
    });

    $("select[name=nama-ekspedisi]").on("change", function() {
        // 3 Syarat Mendapatkan Biaya Ongkir
        // mendapatkan ekspedisi yg dipilih
        var ekspedisi = $("select[name=nama-ekspedisi]").val();

        // mendapatkan id_distrik yg dipilih pengguna
        var distrik = $("option:selected", "select[name=nama-distrik]").attr("id_distrik");

        // mendapatkan total berat
        var berat = $("input[name=total-berat]").val();

        $.ajax({
            type: 'post',
            url: 'dataongkir.php',
            data: 'ekspedisi=' + ekspedisi + '&distrik=' + distrik + '&berat=' + berat,
            success: function(hasil_ongkir) {
                $("select[name=nama-paket]").html(hasil_ongkir);
            }
        })

    })

});