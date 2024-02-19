<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <br>
    <div class="container text-center">
        <h2 class="row justify-content-center">Video</h2>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row justify-content-end">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>
        @foreach ($videos as $video)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="position-relative d-inline-block">
                    <video width="640" height="360" controls class="card-img-top">
                        <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <form action="{{ route('video.destroy',$video->id) }}" method="POST" class="position-absolute" style="top: 10px; right: 10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>            
                    <div class="text-center mt-3">
                        <div class="text-left">
                            <div>{{ $video->caption }}</div>
                            <div style="font-size: 0.8em; color: #5f5d5d;">{{ $video->created_at->format('d F Y') }}</div>
                        </div>
                    </div>                       
                </div>
            </div>
        </div>
        <br>
        @endforeach
        <!-- Add button -->
        <div class="container text-center mt-4">
            <a class="btn btn-success" href="{{ route('video.create') }}">Add</a>
        </div>
    </div>
    <!-- <div class="container text-center mt-4"
 -->
            {{ $videos->links() }}
        <!-- </div>
    </div> -->
    
    
    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>

