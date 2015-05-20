<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family:sans-serif;background:#fff">
		<h2 style="color:#c71444;">New Car Enquiry from the McCarthy Nissan website</h2>
		<br>
		<b>Dealership: </b>: {{ $dealership }}<br><br>
		<div>
			<table width="100%">
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Name:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $firstname }} {{ $surname }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Email:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $email }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Tel:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $tel }}</td>
				</tr>				
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Date:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $date }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Time:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $time }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:100%" colspan="2"><b>Vehicle details</b></td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Car:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $car }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Version:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $version }}</td>
				</tr>							
			</table>						
		</div>
	</body>
</html>
