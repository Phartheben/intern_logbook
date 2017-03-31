@extends('show')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Display Picture</div>
				<table>
					<tr></tr>

				<table class="table"></table>
					<tr>
						<td>Description</td>
						<td>Date</td>
					</tr>
					<?php
						foreach ($activity as $activity) {
						?>
						<tr>
						<td><?php echo $activity->description ?></td>
						<td><?php echo $activity->date ?></td>

						</tr>
						<?php  
						}
						?>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection