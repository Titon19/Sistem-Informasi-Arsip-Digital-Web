<!-- Existing footer code -->
</div>

<script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/wow.min.js"></script>
<script src="../assets/js/jquery-price-slider.js"></script>
<script src="../assets/js/jquery.meanmenu.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/jquery.sticky.js"></script>
<script src="../assets/js/jquery.scrollUp.min.js"></script>
<script src="../assets/js/counterup/jquery.counterup.min.js"></script>
<script src="../assets/js/counterup/waypoints.min.js"></script>
<script src="../assets/js/counterup/counterup-active.js"></script>
<script src="../assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../assets/js/scrollbar/mCustomScrollbar-active.js"></script>
<script src="../assets/js/metisMenu/metisMenu.min.js"></script>
<script src="../assets/js/metisMenu/metisMenu-active.js"></script>
<script src="../assets/js/morrisjs/raphael-min.js"></script>
<script src="../assets/js/morrisjs/morris.js"></script>
<script src="../assets/js/morrisjs/morris-active.js"></script>
<script src="../assets/js/sparkline/jquery.sparkline.min.js"></script>
<script src="../assets/js/sparkline/jquery.charts-sparkline.js"></script>
<script src="../assets/js/sparkline/sparkline-active.js"></script>
<script src="../assets/js/calendar/moment.min.js"></script>
<script src="../assets/js/calendar/fullcalendar.min.js"></script>
<script src="../assets/js/calendar/fullcalendar-active.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/DataTables/datatables.js"></script>
<script src="../assets/js/pdf/jquery.media.js"></script>
<script src="../assets/js/pdf/pdf-active.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$('.table-datatable').DataTable();

		// Grafik Unduhan Arsip
		Morris.Area({
			element: 'extra-area-chart',
			data: [
				<?php
				$dateBegin = strtotime("first day of this month");
				$dateEnd = strtotime("last day of this month");

				$awal = date("Y-m-d", $dateBegin);
				$akhir = date("Y-m-d", $dateEnd);

				$arsip = mysqli_query($koneksi, "SELECT * FROM riwayat WHERE date(riwayat_waktu) >= '$awal' AND date(riwayat_waktu) <= '$akhir'");
				$data = [];
				while ($p = mysqli_fetch_array($arsip)) {
					$tgl = date('Y-m-d', strtotime($p['riwayat_waktu']));
					$jumlah = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM riwayat WHERE date(riwayat_waktu)='$tgl'");
					$j = mysqli_fetch_assoc($jumlah)['total'];
					$data[] = [
						'period' => $tgl,
						'Unduh' => $j
					];
				}

				foreach ($data as $index => $item) {
					echo ($index ? ',' : '') . '{ period: "' . $item['period'] . '", Unduh: ' . $item['Unduh'] . ' }';
				}
				?>
			],
			xkey: 'period',
			ykeys: ['Unduh'],
			labels: ['Unduh'],
			xLabels: 'day',
			xLabelAngle: 45,
			pointSize: 3,
			fillOpacity: 0,
			pointStrokeColors: ['#006DF0'],
			behaveLikeLine: true,
			gridLineColor: '#e0e0e0',
			lineWidth: 1,
			hideHover: 'auto',
			lineColors: ['#006DF0'],
			resize: true
		});

		// Grafik Preview Arsip Perhari
		Morris.Area({
			element: 'morris-area-chart',
			data: [
				<?php
				$preview = mysqli_query($koneksi, "SELECT * FROM riwayat_preview WHERE date(riwayat_preview_waktu) >= '$awal' AND date(riwayat_preview_waktu) <= '$akhir'");
				$data_preview = [];
				while ($p = mysqli_fetch_array($preview)) {
					$tgl = date('Y-m-d', strtotime($p['riwayat_preview_waktu']));
					$jumlah_preview = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM riwayat_preview WHERE date(riwayat_preview_waktu)='$tgl'");
					$j_preview = mysqli_fetch_assoc($jumlah_preview)['total'];
					$data_preview[] = [
						'period' => $tgl,
						'Preview' => $j_preview
					];
				}

				foreach ($data_preview as $index => $item) {
					echo ($index ? ',' : '') . '{ period: "' . $item['period'] . '", Preview: ' . $item['Preview'] . ' }';
				}
				?>
			],
			xkey: 'period',
			ykeys: ['Preview'],
			labels: ['Preview'],
			xLabels: 'day',
			xLabelAngle: 45,
			pointSize: 3,
			fillOpacity: 0,
			pointStrokeColors: ['#ff0000'],
			behaveLikeLine: true,
			gridLineColor: '#e0e0e0',
			lineWidth: 1,
			hideHover: 'auto',
			lineColors: ['#ff0000'],
			resize: true
		});
	});
</script>
</body>

</html>