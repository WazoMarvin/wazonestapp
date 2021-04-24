@extends('beautymail::templates.minty')

@section('content')

	@include('beautymail::templates.minty.contentStart',['color' => '#ce153f'])
		<tr>
			<td class="title">
				Hello {{$admin}},
			</td>
		</tr>
		<tr>
			<td width="100%" height="10"></td>
		</tr>
		<tr>
			<td class="paragraph">
				{{$count}} new Customers have been registered. Attached is the pdf for more details
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"></td>
		</tr>
		
		<tr>
			<td>
				@include('beautymail::templates.minty.button', ['text' => 'Sign in', 'link' => 'https://wazonest.com/login','color' => '#ce153f'])
			</td>
		</tr>
		<tr>
			<td width="100%" height="25"></td>
		</tr>
	@include('beautymail::templates.minty.contentEnd')

@stop