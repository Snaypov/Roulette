<form action="{{ route('create.game') }}" method="POST">
    @csrf
    <div class="container">
        <div class="alert-danger"> {{ session('error') }} </div>
        <div class="form-group">
            <label for="gamers">Выберите количество игроков: </label>
            <select name="gamers" id="gamers">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="players">
            <div class="form-group mt-3" id="1">
                <label for="player1">Игрок 1</label>
                <input type="text" name="player1">
            </div>
            <div class="form-group mt-3" id="2">
                <label for="player2">Игрок 2</label>
                <input type="text" name="player2">
            </div>
        </div>

        <button style="margin-top: 5px" type="submit">Создать игру</button>
    </div>
</form>
