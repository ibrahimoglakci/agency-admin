function getCssValuePrefix() {
    "use strict";
    for (var a = "", t = ["-o-", "-ms-", "-moz-", "-webkit-"], e = document.createElement("div"), r = 0; r < t.length; r++) (e.style.background = t[r] + "linear-gradient(#ffffff, #000000)"), e.style.background && (a = t[r]);
    return (e = null).remove(), a;
}
function index() {
    "use strict";
    var a,
        t = document.getElementById("transactions");
    t.height = "330";
    var e = t.getContext("2d"),
        r = e.createLinearGradient(0, 80, 0, 280);
    r.addColorStop(0, hexToRgba(myVarVal, 0.8) || "rgba(108, 95, 252, 0.8)"), r.addColorStop(1, hexToRgba(myVarVal, 0.2) || "rgba(108, 95, 252, 0.2) ");
    var o = e.createLinearGradient(0, 80, 0, 280);
    o.addColorStop(0, hexToRgba(myVarVal1, 0.8) || "rgba(5, 195, 251, 0.8)"), o.addColorStop(1, hexToRgba(myVarVal1, 0.8) || "rgba(5, 195, 251, 0.2) "), (document.getElementById("transactions").innerHTML = "");
    var n = $("#transactions").attr("ocak"),
        i = $("#transactions").attr("subat"),
        s = $("#transactions").attr("mart"),
        l = $("#transactions").attr("nisan"),
        d = $("#transactions").attr("mayis"),
        c = $("#transactions").attr("haziran"),
        _ = $("#transactions").attr("temmuz"),
        p = $("#transactions").attr("agustos"),
        b = $("#transactions").attr("eylul"),
        g = $("#transactions").attr("ekim"),
        f = $("#transactions").attr("kasim"),
        y = $("#transactions").attr("aralik"),
        u = $("#transactions").attr("topocak"),
        h = $("#transactions").attr("topsubat"),
        C = $("#transactions").attr("topmart"),
        k = $("#transactions").attr("topnisan"),
        m = $("#transactions").attr("topmayis"),
        S = $("#transactions").attr("tophaziran"),
        v = $("#transactions").attr("toptemmuz"),
        D = $("#transactions").attr("topagustos"),
        B = $("#transactions").attr("topeylul"),
        x = $("#transactions").attr("topekim"),
        L = $("#transactions").attr("topkasim"),
        z = $("#transactions").attr("toparalik");
    a = new Chart(t, {
        type: "line",
        data: {
            labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eyl\xfcl", "Ekim", "Kasım", "Aralık"],
            type: "line",
            datasets: [
                {
                    label: "Toplam Siparişler",
                    data: [u, h, C, k, m, S, v, D, B, x, L, z],
                    backgroundColor: r,
                    borderColor: myVarVal,
                    pointBackgroundColor: "#fff",
                    pointHoverBackgroundColor: r,
                    pointBorderColor: myVarVal,
                    pointHoverBorderColor: r,
                    pointBorderWidth: 0,
                    pointRadius: 0,
                    pointHoverRadius: 0,
                    borderWidth: 3,
                    fill: "origin",
                },
                {
                    label: "Teslim Edilen Siparişler",
                    data: [n, i, s, l, d, c, _, p, b, g, f, y],
                    backgroundColor: "transparent",
                    borderColor: "#05c3fb",
                    pointBackgroundColor: "#fff",
                    pointHoverBackgroundColor: o,
                    pointBorderColor: "#05c3fb",
                    pointHoverBorderColor: o,
                    pointBorderWidth: 0,
                    pointRadius: 0,
                    pointHoverRadius: 0,
                    borderWidth: 3,
                    fill: "origin",
                },
            ],
        },
        options: {
            responsive: !0,
            maintainAspectRatio: !1,
            tooltips: { enabled: !1 },
            legend: { display: !1, labels: { usePointStyle: !1 } },
            scales: {
                xAxes: [
                    { display: !0, gridLines: { display: !1, drawBorder: !1, color: "rgba(119, 119, 142, 0.08)" }, ticks: { fontColor: "#b0bac9", autoSkip: !0 }, scaleLabel: { display: !1, labelString: "Month", fontColor: "transparent" } },
                ],
                yAxes: [
                    {
                        ticks: { min: 0, max: 100, stepSize: 10, fontColor: "#b0bac9" },
                        display: !0,
                        gridLines: { display: !0, drawBorder: !1, zeroLineColor: "rgba(142, 156, 173,0.1)", color: "rgba(142, 156, 173,0.1)" },
                        scaleLabel: { display: !1, labelString: "sales", fontColor: "transparent" },
                    },
                ],
            },
            title: { display: !1, text: "Normal Legend" },
        },
    });
}

