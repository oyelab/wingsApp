<div class="size-guid-area">
	<div class="top-part d-flex align-items-center justify-content-between">
		<h2>Size Guide (Inch)</h2>
	</div>
	<div class="size-chart-wrap">
		<div class="tab-content" id="myTabContent">
			<div
				class="tab-pane fade show active"
				id="in-pane"
				role="tabpanel"
				aria-labelledby="in"
				tabindex="0"
			>
				<table class="size-table">
					<tr>
						<th>SIZES</th>
						@foreach ($sizes as $size)
							<td>{{ $size }}</td>
						@endforeach
					</tr>
					<tr>
						<th>CHEST</th>
						@foreach ($chests as $chest)
							<td>{{ $chest }}</td>
						@endforeach
					</tr>
					<tr>
						<th>LENGTH</th>
						@foreach ($lengths as $length)
							<td>{{ $length }}</td>
						@endforeach
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>