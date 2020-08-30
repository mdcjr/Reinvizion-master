@extends('emails.maintemplate')
@section('content')
<div>
	<h4>  From: <?php echo $data['sender']; ?> </h4>
	<p> <?php echo $data['content'] ?> </p>
</div>
@stop
