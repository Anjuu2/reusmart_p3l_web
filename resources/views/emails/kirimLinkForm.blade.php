<!DOCTYPE html>
<html>
<head>
  <title>Kirim Link</title>
  <!-- CSS/JS -->
</head>
<body>
  <form action="{{ route('kirim.link') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label>Email tujuan</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Link</label>
      <input type="url" name="link" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Link</button>
  </form>
</body>
</html>
