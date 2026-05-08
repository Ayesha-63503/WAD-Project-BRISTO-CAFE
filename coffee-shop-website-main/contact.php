<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Contact Us</h1>
    <p>Have questions? Send us a message!</p>

    <form>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea class="form-control" rows="4"></textarea>
        </div>

        <button class="btn btn-dark">Send Message</button>
    </form>
</div>

</body>
</html>