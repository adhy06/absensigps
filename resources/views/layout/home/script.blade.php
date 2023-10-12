<!-- Jquery -->
<script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
<!-- Bootstrap-->
<script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>

<link href="{{ asset('assets/dist/css/tabler.min.css?1692870487')}}" rel="stylesheet">
<link href="{{ asset('assets/dist/css/tabler-flags.min.css?1692870487')}}" rel="stylesheet">
<link href="{{ asset('assets/dist/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet">
<link href="{{ asset('assets/dist/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet">
<link href="{{ asset('assets/dist/css/demo.min.css?1692870487')}}" rel="stylesheet">

<script src="{{ asset('assets//dist/js/demo-theme.min.js?1692870487')}}"></script>

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
<script src="{{ asset('sweetalert2.all.min.js')}}"></script>
<!-- Script sweetalert -->


<!-- Base Js File -->
<script src="{{ asset('assets/js/base.js') }}"></script>

<!-- Date Pickerday -->
{{-- <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script> --}}
<Script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></Script>

<script src="{{ asset('assets/dist/js/tabler.min.js?1692870487')}}" defer=""></script>
<script src="{{ asset('assets/dist/js/demo.min.js?1692870487')}}" defer=""></script>

<script src="https://api.mapbox.com/mapbox-gl-js/v1.8.0/mapbox-gl.js" defer=""></script>


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

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        mapboxgl.accessToken = 'pk.eyJ1IjoiY29kZWNhbG0iLCJhIjoiSzRiOVJvQSJ9.BUVkTT6IYs83xSUs4H7bjQ';
        var map = new mapboxgl.Map({
            container: 'map-markers',
            style: 'mapbox://styles/mapbox/light-v10',
            zoom: 1,
            center: [0, 0],
        });
        new mapboxgl.Marker({ color: tabler.getColor("primary") }).setLngLat([-58.666667, -34.58333333]).addTo(map);
        new mapboxgl.Marker({ color: tabler.getColor("primary") }).setLngLat([16.366667, 48.2]).addTo(map);
        new mapboxgl.Marker({ color: tabler.getColor("primary") }).setLngLat([116.383333, 39.91666667]).addTo(map);
        new mapboxgl.Marker({ color: tabler.getColor("primary") }).setLngLat([149.133333, -35.26666667]).addTo(map);
        new mapboxgl.Marker({ color: tabler.getColor("primary") }).setLngLat([58.583333, 23.61666667]).addTo(map);
        new mapboxgl.Marker({ color: tabler.getColor("primary") }).setLngLat([-77, 38.883333]).addTo(map);
    });
    // @formatter:on
  </script>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        mapboxgl.accessToken = 'pk.eyJ1IjoiY29kZWNhbG0iLCJhIjoiSzRiOVJvQSJ9.BUVkTT6IYs83xSUs4H7bjQ';
        var map = new mapboxgl.Map({
            container: 'map-light',
            style: 'mapbox://styles/mapbox/light-v10',
            zoom: 11,
            center: [-0.2416782, 51.5285582],
        });
    });
    // @formatter:on
  </script>

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function() {
        mapboxgl.accessToken = 'pk.eyJ1IjoiY29kZWNhbG0iLCJhIjoiSzRiOVJvQSJ9.BUVkTT6IYs83xSUs4H7bjQ';
        var map = new mapboxgl.Map({
            container: 'map-simple',
            style: 'mapbox://styles/mapbox/streets-v11',
            zoom: 13,
            center: [13.404900, 52.518827],
        });
    });
    // @formatter:on
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