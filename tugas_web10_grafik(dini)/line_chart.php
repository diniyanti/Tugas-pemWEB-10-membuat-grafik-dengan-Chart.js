<?php
// menyertakan file koneksi.php untuk koneksi ke database
include('koneksi.php');
//mengambil data pada tabel tb_covid
$covid = mysqli_query($koneksi,"SELECT * FROM covid_data");
while($row = mysqli_fetch_array($covid)){
	// array untuk menyimpan hasil query baris 5
	$country[] = $row['country'];
	$total_cases[] = $row['total_cases'];
    $total_deaths[] = $row['total_deaths'];
    $total_recovered[] = $row['total_recovered'];
    $active_cases[] = $row['active_cases'];
    $total_tests[] = $row['total_tests'];
    $population[] = $row['population'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Grafik Line Penderita Covid-19 di 10 Negara </title>
	<!-- memanggil file Chart.js -->
	<script type="text/javascript" src="Chart.js"></script>
    <!-- pengaturan style untuk body dan h1 -->
	<style>
        body {background-color:#FFEFD5; 
			  width: 100%;
			  margin: auto;			  
             }
        h1 {
            text-align: center;
            font-family: tahoma;
            color:black;
            background-color: #FA8072;
        } 
    </style>
</head>
<h1> GRAFIK LINE PENDERITA COVID-19 </h1>
<body>
	<div style="width: 100%;height: 100%">
		<!-- membuat grafik dengan id myChart -->
		<canvas id="myChart"></canvas>
	</div>
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			// tipe chart adalah line
			type: 'line',
			data: {
				// membuat label pada chart/grafik yang berisi nama negara
				labels: <?php echo json_encode($country); ?>,
				datasets: [
                    {
                    // menghilangkan blok warna di bawah garis
                    fill: false, 
					label: 'Total Cases ',
					// bagian data dari chart berisi total kasus
					data: <?php echo json_encode($total_cases); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(147, 112, 219)',
					//memodifikasi border pada chart
					borderColor:  'rgba(186, 85, 211)',
					borderWidth: 3
				    },

                    {
                    // menghilangkan blok warna di bawah garis
                    fill: false, 
					label: 'Total Deaths ',
					// bagian data dari chart berisi kasus baru
					data: <?php echo json_encode($total_deaths); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(255, 0, 0)',
					//memodifikasi border pada chart
					borderColor: 'rgb(255, 255, 0)',
					borderWidth: 3
				    },

                    {
                    // menghilangkan blok warna di bawah garis
                    fill: false, 
					label: 'Total Recovered ',
					// bagian data dari chart berisi total kematian
					data: <?php echo json_encode($total_recovered); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					//memodifikasi border pada chart
					borderColor:  'rgba(255,99,132,1)',
					borderWidth: 3
				    },

                    {
                    // menghilangkan blok warna di bawah garis
                    fill: false, 
					label: 'Active Cases ',
					// bagian data dari chart berisi kematian baru
					data: <?php echo json_encode($active_cases); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(173, 255, 48)',
					//memodifikasi border pada chart
					borderColor: 'rgba(27, 128, 1)',
					borderWidth: 3
				    },

                    {
                    // menghilangkan blok warna di bawah garis
                    fill: false, 
					label: 'Total Tests ',
					// bagian data dari chart berisi total kesembuhan
					data: <?php echo json_encode($total_tests); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(251, 127, 80)',
					//memodifikasi border pada chart
					borderColor:  'rgba(210, 105, 30)',
					borderWidth: 3
				    },

                    {
                    // menghilangkan blok warna di bawah garis
                    fill: false, 
					label: 'Population ',
					// bagian data dari chart berisi kasus aktif
					data: <?php echo json_encode($population); ?>,
					// memberi warna pada chart
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					//memodifikasi border pada chart
					borderColor: 'rgba(75, 192, 192, 1)',
					borderWidth: 3
				    },
                ]
			},
			options: {
                //membuat garis tegak
				elements: {
			        line: {
			            tension: 0
			        }
			    },
				legend: {
					display: true
				},
				barValueSpacing: 25,

				scales: {
                    xAxes: [{
						gridLines: {
							//mengatur baris vertikal berwarna hitam
							color: "rgba(0, 0, 0, 0)",
						}
					}],

					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]

				}
			}
		});
	</script>
</body>
</html>