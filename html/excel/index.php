<? include "../outline/_header.php"; ?>

<section class="col-lg-4 float-lg-none mg-auto pd-sm-20" id="select_view">
	<h1 class="c1">EN</h1>
	<div class="col-lg-12 btn c2 pd-sm-t5 pd-sm-l10 pd-sm-r10" onclick="pageView('en_last_name')">Last name upload</div>
	<div class="col-lg-12 btn c2 pd-sm-t5 pd-sm-l10 pd-sm-r10" onclick="pageView('en_first_name_male')">First name upload(male)</div>
	<div class="col-lg-12 btn c2 pd-sm-t5 pd-sm-l10 pd-sm-r10" onclick="pageView('en_first_name_female')">First name upload(female)</div>
</section>

<script type="text/javascript">
	function pageView(table) {
		var url = './upload.php?type='+table;
		location.href = url;
	}
</script>
