jQuery(document).ready(function () {


    if ($("#pagination-activity")[0]) {
        $('#pagination-activity').pajinate({
            items_per_page: 9,
        });
    }
    ;

    if ($("#pagination-messages")[0]) {
        $('#pagination-messages').pajinate({
            items_per_page: 6,
        });
    }
    ;

    if ($("#pagination-todo")[0]) {

        function todoPagination() {
            $('#pagination-todo').pajinate({
                items_per_page: 11,
            });
        }

        todoPagination();

    }
    ;


// DataTables
// -------------------------------------------------------------------
// URL: http://www.datatables.net/
// -------------------------------------------------------------------

    if ($(".data-table")[0]) {

        $('.data-table').dataTable();

    }
    ;

// Tabs (bootstrap)
// -------------------------------------------------------------------
// URL: http://twitter.github.io/bootstrap/javascript.html#tabs
// -------------------------------------------------------------------

    $('.tab-container a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })

// Todo List
// -------------------------------------------------------------------
// URL: www.gnrsmsportal.com
// -------------------------------------------------------------------

    if ($(".todo")[0]) {

        function todoItemDone() {

            // Strikethrough item if is checkbox is clicked
            $('.todo .checkbox input').unbind('click');

            $('.todo .checkbox input').click(function () {
                console.log($(this));

                $(this).parent().toggleClass('checked');
                $(this).parent().parent().toggleClass('todo-done');

            });

        };

        $('.todo .todo-add').keypress(function (e) {

            // If enter is pressed, adds item
            if (e.which == 13) {

                var todoDescription = $(this).val();

                $(this).parent().parent().find(".pagination-content").prepend(
                    '<div class="item todo-new">'
                        + '<button type="button" class="close" data-dismiss="alert">&times;</button>'
                        + '<label class="checkbox">'
                        + '<input type="checkbox"> '
                        + '<i class="icon-asterisk"></i>'
                        + todoDescription
                        + '</label>'
                        + '</div>');

                todoItemDone();
                todoPagination();

                return false;
            }

        });

        todoItemDone();

    }
    ;

// WYSIWYG (bootstrap)
// -------------------------------------------------------------------
// URL: http://mindmup.github.io/bootstrap-wysiwyg/
// -------------------------------------------------------------------

    function initToolbarBootstrapBindings() {
        var fonts = ['Serif', 'Sans', 'Arial',
                'Courier New', 'Comic Sans MS', 'Helvetica',
                'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
        $.each(fonts, function (idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
        });
        $('a[title]').tooltip({container: 'body'});
        $('.dropdown-menu input').click(function () {
            return false;
        })
            .change(function () {
                $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function () {
                this.value = '';
                $(this).change();
            });

        $('[data-role=magic-overlay]').each(function () {
            var overlay = $(this), target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
        });
    };
    initToolbarBootstrapBindings();


    $(".top-bar div .top-bar-minimize").click(function () {
        $this = $(this).parent().parent().parent();
        if ($($this).find(".top-bar").hasClass("top-bar-closed")) {
            $($this).find(".top-bar").removeClass("top-bar-closed");
            $($this).find(".well").slideDown({duration: 1000, easing: 'easeOutBack'});
        }
        else {
            $($this).find(".well").slideUp('medium', function () {
                $(this).parent().find(".top-bar").addClass("top-bar-closed");
            });
        }
        ;

        return false;
    });
    /*
     $(".row-fluid").disableSelection();

     });
     */


// Flot Example
// -------------------------------------------------------------------
// URL: http://www.flotcharts.org
// -------------------------------------------------------------------

    if ($(".chart1")[0]) {

        // Example Data
        var d1 = [
            [1262304000000, 123],
            [1264982400000, 453],
            [1267401600000, 3894],
            [1270080000000, 9542],
            [1272672000000, 8323],
            [1275350400000, 9343],
            [1277942400000, 9232],
            [1280620800000, 8343],
            [1283299200000, 7343],
            [1285891200000, 3343],
            [1288569600000, 2322],
            [1291161600000, 2012]
        ];
        var d2 = [
            [1262304000000, 6],
            [1264982400000, 60],
            [1267401600000, 2043],
            [1270080000000, 2198],
            [1272672000000, 2660],
            [1275350400000, 2782],
            [1277942400000, 2430],
            [1280620800000, 2427],
            [1283299200000, 2100],
            [1285891200000, 1214],
            [1288569600000, 1057],
            [1291161600000, 1025]
        ];

        // Chart Finder
        $.plot($(".chart1"),
            [
                {
                    label: "Hits",
                    data: d1,
                    color: '#8dbdca',
                    shadowSize: 0
                },
                {
                    label: "Unique Hits",
                    data: d2,
                    color: '#eb8460',
                    shadowSize: 0
                }
            ], {
                xaxis: {
                    show: true,
                    min: (new Date(2009, 12, 1)).getTime(),
                    max: (new Date(2010, 11, 2)).getTime(),
                    mode: "time",
                    tickSize: [1, "month"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    tickLength: 1,
                    axisLabel: 'Month',
                    axisLabelFontSizePixels: 11
                },
                yaxis: {
                    axisLabel: 'Traffic',
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 11,
                    autoscaleMargin: 0.01,
                    axisLabelPadding: 5,
                    tickColor: "#d8d8d8"
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: { colors: [
                            { opacity: 0.04 },
                            { opacity: 0.18 }
                        ] },
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        radius: 3,
                        fill: true,
                        fillColor: "#f0f0f0",
                        symbol: "circle",
                        lineWidth: 2
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    borderWidth: 0,
                    color: "#939393",
                    labelMargin: 20
                },
                legend: {
                    show: false
                }
            });

        function showTooltip(x, y, contents) {
            $('<div class="tooltip bottom"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + contents + '</div></div>').css({
                top: y + 10,
                left: x - 58,
                'z-index': '9999',
                opacity: 0.9,
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $(".chart1").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(0));
            $("#y").text(pos.y.toFixed(0));

            if ($(".chart1").length > 0) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $(".tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        showTooltip(item.pageX, item.pageY,
                            "<strong>" + y + "</strong> " + item.series.label);
                    }
                }
                else {
                    $(".tooltip").remove();
                    previousPoint = null;
                }
            }
        });

        $(".chart1").bind("plotclick", function (event, pos, item) {
            if (item) {
                $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
                plot.highlight(item.series, item.datapoint);
            }
        });
    }
    ;


// Pie
    if ($(".pie1")[0]) {

        //some data
        var d1 = [];
        for (var i = 0; i <= 10; i += 1)
            d1.push([i, parseInt(Math.random() * 30)]);

        var d2 = [];
        for (var i = 0; i <= 10; i += 1)
            d2.push([i, parseInt(Math.random() * 30)]);

        var d3 = [];
        for (var i = 0; i <= 10; i += 1)
            d3.push([i, parseInt(Math.random() * 30)]);

        var ds = new Array();

        ds.push({
            label: "Expenses",
            data: d1,
            bars: {order: 1}
        });
        ds.push({
            label: "Sales",
            data: d2,
            bars: {order: 2}
        });
        ds.push({
            label: "Bonuses",
            data: d3,
            bars: {order: 3}
        });
        this.data = ds;

        jQuery.plot(jQuery(".pie1"), this.data, {
            colors: ['#88bbc8', '#eb815c', '#7fc18d', '#cea0db', '#bbd99b'],
            legend: {
                backgroundColor: "rgba(0,0,0,0)"
            },
            height: "100%",
            width: "100%",
            series: {
                pie: {
                    show: true,
                    innerRadius: 0.5,
                    stroke: {
                        color: "#f0f0f0",
                        width: 0.0
                    }
                }
            }
        });
    }
    ;

// Pie Chart 2
    if ($(".pie2")[0]) {

        //some data
        var d1 = [];
        for (var i = 0; i <= 10; i += 1)
            d1.push([i, parseInt(Math.random() * 30)]);

        var d2 = [];
        for (var i = 0; i <= 10; i += 1)
            d2.push([i, parseInt(Math.random() * 30)]);

        var d3 = [];
        for (var i = 0; i <= 10; i += 1)
            d3.push([i, parseInt(Math.random() * 30)]);

        var ds = new Array();

        ds.push({
            label: "Expenses",
            data: d1,
            bars: {order: 1}
        });
        ds.push({
            label: "Sales",
            data: d2,
            bars: {order: 2}
        });
        ds.push({
            label: "Bonuses",
            data: d3,
            bars: {order: 3}
        });
        this.data = ds;

        jQuery.plot(jQuery(".pie2"), this.data, {
            colors: ['#88bbc8', '#eb815c', '#7fc18d', '#cea0db', '#bbd99b'],

            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 2 / 3,
                        formatter: function (label, series) {
                            return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                        },
                        threshold: 0.1
                    }
                }
            },
            legend: {
                show: false
            }

        });

    }
    ;

