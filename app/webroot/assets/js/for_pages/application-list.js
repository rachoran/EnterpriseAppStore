$(function() {
	$('#appTablePills a').click(function() {
		var h = this.href.substring(this.href.indexOf('#') + 1);
		if (h == 'all') {
			$('#appTable tbody tr').show();
		}
		else {
			$('#appTable tbody tr').hide();
			$('#appTable tbody tr.' + h).show();
		}
	});
});