<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family:sans-serif;background:#fff">
		<h2 style="color:#c71444;">Parts Enquiry from the McCarthy Nissan website</h2>
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
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Make:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $make }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Model:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $model }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Series:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $series }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Year:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $year }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Parts info:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $parts_info }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:100%" colspan="2"><b>Preferences</b></td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Dealership:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $dealership }}</td>
				</tr>
				<tr>
					<td style="padding:10px;background:#ebebeb;width:15%"><b>Contact time:</b></td>
					<td style="padding:10px;background:#f7f7f7">{{ $contact_time }}</td>
				</tr>						
			</table>						
		</div>
	</body>
</html>
