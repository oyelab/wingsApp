/*
Template Name: webadmin - Admin & Dashboard Template
Author: Themesdesign
Website: https://Themesdesign.com/
Contact: Themesdesign@gmail.com
File: Dashboard Ecommerce
*/


function getChartColorsArray(chartId) {
  if (document.getElementById(chartId) !== null) {
    var colors = document.getElementById(chartId).getAttribute("data-colors");
    colors = JSON.parse(colors);
    return colors.map(function (value) {
      var newValue = value.replace(" ", "");
      if (newValue.indexOf("--") != -1) {
        var color = getComputedStyle(document.documentElement).getPropertyValue(
          newValue
        );
        if (color) return color;
      } else {
        return newValue;
      }
    });
  }
}

document.addEventListener('DOMContentLoaded', function () {
	// Fetch sales and orders data from backend
	fetch('/dashboard/monthly-data')
		.then(response => response.json())
		.then(data => {
			const salesData = data.sales; // Monthly sales data
			const ordersData = data.orders; // Monthly order counts

			console.log('Sales Data:', salesData); // Log sales data
			console.log('Orders Data:', ordersData); // Log orders data

			// Chart for sales data (mini-1)
			const salesColors = getChartColorsArray("mini-1");
			const salesChartOptions = {
				series: [{
					data: salesData, // Pass sales data to the chart
				}],
				chart: {
					type: 'area',
					width: 110,
					height: 35,
					sparkline: {
						enabled: true
					}
				},
				fill: {
					type: 'gradient',
					gradient: {
						shadeIntensity: 1,
						inverseColors: false,
						opacityFrom: 0.45,
						opacityTo: 0.05,
						stops: [20, 100, 100, 100]
					},
				},
				stroke: {
					curve: 'smooth',
					width: 2,
				},
				colors: salesColors,
				tooltip: {
					fixed: {
						enabled: false
					},
					x: {
						show: false
					},
					y: {
						title: {
							formatter: function () {
								return 'Sales';
							}
						}
					},
					marker: {
						show: false
					}
				}
			};

			const salesChart = new ApexCharts(document.querySelector("#mini-1"), salesChartOptions);
			salesChart.render();

			// Chart for orders data (mini-2)
			const ordersColors = getChartColorsArray("mini-2");
			const ordersChartOptions = {
				series: [{
					data: ordersData, // Pass orders data to the chart
				}],
				chart: {
					type: 'area',
					width: 110,
					height: 35,
					sparkline: {
						enabled: true
					}
				},
				fill: {
					type: 'gradient',
					gradient: {
						shadeIntensity: 1,
						inverseColors: false,
						opacityFrom: 0.45,
						opacityTo: 0.05,
						stops: [20, 100, 100, 100]
					},
				},
				stroke: {
					curve: 'smooth',
					width: 2,
				},
				colors: ordersColors,
				tooltip: {
					fixed: {
						enabled: false
					},
					x: {
						show: false
					},
					y: {
						title: {
							formatter: function () {
								return 'Orders';
							}
						}
					},
					marker: {
						show: false
					}
				}
			};

			const ordersChart = new ApexCharts(document.querySelector("#mini-2"), ordersChartOptions);
			ordersChart.render();
		})
		.catch(error => console.error('Error fetching sales and orders data:', error));
});


// Chart Mini-3
var barchartColors = getChartColorsArray("mini-3");
  var sparklineoptions1 = {
    series: [{
      data: [12, 75, 2, 47, 42, 15, 47, 75, 65, 19, 14]
    }],
    chart: {
      type: 'area',
      width: 110,
      height: 35,
      sparkline: {
        enabled: true
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        inverseColors: false,
        opacityFrom: 0.45,
        opacityTo: 0.05,
        stops: [20, 100, 100, 100]
      },
    },
    stroke: {
      curve: 'smooth',
      width: 2,
    },
    colors: barchartColors,
    tooltip: {
      fixed: {
        enabled: false
      },
      x: {
        show: false
      },
      y: {
        title: {
          formatter: function (seriesName) {
            return ''
          }
        }
      },
      marker: {
        show: false
      }
    }
  };
  
  var sparklinechart1 = new ApexCharts(document.querySelector("#mini-3"), sparklineoptions1);
  sparklinechart1.render();

  // Chart Mini-4
  var barchartColors = getChartColorsArray("mini-4");
