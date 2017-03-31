<!DOCTYPE html>
<html>
<head>
	<title>Monthly Summary</title>
</head>
<body>
<h3>Import File From Database:</h3>
		    	<div style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;"> 		
			    	<a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success btn-lg">Download Excel xls</button></a>
					<a href="{{ url('downloadExcel/xlsx') }}"><button class="btn btn-success btn-lg">Download Excel xlsx</button></a>
					<a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-success btn-lg">Download CSV</button></a>
		    	</div>
</body>
</html>