// Realtime Chart
    if ($(".realtimechart")[0]) {

        $(function () {
            // we use an inline data source in the example, usually data would
            // be fetched from a server
            var data = [], totalPoints = 300;

            function getRandomData() {
                if (data.length > 0)
                    data = data.slice(1);

                // do a random walk
                while (data.length < totalPoints) {
                    var prev = data.length > 0 ? data[data.length - 1] : 50;
                    var y = prev + Math.random() * 10 - 5;
                    if (y < 0)
                        y = 0;
                    if (y > 100)
                        y = 100;
                    data.push(y);
                }

                // zip the generated y values with the x values
                var res = [];
                for (var i = 0; i < data.length; ++i)
                    res.push([i, data[i]])
                return res;
            }

            // graph interval
            var updateInterval = 30;

            // setup plot
            var options = {
                colors: ['#40c67f'],
                grid: {
                    borderWidth: 0,
                    color: "#939393"
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: { colors: [
                            { opacity: 0.04 },
                            { opacity: 0.18 }
                        ] },
                        lineWidth: 2
                    }, shadowSize: 0 }, // drawing is faster without shadows
                yaxis: { min: 0, max: 100 },
                xaxis: { show: false }
            };
            var plot = $.plot($(".realtimechart"), [ getRandomData() ], options);

            function update() {
                plot.setData([ getRandomData() ]);
                // since the axes don't change, we don't need to call plot.setupGrid()
                plot.draw();

                setTimeout(update, updateInterval);
            }

            update();
        });
    }
    ;