$(function (a) {
    "use strict";
    $.plot("#flotback-chart", [{ data: dashData10, color: "rgba(255,255,255, 0.2)", lines: { lineWidth: 1 } }], {
        series: { stack: 0, shadowSize: 0, lines: { show: !0, lineWidth: 1.8, fill: !0, fillColor: { colors: [{ opacity: 0 }, { opacity: 0.3 }] } } },
        grid: { borderWidth: 0, labelMargin: 5, hoverable: !0 },
        yaxis: { show: !1, color: "rgba(72, 94, 144, .1)", min: 0, max: 130, font: { size: 10, color: "#8392a5" } },
        xaxis: {
            show: !1,
            color: "rgba(72, 94, 144, .1)",
            ticks: [
                [0, "10"],
                [20, "20"],
                [20, "30"],
                [30, "40"],
                [40, "50"],
                [50, "60"],
                [60, "70"],
                [70, "80"],
                [80, "90"],
                [90, "100"],
                [100, "110"],
                [120, "120"],
            ],
            font: { size: 10, color: "#8392a5" },
            reserveSpace: !1,
        },
    });
    var t = document.getElementById("recentorders");
    (t.height = "225"),
        new Chart(t, {
            type: "bar",
            data: {
                labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                datasets: [
                    {
                        label: "This Month",
                        data: [27, 50, 28, 50, 28, 30, 22],
                        backgroundColor: "#61c9fc",
                        borderWidth: 2,
                        hoverBackgroundColor: "#61c9fc",
                        hoverBorderWidth: 0,
                        borderColor: "#61c9fc",
                        hoverBorderColor: "#61c9fc",
                        borderDash: [5, 2],
                    },
                    {
                        label: "This Month",
                        data: [32, 58, 68, 65, 40, 68, 58],
                        backgroundColor: "#f38ff3",
                        borderWidth: 2,
                        hoverBackgroundColor: "#f38ff3",
                        hoverBorderWidth: 0,
                        borderColor: "#f38ff3",
                        hoverBorderColor: "#f38ff3",
                        borderDash: [5, 2],
                    },
                ],
            },
            options: {
                responsive: !0,
                maintainAspectRatio: !1,
                layout: { padding: { left: 0, right: 0, top: 0, bottom: 0 } },
                tooltips: { enabled: !1 },
                scales: {
                    yAxes: [
                        {
                            display: !1,
                            gridLines: { display: !1, drawBorder: !1, zeroLineColor: "rgba(142, 156, 173,0.1)", color: "rgba(142, 156, 173,0.1)" },
                            scaleLabel: { display: !1 },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 25,
                                suggestedMin: 0,
                                suggestedMax: 100,
                                fontColor: "#8492a6",
                                userCallback: function (a) {
                                    return a.toString() + "%";
                                },
                            },
                        },
                    ],
                    xAxes: [
                        {
                            display: !1,
                            barPercentage: 0.4,
                            barValueSpacing: 0,
                            barDatasetSpacing: 0,
                            barRadius: 0,
                            stacked: !1,
                            ticks: { beginAtZero: !0, fontColor: "#8492a6" },
                            gridLines: { color: "rgba(142, 156, 173,0.1)", display: !1 },
                        },
                    ],
                },
                legend: { display: !1 },
                elements: { point: { radius: 0 } },
            },
        });
    var e = document.getElementById("saleschart").getContext("2d");
    (e.height = 10),
        new Chart(e, {
            type: "bar",
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [
                    {
                        label: "Total Sales",
                        data: [19, 15, 17, 14, 13, 15, 16],
                        backgroundColor: ["rgba(5, 195, 251, 0.2)", "rgba(5, 195, 251, 0.2)", "#05c3fb", "rgba(5, 195, 251, 0.2)", "rgba(5, 195, 251, 0.2)", "#05c3fb", "#05c3fb"],
                        borderColor: ["rgba(5, 195, 251, 0.5)", "rgba(5, 195, 251, 0.5)", "#05c3fb", "rgba(5, 195, 251, 0.5)", "rgba(5, 195, 251, 0.5)", "#05c3fb", "#05c3fb"],
                        pointBorderWidth: 2,
                        pointRadius: 2,
                        pointHoverRadius: 2,
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                maintainAspectRatio: !1,
                legend: { display: !1 },
                responsive: !0,
                tooltips: { enabled: !1 },
                scales: {
                    xAxes: [
                        {
                            categoryPercentage: 1,
                            barPercentage: 1,
                            barDatasetSpacing: 0,
                            display: !1,
                            barThickness: 5,
                            barRadius: 0,
                            gridLines: { color: "transparent", zeroLineColor: "transparent" },
                            ticks: { fontSize: 2, fontColor: "transparent" },
                        },
                    ],
                    yAxes: [{ display: !1, ticks: { display: !1 } }],
                },
                title: { display: !1 },
                elements: { point: { radius: 0 } },
            },
        });
    var e = document.getElementById("leadschart").getContext("2d");
    (e.height = 10),
        new Chart(e, {
            type: "line",
            data: {
                labels: ["Date 1", "Date 2", "Date 3", "Date 4", "Date 5", "Date 6", "Date 7", "Date 8", "Date 9", "Date 10", "Date 11", "Date 12", "Date 13", "Date 14", "Date 15"],
                datasets: [
                    {
                        label: "Total Sales",
                        data: [45, 23, 32, 67, 49, 72, 52, 55, 46, 54, 32, 74, 88, 36, 36, 32, 48, 54],
                        backgroundColor: "transparent",
                        borderColor: "#f46ef4",
                        borderWidth: "2.5",
                        pointBorderColor: "transparent",
                        pointBackgroundColor: "transparent",
                    },
                ],
            },
            options: {
                maintainAspectRatio: !1,
                legend: { display: !1 },
                responsive: !0,
                tooltips: { enabled: !1 },
                scales: {
                    xAxes: [
                        { categoryPercentage: 1, barPercentage: 1, barDatasetSpacing: 0, display: !1, barThickness: 5, gridLines: { color: "transparent", zeroLineColor: "transparent" }, ticks: { fontSize: 2, fontColor: "transparent" } },
                    ],
                    yAxes: [{ display: !1, ticks: { display: !1 } }],
                },
                title: { display: !1 },
            },
        });
    var e = document.getElementById("profitchart").getContext("2d");
    (e.height = 10),
        new Chart(e, {
            type: "bar",
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [
                    {
                        label: "Total Sales",
                        barGap: 0,
                        barSizeRatio: 1,
                        data: [14, 17, 12, 13, 11, 15, 16],
                        backgroundColor: "#4ecc48",
                        borderColor: "#4ecc48",
                        pointBackgroundColor: "#fff",
                        pointHoverBackgroundColor: "#4ecc48",
                        pointBorderColor: "#4ecc48",
                        pointHoverBorderColor: "#4ecc48",
                        pointBorderWidth: 2,
                        pointRadius: 2,
                        pointHoverRadius: 2,
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                maintainAspectRatio: !1,
                legend: { display: !1 },
                responsive: !0,
                tooltips: { enabled: !1 },
                scales: {
                    xAxes: [
                        { categoryPercentage: 1, barPercentage: 1, barDatasetSpacing: 0, display: !1, barThickness: 5, gridLines: { color: "transparent", zeroLineColor: "transparent" }, ticks: { fontSize: 2, fontColor: "transparent" } },
                    ],
                    yAxes: [{ display: !1, ticks: { display: !1 } }],
                },
                title: { display: !1 },
            },
        });
    var e = document.getElementById("costchart").getContext("2d");
    (e.height = 10),
        new Chart(e, {
            type: "line",
            data: {
                labels: ["Date 1", "Date 2", "Date 3", "Date 4", "Date 5", "Date 6", "Date 7", "Date 8", "Date 9", "Date 10", "Date 11", "Date 12", "Date 13", "Date 14", "Date 15", "Date 16", "Date 17"],
                datasets: [
                    {
                        label: "Total Sales",
                        data: [28, 56, 36, 32, 48, 54, 37, 58, 66, 53, 21, 24, 14, 45, 0, 32, 67, 49, 52, 55, 46, 54, 130],
                        backgroundColor: "transparent",
                        borderColor: "#f7ba48",
                        borderWidth: "2.5",
                        pointBorderColor: "transparent",
                        pointBackgroundColor: "transparent",
                    },
                ],
            },
            options: {
                maintainAspectRatio: !1,
                legend: { display: !1 },
                responsive: !0,
                tooltips: { enabled: !1 },
                scales: {
                    xAxes: [
                        { categoryPercentage: 1, barPercentage: 1, barDatasetSpacing: 0, display: !1, barThickness: 5, gridLines: { color: "transparent", zeroLineColor: "transparent" }, ticks: { fontSize: 2, fontColor: "transparent" } },
                    ],
                    yAxes: [{ display: !1, ticks: { display: !1 } }],
                },
                title: { display: !1 },
            },
        }),
        $("#data-table").DataTable({ order: [[0, "desc"]], order: [], columnDefs: [{ orderable: !1, targets: [0, 4, 5] }], language: { searchPlaceholder: "Search...", sSearch: "" } }),
        $(".select2").select2({ minimumResultsForSearch: 1 / 0 }),
        $("#world-map-markers1").vectorMap({
            map: "world_mill_en",
            scaleColors: ["#6c5ffc", "#e82646", "#05c3fb"],
            normalizeFunction: "polynomial",
            hoverOpacity: 0.7,
            hoverColor: !1,
            regionStyle: { initial: { fill: "#edf0f5" } },
            markerStyle: { initial: { r: 6, fill: "#6c5ffc", "fill-opacity": 0.9, stroke: "#fff", "stroke-width": 9, "stroke-opacity": 0.2 }, hover: { stroke: "#fff", "fill-opacity": 1, "stroke-width": 1.5 } },
            backgroundColor: "transparent",
            markers: [
                { latLng: [40.3, -101.38], name: "USA" },
                { latLng: [22.5, 1.51], name: "India" },
                { latLng: [50.02, 80.55], name: "Bahrain" },
                { latLng: [3.2, 73.22], name: "Maldives" },
                { latLng: [35.88, 14.5], name: "Malta" },
            ],
        });
});
