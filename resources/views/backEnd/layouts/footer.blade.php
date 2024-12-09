<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Wings Sportswear.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Crafted with <i class="mdi mdi-heart text-danger"></i> by 
					@foreach($assets->filter(fn($asset) => $asset->type === 0) as $asset)
						<a href="{{ $asset->url }}" target="_blank">
							<img src="{{ $asset->filePath }}" draggable="false" height="20" class="auth-logo-light"
							alt="{{ $asset->title }}" />
						</a>
					@endforeach
                </div>
            </div>
        </div>
    </div>
</footer>