<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family:sans-serif;background:#fff">
		<h2 style="color:#c71444;">General Enquiry from the McCarthy Nissan website</h2>
		<br>
		<b>Dealership: </b>: {{ $dealer }}<br><br>
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
					<td style="padding:10px;background:#ebebeb;width:15%" valign="top"><b>Message:</b></td>
					<td style="padding:10px;background:#f7f7f7">{!! html_entity_decode(nl2br($message_body)) !!}</td>
				</tr>				
			</table>						
		</div>
	</body>
</html>
