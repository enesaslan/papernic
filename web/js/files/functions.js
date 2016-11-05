$(document).ready(function () {

    d = new Date();
    d.setUTCFullYear(2004);
    d.setUTCMonth(1);
    d.setUTCDate(29);
    d.setUTCHours(2);
    d.setUTCMinutes(45);
    d.setUTCSeconds(26);

    df = d.toLocaleDateString().replace("29", 'dd');
    df = df.replace("02", 'mm');
    df = df.replace("2004", 'yy');

    $('.dropdown-toggle').dropdown();

    $('#breadcrumbs').xBreadcrumbs();

    $(".remove").click(function () {
        $(this).parent('li').fadeTo(200, 0.00, function () {
            $(this).slideUp(200, function () {
                $(this).remove();
            });
        });
    });

    $('.breadLinks ul li').hover(function () {
        $(this).children("ul").slideToggle(150);
    });

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("has"))
            $('.breadLinks ul li').children("ul").slideUp(150);
    });

    $('#document_filter_column').change(function () {

        $('#btn_quick_document_search').hide("fast");

        if ($(this).val() == 'document_filter_type') {
            $('#qds_date_start').hide("fast");
            $('#qds_date_end').hide("fast");
            $('#qds_types').show("fast");
            $('#document_filter_value').hide("fast");
            $('#qds_categories').hide("fast");
            $('#qds_contacts').hide("fast");
        } else if ($(this).val() == 'document_filter_document_date' || $(this).val() == 'document_filter_date_added') {
            $('#qds_date_start').show("fast");
            $('#qds_date_end').show("fast");
            $('#qds_types').hide("fast");
            $('#document_filter_value').hide("fast");
            $('#qds_categories').hide("fast");
            $('#qds_contacts').hide("fast");
        } else if ($(this).val() == 'document_filter_category') {
            $('#qds_date_start').hide("fast");
            $('#qds_date_end').hide("fast");
            $('#qds_types').hide("fast");
            $('#document_filter_value').hide("fast");
            $('#qds_categories').show("fast");
            $('#qds_contacts').hide("fast");
        } else if ($(this).val() == 'document_filter_from' || $(this).val() == 'document_filter_to') {
            $('#qds_date_start').hide("fast");
            $('#qds_date_end').hide("fast");
            $('#qds_types').hide("fast");
            $('#document_filter_value').hide("fast");
            $('#qds_categories').hide("fast");
            $('#qds_contacts').show("fast");
        } else {
            $('#qds_date_start').hide("fast");
            $('#qds_date_end').hide("fast");
            $('#qds_types').hide("fast");
            $('#document_filter_value').show("fast");
            $('#qds_categories').hide("fast");
            $('#qds_contacts').hide("fast");
        }

        $('#btn_quick_document_search').show("normal");

    });

    $.datepicker.regional['tr']  = {
        closeText: "kapat",
        prevText: "&#x3C;geri",
        nextText: "ileri&#x3e",
        currentText: "bugün",
        monthNames: [ "Ocak","Şubat","Mart","Nisan","Mayıs","Haziran", "Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık" ],
        monthNamesShort: [ "Oca","Şub","Mar","Nis","May","Haz", "Tem","Ağu","Eyl","Eki","Kas","Ara" ],
        dayNames: [ "Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi" ],
        dayNamesShort: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
        dayNamesMin: [ "Pz","Pt","Sa","Ça","Pe","Cu","Ct" ],
        weekHeader: "Hf",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: "" };

    $(".datepicker").datepicker({
        defaultDate: +7,
        showOtherMonths: true,
        autoSize: false,
        dateFormat: 'yy-mm-dd'
    });

});

	
