<!-- Jquery -->
<script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
<!-- Bootstrap-->
<script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Owl Carousel -->
<script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<!-- jQuery Circle Progress -->
<script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>


<!-- Datepikerday CSS -->
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css"> --}}

<!-- Script Camera -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<!-- Script Camera -->

<!-- Script sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<!-- Script sweetalert -->


<!-- Base Js File -->
<script src="{{ asset('assets/js/base.js') }}"></script>

<!-- Date Pickerday -->
{{-- <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script> --}}
<Script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></Script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdu9gXgc3X1zN0ENhSb6fh4me9aEslKHI&libraries=&v=weekly" defer></script>

<script>
    am4core.ready(function () {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        var chart = am4core.create("chartdiv", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = [
            {
                country: "Hadir",
                litres: 0
            },
            {
                country: "Sakit",
                litres: 0
            },
            {
                country: "Izin",
                litres: 0
            },
            {
                country: "Terlambat",
                litres: 0
            },
        ];



        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "litres";
        series.dataFields.category = "country";
        series.alignLabels = false;
        series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
        series.labels.template.radius = am4core.percent(-40);
        series.labels.template.fill = am4core.color("white");
        series.colors.list = [
            am4core.color("#1171ba"),
            am4core.color("#fca903"),
            am4core.color("#37db63"),
            am4core.color("#ba113b"),
        ];
    }); // end am4core.ready()
</script>


{{-- <script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({ field: document.getElementById('datepicker') });
</script> --}}

{{-- 
<script src="moment.js"></script>
<script src="pikaday.js"></script>
<script>
    var picker = new Pikaday({
    field: document.getElementByClass('datepicker'), 
    format: 'Y-m-d',
    toString(date, format) {
        // you should do formatting based on the passed format,
        // but we will just return 'D/M/YYYY' for simplicity
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        return `${year}-${month}-${day}`;
    },
    parse(dateString, format) {
        // dateString is the result of `toString` method
        const parts = dateString.split('-');
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const year = parseInt(parts[2], 10);
        return new Date(year, month, day);
    }
}); --}}

{{-- <script src="moment.js"></script>
<script src="pikaday.js"></script> --}}
{{-- <script>
    var picker = new Pikaday({
    field: document.getElementById('datepicker'), 
    format: 'Y-m-d',
    toString(date, format) {
        // you should do formatting based on the passed format,
        // but we will just return 'D/M/YYYY' for simplicity
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        return `${year}-${month}-${day}`;
    },
    parse(dateString, format) {
        // dateString is the result of `toString` method
        const parts = dateString.split('-');
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const year = parseInt(parts[2], 10);
        return new Date(year, month, day);
    }
}); --}}

{{-- 
</script> --}}

@stack('myscript')