// Bars
    if ($(".bars1")[0]) {

        $(function () {

            //some data
            var d1 = [];
            for (var i = 0; i <= 10; i += 1)
                d1.push([i, parseInt(Math.random() * 30)]);

            var d2 = [];
            for (var i = 0; i <= 10; i += 1)
                d2.push([i, parseInt(Math.random() * 30)]);

            var d3 = [];
            for (var i = 0; i <= 10; i += 1)
                d3.push([i, parseInt(Math.random() * 30)]);

            var ds = new Array();

            ds.push({
                label: "Expenses",
                data: d1,
                bars: {order: 1}
            });
            ds.push({
                label: "Sales",
                data: d2,
                bars: {order: 2}
            });
            ds.push({
                label: "Bonuses",
                data: d3,
                bars: {order: 3}
            });
            this.data = ds;

            $.plot(".bars1", this.data, {
                colors: ['#88bbc8', '#eb815c', '#7fc18d', '#cea0db', '#bbd99b'],
                grid: {
                    borderWidth: 0,
                    color: "#939393"
                },
                legend: {
                    margin: 0,
                    noColumns: 3
                },
                series: {
                    bars: {
                        show: true,
                        barWidth: 0.15,
                        align: "center",
                        fillColor: { colors: [
                            { opacity: 1 },
                            { opacity: 1 }
                        ] },
                    }
                },
                xaxis: {
                    tickLength: 1,
                    mode: "categories",
                    ticks: [
                        [0, 'Jan'],
                        [1, 'Feb'],
                        [2, 'Mar'],
                        [3, 'Apr'],
                        [4, 'May'],
                        [5, 'Jun'],
                        [6, 'Jul'],
                        [7, 'Aug'],
                        [8, 'Sep'],
                        [9, 'Oct'],
                        [10, 'Nov'],
                        [11, 'Dec']
                    ]
                }
            });


        });

    }
    ;


// Tooltip (bootstrap)
// -------------------------------------------------------------------
// URL: http://bootstrap.twitter.com
// -------------------------------------------------------------------

    $("[rel='tooltip']").tooltip();

    $("[rel='tooltip']").each(function (index) {
        $(this).data('tooltip').options.placement = 'bottom';
    });

// Chosen
// -------------------------------------------------------------------
// URL: http://harvesthq.github.io/chosen/
// -------------------------------------------------------------------
//
//if ($("select")[0]){
//
//  $("select").chosen({disable_search_threshold: 10});
//
//};


});

