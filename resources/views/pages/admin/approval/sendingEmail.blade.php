<form action="/kirim" method="post">
    @csrf
        <input type="text" name="email">
        <textarea name="pesan" id="" cols="30" rows="10"></textarea>
        <button>Kirim</button>
</form>