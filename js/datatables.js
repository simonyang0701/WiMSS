
// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#manufactureReportDataTable').DataTable({
        "order": [[ 2, "desc" ]]
    });
	$('#CategoryReportDataTable').DataTable({
        "order": [[ 0, "asc" ]]
    });
	$('#RevenueCompareReportDataTable').DataTable({
        "order": [[ 8, "desc" ]]
    });
	$('#StoreRevenueReportDataTable').DataTable({
		"order": [[ 3, "asc" ], [ 4, "desc" ]]
	});
    $('#manufactureDetailDataTable').DataTable({
		"order": [[ 3, "asc" ]]
	});
    $('#GrandCategoryReportDataTable').DataTable({
		"order": [[ 0, "asc" ], [ 3, "desc" ]]
	});
	$('#GrandRevenueReportDataTable').DataTable({
		"order": [[ 0, "asc" ]]
	});
	$('#OutdoorFurnitureReportDataTable').DataTable({
		"order": [[ 0, "asc" ]]
	});
	$('#stateHighestReportDataTable').DataTable({
		"order": [[ 0, "asc" ]]
	});
	$('#RevenuebyPopulationReportDataTable').DataTable({
		"order": [[ 0, "asc" ]]
	});
	$('#storedetailDataTable').DataTable({
		"order": [[ 0, "asc" ]]
	});
});
  