var sparklineoptions1 = {
    series: [{
      data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 70]
    }],
    chart: {
      type: 'area',
      width: 110,
      height: 35,
      sparkline: {
        enabled: true
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        inverseColors: false,
        opacityFrom: 0.45,
        opacityTo: 0.05,
        stops: [20, 100, 100, 100]
      },
    },
    stroke: {
      curve: 'smooth',
      width: 2,
    },
    colors: barchartColors,
    tooltip: {
      fixed: {
        enabled: false
      },
      x: {
        show: false
      },
      y: {
        title: {
          formatter: function (seriesName) {
            return ''
          }
        }
      },
      marker: {
        show: false
      }
    }
  };
  
  var sparklinechart1 = new ApexCharts(document.querySelector("#mini-4"), sparklineoptions1);
  sparklinechart1.render();

  
  document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from the updated route
    axios.get('/dashboard/monthly-data')
        .then(function (response) {
            // Extract sales data from the response
            const salesData = response.data.sales; // Access "sales" data from the response
            const orderData = response.data.orders; // Access "orders" data from the response

            // Define the threshold for dynamic coloring
            const threshold = 10000;

            // Generate dynamic colors based on the sales threshold
            const dynamicColors = salesData.map(amount => amount > threshold ? '#1f58c7' : '#e6ecf9');

            // Define chart options
            const options = {
                series: [{
                    name: 'Amount',
                    data: salesData,
                }],
                chart: {
                    toolbar: { show: false },
                    height: 323,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        columnWidth: '80%',
                        distributed: true, // Use different colors for each bar
                        horizontal: false,
                        borderRadius: 8,
                    },
                },
                fill: { opacity: 1 },
                stroke: { show: false },
                dataLabels: { enabled: false },
                legend: { show: false },
                colors: dynamicColors, // Apply dynamic colors to bars
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: {
                        style: {
                            fontSize: '12px',
                            colors: ['#6c757d'], // Optional: Customize label colors
                        },
                    },
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return value.toLocaleString(); // Format numbers for better readability
                        },
                        style: {
                            fontSize: '12px',
                            colors: ['#6c757d'],
                        },
                    },
                },
            };

            // Render the chart
            const chart = new ApexCharts(document.querySelector("#overview"), options);
            chart.render();

            // Optionally log order data for further use
            console.log("Order Data:", orderData);
        })
        .catch(function (error) {
            console.error("Error fetching monthly data:", error);
        });
});


// Saleing Categories

var barchartColors = getChartColorsArray("saleing-categories");
var options = {
  chart: {
      height: 350,
      type: 'donut',
  }, 
  series: [24, 18, 13, 15],
  labels: ["Fashion", "Beauty", "Clothing", "Others"],
  colors: barchartColors,
  plotOptions: {
        pie: {
          startAngle: 25,
          donut: {
            size: '72%',
            labels: {
              show: true,
              total: {
                show: true,
                label: 'Products',
                fontSize: '22px',
                fontFamily: 'Montserrat,sans-serif',
                fontWeight: 600,
              }
            }
          }
        }
  },

  legend: {
      show: false,
      position: 'bottom',
      horizontalAlign: 'center',
      verticalAlign: 'middle',
      floating: false,
      fontSize: '14px',
      offsetX: 0,
      
  },

  dataLabels: {
        style: {
          fontSize: '11px',
          fontFamily: 'Montserrat,sans-serif',
          fontWeight: 'bold',
          colors: undefined
         },
    
        background: {
          enabled: true,
          foreColor: '#fff',
          padding: 4,
          borderRadius: 2,
          borderWidth: 1,
          borderColor: '#fff',
          opacity: 1,
        },
  },
  responsive: [{
      breakpoint: 600,
      options: {
          chart: {
              height: 240
          },
          legend: {
              show: false
          },
      }
  }]
  }
  
  var chart = new ApexCharts(
  document.querySelector("#saleing-categories"),
  options
  );
  
  chart.render();

// world map with markers
var worldemapmarkers = new jsVectorMap({
	map: 'world_merc',
	selector: '#world-map-markers',
	zoomOnScroll: false,
	zoomButtons: false,
	selectedMarkers: [0, 2],
	markersSelectable: true,
  regionStyle : {
    initial : {
        fill : '#cfd9ed'
    }
},
	markers:[
	  { name: "United States", coords: [31.9474,35.2272] },
	  { name: "Italy", coords: [61.524,105.3188] },
	  { name: "French", coords: [56.1304,-106.3468] },
	  { name: "Spain", coords: [71.7069,-42.6043] },
	],
	markerStyle:{
	  initial: { fill: "#1f58c7" },
	  selected: { fill: "#1f58c7" }
	},
	labels: {
	  	markers: {
			render: function(marker){
				return marker.name
			}
	  	}
	}
})