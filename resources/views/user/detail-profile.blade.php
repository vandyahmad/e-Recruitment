@extends('user.profile-pelamar')
<script>
    function updateFileName() {
        // document.getElementById('fileLabel').innerText = "Rudy";
        var fileName = document.getElementById('upload_file').files[0].name;
        // alert(fileName)
        // console.log(document.getElementById('fileLabel').innerText);
        document.getElementById('fileLabel').innerText = fileName;
    }
</script>

@section('user-content')

<html>


@if($acceptedPelamarExists)


<!-- jika pelamar->accepted-> tampilkan data employee -->
@include('user.data-employee')

@else

<!-- jika pelamar->accepted-> tampilkan data pelamar -->
@include('user.data-pelamar')

@endif

</html>

@endsection