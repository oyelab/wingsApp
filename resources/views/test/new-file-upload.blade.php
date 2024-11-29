@extends('frontEnd.layouts.app')
@section('content')
<div class="container">
  <div class="content section-padding">
    <form id="uploadForm" action="/new-file-upload" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
		<input type="file" accept="image/*" name="file" onchange="handleImageUpload(event);">
      </div>
      <button class="form-control btn btn-success" type="submit">Submit</button>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<!-- Load compress.js (non-module version) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@xkeshi/compress.js/dist/compress.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.1/dist/browser-image-compression.js"></script>


<script>
 async function handleImageUpload(event) {

const imageFile = event.target.files[0];
console.log('originalFile instanceof Blob', imageFile instanceof Blob); // true
console.log(`originalFile size ${imageFile.size / 1024 / 1024} MB`);

const options = {
  maxSizeMB: 1,
  maxWidthOrHeight: 1920,
  useWebWorker: true,
}
try {
  const compressedFile = await imageCompression(imageFile, options);
  console.log('compressedFile instanceof Blob', compressedFile instanceof Blob); // true
  console.log(`compressedFile size ${compressedFile.size / 1024 / 1024} MB`); // smaller than maxSizeMB

  await uploadToServer(compressedFile); // write your own logic
} catch (error) {
  console.log(error);
}
 }

</script>
@endsection
