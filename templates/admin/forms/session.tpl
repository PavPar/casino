           <form class="form form_type-admin" name="formReg" action="../../php/createSession.php">
                <input class="form__input" placeholder="Имя сессии" name="name" required>
                <input class="form__input" placeholder="Инфо" name="info">

                <select  class="form__input" name="game_id">
                    {OPTIONS}
              
                </select>
                 <select class="form__input" name="time" required>
            <option value="120">Через 2 минут</option>
            <option value="300">Через 5 минут</option>
            <option value="900">Через 15 минут</option>
            <option value="1800">Через полчаса</option>
            <option value="3600">Через час</option>
          </select>
                <button class="button button_type-home" type="submit">Добавить</button>
            </form>