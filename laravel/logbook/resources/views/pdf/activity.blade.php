<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    padding: 5px;
}
table {
    border-spacing: 15px;
}
</style>
	<title></title>
</head>
<body>
<h1>Monthly Summary</h1>
<table style="width:100%">
	<thead>
	<tr>
	<th>Description</th>
	<th>Date</th>
	<th>User</th>	
	</tr>
	</thead>
	<tbody>
	@foreach($activities as $key => $activity)
		<tr>
			<td>{{$activity->description}}</td>
			<td>{{$activity->date}}</td>
			<td>{{$activity->user_id}}</td>
		</tr>
	@endforeach	
	</tbody>
</table>
</body>
</html>